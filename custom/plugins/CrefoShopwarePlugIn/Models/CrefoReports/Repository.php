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
namespace CrefoShopwarePlugIn\Models\CrefoReports;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoReports
 */
class Repository extends ModelRepository
{
    /**
     * @param null|array $filter
     * @param null $orderBy
     * @param null $limit
     * @param null $offset
     * @return \Doctrine\ORM\Query
     */
    public function getCompanyReportResultsQuery($filter = null, $orderBy = null, $limit = null, $offset = null)
    {
        $builder = $this->getCompanyReportResultsQueryBuilder();
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        if (!empty($filter)) {
            $builder = $this->filterListQuery($builder, $filter);
        }
        if (!empty($orderBy)) {
            //add order by path
            $builder->addOrderBy($orderBy);
        }
        return $builder->getQuery();
    }


    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCompanyReportResultsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'crefo_rr.id as id',
                'crefo_rr.orderNumber as orderNumber',
                'crefo_rr.textReportName as textReportName',
                'crefo_rr.successfulSolvency as successfulSolvency',
                'crefo_rr.riskJudgement as riskJudgement',
                'crefo_rr.indexThreshold as indexThreshold'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults', 'crefo_rr');
        $builder->orderBy('id');
        return $builder;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getPrivatePersonReportResultsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'pprr.id as id',
                'pprr.orderNumber as orderNumber',
                'pprr.textReportName as textReportName',
                'pprr.successfulSolvency as successfulSolvency',
                'pprr.addressValidationResult as addressValidationResult',
                'pprr.identificationResult as identificationResult',
                'pprr.scoreType as scoreType',
                'pprr.scoreValue as scoreValue'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults', 'pprr');
        $builder->orderBy('id');
        return $builder;
    }

    /**
     * @param string $orderNumber
     * @return \Doctrine\ORM\Query
     */
    public function getCompanyReportResultsPdfQuery($orderNumber)
    {
        $builder = $this->getCompanyReportResultsPdfQueryBuilder();
        $builder->andWhere('crefo_rr.orderNumber = ?1');
        $builder->setParameter(1, $orderNumber);
        return $builder->getQuery();
    }


    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCompanyReportResultsPdfQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'crefo_rr.id as id',
                'crefo_rr.orderNumber as orderNumber',
                'crefo_rr.textReportPdf as textReportPdf'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults', 'crefo_rr');
        $builder->orderBy('id');
        return $builder;
    }

    /**
     * Filters the displayed fields by the passed filter value.
     *
     * @param \Doctrine\ORM\QueryBuilder $builder
     * @param array|null $filters
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function filterListQuery(\Doctrine\ORM\QueryBuilder $builder, $filters = null)
    {
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (empty($filter['property']) || $filter['value'] === null || $filter['value'] === '') {
                    continue;
                }
                $builder->addFilter([$filter]);
            }
        }

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