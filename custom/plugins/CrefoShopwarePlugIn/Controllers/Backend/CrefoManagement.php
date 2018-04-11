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
use \CrefoShopwarePlugIn\Components\Core\CrefoValidator;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \Shopware\Components\CSRFWhitelistAware;

/**
 * Class Shopware_Controllers_Backend_CrefoManagement
 */
class Shopware_Controllers_Backend_CrefoManagement extends Shopware_Controllers_Backend_Application implements CSRFWhitelistAware
{
    const RESPONSE_TEXT_REPORT = "response_textreport_";
    const RESPONSE_XML_REPORT = "response_xmlreport_";
    const PDF_EXTENSION = ".pdf";
    const XML_EXTENSION = ".xml";
    const COLLECTION_FILES_CSV = "collectionfiles.csv";


    protected $model = 'CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults';
    protected $alias = 'crefoReportResults';
    const WINDOWS_NEWLINE = "\r\n";
    const CSV_UTF8_BOM = "\xEF\xBB\xBF";


    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReports\Repository
     */
    private $reportResultsRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoOrders\Repository;
     */
    private $crefoOrderRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoLogs\Repository $crefoLogsRepository
     */
    private $crefoLogsRepository = null;

    /**
     * @return null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger
     */
    private function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.logger');
        }
        return $this->crefoLogger;
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
     * Exports the collection orders and the report Pdfs in a Zip file
     * @method exportCrefoZipAction
     */
    public function exportCrefoZipAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==exportCrefoZip==",
            ['start exporting the CrefoShopwarePlugIn_Export Zip.']);
        $format = strtolower($this->Request()->getParam('format', 'csv'));
        $temp = tempnam(sys_get_temp_dir(), '');
        if (file_exists($temp)) {
            @unlink($temp);
        }
        @mkdir($temp);
        if (is_dir($temp)) {
            $path = $temp . DIRECTORY_SEPARATOR;
            $files = $this->exportSolvencyPdfFromDb($path);
            $files = $this->exportSolvencyXmlFromDb($path, $files);
            $files = $this->exportCollectionOrdersFromDb($format, $path, $files);
            $zipName = $path . "CrefoShopwarePlugIn_Export_" . date("Ymd_His") . ".zip";
            /**
             * @var \CrefoShopwarePlugIn\Components\Core\ZipManager $crefoZipper
             */
            $crefoZipper = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.zip_manager');
            $crefoZipper->create_zip($files, $zipName);
            $this->View()->assign(['success' => true, 'zipName' => $zipName]);
        } else {
            $this->View()->assign(['success' => false]);
        }
    }

    public function downloadZipAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==downloadZipAction==", ['Download Zip.']);
        /**
         * @var Enlight_Controller_Plugins_Json_Bootstrap $json
         */
        $json = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('Front')->Plugins()->Json();
        $json->setRenderer(false);
        $zipName = $this->Request()->getParam('zipName', null);
        if (is_null($zipName)) {
            return;
        }
        $this->Response()->setHeader('Content-Type', 'application/zip'); //or use application/octet-stream
        $this->Response()->setHeader('Content-Length', filesize($zipName));
        $this->Response()->setHeader('Content-Disposition', 'attachment; filename="' . basename($zipName) . '"');
        $this->Response()->setHeader('Content-Transfer-Encoding', 'binary');

        @readfile($zipName);
        @unlink($zipName);
    }

    /**
     * @param string $temp
     * @param array $files
     * @return array
     */
    private function exportSolvencyPdfFromDb($temp, array $files = [])
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==exportSolvencyPdfFromDb==", ['Prepare Solvency PDFs.']);
        $builder = $this->getReportResultsRepository()->getCompanyReportResultsPdfQueryBuilder();
        $builder->where($builder->expr()->isNotNull('crefo_rr.textReportPdf'));
        $reportResultArray = $builder->getQuery()->getArrayResult();
        foreach ($reportResultArray as $report) {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs $crefoLog
             */
            $crefoLog = $this->getCrefoLogsRepository()->findOneBy([
                'reportResultId' => $report['id']
            ], ['id' => 'ASC']);
            if (is_null($crefoLog)) {
                continue;
            }
            $fileName = $temp . self::RESPONSE_TEXT_REPORT . $crefoLog->getId() . self::PDF_EXTENSION;
            file_put_contents($fileName, $report['textReportPdf']);
            $files[] = $fileName;
        }
        return $files;
    }

    /**
     * @param string $temp
     * @param array $files
     * @return array
     */
    private function exportSolvencyXmlFromDb($temp, array $files = [])
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==exportSolvencyXmlFromDb==", ['Prepare Solvency XMLs.']);
        $builder = $this->getReportResultsRepository()->getPrivatePersonReportResultsQueryBuilder();
        $reportResultArray = $builder->getQuery()->getArrayResult();
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\XmlManager $xmlManager
         */
        $xmlManager = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.xml_manager');
        foreach ($reportResultArray as $report) {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs $crefoLog
             */
            $crefoLog = $this->getCrefoLogsRepository()->findOneBy([
                'reportResultId' => $report['id']
            ], ['id' => 'ASC']);
            if (is_null($crefoLog) || strcmp($report['textReportName'], 'fault') == 0) {
                continue;
            }
            $fileName = $temp . self::RESPONSE_XML_REPORT . $crefoLog->getId() . self::XML_EXTENSION;
            $xmlManager->saveXMLToFile($crefoLog->getResponseXML(), $fileName);
            $files[] = $fileName;
        }
        return $files;
    }


    /**
     * @param string $format
     * @param string $temp
     * @param array $files
     * @return array
     */
    private function exportCollectionOrdersFromDb($format, $temp, array $files = [])
    {
        switch ($format) {
            case 'csv':
                return $this->exportCollectionOrdersAsCsv($temp, $files);
                break;
            default:
                return $files;
                break;
        }
    }

    /**
     * @param $temp
     * @param array $files
     * @see Shopware_Components_Convert_Csv
     * @return array
     */
    private function exportCollectionOrdersAsCsv($temp, array $files = [])
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==exportCollectionOrdersAsCsv==", ['Prepare Collection CSV.']);
        $arrayOrders = $this->getCrefoOrdersRepository()->getCrefoOrdersQuery()->getArrayResult();
        $collectionOrders = [];
        foreach ($arrayOrders as $collectionOrder) {
            $collectionOrders[] = $this->buildCsvArrayFromOrder($collectionOrder['id']);
        }
        if (empty($collectionOrders)) {
            return $files;
        }
        $convert = new Shopware_Components_Convert_Csv();
        $convert->sSettings['newline'] = self::WINDOWS_NEWLINE;
        // UTF-8 BOM
        $contentCsv = self::CSV_UTF8_BOM . $convert->encode($collectionOrders);
        file_put_contents($temp . self::COLLECTION_FILES_CSV, $contentCsv);
        $newFiles = $files;
        $newFiles[] = $temp . self::COLLECTION_FILES_CSV;
        return $newFiles;
    }

    /**
     * @param integer $collectionOrderId
     * @return array
     */
    private function buildCsvArrayFromOrder($collectionOrderId)
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==buildCsvArrayFromOrder==", ['Prepare CSV Array.']);

        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders $crefoOrder
         */
        $crefoOrder = $this->getCrefoOrdersRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders::class,
            $collectionOrderId);
        /**
         * @var CrefoValidator $validator
         */
        $validator = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.validator');
        $lang = $crefoOrder->getLanguageIso();
        $sendDate = $crefoOrder->getSentDate();
        $contractDate = $crefoOrder->getDateContract();
        $invoiceDate = $crefoOrder->getDateInvoice();
        $valutaDate = $crefoOrder->getValutaDate();
        $dueDate = $crefoOrder->getDueDate();
        $countryIso = $crefoOrder->getOrderId()->getBilling()->getCountry()->getIso();
        if (strtolower($countryIso) === 'de' || strtolower($countryIso) === 'at') {
            $resultStreet = $validator->computeRawAddress($crefoOrder->getStreet());
        } else {
            $resultStreet['street'] = $crefoOrder->getStreet();
            $resultStreet['number'] = null;
            $resultStreet['affix'] = null;
        }

        $interestRateValue = $validator->formatCurrency(floatval($crefoOrder->getInterestRateValue()), $lang);
        $amount = $validator->formatCurrency($crefoOrder->getAmount(), $lang);
        $csvArray = [
            'useraccount' => $crefoOrder->getUserAccountNumber(),
            'transmissiontimestamp' => $sendDate->format("Y-m-d"),
            'filenumber' => $crefoOrder->getDocumentNumber(),
            'companyname' => $crefoOrder->getCompanyName(),
            'salutation' => $crefoOrder->getSalutation(),
            'firstname' => $crefoOrder->getFirstName(),
            'surname' => $crefoOrder->getLastName(),
            'street' => $resultStreet['street'],
            'housenumber' => $resultStreet['number'],
            'housenumberaffix' => $resultStreet['affix'],
            'postcode' => $crefoOrder->getZipCode(),
            'city' => $crefoOrder->getCity(),
            'country' => $crefoOrder->getCountry(),
            'email' => $crefoOrder->getEmail(),
            'user' => $crefoOrder->getCreditor(),
            'collectionordertype' => $crefoOrder->getOrderType(),
            'interest' => $crefoOrder->getInterestRate(),
            'interestValue' => $interestRateValue,
            'customerreference' => $crefoOrder->getCustomerReference(),
            'remarks' => $crefoOrder->getRemarks(),
            'collectionturnovertype' => $crefoOrder->getTurnoverType(),
            'datecontract' => $contractDate->format("Y-m-d"),
            'dateinvoice' => $invoiceDate->format("Y-m-d"),
            'invoicenumber' => $crefoOrder->getInvoiceNumber(),
            'receivablereason' => $crefoOrder->getReceivableReason(),
            'datevaluta' => $valutaDate->format("Y-m-d"),
            'datedue' => $dueDate->format("Y-m-d"),
            'amount' => $amount,
            'currency' => $crefoOrder->getCurrency()
        ];
        return $csvArray;
    }


    /**
     * Returns a list with actions which should not be validated for CSRF protection
     *
     * @return string[]
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'downloadZip'
        ];
    }
}
