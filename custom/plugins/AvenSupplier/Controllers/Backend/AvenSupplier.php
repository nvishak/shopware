<?php

use AvenSupplier\Models\Product;

class Shopware_Controllers_Backend_AvenSupplier extends \Shopware_Controllers_Backend_Application
{
    protected $model = Product::class;
    protected $alias = 'product';
}
