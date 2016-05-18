<?php

namespace Bozboz\Ecommerce\Shipping;

use Bozboz\Admin\Base\ModelAdminDecorator;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Ecommerce\Products\Pricing\PriceField;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ShippingCostDecorator extends ModelAdminDecorator
{
	public function __construct(ShippingCost $model)
	{
		parent::__construct($model);
	}

	public function getColumns($instance)
	{
		// Todo: implement
	}

	public function getFields($instance)
	{
		return [
			new SelectField('shipping_method_id', [
				'label' => 'Shipping Method',
				'options' => $instance->method()->getRelated()->pluck('name', 'id')
			]),
			new SelectField('country', [
				'options' => [null => 'Select'] + DB::table('countries')->pluck('country', 'code')
			]),
			new SelectField('region', [
				'options' => [null => 'Select'] + DB::table('regions')->pluck('region', 'code')
			]),
			new TextField('from_weight'),
			new PriceField('price'),
		];
	}

	public function getLabel($instance)
	{
		$where = $instance->country ? $instance->country : $instance->region;

		return sprintf('%s%s - %s',
			$where ? $where : '-',
			$instance->from_weight ? sprintf(' (wt.: %s)', $instance->from_weight) : null,
			format_money($instance->price_pence_ex_vat)
		);
	}

	/**
	 * @param  array  $attributes
	 * @return Bozboz\Admin\Models\Base
	 */
	public function newModelInstance($attributes = array())
	{
		$data = [];

		if (array_key_exists('method', $attributes)) {
			$data[$this->model->method()->getForeignKey()] = $attributes['method'];
		}

		return $this->model->newInstance($data);
	}

	public function getCreateForMethodUrl($instance)
	{
		return URL::action('\Bozboz\Ecommerce\Shipping\Http\Controllers\Admin\ShippingCostController@createForMethod', [
			'method' => $instance->getKey()
		]);
	}
}
