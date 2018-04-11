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

namespace CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class ReportCompanyRepository
 * @package CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig
 */
class ReportCompanyRepository extends ModelRepository
{

    /**
     * @param $configId
     * @return array
     */
    public function getUsedCrefoProductsKeys($configId)
    {
        $keysArray = [];
        $builder = $this->getCrefoProductsConfigQueryBuilder();
        $builder->where('pConf.productKeyWS IS NOT NULL AND pConf.configsId = ?1');
        $builder->setParameter(1, $configId);
        $builder->distinct();
        $configProducts = $builder->getQuery()->getArrayResult();
        foreach ($configProducts as $configProduct) {
            $keysArray[] = $configProduct['productKeyWS'];
        }
        return $keysArray;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCrefoProductsConfigQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'pConf.id as id',
                'pConf.configsId as configsId',
                'pConf.productKeyWS as productKeyWS',
                'pConf.productTextWS as productTextWS',
                'pConf.solvencyIndexWS as solvencyIndexWS',
                'pConf.sequence as sequence',
                'pConf.threshold as threshold',
                'pConf.threshold_index as threshold_index',
                'pConf.land as land'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig', 'pConf');
        return $builder;
    }

    /**
     * @param integer $idConfig
     * @return \Doctrine\ORM\Query
     */
    public function getCrefoProductsConfigQuery($idConfig = null)
    {
        $builder = $this->getCrefoProductsConfigQueryBuilder();
        if (!is_null($idConfig)) {
            $builder->where('pConf.configsId = ?1');
            $builder->setParameter(1, $idConfig);
        }
        return $builder->getQuery();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getReportCompanyConfigQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'rc.id as id',
                'crefo_accounts.id as useraccountId',
                'rc.legitimateKey as legitimateKey',
                'rc.reportLanguageKey as reportLanguageKey'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig', 'rc')
            ->innerJoin('rc.useraccountId', 'crefo_accounts');
        return $builder;
    }

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