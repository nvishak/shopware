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

namespace CrefoShopwarePlugIn\Setup;

use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use \CrefoShopwarePlugIn\CrefoShopwarePlugIn;
use \Doctrine\ORM\Tools\SchemaTool;
use \Shopware\Models\Payment\Payment;
use \Shopware\Models\Shop\Shop;
use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Shopware\Components\Plugin\Context\InstallContext;

/**
 * Class Installer
 * @codeCoverageIgnore
 * @package CrefoShopwarePlugIn\Setup
 */
class Installer
{
    const GERMAN_LOCALE = 'de_DE';
    const ENGLISH_LOCALE = 'en_GB';
    /** @var ContainerInterface */
    private $container;

    /**
     * @var CrefoShopwarePlugIn
     */
    private $creditreformPlugin;

    /**
     * Installer constructor.
     * @param ContainerInterface $container
     * @param CrefoShopwarePlugIn $creditreform
     */
    public function __construct(ContainerInterface $container, CrefoShopwarePlugIn $creditreform)
    {
        $this->container = $container;
        $this->creditreformPlugin = $creditreform;
    }

    /**
     * @param InstallContext $context
     * @return bool
     * @throws \Exception
     */
    public function install(InstallContext $context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, "Start installing transaction.", ["Install plugin."]);
        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $this->container->get('dbal_connection');
        $connection->beginTransaction();
        try {
            $this->createCrefoPayment($context);
            $this->createSchema();
            $this->addInitData($connection);
            $this->addCron($context->getPlugin()->getId(), $connection);
            $connection->commit();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, "==Plugin is not successful installed.==",
                (array)$e);
            $this->creditreformPlugin->rollbackInstallation($connection, $context);
            throw new \Exception($e->getMessage());
        }
        $context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
        return true;
    }

    /**
     * @param InstallContext $context
     */
    private function createCrefoPayment(InstallContext $context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==create CrefoPayment==", ["Create payment."]);
        /**
         * @var \Shopware\Models\Payment\Repository $paymentRepo
         */
        $paymentRepo = $this->getEntityManager()->getRepository('Shopware\Models\Payment\Payment');

        $dbPayment = $paymentRepo->findOneBy(['name' => 'crefo_invoice']);
        if (!is_null($dbPayment)) {
            return;
        }
        /**
         * @var \Shopware\Models\Country\Repository $countryRepo
         */
        $countryRepo = $this->getEntityManager()->getRepository('Shopware\Models\Country\Country');
        $countries = $countryRepo->getCountriesQuery()->getArrayResult();
        $countriesWanted = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($countries as $country) {
            if (in_array(strtoupper($country['iso']),
                CountryType::getAllowedCountriesISOForCompanies())) {
                $countriesWanted->add($countryRepo->find($country['id']));
            }
        }
        /**
         * @var \Shopware_Components_Snippet_Manager $snippets
         */
        $snippets = $this->container->get('snippets');
        $namespace = $snippets->getNamespace('frontend/creditreform/translation');
        $descriptionPayment = $namespace->get('frontend/shippingPayment/crefo_invoice_name',
            'Rechnung mit Creditreform-Bonitätsprüfung');
        $paymentArray = [
            'Name' => 'crefo_invoice',
            'Description' => $descriptionPayment,
            'Action' => 'crefo_invoice',
            'Class' => 'crefo_invoice',
            'Template' => 'crefo_invoice.tpl',
            'Table' => '',
            'Hide' => '0',
            'Active' => '0',
            'Position' => '0',
            'DebitPercent' => '0',
            'Surcharge' => '0',
            'SurchargeString' => '',
            'EsdActive' => '0',
            'EmbedIFrame' => '',
            'HideProspect' => '0',
            'MobileInactive' => '0',
            'Source' => null, // null - default payment & cannot be deleted, 1 - self-created & can be deleted
            'Countries' => $countriesWanted,
            'AdditionalDescription' => ''//'text for additional Description'
        ];
        /**
         * @var \Shopware\Models\Payment\Repository $paymentsRepo
         */
        $paymentsRepo = $this->getEntityManager()->getRepository(Payment::class);
        /**
         * @var Payment $payment
         */
        $payment = $paymentsRepo->findOneBy(['name' => $paymentArray['Name']]);
        if ($payment === null) {
            $payment = new Payment();
            $payment->setName($paymentArray['Name']);
            Shopware()->Models()->persist($payment);
        }
        $payment->fromArray($paymentArray);
        CrefoCrossCuttingComponent::getShopwareInstance()->Models()->persist($payment);
        $context->getPlugin()->getPayments()->add($payment);
        $payment->setPlugin($context->getPlugin());
        CrefoCrossCuttingComponent::getShopwareInstance()->Models()->flush($payment);
        $this->addExtraLanguageInConfig($payment->getId());
    }

    /**
     * @param int $paymentId
     */
    private function addExtraLanguageInConfig($paymentId)
    {
        /**
         * @var \Shopware_Components_Auth $auth
         */
        $auth = $this->container->get('Auth');
        /**
         * @var \Shopware_Components_Translation $translator
         */
        $translator = new \Shopware_Components_Translation();
        $localeId = $auth->getIdentity()->localeID;
        $arrayLocales = $this->getLocalesArray();
        $baseShops = $this->getBaseShops();
        foreach($baseShops as $shop){
            foreach ($arrayLocales as $locale) {
                if($locale['id'] == $shop['localeId'] && $shop['default'] == false) {
                    $arrayConfigPayment = $translator->read($locale['id'], 'config_payment', 1, false);
                    if (!is_array($arrayConfigPayment)) {
                        $arrayConfigPayment = [];
                    }
                    if (!array_key_exists($paymentId, $arrayConfigPayment)) {
                        $arrayConfigPayment[$paymentId] = ['description' => $this->getCrefoPaymentDescription($locale['id'])];
                        $translator->write($shop['id'], 'config_payment', 1, $arrayConfigPayment, false);
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    private function getLocalesArray()
    {
        /**
         * @var \Shopware\Models\Shop\Repository $repoShop
         */
        $repoShop = $this->getEntityManager()->getRepository(Shop::class);
        $arrayLocales = $queryDe = $repoShop->getLocalesListQuery()->getArrayResult();
        $locales = [];
        foreach ($arrayLocales as $locale) {
            if (($locale['locale'] == self::GERMAN_LOCALE || $locale['locale'] == self::ENGLISH_LOCALE) && !in_array($locale,
                    $locales)
            ) {
                $locales[] = $locale;
            }
            if (count($locales) == 2) {
                return $locales;
            }
        }
        return $locales;
    }

    /**
     * @return array
     */
    private function getBaseShops()
    {
        /**
         * @var \Shopware\Models\Shop\Repository $repoShop
         */
        $repoShop = $this->getEntityManager()->getRepository(Shop::class);
        return $repoShop->getBaseListQuery()->getArrayResult();
    }

    /**
     * @param $localeId
     * @return string
     */
    private function getCrefoPaymentDescription($localeId)
    {
        /**
         * @var \Shopware_Components_Snippet_Manager $snippets
         */
        $snippets = $this->container->get('snippets');
        /**
         * @var \Shopware\Models\Shop\Locale $locale
         */
        $locale = $this->getEntityManager()->find('Shopware\Models\Shop\Locale', $localeId);
        $snippets->setLocale($locale);
        $namespace = $snippets->getNamespace('frontend/creditreform/translation');
        return $namespace->get('frontend/shippingPayment/crefo_invoice_name',
            'Rechnung mit Creditreform-Bonitätsprüfung');
    }

    /**
     *
     * @return \Shopware\Components\Model\ModelManager
     */
    protected function getEntityManager()
    {
        return $this->container->get('Models');
    }

    /**
     * Creates Schema
     */
    private function createSchema()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==create schema==", ["Create DB schema."]);
        $this->creditreformPlugin->registerCustomModels();
        $tool = new SchemaTool($this->getEntityManager());
        $classes = $this->creditreformPlugin->getCrefoClassArray();
        /**
         * Just to be on the safe side that any residual tables are still existent in DB
         */
        $tool->dropSchema($classes);
        $tool->createSchema($classes);
    }

    /**
     * @param \Doctrine\DBAL\Connection $connection
     */
    private function addInitData($connection)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, "==addInitData==",
            ["Start to initiate data in DB."]);
        $connection->insert('crefo_plugin_settings',
            [
                'communicationLanguage' => 'de',
                'logsMaxNumberOfRequest' => 0,
                'logsMaxStorageTime' => 2,
                'errorNotificationStatus' => false,
                'emailAddress' => null,
                'requestCheckAtValue' => null,
                'errorTolerance' => null,
                'consentDeclaration' => 1
            ]);
        $connection->insert('crefo_report_company_config',
            [
                'useraccountId' => null,
                'legitimateKey' => null,
                'reportLanguageKey' => null
            ]);
        $connection->insert('crefo_report_private_person_config',
            [
                'userAccountId' => null,
                'legitimateKey' => null
            ]);
        $connection->insert('crefo_error_requests',
            [
                'numberOfRequests' => 0,
                'numberOfFailedRequests' => 0
            ]);
        $connection->insert('crefo_inkasso_config',
            [
                'useraccountId' => null,
                'creditor' => null,
                'order_type' => null,
                'interest_rate_radio' => null,
                'interest_rate_value' => null,
                'customer_reference' => 1,
                'turnover_type' => null,
                'receivable_reason' => null,
                'valuta_date' => 0,
                'due_date' => 0
            ]);

        $emailContentDe = <<<EOT
Sie erhalten diese E-Mail, da die Fehler-Benachrichtigung aktiviert ist, die Anfragen-Prüfmenge erreicht wurde und die Fehlertoleranz überschritten wurde. 

Software 
Software-Name			    CrefoShopwarePlugIn
Software-Version		    {\$errorNotification.softwareVersion} 
WebShop-Version			    {\$errorNotification.webshopVersion} 

Details zur aktuellen Prüfung 
Anzahl Anfragen			    {\$errorNotification.numberOfRequests} 
Anzahl Fehler			    {\$errorNotification.numberOfFailedRequests}  
Fehlerquote				    {\$errorNotification.errorQuote} % 

Aktuelle Einstellungen zur Fehler-Benachrichtigung 
Fehler-Benachrichtigung	    {\$errorNotification.errorNotification}  
Email-Adresse			    {\$errorNotification.emailAddress}  
Anfragen-Prüfmenge		    {\$errorNotification.numberOfRequestCheck}  
Fehlertoleranz			    {\$errorNotification.errorTolerance} %
 
Bitte prüfen Sie, ob es Unregelmäßigkeiten gab. 
Diese Nachricht wurde automatisch generiert. Bitte antworten Sie nicht darauf.
EOT;
        $emailHtmlContentDe = <<<EOT
<div style='font-family: "Courier New", Courier, monospace; font-size:10pt;'>        
<div>Sie erhalten diese E-Mail, da die Fehler-Benachrichtigung aktiviert ist, die Anfragen-Prüfmenge erreicht wurde und die Fehlertoleranz überschritten wurde.</div>
<br />
<div>Software</div>
<table style='font-family: "Courier New", Courier, monospace; font-size:10pt;'>
<tbody>
<tr>
<td>Software-Name</td>
<td style="padding-left:50px;">CrefoShopwarePlugIn</td>
</tr>
<tr>
<td>Software-Version</td>
<td style="padding-left:50px;">{\$errorNotification.softwareVersion}</td>
</tr>
<tr>
<td>WebShop-Version</td>
<td style="padding-left:50px;">{\$errorNotification.webshopVersion}</td>
</tr>
<tr>
<td colspan=2>&nbsp;</td>
</tr>
<tr>
<td colspan=2>Details zur aktuellen Prüfung</td>
</tr>
<tr>
<td>Anzahl Anfragen</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfRequests}</td>
</tr>
<tr>
<td>Anzahl Fehler</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfFailedRequests}</td>
</tr>
<tr>
<td>Fehlerquote</td>
<td style="padding-left:50px;">{\$errorNotification.errorQuote} %</td>
</tr>
<tr>
<td colspan=2>&nbsp;</td>
</tr>
<tr>
<td colspan=2>Aktuelle Einstellungen zur Fehler-Benachrichtigung</td>
</tr>
<tr>
<td>Fehler-Benachrichtigung</td>
<td style="padding-left:50px;">{\$errorNotification.errorNotification}</td>
</tr>
<tr>
<td>Email-Adresse</td>
<td style="padding-left:50px;">{\$errorNotification.emailAddress}</td>
</tr>
<tr>
<td>Anfragen-Prüfmenge</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfRequestCheck}</td>
</tr>
<tr>
<td>Fehlertoleranz</td>
<td style="padding-left:50px;">{\$errorNotification.errorTolerance} %</td>
</tr>
</tbody>
</table>
<br />
<div>Bitte prüfen Sie, ob es Unregelmäßigkeiten gab.<br /> 
Diese Nachricht wurde automatisch generiert. Bitte antworten Sie nicht darauf.</div>
</div>
EOT;

        /**
         * Create EMail template german Version
         */
        $connection->insert('s_core_config_mails',
            [
                'name' => 'sCREFOERRORREQUESTNOTIFICATIONDE',
                'fromMail' => '{config name=mail}',
                'fromName' => '{config name=shopName}',
                'subject' => 'Creditreform-PlugIn: Fehler-Benachrichtigung',
                'content' => $emailContentDe,
                'contentHTML' => $emailHtmlContentDe,
                'ishtml' => true,
                'dirty' => false,
                'mailtype' => 1,
                'context' => null
            ]);
        $emailContentEn = <<<EOT
