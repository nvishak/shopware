<?php

use AvenFaxorder\Models\Product;

class Shopware_Controllers_Backend_AvenFaxorder extends \Shopware_Controllers_Backend_Application
{
    protected $model = Product::class;
    protected $alias = 'product';
}
