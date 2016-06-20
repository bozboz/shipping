<?php

namespace Bozboz\Ecommerce\Shipping;

use Bozboz\Admin\Base\ModelAdminDecorator;
use Bozboz\Admin\Fields\BelongsToField;
use Bozboz\Admin\Fields\CheckboxField;
use Bozboz\Admin\Fields\TextField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use HTML;

class ShippingMethodDecorator extends ModelAdminDecorator
{
	protected $shippingCost;
	protected $shippingBand;

	public function __construct(ShippingMethod $model, ShippingCostDecorator $cost, ShippingBandDecorator $band)
	{
		$this->shippingCost = $cost;
		$this->shippingBand = $band;

		parent::__construct($model);
	}

	public function getFields($instance)
	{
		return [
			new TextField('name'),
			new BelongsToField($this->shippingBand, $instance->band()),
			new CheckboxField('is_default')
		];
	}

	public function getColumns($instance)
	{
		return [
			'Name' => $instance->name . ($instance->is_default ? ' <strong>(x)</strong>' : ''),
			'Band' => $instance->band ? $instance->band->name : '-',
			'Costs' => $this->getCosts($instance),
		];
	}

	private function getCosts($instance)
	{
		$costsList = implode(PHP_EOL, $instance->costs->map(function($cost) {
			return '<li>' . HTML::linkRoute(
				'admin.shipping.costs.edit',
				$this->shippingCost->getLabel($cost),
				[ $cost->id ]
			) . '</li>';
		})->all());

		return "<ul class=\"secret-list\">{$costsList}</ul>";
	}

	public function getLabel($instance)
	{
		return $instance->name;
	}

	public function modifyListingQuery(Builder $query)
	{
		$query
			->with('costs', 'band')
			->orderBy('shipping_band_id')
			->orderBy('is_default', 'DESC')
			->orderBy('name', 'ASC');
	}
}
