<?php

namespace Bozboz\Ecommerce\Shipping;

use Bozboz\Admin\Base\Model;

class ShippingMethod extends Model
{
	protected $fillable = ['name', 'is_default', 'shipping_band_id'];

	public function getValidator()
	{
		return new ShippingMethodValidator;
	}

	public function band()
	{
		return $this->belongsTo(ShippingBand::class, 'shipping_band_id');
	}

	public function costs()
	{
		return $this->hasMany(__NAMESPACE__ . '\ShippingCost', 'shipping_method_id');
	}
}
