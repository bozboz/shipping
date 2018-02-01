# Shipping package

## Installation

See http://gitlab.lab/laravel-packages/ecommerce

## Usage

Shipping is comprised of 3 different models:

- Bands
- Methods
- Costs

### Bands

A shipping band is a group of shipping methods. Each orderable model should be related to one band. If the orderable model doesn't have a shipping band then it will be considered as not requiring shipping.

Most sites will probably only require one shipping band but an example of where you might need more would be if a site had products that shipped from different places or countries meaning that the costs would be different since they would have different distances to ship.

### Methods

A shipping method is a group of costs that belongs to particular shipping band. Whether or not a method is valid for a particular order is determined by whether or not any of it's costs are valid. Multiple methods may be valid for an order but the front end use must select only one, e.g. Next day express, 1st class, 5-6 day economy, etc...

### Costs

The shipping costs are what determine the actual price of the shipping and are selected based on the weight of the items in the basket and the country/region of the shipping address. Only one cost per method can be valid at a time.

### Shippable interface

In order to allow shipping on a product it must implement the Shippable interface. The `ShippableTrait` provides the default implementation of the interface.

### Mailman

The Mailman class should be used to determine what shipping methods are available for a given order and adding the shipping cost to the order. 

See BentonGroup for an example implementation of this: http://gitlab.lab/bozboz/benton/blob/ecommerce/app/Screens/ShippingSelection.php
