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
namespace CrefoShopwarePlugIn\Models\CrefoLogs;

use \Shopware\Components\Model\ModelRepository;
use \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoLogs
 */
class Repository extends ModelRepository
{

    /**
     * @param null $filter
     * @param null $sort
     * @param null $offset
     * @param null $limit
     * @return \Doctrine\ORM\Query
     */
    public function getCrefoLogsQuery($filter = null, $sort = null, $offset = null, $limit = null)
    {
        $builder = $this->getCrefoLogsQueryBuilder($filter, $sort);
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * @param null $filters
     * @param null $orderBy
     * @param boolean $filterStatus
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCrefoLogsQueryBuilder($filters = null, $orderBy = null, $filterStatus = true)
    {
        $notAllowedLogsToBeDisplayed = [LogStatusType::SAVE_AND_NOT_SHOW];
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'clog.id as id',
                'clog.statusLogs as statusLogs',
                'clog.requestXMLDescription as requestXMLDescription',
                'clog.responseXMLDescription as responseXMLDescription',
                'crefo_report_result.id as reportResultId',
                'clog.tsResponse as tsResponse',
                'clog.tsProcessEnd as tsProcessEnd'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs', 'clog')
            ->leftJoin('clog.reportResultId', 'crefo_report_result');

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (empty($filter['property']) || $filter['value'] === null || $filter['value'] === '') {
                    continue;
                }
                $builder->addFilter([$filter]);
            }
        }

        if ($filterStatus) {
            $builder->andWhere($builder->expr()->notIn('clog.statusLogs', $notAllowedLogsToBeDisplayed));
        }

        if (!empty($orderBy)) {
            //add order by path
            $builder->addOrderBy($orderBy);
        } else {
            $builder->addOrderBy('clog.id');
        }
        return $builder;
    }

    /**
     * @param $logId
     * @return null|\Doctrine\ORM\Query
     */
    public function getCrefoLogsXmlsQuery($logId)
    {
        if (!is_numeric($logId)) {
            return null;
        }
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'clog.id as id',
                'clog.requestXML as requestXML',
                'clog.responseXML as responseXML',
                'clog.tsResponse as tsResponse'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs', 'clog');
        $builder->addOrderBy('clog.id');

        $builder->andWhere('clog.id = ?1');
        $builder->setParameter(1, $logId);

        return $builder->getQuery();
    }

}