<?php

namespace Bozboz\Ecommerce\Shipping;

use Bozboz\Admin\Base\Model;
use Bozboz\StandardValidator;

class ShippingBand extends Model
{
	protected $fillable = ['name'];

	public function getValidator()
	{
		return new ShippingBandValidator;
	}

	public function methods()
	{
		return $this->hasMany(ShippingMethod::class);
	}

	public function orderableMethods()
	{
		return $this->hasMany(OrderableShippingMethod::class);
	}
}
