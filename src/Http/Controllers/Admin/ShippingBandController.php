<?php

namespace Bozboz\Ecommerce\Shipping\Http\Controllers\Admin;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Admin\Reports\Report;
use Bozboz\Ecommerce\Shipping\ShippingBandDecorator;
use Illuminate\Support\Facades\Redirect;

class ShippingBandController extends ModelAdminController
{
	public function __construct(ShippingBandDecorator $decorator)
	{
		parent::__construct($decorator);
	}

    protected function getSuccessResponse($instance)
    {
        return Redirect::action('\Bozboz\Ecommerce\Shipping\Http\Controllers\Admin\ShippingMethodController@index');
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
