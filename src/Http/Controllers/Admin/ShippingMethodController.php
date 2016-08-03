<?php

namespace Bozboz\Ecommerce\Shipping\Http\Controllers\Admin;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Admin\Reports\Actions\CreateAction;
use Bozboz\Admin\Reports\Actions\Permissions\IsValid;
use Bozboz\Admin\Reports\Actions\Presenters\Link;
use Bozboz\Admin\Reports\Actions\Presenters\Urls\Custom;
use Bozboz\Admin\Reports\Report;
use Bozboz\Ecommerce\Shipping\ShippingMethodDecorator;

class ShippingMethodController extends ModelAdminController
{
	private $bands;
	protected $useActions = true;

	public function __construct(ShippingMethodDecorator $decorator, ShippingBandController $bands)
	{
		$this->bands = $bands;
		parent::__construct($decorator);
	}

	protected function getReportActions()
	{
		return [
			$this->actions->create(
				$this->getActionName('create'),
				[$this, 'canCreate'],
				'New ' . $this->decorator->getHeading(),
				['class' => 'space-left pull-right btn btn-sm- btn-success']
			),
			$this->actions->create(
				$this->bands->getActionName('create'),
				[$this->bands, 'canCreate'],
				'New ' . $this->bands->decorator->getHeading()
			),
		];
	}

	protected function getRowActions()
	{
		return array_merge([
			$this->actions->custom(
				new Link(
					'\Bozboz\Ecommerce\Shipping\Http\Controllers\Admin\ShippingCostController@createForMethod',
					'Add Cost',
					'fa fa-plus',
					['class' => 'btn-success']
				),
				new IsValid([$this, 'canCreate'])
			),
		], parent::getRowActions());
	}

    public function viewPermissions($stack)
    {
        $stack->add('ecommerce');
    }

    public function createPermissions($stack, $instance)
    {
        $stack->add('ecommerce', $instance);
    }

    public function editPermissions($stack, $instance)
    {
        $stack->add('ecommerce', $instance);
    }

    public function deletePermissions($stack, $instance)
    {
        $stack->add('ecommerce', $instance);
    }
}
