<?php

namespace Bozboz\Ecommerce\Shipping;

interface Shippable
{
    /**
     * Fetch ShippingBand relation
     *
     * @return Bozboz\Ecommerce\Shipping\ShippingBand
     */
    public function ShippingBand();
}