You are receiving this email because the error notification is activated, the requests check amount was reached and the error tolerance has been exceeded.

Software 
Software Name        			CrefoShopwarePlugIn
Software Version          		{\$errorNotification.softwareVersion} 
WebShop Version          		{\$errorNotification.webshopVersion} 

Current Check Details
Number of Requests         		{\$errorNotification.numberOfRequests} 
Number of Errors  			    {\$errorNotification.numberOfFailedRequests}  
Error Rate             			{\$errorNotification.errorQuote} % 

Current Error Notification Settings
Error Notification        		{\$errorNotification.errorNotification}  
Email Address           		{\$errorNotification.emailAddress}  
Requests Check Amount     		{\$errorNotification.numberOfRequestCheck}  
Error Tolerance      			{\$errorNotification.errorTolerance} %
 
Please check whether there were irregularities.
This message was generated automatically. Please do not reply to it.
EOT;
        $emailHtmlContentEn = <<<EOT
<div style='font-family: "Courier New", Courier, monospace; font-size:10pt;'>        
<div>You are receiving this email because the error notification is activated, the requests check amount was reached and the error tolerance has been exceeded.</div>
<br />
<div>Software</div>
<table style='font-family: "Courier New", Courier, monospace; font-size:10pt;'>
<tbody>
<tr>
<td>Software Name</td>
<td style="padding-left:50px;">CrefoShopwarePlugIn</td>
</tr>
<tr>
<td>Software Version</td>
<td style="padding-left:50px;">{\$errorNotification.softwareVersion}</td>
</tr>
<tr>
<td>WebShop Version</td>
<td style="padding-left:50px;">{\$errorNotification.webshopVersion}</td>
</tr>
<tr>
<td colspan=2>&nbsp;</td>
</tr>
<tr>
<td colspan=2>Current Check Details</td>
</tr>
<tr>
<td>Number of Requests</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfRequests}</td>
</tr>
<tr>
<td>Number of Errors</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfFailedRequests}</td>
</tr>
<tr>
<td>Error Rate</td>
<td style="padding-left:50px;">{\$errorNotification.errorQuote} %</td>
</tr>
<tr>
<td colspan=2>&nbsp;</td>
</tr>
<tr>
<td colspan=2>Current Error Notification Settings</td>
</tr>
<tr>
<td>Error Notification</td>
<td style="padding-left:50px;">{\$errorNotification.errorNotification}</td>
</tr>
<tr>
<td>Email Address</td>
<td style="padding-left:50px;">{\$errorNotification.emailAddress}</td>
</tr>
<tr>
<td>Requests Check Amount</td>
<td style="padding-left:50px;">{\$errorNotification.numberOfRequestCheck}</td>
</tr>
<tr>
<td>Error Tolerance</td>
<td style="padding-left:50px;">{\$errorNotification.errorTolerance} %</td>
</tr>
</tbody>
</table>
<br />
<div>Please check whether there were irregularities.<br />
This message was generated automatically. Please do not reply to it.</div>
</div>
EOT;

        /**
         * Create EMail template english Version
         */
        $connection->insert('s_core_config_mails',
            [
                'name' => 'sCREFOERRORREQUESTNOTIFICATIONEN',
                'fromMail' => '{config name=mail}',
                'fromName' => '{config name=shopName}',
                'subject' => 'Creditreform-PlugIn: Error Notification',
                'content' => $emailContentEn,
                'contentHTML' => $emailHtmlContentEn,
                'ishtml' => true,
                'dirty' => false,
                'mailtype' => 1,
                'context' => null
            ]);
    }

    /**
     * adds Cron to the cron table
     * @param int $pluginId
     * @param \Doctrine\DBAL\Connection $connection
     */
    private function addCron($pluginId, $connection)
    {
        $startCronFromTomorrow = new \DateTime();
        $startCronFromTomorrow->add(new \DateInterval('P1D'));
        $connection->insert(
            's_crontab',
            [
                'name' => 'CrefoLogs',
                'action' => 'DeleteCrefoLogs',
                'next' => $startCronFromTomorrow,
                'start' => null,
                '`interval`' => 86400,
                'active' => 1,
                'end' => $startCronFromTomorrow,
                'pluginID' => $pluginId
            ],
            [
                'next' => 'datetime',
                'end' => 'datetime'
            ]
        );
    }
}
