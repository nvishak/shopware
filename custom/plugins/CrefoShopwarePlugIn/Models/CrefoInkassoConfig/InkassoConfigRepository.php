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

namespace CrefoShopwarePlugIn\Models\CrefoInkassoConfig;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class InkassoConfigRepository
 * @package CrefoShopwarePlugIn\Models\CrefoInkassoConfig
 */
class InkassoConfigRepository extends ModelRepository
{

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getInkassoConfigQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'ink.id as id',
                'crefo_accounts.id as inkasso_user_account',
                'ink.creditor as inkasso_creditor',
                'ink.interest_rate_radio as inkasso_interest_rate_radio',
                'ink.interest_rate_value as inkasso_interest_rate_value',
                'ink.customer_reference as inkasso_customer_reference',
                'ink.turnover_type as inkasso_turnover_type',
                'ink.receivable_reason as inkasso_receivable_reason',
                'ink.valuta_date as inkasso_valuta_date',
                'ink.due_date as inkasso_due_date',
                'ink.order_type as inkasso_order_type'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig', 'ink')
            ->innerJoin('ink.useraccountId', 'crefo_accounts');
        return $builder;
    }

    /**
     * @return mixed
     */
    public function getInkassoValuesQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'inkws.id as id',
                'inkws.keyWS as keyWS',
                'inkws.textWS as textWS'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues', 'inkws');
        return $builder;
    }

    /**
     * @return mixed
     */
    public function getInkassoCreditorsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'creditor.id as id',
                'creditor.useraccount as useraccount',
                'creditor.name as name',
                'creditor.address as address'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors', 'creditor');
        return $builder;
    }

    /**
     * @param $entity
     * @param $id
     * @return mixed
     */
    public function findCrefoObject($entity, $id)
    {
        return $this->getEntityManager()->find($entity, $id);
    }

}