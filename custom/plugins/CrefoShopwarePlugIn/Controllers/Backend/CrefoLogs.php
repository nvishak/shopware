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

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use Shopware\Components\CSRFWhitelistAware;

/**
 * Class Shopware_Controllers_Backend_CrefoLogs
 * @codeCoverageIgnore
 */
class Shopware_Controllers_Backend_CrefoLogs extends Shopware_Controllers_Backend_Application implements CSRFWhitelistAware
{
    const COLUMN_IDX_REQUEST = 2;
    protected $model = 'CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs';
    protected $alias = 'CrefoLogs';

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoLogs\Repository;
     */
    private $crefoLogsRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReports\Repository
     */
    private $reportResultsRepository = null;

    /**
     * @codeCoverageIgnore
     */
    public function getCrefoLogsAction()
    {
        $limit = $this->Request()->getParam('limit', 20);
        $offset = $this->Request()->getParam('start', 0);
        $sort = $this->Request()->getParam('sort', null);
        $filter = $this->Request()->getParam('filter', null);

        $list = $this->getLogList($filter, $sort, $offset, $limit);
        $this->View()->assign($list);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getServerLogsAction()
    {
        $limit = $this->Request()->getParam('limit', 20);
        $sort = $this->Request()->getParam('sort', null);
        $offset = $this->Request()->getParam('start', 0);

        $pathServerLogs = CrefoCrossCuttingComponent::getShopwareInstance()->DocPath() . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;
        $scanFiles = scandir($pathServerLogs);
        $files = [];

        //filter files
        foreach ($scanFiles as $file) {
            if (strpos($file, 'crefo') !== false) {
                $files[] = $file;
            }
        }

        $direction = 'DESC';
        if (null !== $sort) {
            $direction = $sort[0]['direction'];
        }
        if ($direction === 'ASC') {
            asort($files);
        } else {
            arsort($files);
        }

        $crefoLogs = [];
        $iter = 0;
        foreach ($files as $file) {
            if (strpos($file, 'crefo-') !== false && $iter >= $offset && $iter < ($offset + $limit)) {
                $crefoLogs[]['filename'] = $file;
            }
            ++$iter;
        }

        $this->View()->assign(['success' => true, 'data' => $crefoLogs]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function openXmlAction()
    {
        $xmlId = intval($this->Request()->getParam('xmlId', 0));
        $colId = intval($this->Request()->getParam('columnId', 0));
        $success = $xmlId !== 0 && $colId !== 0;
        $data = '';
        $title = 'XMLReport';

        try {
            if (!$success) {
                throw new \Exception('Wrong parameters received.');
            }
            $query = $this->getCrefoLogsRepository()->getCrefoLogsXmlsQuery($xmlId);
            $oneLogsResultArray = $query->getArrayResult();
            if (null === $oneLogsResultArray || empty($oneLogsResultArray)) {
                throw new \Exception('Xmls not found.');
            }
            if ($colId === self::COLUMN_IDX_REQUEST) {
                $data = $oneLogsResultArray[0]['requestXML'];
                $title = 'request_xmlreport_' . $xmlId . '.xml';
            } else {
                $data = $oneLogsResultArray[0]['responseXML'];
                $title = 'response_xmlreport_' . $xmlId . '.xml';
            }
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==openXmlAction==', (array) $e);
            $success = false;
        }
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\XmlManager $manager
         */
        $manager = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.xml_manager');

        $this->View()->assign([
            'success' => $success,
            'title' => $title,
            'dataXml' => $manager->formatXmlPretty($data),
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function exportLogsZipAction()
    {
        $xmlRowId = $this->Request()->getParam('xmlRowId', null);
        $reportResultId = $this->Request()->getParam('reportResultId', null);

        if (null === $xmlRowId) {
            $this->View()->assign(['success' => false]);

            return;
        }

        $tempfile = tempnam(sys_get_temp_dir(), '');
        if (file_exists($tempfile)) {
            @unlink($tempfile);
        }
        @mkdir($tempfile);
        $tempfile .= DIRECTORY_SEPARATOR;

        $files = [];
        $success = true;
        $zipName = null;
        try {
            $query = $this->getCrefoLogsRepository()->getCrefoLogsXmlsQuery($xmlRowId);
            $oneLogsResultArray = $query->getArrayResult();
            if (null === $oneLogsResultArray || empty($oneLogsResultArray)) {
                throw new \Exception('Xmls not found.');
            }
            $nameResponsePDF = '';
            if (null !== $reportResultId) {
                $nameResponsePDF = $tempfile . DIRECTORY_SEPARATOR . 'response_textreport.pdf';
                $pdfBuilder = $this->getReportResultsRepository()->getCompanyReportResultsPdfQueryBuilder();
                $pdfBuilder->where($pdfBuilder->expr()->andX(
                    $pdfBuilder->expr()->eq('crefo_rr.id', '?1'),
                    $pdfBuilder->expr()->isNotNull('crefo_rr.textReportPdf')
                ));
                $pdfBuilder->setParameter(1, $reportResultId);
                $arrayPdf = $pdfBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
                if (!empty($arrayPdf)) {
                    file_put_contents($nameResponsePDF, $arrayPdf['textReportPdf']);
                    $files[] = $nameResponsePDF;
                } else {
                    $reportResultId = null;
                }
            }
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs $crefoLog
             */
            $crefoLog = $this->getCrefoLogsRepository()->find($oneLogsResultArray[0]['id']);
            $zipName = $tempfile . 'CrefoShopwarePlugIn_LogEntry_' . $xmlRowId . '_' . $crefoLog->getTsResponse()->format('Ymd_His') . '.zip';

            $nameRequestXML = $tempfile . DIRECTORY_SEPARATOR . 'request.xml';
            $nameResponseXML = $tempfile . DIRECTORY_SEPARATOR . 'response.xml';

            /**
             * @var \CrefoShopwarePlugIn\Components\Core\XmlManager $xmlManager
             */
            $xmlManager = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.xml_manager');

            $xmlManager->saveXMLToFile($crefoLog->getRequestXML(), $nameRequestXML);
            $xmlManager->saveXMLToFile($crefoLog->getResponseXML(), $nameResponseXML);

            $files[] = $nameRequestXML;
            $files[] = $nameResponseXML;

            /**
             * @var \CrefoShopwarePlugIn\Components\Core\ZipManager $crefoZipper
             */
            $crefoZipper = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.zip_manager');
            $crefoZipper->create_zip($files, $zipName);

            @unlink($nameRequestXML);
            @unlink($nameResponseXML);
            if (null !== $reportResultId) {
                @unlink($nameResponsePDF);
            }
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==exportLogsZipAction==', (array) $e);
            $success = false;
        }
        $this->View()->assign(['success' => $success, 'zipName' => $zipName]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function createServerLogsZipAction()
    {
        $params = $this->Request()->getParams();
        $records = json_decode($params['records']);

        if (null === $records) {
            $this->View()->assign(['success' => false]);

            return;
        }
        $pathServerLogs = CrefoCrossCuttingComponent::getShopwareInstance()->DocPath() . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;

        $success = true;
        $zipName = null;
        try {
            $zipName = $pathServerLogs . 'CrefoShopwarePlugIn_ServerLogs_' . date('Ymd_His') . '.zip';
            $files = scandir($pathServerLogs);
            $selectedServerLogs = [];
            foreach ($records as $filename) {
                if (in_array($filename, $files)) {
                    $selectedServerLogs[] = $pathServerLogs . $filename;
                }
            }

            /**
             * @var \CrefoShopwarePlugIn\Components\Core\ZipManager $crefoZipper
             */
            $crefoZipper = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.zip_manager');
            $crefoZipper->create_zip($selectedServerLogs, $zipName);
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==exportLogsZipAction==', (array) $e);
            $success = false;
        }

        $this->View()->assign(['success' => $success, 'zipName' => $zipName]);
    }

    /**
     * Downloads Zip
     * @codeCoverageIgnore
     * @method downloadZip
     */
    public function downloadZipAction()
    {
        /**
         * @var Enlight_Controller_Plugins_Json_Bootstrap $json
         */
        $json = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('Front')->Plugins()->Json();
        $json->setRenderer(false);

        $zipName = $this->Request()->getParam('zipName', null);

        if (null === $zipName) {
            return;
        }

        $this->Response()->setHeader('Content-Type', 'application/zip'); //or use application/octet-stream
        $this->Response()->setHeader('Content-Length', filesize($zipName));
        $this->Response()->setHeader('Content-Disposition', 'attachment; filename="' . basename($zipName) . '"');
        $this->Response()->setHeader('Content-Transfer-Encoding', 'binary');

        readfile($zipName);
        unlink($zipName);
    }

    /**
     * Opens the report Pdf
     * @codeCoverageIgnore
     * @method openSolvencyPdf
     */
    public function openSolvencyPdfAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==openPDF==', ['Open solvency PDF.']);
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
            $namePDF = $tempfile . DIRECTORY_SEPARATOR . 'response_textreport_' . $params['id'] . '.pdf';
            $pdfBuilder = $this->getReportResultsRepository()->getCompanyReportResultsPdfQueryBuilder();
            $pdfBuilder->andWhere('crefo_rr.id = ?1');
            $pdfBuilder->setParameter(1, $params['id']);
            $pdf = $pdfBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

            file_put_contents($namePDF, $pdf['textReportPdf']);
            $this->Response()->setHeader('Content-Type', 'application/pdf'); //or use application/octet-stream
            $this->Response()->setHeader('Content-Length', filesize($namePDF));
            $this->Response()->setHeader('Content-Disposition', 'inline; filename="' . basename($namePDF) . '"');
            $this->Response()->setHeader('Content-Transfer-Encoding', 'binary');

            @readfile($namePDF);
            @unlink($namePDF);
        }
    }

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'openXml',
            'downloadZip',
            'openSolvencyPdf',
        ];
    }

    /**
     * @param int   $filter
     * @param int   $sort
     * @param array $offset
     * @param array $limit
     * @param array $wholeParams
     *
     * @return array
     */
    protected function getLogList($filter, $sort, $offset, $limit, array $wholeParams = [])
    {
        if (empty($sort)) {
            $sort = [['property' => 'clog.id', 'direction' => 'DESC']];
        } else {
            $sort[0]['property'] = 'clog.' . $sort[0]['property'];
        }

        $query = $this->getCrefoLogsRepository()->getCrefoLogsQuery($filter, $sort, $offset, $limit);

        $query->setHydrationMode(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $paginator = $this->getModelManager()->createPaginator($query);

        //returns the total count of the query
        $total = $paginator->count();

        //returns the customer data
        $logs = $paginator->getIterator()->getArrayCopy();

        foreach ($logs as $key => $data) {
            if (empty($data) || empty($data['id']) || null === $data['reportResultId']) {
                continue;
            }
            $reportBuilder = $this->getReportResultsRepository()->getCompanyReportResultsQueryBuilder();
            $reportBuilder->where($reportBuilder->expr()->andX(
                $reportBuilder->expr()->eq('crefo_rr.id', '?1'),
                $reportBuilder->expr()->isNotNull('crefo_rr.textReportPdf')
            ));
            $reportBuilder->setParameter(1, $data['reportResultId']);
            $reportResultArray = $reportBuilder->getQuery()->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
            if (null !== $reportResultArray) {
                $data['crefoReportResult'] = $reportResultArray;
            }

            //return the modified data array.
            $logs[$key] = $data;
        }

        return [
            'success' => true,
            'data' => $logs,
            'total' => $total,
        ];
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
}
