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

namespace CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class ProductsRepository
 * @package CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig
 */
class ProductsRepository extends ModelRepository
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

    /**
     * @param boolean $available
     * @param integer $productType
     * @return mixed
     */
    public function updateAvailabilityForProducts($available, $productType)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->update('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson', 'ppp');
        $builder->set('ppp.isProductAvailable', '?1');
        $builder->where('ppp.productKeyWS = ?2');
        $builder->setParameter(1, $available);
        $builder->setParameter(2, $productType);
        return $builder->getQuery()->execute();
    }
}