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

use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Core\Enums\CrefoOrderTypes;
use \CrefoShopwarePlugIn\Components\Core\Enums\ProposalStatus;
use \CrefoShopwarePlugIn\Components\Core\Enums\CollectionOrderActions;
use \CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionOrderParser;
use \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal;
use \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders;
use \CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing;
use \Shopware\Components\CSRFWhitelistAware;
use \CrefoShopwarePlugIn\Components\Core\Enums\AddressValidationResultType;
use \CrefoShopwarePlugIn\Components\Core\Enums\IdentificationResultType;

/**
 * Class Shopware_Controllers_Backend_CrefoOrders
 */
class Shopware_Controllers_Backend_CrefoOrders extends Shopware_Controllers_Backend_Application implements CSRFWhitelistAware
{
    protected $model = 'CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders';
    protected $alias = 'crefoOrders';

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReports\Repository
     */
    private $reportResultsRepository = null;

    /**
     * @var null|Shopware\Models\Order\Repository
     */
    private $orderRepository = null;

    /**
     * @var null|Shopware\Models\Country\Repository
     */
    private $countryRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoOrders\Repository;
     */
    private $crefoOrderRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoLogs\Repository;
     */
    private $crefoLogsRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfigRepository
     */
    private $inkassoConfigRepository = null;

