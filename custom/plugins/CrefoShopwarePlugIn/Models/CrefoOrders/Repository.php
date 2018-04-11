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

namespace CrefoShopwarePlugIn\Models\CrefoOrders;

use \Shopware\Components\Model\ModelRepository;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;

/**
 * Class Repository
 * @package CrefoShopwarePlugIn\Models\CrefoOrders
 */
class Repository extends ModelRepository
{


    /**
     * @param null $limit
     * @param null $offset
     * @return \Doctrine\ORM\Query
     */
    public function getCrefoProposalQuery($limit = null, $offset = null)
    {
        $builder = $this->getCrefoProposalQueryBuilder();
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * @param $filter
     * @param $order
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCrefoOrderListingQueryBuilder($filter = null, $order = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'ol.id as id',
                's_order.id as orderId',
                'crefo_orders.id as crefoOrderId',
                'crefo_orders.crefoOrderType as crefoOrderType'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing', 'ol')
            ->innerJoin('ol.orderId', 's_order')
            ->leftJoin('ol.crefoOrderId', 'crefo_orders');

        if ($filter !== null) {
            $builder->addFilter($filter);
        }
        if ($order !== null) {
            $builder->addOrderBy($order);
        } else {
            $builder->addOrderBy('id');
        }

        return $builder;
    }

    /**
     * @param $filter
     * @param $order
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCrefoProposalQueryBuilder($filter = null, $order = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'prop.id as id',
                's_order.id as orderId',
                'prop.documentNumber as documentNumber',
                'prop.crefoOrderType as crefoOrderType',
                'prop.proposalStatus as proposalStatus',
                'prop.creditor as creditor',
                'prop.orderTypeKey as orderTypeKey',
                'prop.interestRateRadio as interestRateRadio',
                'prop.interestRateValue as interestRateValue',
                'prop.customerReference as customerReference',
                'prop.remarks as remarks',
                'prop.turnoverTypeKey as turnoverTypeKey',
                'prop.dateInvoice as dateInvoice',
                'prop.dateContract as dateContract',
                'prop.invoiceNumber as invoiceNumber',
                'prop.receivableReasonKey as receivableReasonKey',
                'prop.valutaDate as valutaDate',
                'prop.dueDate as dueDate'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal', 'prop')
            ->innerJoin('prop.orderId', 's_order');

        if ($filter !== null) {
            $builder->addFilter($filter);
        }
        if ($order !== null) {
            $builder->addOrderBy($order);
        } else {
            $builder->addOrderBy('id');
        }

        return $builder;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return \Doctrine\ORM\Query
     */
    public function getCrefoOrdersQuery($limit = null, $offset = null)
    {
        $builder = $this->getCrefoOrdersQueryBuilder();
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * @param $filter
     * @param $order
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCrefoOrdersQueryBuilder($filter = null, $order = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'crefoOrd.id as id',
                'crefoOrd.orderNumber as orderNumber',
                'crefoOrd.crefoOrderType as crefoOrderType',
                'crefoOrd.userAccountNumber as userAccountNumber',
                'crefoOrd.languageIso as languageIso',
                'crefoOrd.sentDate as sentDate',
                'crefoOrd.documentNumber as documentNumber',
                'crefoOrd.companyName as companyName',
                'crefoOrd.salutation as salutation',
                'crefoOrd.lastName as lastName',
                'crefoOrd.firstName as firstName',
                'crefoOrd.street as street',
                'crefoOrd.zipCode as zipCode',
                'crefoOrd.city as city',
                'crefoOrd.country as country',
                'crefoOrd.email as email',
                'crefoOrd.creditor as creditor',
                'crefoOrd.orderType as orderType',
                'crefoOrd.interestRate as interestRate',
                'crefoOrd.interestRateValue as interestRateValue',
                'crefoOrd.customerReference as customerReference',
                'crefoOrd.remarks as remarks',
                'crefoOrd.turnoverType as turnoverType',
                'crefoOrd.dateInvoice as dateInvoice',
                'crefoOrd.dateContract as dateContract',
                'crefoOrd.invoiceNumber as invoiceNumber',
                'crefoOrd.receivableReason as receivableReason',
                'crefoOrd.valutaDate as valutaDate',
                'crefoOrd.dueDate as dueDate',
                'crefoOrd.amount as amount',
                'crefoOrd.currency as currency'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders', 'crefoOrd');

        if ($filter !== null) {
            $builder->addFilter($filter);
        }
        if ($order !== null) {
            $builder->addOrderBy($order);
        } else {
            $builder->addOrderBy('id');
        }

        return $builder;
    }


    /**
     * Returns a query-object for all known order stati
     *
     * @param null $filter
     * @param null $order
     * @param null $offset
     * @param null $limit
     * @return \Doctrine\ORM\Query
     */
    public function getCrefoOrderListingQuery($filter = null, $order = null, $offset = null, $limit = null)
    {
        $builder = $this->getCrefoOrderListingQueryBuilder($filter, $order);
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }


    /**
     * Returns an instance of the \Doctrine\ORM\Query object which .....
     * @param null $filters
     * @param null $orderBy
     * @param null $offset
     * @param null $limit
     * @internal param $ids
     * @return \Doctrine\ORM\Query
     */
    public function getBackendOrdersQuery($filters = null, $orderBy = null, $offset = null, $limit = null)
    {
        $builder = $this->getBackendOrdersQueryBuilder($filters, $orderBy);
        if ($limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $builder->getQuery();
    }

    /**
     * Helper function to create the query builder for the "getOrdersQuery" function.
     * This function can be hooked to modify the query builder of the query object.
     * @param null $filters
     * @param      $orderBy
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getBackendOrdersQueryBuilder($filters = null, $orderBy = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
            'orders',
            'customer',
            'payment',
            'billing',
            'billingCountry',
            'billingState',
            'shop',
            'dispatch',
            'paymentStatus',
            'orderStatus',
            'billingAttribute',
            'attribute',
            'crr.id as solvencyId',
            'ol.id as collectionId'
        ]);

        $builder->from('Shopware\Models\Order\Order', 'orders');
        $builder->leftJoin('orders.payment', 'payment')
            ->leftJoin('orders.paymentStatus', 'paymentStatus')
            ->leftJoin('orders.orderStatus', 'orderStatus')
            ->leftJoin('orders.billing', 'billing')
            ->leftJoin('orders.customer', 'customer')
            ->leftJoin('billing.country', 'billingCountry')
            ->leftJoin('billing.state', 'billingState')
            ->leftJoin('orders.shop', 'shop')
            ->leftJoin('orders.dispatch', 'dispatch')
            ->leftJoin('billing.attribute', 'billingAttribute')
            ->leftJoin('orders.attribute', 'attribute')
            ->leftJoin('CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults',
                'crr',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'orders.number = crr.orderNumber'
            )->leftJoin('CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing',
                'ol',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'orders.id = ol.orderId'
            );

        if (!empty($filters)) {
            $builder = $this->filterListQuery($builder, $filters);
        }
        $builder->andWhere($builder->expr()->notIn('orders.status', ['-1']));
        $builder->andWhere('orders.number IS NOT NULL');

        if (!empty($orderBy)) {
            //add order by path
            $builder->addOrderBy($orderBy);
        }
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
        $expr = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getExpressionBuilder();

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (empty($filter['property']) || $filter['value'] === null || $filter['value'] === '') {
                    continue;
                }
                switch ($filter['property']) {
                    case "free":
                        $builder->andWhere(
                            $expr->orX(
                                $expr->like('orders.number', '?1'),
                                $expr->like('orders.invoiceAmount', '?1'),
                                $expr->like('orders.transactionId', '?1'),
                                $expr->like('billing.company', '?3'),
                                $expr->like('customer.email', '?3'),
                                $expr->like('billing.lastName', '?3'),
                                $expr->like('billing.firstName', '?3'),
                                $expr->like('orders.comment', '?3'),
                                $expr->like('orders.customerComment', '?3'),
                                $expr->like('orders.internalComment', '?3')
                            )
                        );
                        $builder->setParameter(1, $filter['value'] . '%');
                        $builder->setParameter(3, '%' . $filter['value'] . '%');
                        break;
                    case "from":
                        $tmp = new \DateTime($filter['value']);
                        $builder->andWhere('orders.orderTime >= :orderTimeFrom');
                        $builder->setParameter('orderTimeFrom', $tmp->format('Ymd'));
                        break;
                    case "to":
                        $tmp = new \Zend_Date($filter['value']);
                        $tmp->setHour('23');
                        $tmp->setMinute('59');
                        $tmp->setSecond('59');
                        $builder->andWhere('orders.orderTime <= :orderTimeTo');
                        $builder->setParameter('orderTimeTo', $tmp->get('yyyy-MM-dd HH:mm:ss'));
                        break;
                    case 'details.articleNumber':
                        $builder->leftJoin('orders.details', 'details');
                        $builder->andWhere('details.articleNumber LIKE :articleNumber');
                        $builder->setParameter('articleNumber', $filter['value']);
                        break;
                    default:
                        $builder->addFilter([$filter]);
                }
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