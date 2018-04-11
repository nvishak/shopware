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

namespace CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig
 */
class Repository extends ModelRepository
{

    /**
     * @param $entity
     * @param $id
     * @return null|object
     */
    public function findCrefoObject($entity, $id)
    {
        return $this->getEntityManager()->find($entity, $id);
    }
}