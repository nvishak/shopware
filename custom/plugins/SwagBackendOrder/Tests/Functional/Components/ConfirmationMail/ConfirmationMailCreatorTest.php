<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagBackendOrder\Tests\Functional\Components\ConfirmationMail;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Article\Detail;
use Shopware\Models\Order\Detail as OrderDetailModel;
use Shopware\Models\Order\Order;
use Shopware\Models\Order\Status;
use Shopware_Components_Translation;
use SwagBackendOrder\Components\ConfirmationMail\ConfirmationMailCreator;
use SwagBackendOrder\Components\ConfirmationMail\ConfirmationMailRepository;
use SwagBackendOrder\Components\ConfirmationMail\NumberFormatterWrapper;
use SwagBackendOrder\Components\PriceCalculation\TaxCalculation;
use SwagBackendOrder\Components\Translation\PaymentTranslator;
use SwagBackendOrder\Components\Translation\ShippingTranslator;
use SwagBackendOrder\Tests\DatabaseTestCaseTrait;
use SwagBackendOrder\Tests\FixtureImportTestCaseTrait;

class ConfirmationMailCreatorTest extends \PHPUnit_Framework_TestCase
{
    use DatabaseTestCaseTrait;
    use FixtureImportTestCaseTrait;

    const ORDER_ID = 10000;

    public function test_prepareOrderConfirmationMailData_should_return_localized_billing_sums()
    {
        $this->importFixtures(__DIR__ . '/test-fixtures.sql');

        $confirmationMailCreator = $this->createConfirmationMailCreator();

        $order = Shopware()->Models()->find(Order::class, self::ORDER_ID);
        $mailData = $confirmationMailCreator->prepareOrderConfirmationMailData($order);

        $this->assertEquals('63,89 EUR', $mailData['sAmount']);
        $this->assertEquals('53,69 EUR', $mailData['sAmountNet']);
        $this->assertEquals('3,90 EUR', $mailData['sShippingCosts']);
    }

    public function test_prepareOrderDetailsConfirmationMailData_should_return_localized_billing_sums()
    {
        $this->importFixtures(__DIR__ . '/test-fixtures.sql');

        $confirmationMailCreator = $this->createConfirmationMailCreator();

        $order = Shopware()->Models()->find(Order::class, self::ORDER_ID);
        $orderDetails = $confirmationMailCreator->prepareOrderDetailsConfirmationMailData($order, $order->getLanguageSubShop()->getLocale());

        $this->assertEquals('50,41', $orderDetails[0]['netprice']);
        $this->assertEquals('59,99', $orderDetails[0]['amount']);
        $this->assertEquals('50,00', $orderDetails[0]['amountnet']);
        $this->assertEquals('59,99', $orderDetails[0]['priceNumeric']);
        $this->assertEquals('59,99', $orderDetails[0]['price']);
    }

    public function test_prepareOrderDetailsConfirmationMailData_with_discount()
    {
        $this->importFixtures(__DIR__ . '/test-fixtures.sql');

        //Insert the discount into the order
        /** @var Order $order */
        $order = Shopware()->Models()->find(Order::class, self::ORDER_ID);
        $confirmationMailCreator = $this->createConfirmationMailCreator();

        $this->insertDiscount($order);

        $orderDetails = $confirmationMailCreator->prepareOrderDetailsConfirmationMailData($order, $order->getLanguageSubShop()->getLocale());
        $discountDetails = $orderDetails[1];

        $this->assertEquals('DISCOUNT.0', $discountDetails['ordernumber']);
        $this->assertEquals('DISCOUNT.0', $discountDetails['ordernumber']);
        $this->assertEquals(4, $discountDetails['modus']);
    }

    /**
     * @param Order $order
     */
    private function insertDiscount(Order $order)
    {
        $detail = new OrderDetailModel();
        $detail->setTaxRate(0);
        $detail->setQuantity(1);
        $detail->setShipped(0);
        $detail->setOrder($order);
        $detail->setNumber($order->getNumber());
        $detail->setArticleId(0);
        $detail->setArticleName('Discount (percentage)');
        $detail->setArticleNumber('DISCOUNT.0');
        $detail->setPrice(-10.0);
        $detail->setMode(4);
        $detail->setStatus(Shopware()->Models()->find(Status::class, 0));

        /** @var ModelManager $em */
        $em = Shopware()->Container()->get('models');
        $em->persist($detail);
        $em->flush($detail);
    }

    /**
     * @return ConfirmationMailCreator
     */
    private function createConfirmationMailCreator()
    {
        return new ConfirmationMailCreator(
            new TaxCalculation(),
            new PaymentTranslator(new Shopware_Components_Translation()),
            new ShippingTranslator(new Shopware_Components_Translation()),
            new ConfirmationMailRepository(Shopware()->Container()->get('dbal_connection')),
            Shopware()->Models()->getRepository(Detail::class),
            Shopware()->Container()->get('config'),
            new NumberFormatterWrapper(),
            Shopware()->Modules()->Articles()
        );
    }
}
