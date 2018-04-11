<?php

use AvenFaxorder\Models\Orderdetails;

class Shopware_Controllers_Backend_AvenFaxcustomer extends \Shopware_Controllers_Backend_Application
{
    protected $model = Orderdetails::class;
    protected $alias = 'orderdetails';
}