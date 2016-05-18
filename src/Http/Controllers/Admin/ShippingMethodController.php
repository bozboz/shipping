<?php

namespace Bozboz\Ecommerce\Shipping\Http\Controllers\Admin;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Admin\Reports\Actions\CreateAction;
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
			new CreateAction(
				$this->getActionName('create'),
				[$this, 'canCreate'],
				['label' => 'New ' . $this->decorator->getHeading(), 'class' => 'space-left pull-right btn btn-sm- btn-success']
			),
			new CreateAction(
				$this->bands->getActionName('create'),
				[$this->bands, 'canCreate'],
				['label' => 'New ' . $this->bands->decorator->getHeading()]
			),
		];
	}

	protected function getRowActions()
	{
		return array_merge([
			// new CreateAction(),
		], parent::getRowActions());
	}
}
