<?php
class Shopware_Proxies_ShopwareControllersBackendProductStreamProxy extends \Shopware_Controllers_Backend_ProductStream implements \Enlight_Hook_Proxy
{

    public function executeParent($method, $args = array())
    {
        return call_user_func_array([$this, 'parent::' . $method], $args);
    }

    public static function getHookMethods()
    {
        return [];
    }


}