    /**
     * @var null|CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @return null|CrefoLogger
     */
    private function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.logger');
        }
        return $this->crefoLogger;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfigRepository
     */
    private function getInkassoConfigRepository()
    {
        if ($this->inkassoConfigRepository === null) {
            $this->inkassoConfigRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig');
        }
        return $this->inkassoConfigRepository;
    }

    /**
     * @return null|Shopware\Models\Order\Repository
     */
    protected function getOrderRepository()
    {
        if ($this->orderRepository === null) {
            $this->orderRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('Shopware\Models\Order\Order');
        }
        return $this->orderRepository;
    }

    /**
     * @return null|Shopware\Models\Country\Repository
     */
    protected function getCountryRepository()
    {
        if ($this->countryRepository === null) {
            $this->countryRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('Shopware\Models\Country\Country');
        }
        return $this->countryRepository;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoReports\Repository
     */
    private function getReportResultsRepository()
    {
        if ($this->reportResultsRepository === null) {
            $this->reportResultsRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults');
        }
        return $this->reportResultsRepository;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoOrders\Repository
     */
    private function getCrefoOrdersRepository()
    {
        if ($this->crefoOrderRepository === null) {
            $this->crefoOrderRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders');
        }
        return $this->crefoOrderRepository;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoLogs\Repository
     */
    private function getCrefoLogsRepository()
    {
        if ($this->crefoLogsRepository === null) {
            $this->crefoLogsRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs');
        }
        return $this->crefoLogsRepository;
    }

    /**
     * @method getCrefoProposalListAction
     */
    public function getCrefoProposalAction()
    {
        $proposalData = null;
        try {
            $query = $this->getCrefoOrdersRepository()->getCrefoProposalQueryBuilder()->getQuery();
            //returns the customer data
            $proposalData = $query->getArrayResult();
            foreach ($proposalData as $key => $data) {
                $data['proposalOrder'] = $this->getOrderDataForProposal($data['orderId']);
                $proposalData[$key] = $data;
            }
            $this->View()->assign([
                'success' => true,
                'data' => $proposalData
            ]);
        } catch (\Exception $e) {
            $this->View()->assign([
                'success' => false,
                'data' => $proposalData
            ]);
        }
    }

    /**
     * @param integer $orderId
     * @return array
     */
    public function getOrderDataForProposal($orderId)
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest $orderRequest
         */
        $orderRequest = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_order_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Body\CollectionOrderBody $collectionBody
         */
        $collectionBody = $orderRequest->getBody();

        /**
         * @var \Shopware\Models\Order\Order $order
         */
        $order = $shopwareModels->find(\Shopware\Models\Order\Order::class, $orderId);
        try {
            $collectionBody->getDebtor()->getCommunicationData()->setEmail($order->getCustomer()->getEmail());
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==getOrderDataForProposal==", (array)$e);
            $collectionBody->getDebtor()->getCommunicationData()->setEmail('');
        }
        if (!is_null($order->getBilling()->getCompany()) && $order->getBilling()->getCompany() !== '') {
            $collectionBody->getDebtor()->disablePrivatePerson();
            $collectionBody->getDebtor()->enableCompany();
            $collectionBody->getDebtor()->getCompany()->setCompanyname($order->getBilling()->getCompany());
        } else {
            $collectionBody->getDebtor()->disableCompany();
            $collectionBody->getDebtor()->enablePrivatePerson();
            $collectionBody->getDebtor()->getPrivateperson()->setFirstname($order->getBilling()->getFirstName());
            $collectionBody->getDebtor()->getPrivateperson()->setSurname($order->getBilling()->getLastName());
            $collectionBody->getDebtor()->getPrivateperson()->setSalutation($order->getBilling()->getSalutation());
        }
        $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setCity($order->getBilling()->getCity());
        $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setCountry($order->getBilling()->getCountry()->getName());
        $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setPostcode($order->getBilling()->getZipCode());
        $collectionBody->getPartreceivable()->setAmount($order->getInvoiceAmount());
        $collectionBody->getReceivable()->setCurrency($order->getCurrency());
        $proposalOrder['currencyFactor'] = $order->getCurrencyFactor();
        $proposalOrder['countryIso'] = $order->getBilling()->getCountry()->getIso();
        if (strtolower($proposalOrder['countryIso']) === 'de' || strtolower($proposalOrder['countryIso']) === 'at') {
            $address = $collectionBody->validateAddress($order->getBilling()->getStreet());
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setStreet($address['street']);
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumber($address['number']);
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumberaffix($address['affix']);
        } else {
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setStreet($order->getBilling()->getStreet());
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumber(null);
            $collectionBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumberaffix(null);
        }
        $collectionBody->performSanitization();
        return array_merge($proposalOrder, $collectionBody->getBodyAsArray());
    }

    public function updateCrefoProposalAction()
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\CrefoValidator $validator
         */
        $validator = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.validator');

        $id = $this->Request()->getParam('id', null);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
         */
        $proposal = $this->getCrefoOrdersRepository()->findCrefoObject(CrefoOrderProposal::class, $id);
        $params = $this->Request()->getParams();

        $proposal->setProposalStatus(ProposalStatus::ReadyToSend);
        if (array_key_exists('creditor', $params) && $params['creditor'] !== '') {
            $proposal->setCreditor($params['creditor']);
        } else {
            $proposal->setCreditor(null);
        }
        $proposal->setOrderTypeKey($params['orderTypeKey']);
        $proposal->setInterestRateRadio($params['interestRateRadio']);
        if (array_key_exists('interestRateValue', $params)) {
            $proposal->setInterestRateValue(floatval($params['interestRateValue']));
        } else {
            $proposal->setInterestRateValue(null);
        }
        if (array_key_exists('customerReference', $params)) {
            $customerRefSanitized = $validator->sanitizeInput(['customerReference' => $params['customerReference']],
                ['customerReference' => ['type' => 'string', 'length' => 30, 'trim' => true]]);
            $proposal->setCustomerReference($customerRefSanitized['customerReference']);
        } else {
            $proposal->setCustomerReference(null);
        }
        if (array_key_exists('remarks', $params)) {
            $remarksSanitized = $validator->sanitizeInput(['remarks' => $params['remarks']],
                ['remarks' => ['type' => 'string', 'length' => 500, 'trim' => true]]);
            $proposal->setRemarks($remarksSanitized['remarks']);
        } else {
            $proposal->setRemarks(null);
        }
        $proposal->setTurnoverTypeKey($params['turnoverTypeKey']);
        $proposal->setDateContract($params['dateContract']);
        $proposal->setDateInvoice($params['dateInvoice']);
        $proposal->setValutaDate($params['valutaDate']);
        $proposal->setDueDate($params['dueDate']);
        if (array_key_exists('invoiceNumber', $params)) {
            $invoiceNumberSanitized = $validator->sanitizeInput(['invoiceNumber' => $params['invoiceNumber']],
                ['invoiceNumber' => ['type' => 'string', 'length' => 30, 'trim' => true]]);
            $proposal->setInvoiceNumber($invoiceNumberSanitized['invoiceNumber']);
        } else {
            $proposal->setInvoiceNumber(null);
        }
        $proposal->setReceivableReasonKey($params['receivableReasonKey']);

        $shopwareModels->persist($proposal);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($proposal)]);
    }

    /**
     * deletes a crefo proposal from a proposal ID
     */
    public function deleteCrefoProposalAction()
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        $proposalId = $this->Request()->getParam('id', null);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
         */
        $proposal = $this->getCrefoOrdersRepository()->findCrefoObject(CrefoOrderProposal::class, $proposalId);
        if ($proposal->getCrefoOrderType() === CrefoOrderTypes::Document) {
            $this->View()->assign(['success' => false]);
            return;
        }

        $crefoOrderListingBuilder = $this->getCrefoOrdersRepository()->getCrefoOrderListingQueryBuilder();
        $crefoOrderListingBuilder->andWhere('ol.crefoOrderId = ?1');
        $crefoOrderListingBuilder->setParameter(1, $proposalId);
        $arrayOrderListing = $crefoOrderListingBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing $orderListing
         */
        $orderListing = $this->getCrefoOrdersRepository()->findCrefoObject(OrderListing::class,
            $arrayOrderListing['id']);

        $shopwareModels->remove($proposal);
        $shopwareModels->remove($orderListing);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true]);
    }


    public function getCrefoOrderDocumentAction()
    {
        $query = $this->getCrefoOrdersRepository()->getCrefoOrdersQueryBuilder()->getQuery();
        //returns the customer data
        $orderData = $query->getArrayResult();
        $this->View()->assign([
            'success' => true,
            'data' => $orderData
        ]);
    }

    public function hasInkassoConfigAction()
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $configInkasso
         */
        $configInkasso = $this->getInkassoConfigRepository()->find($configId);
        $this->View()->assign([
            'success' => !is_null($configInkasso->getUserAccountId())
        ]);
    }

    public function getCrefoOrderListAction()
    {
        $query = $this->getCrefoOrdersRepository()->getCrefoOrderListingQueryBuilder()->getQuery();
        //returns the customer data
        $listingData = $query->getArrayResult();
        $this->View()->assign([
            'success' => true,
            'data' => $listingData
        ]);
    }

    /**
     * @method getReportResultsList
     */
    public function getReportResultsListAction()
    {
        $queryCompany = $this->getReportResultsRepository()->getCompanyReportResultsQueryBuilder()->getQuery();
        $queryPerson = $this->getReportResultsRepository()->getPrivatePersonReportResultsQueryBuilder()->getQuery();
        //returns the customer data
        $reportResult = $queryCompany->getArrayResult();
        $reportResultPrivatePerson = $queryPerson->getArrayResult();
        $lenResult = count($reportResult);
        foreach ($reportResultPrivatePerson as $key => $personReport) {
            $finalPersonReport['id'] = $personReport['id'];
            $finalPersonReport['orderNumber'] = $personReport['orderNumber'];
            $finalPersonReport['textReportName'] = $personReport['textReportName'];
            $finalPersonReport['successfulSolvency'] = $personReport['successfulSolvency'];
            $finalPersonReport['privatePersonResult'] = $this->renderBonimaPrivatePersonText($personReport);
            $reportResult[$lenResult + $key] = $finalPersonReport;
        }
        $this->View()->assign([
            'success' => true,
            'data' => $reportResult
        ]);
    }

    public function openSolvencyErrorAction()
    {
        $solvencyId = intval($this->Request()->getParam('solvencyId', 0));
        $success = $solvencyId !== 0;
        $displayErrors = null;
        try {
            if (!$success) {
                throw new \Exception('Wrong parameters received.');
            }
            $builderLogs = $this->getCrefoLogsRepository()->getCrefoLogsQueryBuilder();
            $builderLogs->andWhere('clog.reportResultId = ?1');
            $builderLogs->setParameter(1, $solvencyId);
            $oneLogsResultArray = $builderLogs->getQuery()->getArrayResult();
            $query = $this->getCrefoLogsRepository()->getCrefoLogsXmlsQuery($oneLogsResultArray[0]['id']);
            $oneLogsResultArray = $query->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            if (is_null($oneLogsResultArray)) {
                throw new \Exception('Error-Xml not found.');
            }
            $xml = $oneLogsResultArray['responseXML'];
            if (is_null($xml) || empty($xml)) {
                throw new \Exception('Null/Empty Error-Xml.');
            }
            /**
             * @var \DateTime $responseTime
             */
            $responseTime = $oneLogsResultArray['tsResponse'];
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser $crefoParser
             */
            $crefoParser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.identification_report_parser');
            $displayErrors = $crefoParser->getSoapErrorsFromXml(stripslashes($xml));
            $displayErrors['timestamp'] = $responseTime->format("Y-m-d H:i:s");
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==openSolvencyErrorAction==", (array)$e);
            $success = false;
        }
        $this->View()->assign(['success' => $success, 'displayError' => $displayErrors]);
    }

    public function openXmlAction()
    {
        $solvencyId = intval($this->Request()->getParam('solvencyId', null));
        if (is_null($solvencyId)) {
            $this->View()->assign(['success' => false]);
            return;
        }
        $logBuilder = $this->getCrefoLogsRepository()->getCrefoLogsQueryBuilder();
        $logBuilder->andWhere("clog.reportResultId = ?1");
        $logBuilder->setParameter(1, $solvencyId);
        $logArray = $logBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        if (is_null($logArray)) {
            $this->View()->assign(['success' => false]);
            return;
        }
        $title = "response_xmlreport_" . $logArray['id'] . ".xml";
        $query = $this->getCrefoLogsRepository()->getCrefoLogsXmlsQuery($logArray['id']);
        $xmlArray = $query->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        if (is_null($xmlArray['responseXML'])) {
            $this->View()->assign(['success' => false]);
            return;
        }
        $data = $xmlArray['responseXML'];
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\XmlManager $manager
         */
        $manager = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.xml_manager');

        $this->View()->assign([
            'success' => true,
            'title' => $title,
            'dataXml' => $manager->formatXmlPretty($data)
        ]);
    }

    /**
     * Opens the report Pdf
     * @method openSolvencyPdf
     */
    public function openSolvencyPdfAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==openPDF==", ["Open solvency PDF."]);
        $params = $this->Request()->getParams();
        /**
         * @var Enlight_Controller_Plugins_Json_Bootstrap $json
         */
        $json = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('Front')->Plugins()->Json();
        $json->setRenderer(false);

        $tempfile = tempnam(sys_get_temp_dir(), '');
        if (file_exists($tempfile)) {
            @unlink($tempfile);
        }
        @mkdir($tempfile);
        if (is_dir($tempfile)) {
            $namePDF = $tempfile . DIRECTORY_SEPARATOR . "response_textreport_" . $params['orderNumber'] . ".pdf";
            $queryPdf = $this->getReportResultsRepository()->getCompanyReportResultsPdfQuery($params['orderNumber']);
            $pdf = $queryPdf->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

            file_put_contents($namePDF, $pdf['textReportPdf']);
            $this->Response()->setHeader('Content-Type', 'application/pdf'); //or use application/octet-stream
            $this->Response()->setHeader('Content-Length', filesize($namePDF));
            $this->Response()->setHeader('Content-Disposition', 'inline; filename="' . basename($namePDF) . '"');
            $this->Response()->setHeader('Content-Transfer-Encoding', 'binary');

            @readfile($namePDF);
            @unlink($namePDF);
        }
    }

    public function getListOrdersAction()
    {
        //read store parameter to filter and paginate the data.
        $limit = $this->Request()->getParam('limit', 20);
        $offset = $this->Request()->getParam('start', 0);
        $sort = $this->Request()->getParam('sort', null);
        $filter = $this->Request()->getParam('filter', null);
        $orderId = $this->Request()->getParam('orderID');

        if (!is_null($orderId)) {
            $orderIdFilter = ['property' => 'orders.id', 'value' => $orderId];
            if (!is_array($filter)) {
                $filter = [];
            }
            array_push($filter, $orderIdFilter);
        }
        $list = $this->getListOfOrders($filter, $sort, $offset, $limit);
        $this->View()->assign($list);
    }

    /**
     * @param $filter
     * @param $sort
     * @param $offset
     * @param $limit
     * @return array
     */
    protected function getListOfOrders($filter, $sort, $offset, $limit)
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==getListOrders==",
            ["Get the Orders list to display it."]);
        if (empty($sort)) {
            $sort = [['property' => 'orders.orderTime', 'direction' => 'DESC']];
        } else {
            if (strcmp(strtolower($sort[0]['property']), "solvencyid") == 0) {
                $sort[0]['property'] = 'crr.id';
            } else {
                if (strcmp(strtolower($sort[0]['property']), "collectionid") == 0) {
                    $sort[0]['property'] = 'ol.id';
                } else {
                    $sort[0]['property'] = 'orders.' . $sort[0]['property'];
                }
            }
        }

        $query = $this->getCrefoOrdersRepository()->getBackendOrdersQuery($filter, $sort, $offset, $limit);
        $query->setHydrationMode(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $paginator = $this->getModelManager()->createPaginator($query);

        //returns the total count of the query
        $total = $paginator->count();

        //returns the customer data
        $orders = $paginator->getIterator()->getArrayCopy();

        return [
            'success' => true,
            'data' => $this->processOrders($orders),
            'total' => $total
        ];
    }

    /**
     * @param array $orders
     * @return array
     */
    private function processOrders($orders)
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $newOrders = [];
        foreach ($orders as $key => $orderArray) {
            $order = $orderArray[0];

            if (!is_null($orderArray['solvencyId'])) {
                $crefoReportResult = $this->getReportResultsRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults::class,
                    $orderArray['solvencyId']);
                if ($crefoReportResult instanceof \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults) {
                    $reportResultArray = $shopwareModels->toArray($crefoReportResult);
                    /**
                     * PDFs are too large to be handled by the ajax call
                     */
                    unset($reportResultArray['textReportPdf']);
                } else {
                    $personReport = $shopwareModels->toArray($crefoReportResult);
                    $reportResultArray['id'] = $personReport['id'];
                    $reportResultArray['orderNumber'] = $personReport['orderNumber'];
                    $reportResultArray['textReportName'] = $personReport['textReportName'];
                    $reportResultArray['successfulSolvency'] = $personReport['successfulSolvency'];
                    $reportResultArray['privatePersonResult'] = $this->renderBonimaPrivatePersonText($personReport);
                }
            } else {
                unset($reportResultArray);
            }

            $collectionBuilder = $this->getCrefoOrdersRepository()->getCrefoOrderListingQueryBuilder();
            $collectionBuilder->andWhere('ol.id = ?1');
            $collectionBuilder->setParameter(1, $orderArray['collectionId']);
            $collectionResultArray = $collectionBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            $data = $collectionResultArray;
            if (!empty($data)) {
                if ($data['crefoOrderType'] === CrefoOrderTypes::Proposal) {
                    /**
                     * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
                     */
                    $proposal = $this->getCrefoOrdersRepository()->findCrefoObject(CrefoOrderProposal::class,
                        $data['crefoOrderId']);
                    $crefoOrderProposalArray = $shopwareModels->toArray($proposal);
                } else {
                    /**
                     * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders $crefoOrder
                     */
                    $crefoOrder = $this->getCrefoOrdersRepository()->findCrefoObject(CrefoOrders::class,
                        $data['crefoOrderId']);
                    $crefoOrderProposalArray = $shopwareModels->toArray($crefoOrder);
                }
                $data['crefoOrderProposal'] = $crefoOrderProposalArray;
            }
            $order['crefoOrderListing'] = $data;
            $order['crefoReportResults'] = isset($reportResultArray) ? $reportResultArray : null;
            $order['solvencyId'] = isset($reportResultArray) ? $reportResultArray['id'] : null;
            $order['collectionId'] = !is_null($collectionResultArray) ? $collectionResultArray['id'] : null;
            /**
             * @var \Doctrine\ORM\Query $additionalOrderDataQuery
             */
            $additionalOrderDataQuery = $this->getOrderRepository()->getBackendAdditionalOrderDataQuery($order['number']);
            $additionalOrderData = $additionalOrderDataQuery->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            $order = array_merge($order, $additionalOrderData);
            //we need to set the billing and shipping attributes to the first array level to load the data into a form panel
            //same for locale
            $order['billingAttribute'] = $order['billing']['attribute'];
            $order['shippingAttribute'] = $order['shipping']['attribute'];
            $order['locale'] = $order['languageSubShop']['locale'];

            //Deprecated: use payment instance
            $order['debit'] = $order['customer']['debit'];

            $order['customerEmail'] = $order['customer']['email'];

            unset($order['billing']['attribute']);
            unset($order['shipping']['attribute']);

            //find the instock of the article
            foreach ($order["details"] as &$orderDetail) {
                $articleRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('Shopware\Models\Article\Detail');
                $article = $articleRepository->findOneBy(['number' => $orderDetail["articleNumber"]]);
                if ($article instanceof \Shopware\Models\Article\Detail) {
                    $orderDetail['inStock'] = $article->getInStock();
                }
            }
            $newOrders[$key] = $order;
        }
        return $newOrders;
    }

    /**
     * @method createProposalAction
     */
    public function createProposalAction()
    {
        try {
            $orderId = $this->Request()->getParam('orderId');
            /**
             * @var \Shopware\Models\Order\Order $order
             */
            $order = $this->getOrderRepository()->find($orderId);
            if ($order->getCurrency() !== 'EUR') {
                throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoUnsupportedCurrencyException("The currency is different from EUR (" . $order->getCurrency() . ")");
            }
            $listing = $this->createProposal($order);
            $this->View()->assign(['success' => !is_null($listing), 'error' => false]);
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoUnsupportedCurrencyException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==createProposalAction::UnsupportedCurrency==",
                (array)$e);
            $this->View()->assign(['success' => true, 'error' => true]);
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==createProposalAction==", (array)$e);
            $this->View()->assign(['success' => false, 'error' => true]);
        }
    }

    /**
     * @method createProposalAction
     */
    public function openProposalWithErrorsAction()
    {
        $proposalId = $this->Request()->getParam('proposalId', 0);
        if ($proposalId === 0) {
            $this->View()->assign(['success' => false]);
            return;
        }

        /**
         * @var CrefoOrderProposal $proposal
         */
        $proposal = $this->getCrefoOrdersRepository()->findCrefoObject(CrefoOrderProposal::class, $proposalId);
        /**
         * @var CollectionOrderParser $crefoParser
         */
        $crefoParser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_order_parser');
        $displayErrors = null;
        if (!is_null($proposal->getErrorXML())) {
            $displayErrors = $crefoParser->getSoapErrorsFromXml($proposal->getErrorXML());
        }
        $this->View()->assign(['success' => true, 'displayErrors' => $displayErrors]);
    }

    /**
     * @param \Shopware\Models\Order\Order $order
     * @return OrderListing
     */
    private function createProposal($order)
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==createProposal==",
            ["Start creating the proposal."]);
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $proposal = new CrefoOrderProposal();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $configInkasso
         */
        $configInkasso = $this->getInkassoConfigRepository()->find($configId);

        $proposal->setOrderId($order);
        $proposal->setDocumentNumber(ProposalStatus::ReadyToSend);
        $proposal->setProposalStatus(ProposalStatus::NeedsEditing);
        $proposal->setCrefoOrderType(CrefoOrderTypes::Proposal);

        $proposal->setCreditor($configInkasso->getCreditor());
        if (!is_null($configInkasso->getCustomerReference())) {
            try {
                $proposal->setCustomerReference($order->getCustomer()->getNumber() . "-" . $order->getNumber());
            } catch (\Exception $e) {
                $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==createProposal==",
                    ["Assuming something went wrong trying to get the customer from order."]);
                $proposal->setCustomerReference($order->getNumber());
            }
        } else {
            $proposal->setCustomerReference(null);
        }
        $proposal->setDateContract($order->getOrderTime());
        $proposal->setInterestRateRadio($configInkasso->getInterestRateRadio());
        $proposal->setInterestRateValue($configInkasso->getInterestRateValue());
        $proposal->setTurnoverTypeKey($configInkasso->getTurnoverType());
        $proposal->setReceivableReasonKey($configInkasso->getReceivableReason());
        $proposal->setOrderTypeKey($configInkasso->getOrderType());
        $shopwareModels->persist($proposal);
        $shopwareModels->flush();
        $listing = new OrderListing();
        $listing->setOrderId($order);
        $listing->setCrefoOrderId($proposal);
        $shopwareModels->persist($listing);
        $shopwareModels->flush();
        return $listing;
    }

    /**
     * @method sendProposalAction
     */
    public function sendProposalAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==sendProposalAction==",
            ["Send Proposal - " . $this->Request()->getParam('listingId', -1)]);
        $orderListingId = $this->Request()->getParam('listingId');
        $errors = null;
        $successful = false;
        try {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing $orderListing
             */
            $orderListing = $this->getCrefoOrdersRepository()->findCrefoObject(OrderListing::class, $orderListingId);
            $this->sendCrefoProposalFromOrder($orderListing, $successful, $errors);
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==sendProposalAction==", ["Exception sending Proposal"]);
        } finally {
            $this->View()->assign(['success' => $successful, 'errors' => $errors]);
        }
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
     * @param \Shopware\Models\Order\Order $order
     * @param \Shopware\Models\Order\Billing $billing
     * @param \Shopware\Models\Country\Country $country
     * @return \CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest
     */
    private function fillOrderRequest($proposal, $order, $billing, $country)
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest $collectionOrderRequest
         */
        $collectionOrderRequest = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_order_request');
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $configInkasso
         */
        $configInkasso = $this->getInkassoConfigRepository()->find($configId);

        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.config_header_request');
        $collectionOrderRequest->setConfigHeaderRequest($config);
        $account = $configInkasso->getUserAccountId();
        if (!is_null($account)) {
            /**
             * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
             */
            $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
            $accountArray = [
                'userAccount' => $account->getUserAccount(),
                'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                    $config->getEncryptionKey()),
                'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                    $config->getEncryptionKey())
            ];
            $collectionOrderRequest->setHeaderAccount($accountArray);
        }
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Body\CollectionOrderBody $collectionOrderBody
         */
        $collectionOrderBody = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_order_body');
        if (!is_null($billing->getCompany()) && strcmp(trim($billing->getCompany()), '') != 0) {
            $collectionOrderBody->getDebtor()->enableCompany();
            $collectionOrderBody->getDebtor()->getCompany()->setCompanyname($billing->getCompany());
        } else {
            $collectionOrderBody->getDebtor()->enablePrivatePerson();
            $collectionOrderBody->getDebtor()->getPrivateperson()->setFirstname($billing->getFirstName());
            $collectionOrderBody->getDebtor()->getPrivateperson()->setSurname($billing->getLastName());
            $collectionOrderBody->getDebtor()->getPrivateperson()->setSalutation($billing->getSalutation());
        }
        $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setCountry($country->getIso());
        $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setCity($billing->getCity());
        $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setPostcode($billing->getZipCode());
        try {
            $collectionOrderBody->getDebtor()->getCommunicationData()->setEmail($order->getCustomer()->getEmail());
        } catch (\Exception $e) {
            $collectionOrderBody->getDebtor()->getCommunicationData()->setEmail(null);
        }
        if (strtolower($country->getIso()) === 'de' || strtolower($country->getIso()) === 'at') {
            $crefoAddress = $collectionOrderBody->validateAddress($billing->getStreet());
        } else {
            $crefoAddress['street'] = $billing->getStreet();
        }
        if (isset($crefoAddress['street'])) {
            $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setStreet($crefoAddress['street']);
        }
        if (isset($crefoAddress['number'])) {
            $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumber($crefoAddress['number']);
        }
        if (isset($crefoAddress['affix'])) {
            $collectionOrderBody->getDebtor()->getAddressdata()->getAddressForService()->setHousenumberaffix($crefoAddress['affix']);
        }
        $collectionOrderBody->getReceivable()->setInterestField($proposal->getInterestRateRadio(),
            $proposal->getInterestRateValue());

        /**
         * make sure that the creditor exists in the inkasso configuration
         */
        $creditors = $this->getInkassoConfigRepository()->getInkassoCreditorsQueryBuilder();
        $creditors->andWhere('creditor.useraccount = ?1');
        $creditors->setParameter(1, $proposal->getCreditor());
        $arrayCreditor = $creditors->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        if(!is_null($arrayCreditor)) {
            $collectionOrderBody->setUser($proposal->getCreditor());
        }
        $collectionOrderBody->getReceivable()->setRemarks($proposal->getRemarks());
        $collectionOrderBody->getPartreceivable()->setReceivablereason($proposal->getReceivableReasonKey());
        $collectionOrderBody->getReceivable()->setCustomerreference($proposal->getCustomerReference());
        $collectionOrderBody->setCollectionordertype($proposal->getOrderTypeKey());
        $collectionOrderBody->getPartreceivable()->setCollectionturnovertype($proposal->getTurnoverTypeKey());
        $collectionOrderBody->getPartreceivable()->setDatecontract($proposal->getDateContract());
        $collectionOrderBody->getPartreceivable()->setInvoicenumber($proposal->getInvoiceNumber());
        $collectionOrderBody->getPartreceivable()->setDateinvoice($proposal->getDateInvoice());
        $collectionOrderBody->getPartreceivable()->setDatevaluta($proposal->getValutaDate());
        $collectionOrderBody->getPartreceivable()->setDatedue($proposal->getDueDate());
        $collectionOrderBody->getPartreceivable()->setAmount($order->getInvoiceAmount());
        $collectionOrderBody->getReceivable()->setCurrency($order->getCurrency());

        $collectionOrderRequest->setBody($collectionOrderBody);
        return $collectionOrderRequest;
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest $collectionOrderRequest
     * @param \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
     * @return CrefoOrders
     */
    private function saveCrefoOrder($collectionOrderRequest, $proposal)
    {
        $arrayWsValues = $this->getInkassoConfigRepository()->getInkassoValuesQueryBuilder()->getQuery()->getArrayResult();
        $crefoOrders = new CrefoOrders();
        /**
         * values from \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal
         */
        $crefoOrders->setOrderId($proposal->getOrderId());
        $crefoOrders->setOrderNumber($proposal->getOrderId()->getNumber());
        $crefoOrders->setProposalStatus(ProposalStatus::Sent);
        $crefoOrders->setCrefoOrderType(CrefoOrderTypes::Document);
        $crefoOrders->setOrderTypeKey($proposal->getOrderTypeKey());
        $crefoOrders->setReceivableReasonKey($proposal->getReceivableReasonKey());
        $crefoOrders->setTurnoverTypeKey($proposal->getTurnoverTypeKey());
        $crefoOrders->setInterestRateRadio($proposal->getInterestRateRadio());
        $crefoOrders->setInterestRateValue($proposal->getInterestRateValue());
        /**
         * values from \CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest
         */
        $crefoOrders->setUserAccountNumber($collectionOrderRequest->getHeader()->getUserAccount());
        $crefoOrders->setDocumentNumber($collectionOrderRequest->getCrefoParser()->extractFileNumber());
        $crefoOrders->setSentDate(new \Datetime($collectionOrderRequest->getHeader()->getTransmissionTimestamp()));
        $crefoOrders->setLanguageIso($collectionOrderRequest->getHeader()->getCommunicationLanguage());

        if (!is_null($collectionOrderRequest->getBody()->getDebtor()->getCompany()) &&
            $this->notNullOrEmpty($collectionOrderRequest->getBody()->getDebtor()->getCompany()->getCompanyname())
        ) {
            $crefoOrders->setCompanyName($collectionOrderRequest->getBody()->getDebtor()->getCompany()->getCompanyname());
        } else {
            $salutation = strcmp($collectionOrderRequest->getBody()->getDebtor()->getPrivateperson()->getSalutation(),
                "SA-1") == 0 ?
                $this->getSalutationText("mr",
                    $collectionOrderRequest->getHeader()->getCommunicationLanguage()) : $this->getSalutationText("ms",
                    $collectionOrderRequest->getHeader()->getCommunicationLanguage());
            $crefoOrders->setSalutation($salutation);
            $crefoOrders->setFirstName($collectionOrderRequest->getBody()->getDebtor()->getPrivateperson()->getFirstname());
            $crefoOrders->setLastName($collectionOrderRequest->getBody()->getDebtor()->getPrivateperson()->getSurname());
        }

        $street = $collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getStreet();
        if ($this->notNullOrEmpty($collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber())) {
            $street .= ' ' . $collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber();
        }
        if ($this->notNullOrEmpty($collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix())) {
            $street .= $collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix();
        }
        $crefoOrders->setStreet($street);
        $crefoOrders->setZipCode($collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getPostcode());
        $crefoOrders->setCity($collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getCity());
        $crefoOrders->setCountry($this->getCountryName($collectionOrderRequest->getBody()->getDebtor()->getAddressdata()->getAddressForService()->getCountry()));
        $crefoOrders->setEmail($collectionOrderRequest->getBody()->getDebtor()->getCommunicationData()->getEmail());
        if ($this->notNullOrEmpty($collectionOrderRequest->getBody()->getUser())) {
            $builderInkasso = $this->getInkassoConfigRepository()->getInkassoCreditorsQueryBuilder();
            $builderInkasso->andWhere('creditor.useraccount = ?1');
            $builderInkasso->setParameter(1, $collectionOrderRequest->getBody()->getUser());
            $arrayCreditor = $builderInkasso->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            $crefoOrders->setCreditor($arrayCreditor['useraccount'] . ' - ' . $arrayCreditor['name'] . ' ' . $arrayCreditor['address']);
        }
        $interestRate = $this->getInterestRate($collectionOrderRequest->getHeader()->getCommunicationLanguage(),
            $collectionOrderRequest->getBody()->getReceivable()->getInterestArray());
        $crefoOrders->setInterestRate($interestRate);
        $crefoOrders->setOrderType($this->getTextValue($arrayWsValues,
            $collectionOrderRequest->getBody()->getCollectionordertype()));
        $crefoOrders->setRemarks($collectionOrderRequest->getBody()->getReceivable()->getRemarks());
        $crefoOrders->setTurnoverType($this->getTextValue($arrayWsValues,
            $collectionOrderRequest->getBody()->getPartreceivable()->getCollectionturnovertype()));
        $crefoOrders->setReceivableReason($this->getTextValue($arrayWsValues,
            $collectionOrderRequest->getBody()->getPartreceivable()->getReceivablereason()));
        $crefoOrders->setCustomerReference($collectionOrderRequest->getBody()->getReceivable()->getCustomerreference());
        $crefoOrders->setDateContract($collectionOrderRequest->getBody()->getPartreceivable()->getDatecontract());
        $crefoOrders->setDateInvoice($collectionOrderRequest->getBody()->getPartreceivable()->getDateinvoice());
        $crefoOrders->setInvoiceNumber($collectionOrderRequest->getBody()->getPartreceivable()->getInvoicenumber());
        $crefoOrders->setDueDate($collectionOrderRequest->getBody()->getPartreceivable()->getDatedue());
        $crefoOrders->setValutaDate($collectionOrderRequest->getBody()->getPartreceivable()->getDatevaluta());
        $crefoOrders->setAmount($collectionOrderRequest->getBody()->getPartreceivable()->getAmount());
        $crefoOrders->setCurrency($collectionOrderRequest->getBody()->getReceivable()->getCurrency());

        return $crefoOrders;
    }

    /**
     * @param string|array $value
     * @return bool
     */
    private function notNullOrEmpty($value)
    {
        return !is_null($value) && !empty($value) && (is_object($value) || (is_array($value) ? true : strcmp($value,
                        '') != 0));
    }

    /**
     * @param string $countryIso
     * @return string
     */
    private function getCountryName($countryIso)
    {
        $countryBuilder = $this->getCountryRepository()->getCountriesQueryBuilder();
        $countryBuilder->andWhere('countries.iso = ?1');
        $countryBuilder->setParameter(1, strtoupper($countryIso));
        $arrayCountry = $countryBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        return isset($arrayCountry['name']) ? $arrayCountry['name'] : $countryIso;
    }

    /**
     * @param string $gender
     * @param string $lang
     * @return string
     */
    private function getSalutationText($gender, $lang = "de")
    {
        $lexicon = [
            'de' => [
                'mr' => 'Herr',
                'ms' => 'Frau'
            ],
            'en' => [
                'mr' => 'Mr.',
                'ms' => 'Mrs.'
            ]
        ];
        if (!in_array(strtolower($lang), array_keys($lexicon))) {
            $lang = 'de';
        }
        return $lexicon[strtolower($lang)][$gender];
    }

    /**
     * @param $array
     * @param string $key
     * @return mixed
     */
    private function getTextValue($array, $key)
    {
        foreach ($array as $values) {
            if (strcmp($values['keyWS'], $key) == 0) {
                return $values['textWS'];
            }
        }
        return $key;
    }

    /**
     * @param $lang
     * @param $interestArray
     * @return string
     */
    private function getInterestRate($lang, $interestArray)
    {
        if (isset($interestArray['fix'])) {
            return strcmp(mb_strtolower($lang), "de") == 0 ? "Fest" : "Fix";
        } else {
            if (isset($interestArray['variable'])) {
                return strcmp(mb_strtolower($lang), "de") == 0 ? "Variabel-Aufschlag" : "Variable-Spread";
            } else {
                return strcmp(mb_strtolower($lang), "de") == 0 ? "Gesetzlich" : "Legal";
            }
        }
    }

    public function batchProcessAction()
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $actionCollection = $this->Request()->getParam('actionCollection', 0);
        $orders = $this->Request()->getParam('orders', [0 => $this->Request()->getParams()]);
        $errors = null;
        $successful = true;

        if (empty($orders)) {
            $successful = false;
            $this->View()->assign([
                    'success' => $successful,
                    'data' => $this->Request()->getParams(),
                    'errors' => $errors
                ]
            );
            return;
        }

        foreach ($orders as $key => $data) {
            if (empty($data) || empty($data['id'])) {
                continue;
            }

            /**
             * @var \Shopware\Models\Order\Order $order
             */
            $order = $this->getOrderRepository()->find($data['id']);
            if (!$order) {
                continue;
            }

            $builderListing = $this->getCrefoOrdersRepository()->getCrefoOrderListingQueryBuilder();
            $builderListing->andWhere('ol.orderId = ?1');
            $builderListing->setParameter(1, $data['id']);
            $arrayOrderListing = $builderListing->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            /**
             * @var OrderListing|null $orderListing
             */
            $orderListing = null;
            if (!is_null($arrayOrderListing)) {
                $orderListing = $this->getCrefoOrdersRepository()->findCrefoObject(OrderListing::class,
                    $arrayOrderListing['id']);
            }


            switch ($actionCollection) {
                case CollectionOrderActions::CREATE:
                    if (isset($data['collectionId']) || !is_null($orderListing) || $order->getCurrency() !== 'EUR') {
                        continue;
                    } else {
                        $orderListing = $this->createProposal($order);
                    }
                    break;
                case CollectionOrderActions::SEND:
                    if (!isset($data['collectionId'])
                        || is_null($orderListing)
                        || (!is_null($orderListing) && $orderListing->getCrefoOrderId()->getCrefoOrderType() === CrefoOrderTypes::Document)
                        || (!is_null($orderListing) && $orderListing->getCrefoOrderId()->getProposalStatus() !== ProposalStatus::ReadyToSend)
                    ) {
                        continue;
                    } else {
                        $orderListing = $this->sendCrefoProposalFromOrder($orderListing, $successful, $errors);
                    }
                    break;
                case CollectionOrderActions::DELETE:
                    if (is_null($orderListing)) {
                        continue;
                    }
                    $orderListing = $this->deleteCrefoProposalFromOrder($orderListing);
                    break;
                default:
                    continue;
            }

            if (!is_null($orderListing)) {
                $data['crefoOrderListing'] = $shopwareModels->toArray($orderListing);
                /**
                 * @var CrefoOrderProposal $proposalOrder
                 */
                $proposalOrder = $orderListing->getCrefoOrderId();
                $data['crefoOrderListing']['crefoOrderProposal'] = $shopwareModels->toArray($proposalOrder);
                $data['collectionId'] = $orderListing->getId();
            } else {
                $data['crefoOrderListing'] = [];
                $data['collectionId'] = null;
            }

            if (!is_null($data['solvencyId'])) {
                $reportBuilder = $this->getReportResultsRepository()->getCompanyReportResultsQueryBuilder();
                $reportBuilder->andWhere('crefo_rr.id = ?1');
                $reportBuilder->setParameter(1, $data['solvencyId']);
                $reportResultArray = $reportBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
                if (is_null($reportResultArray)) {
                    $reportBuilder = $this->getReportResultsRepository()->getPrivatePersonReportResultsQueryBuilder();
                    $reportBuilder->andWhere('pprr.id = ?1');
                    $reportBuilder->setParameter(1, $data['solvencyId']);
                    $reportResultPrivatePerson = $reportBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
                    if (!is_null($reportResultPrivatePerson)) {
                        $reportResultPrivatePerson['privatePersonResult'] = $this->renderBonimaPrivatePersonText($reportResultPrivatePerson);
                        unset($reportResultPrivatePerson['addressValidationResult']);
                        unset($reportResultPrivatePerson['identificationResult']);
                        unset($reportResultPrivatePerson['scoreType']);
                        unset($reportResultPrivatePerson['scoreValue']);
                    }
                    $data['crefoReportResults'] = $reportResultPrivatePerson;
                } else {
                    $data['crefoReportResults'] = $reportResultArray;
                }
            }

            //return the modified data array.
            $orders[$key] = $data;
        }

        $this->View()->assign([
            'success' => true,
            'data' => $orders,
            'errors' => $errors
        ]);
    }

    /**
     * @param OrderListing $orderListing
     * @return OrderListing|null
     */
    public function deleteCrefoProposalFromOrder($orderListing)
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
         */
        $proposal = $orderListing->getCrefoOrderId();

        if ($proposal->getCrefoOrderType() === CrefoOrderTypes::Document) {
            return $orderListing;
        }
        try {
            $shopwareModels->remove($proposal);
            $shopwareModels->remove($orderListing);
            $shopwareModels->flush();
        } catch (Exception $e) {
            $this->crefoLogger->log(CrefoLogger::ERROR, "==deleteCrefoProposalFromOrder==", [$e->getMessage()]);
            return $orderListing;
        }
        return null;
    }

    /**
     * @param OrderListing $orderListing
     * @param boolean $successful
     * @param array|null $errors
     * @return OrderListing
     */
    public function sendCrefoProposalFromOrder($orderListing, &$successful = false, &$errors = null)
    {
        /**
         * @var \Shopware\Components\Model\ModelManager $shopwareModels
         */
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var Enlight_Components_Snippet_Namespace $snippets
         */
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        $generalErrorXML = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>';
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $proposal
         */
        $proposal = $orderListing->getCrefoOrderId();
        /**
         * @var \Shopware\Models\Order\Order $order
         */
        $order = $orderListing->getOrderId();
        /**
         * @var \Shopware\Models\Order\Billing $billing
         */
        $billing = $shopwareModels->find('Shopware\Models\Order\Billing', $order->getBilling());
        /**
         * @var \Shopware\Models\Country\Country $country
         */
        $country = $shopwareModels->find('Shopware\Models\Country\Country', $billing->getCountry());
        /**
         * @var null|\CrefoShopwarePlugIn\Components\API\Request\CollectionOrderRequest $collectionOrderRequest
         */
        $collectionOrderRequest = null;
        $response = null;
        try {
            $collectionOrderRequest = $this->fillOrderRequest($proposal, $order, $billing, $country);
            $result = $collectionOrderRequest->sendOrder();
            $collectionOrderRequest->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($collectionOrderRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $successful = true;
        } catch (\SoapFault $fault) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==sendCrefoProposalFromOrder>>SoapFault " . date(CrefoCrossCuttingComponent::DATE_FORMAT) . "==",
                (array)$fault);
            $result = $fault;
            $collectionOrderRequest->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($collectionOrderRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $errors[$order->getId()] = $collectionOrderRequest->getCrefoParser()->getSoapErrors();
            $successful = false;
            $response = $collectionOrderRequest->getLastSoapCallResponse();
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==sendCrefoProposalFromOrder>>CrefoCommunicationException " . date(CrefoCrossCuttingComponent::DATE_FORMAT) . "==",
                (array)$e);
            $result = new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException($snippets->get('crefo/messages/error_in_communication'),
                $e->getCode());
            $collectionOrderRequest->getCrefoParser()->setRawResponse($result);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($collectionOrderRequest, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
            $errors[$order->getId()] = $collectionOrderRequest->getCrefoParser()->getSoapErrors();
            $successful = false;
            $response = $xmlText;
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==sendCrefoProposalFromOrder>>Error==", (array)$e);
            if (is_null($collectionOrderRequest)) {
                $tempCollectionOrderRequest = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_order_request');
            } else {
                $tempCollectionOrderRequest = $collectionOrderRequest;
            }
            $tempCollectionOrderRequest->getCrefoParser()->setRawResponse($e);
            $dateProcessEnd = new \DateTime('now');
            CrefoCrossCuttingComponent::saveCrefoLogs(
                [
                    'log_status' => \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType::NOT_SAVED,
                    'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                    'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                    'requestXML' => $generalErrorXML,
                    'requestXMLDescription' => 'Error',
                    'responseXML' => $generalErrorXML,
                    'responseXMLDescription' => 'Error'
                ]
            );
            $tempError = $tempCollectionOrderRequest->getCrefoParser()->getSoapErrors();
            empty($tempError) ?: $errors[$order->getId()] = $tempError;
            $successful = false;
            $response = $generalErrorXML;
        } finally {
            if ($successful) {
                /**
                 * @var CrefoOrders $crefoOrders
                 */
                $crefoOrders = $this->saveCrefoOrder($collectionOrderRequest, $proposal);
                $shopwareModels->persist($crefoOrders);
                $shopwareModels->flush();

                $orderListing->setCrefoOrderId($crefoOrders);
                $shopwareModels->persist($orderListing);
                $shopwareModels->remove($proposal);
                $shopwareModels->flush();
            } else {
                $proposal->setProposalStatus(ProposalStatus::Error);
                if(is_null($response)){
                    $response = $generalErrorXML;
                }
                $proposal->setErrorXML($response);
                $shopwareModels->persist($proposal);
                $shopwareModels->flush();
            }
            return $orderListing;
        }
    }

    /**
     *
     */
    public function loadListAction()
    {
        $filters = [['property' => 'status.id', 'expression' => '!=', 'value' => '-1']];
        $orderStatus = $this->getOrderRepository()->getOrderStatusQuery($filters)->getArrayResult();
        $paymentStatus = $this->getOrderRepository()->getPaymentStatusQuery()->getArrayResult();
        $positionStatus = $this->getOrderRepository()->getDetailStatusQuery()->getArrayResult();
        $crefoOrderListing = $this->getCrefoOrdersRepository()->getCrefoOrderListingQuery()->getArrayResult();
        $crefoReportResults = $this->getReportResultsRepository()->getCompanyReportResultsQuery()->getArrayResult();

        $this->View()->assign([
            'success' => true,
            'data' => [
                'orderStatus' => $orderStatus,
                'paymentStatus' => $paymentStatus,
                'positionStatus' => $positionStatus,
                'crefoOrderListing' => $crefoOrderListing,
                'crefoReportResults' => $crefoReportResults
            ]
        ]);
    }

    /**
     * @param array $personReport
     * @return string
     */
    private function renderBonimaPrivatePersonText($personReport)
    {
        $text = AddressValidationResultType::getAddressAcronym(null, $personReport['addressValidationResult']);
        $text .= '<br/>';
        $text .= IdentificationResultType::getIdentificationAcronyms($personReport['identificationResult']);
        $text .= '<br/>' . $personReport['scoreValue'];
        return $text;
    }

    /**
     * @inheritdoc
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'openSolvencyPdf',
            'openXml'
        ];
    }
}
