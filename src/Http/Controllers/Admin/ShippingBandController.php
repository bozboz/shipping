<?php

namespace Bozboz\Ecommerce\Shipping\Http\Controllers\Admin;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Admin\Reports\Report;
use Bozboz\Ecommerce\Shipping\ShippingBandDecorator;

class ShippingBandController extends ModelAdminController
{
	public function __construct(ShippingBandDecorator $decorator)
	{
		parent::__construct($decorator);
	}
}
