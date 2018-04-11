<?php
/**
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
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
     * @return bool
     */
    public function hasService()
    {
        return null !== $this->getService('collectionorder');
    }

    /**
     * @param $subUser
     * @return array|null
     */
    private function getSubUserInfo($subUser)
    {
        if (is_object($subUser) && null !== $subUser->user && null !== $subUser->name && null !== $subUser->address) {
            return ["useraccount" => $subUser->user, "name" => $subUser->name, "address" => $subUser->address];
        } else {
            return null;
        }
    }
}