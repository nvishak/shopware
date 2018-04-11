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

namespace CrefoShopwarePlugIn\Models\CrefoAccounts;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoAccounts
 */
class Repository extends ModelRepository
{
    /**
     * @param null $limit
     * @param null $offset
     * @return \Doctrine\ORM\Query
     */
    public function getAccountsQuery($limit = null, $offset = null)
    {
        $builder = $this->getAccountsQueryBuilder();
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAccountsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'accounts.id as id',
                'accounts.useraccount as useraccount',
                'accounts.generalpassword as generalpassword',
                'accounts.individualpassword as individualpassword'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount', 'accounts');
        $builder->orderBy('useraccount');
        return $builder;
    }

    /**
     * @param string $useraccount
     * @return array
     */
    public function getAccountWithNumber($useraccount)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'accounts.id as id',
                'accounts.useraccount as useraccount',
                'accounts.generalpassword as generalpassword',
                'accounts.individualpassword as individualpassword'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount', 'accounts');
        $builder->where('accounts.useraccount = ?1');
        $builder->setParameter(1, $useraccount);
        return $builder->getQuery()->getArrayResult();
    }

    /**
     * @param string $useraccount
     * @param string $password
     * @return mixed
     */
    public function updateIndividualPassword($useraccount, $password)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->update('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount', 'accounts');
        $builder->set('accounts.individualpassword', '?1');
        $builder->where('accounts.useraccount = ?2');
        $builder->setParameter(1, $password);
        $builder->setParameter(2, $useraccount);
        return $builder->getQuery()->execute();
    }

}