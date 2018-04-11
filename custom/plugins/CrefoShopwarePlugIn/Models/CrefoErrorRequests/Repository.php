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

namespace CrefoShopwarePlugIn\Models\CrefoErrorRequests;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoErrorRequests
 */
class Repository extends ModelRepository
{


    /**
     * @param null $limit
     * @param null $offset
     * @return \Doctrine\ORM\Query
     */
    public function getErrorRequestsQuery($limit = null, $offset = null)
    {
        $builder = $this->getErrorRequestsQueryBuilder();
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getErrorRequestsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'er.id as id',
                'er.numberOfRequests as numberOfRequests',
                'er.numberOfFailedRequests as numberOfFailedRequests'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests', 'er');
        $builder->orderBy('id');
        return $builder;
    }

    /**
     * @return mixed
     */
    public function resetErrorRequests()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->update('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests', 'er');
        $builder->set('er.numberOfRequests', '?1');
        $builder->set('er.numberOfFailedRequests', '?2');
        $builder->where('er.id = ?3');
        $builder->setParameter(1, 0);
        $builder->setParameter(2, 0);
        $builder->setParameter(3, 1);
        return $builder->getQuery()->execute();
    }

}