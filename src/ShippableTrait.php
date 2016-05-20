<?php

namespace Bozboz\Ecommerce\Shipping;

trait ShippableTrait
{
    /**
     * Fetch ShippingBand relation
     *
     * @return Bozboz\Ecommerce\Shipping\ShippingBand
     */
    public function shippingBand()
    {
        return $this->belongsTo(ShippingBand::class);
    }
}