<?php

namespace Bozboz\Ecommerce\Shipping\Http\Controllers\Admin;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Ecommerce\Shipping\ShippingCostDecorator;
use Illuminate\Support\Facades\Redirect;

class ShippingCostController extends ModelAdminController
{
	public function __construct(ShippingCostDecorator $decorator)
	{
		parent::__construct($decorator);
	}

	public function index()
	{
		return Redirect::route('admin.shipping.index');
	}

	public function createForMethod($methodId)
	{
	    $instance = $this->decorator->newModelInstance(['method' => $methodId]);

	    return $this->renderFormFor($instance, $this->createView, 'POST', 'store');
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
