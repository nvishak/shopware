<?php

use AvenFaxorder\Models\Faxquotes;

class Shopware_Controllers_Backend_AvenFaxitems extends \Shopware_Controllers_Backend_Application
{
    protected $model = Faxquotes::class;
    protected $alias = 'faxquotes';
}