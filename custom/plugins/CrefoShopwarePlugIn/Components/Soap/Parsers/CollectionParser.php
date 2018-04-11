<?php
/**
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

namespace CrefoShopwarePlugIn\Components\Soap\Parsers;

use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;

/**
 * Class CollectionParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class CollectionParser extends CrefoSoapParser
{

    /**
     * @return array
     */
    public function extractCreditorFromWS()
    {
        $creditors = [];
        if (isset($this->getBody()->useraccountinformation)) {
            $useraccountinformation = $this->getBody()->useraccountinformation;
            if (is_object($useraccountinformation->subuser)) {
                $creditors[] = $this->getSubUserInfo($useraccountinformation->subuser);
            } elseif (is_array($useraccountinformation->subuser)) {
                foreach ($useraccountinformation->subuser as $subuser) {
                    $creditors[] = $this->getSubUserInfo($subuser);
                }
            }
        }
        return $creditors;
    }

    /**
     * @param $subuser
     * @return array|null
     */
    private function getSubUserInfo($subuser)
    {
        if (is_object($subuser) && !is_null($subuser->user) && !is_null($subuser->name) && !is_null($subuser->address)) {
            return ["useraccount" => $subuser->user, "name" => $subuser->name, "address" => $subuser->address];
        } else {
            return null;
        }
    }
}