<?php

/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */


namespace Shopware\Models\Attribute;
use Shopware\Components\Model\ModelEntity,
    Doctrine\ORM\Mapping AS ORM,
    Symfony\Component\Validator\Constraints as Assert,
    Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="s_order_attributes")
 */
class Order extends ModelEntity
{
    

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
     protected $id;


    /**
     * @var integer $orderId
     *
     * @ORM\Column(name="orderID", type="integer", nullable=true)
     */
     protected $orderId;


    /**
     * @var string $attribute1
     *
     * @ORM\Column(name="attribute1", type="text", nullable=true)
     */
     protected $attribute1;


    /**
     * @var string $attribute2
     *
     * @ORM\Column(name="attribute2", type="text", nullable=true)
     */
     protected $attribute2;


    /**
     * @var string $attribute3
     *
     * @ORM\Column(name="attribute3", type="text", nullable=true)
     */
     protected $attribute3;


    /**
     * @var string $attribute4
     *
     * @ORM\Column(name="attribute4", type="text", nullable=true)
     */
     protected $attribute4;


    /**
     * @var string $attribute5
     *
     * @ORM\Column(name="attribute5", type="text", nullable=true)
     */
     protected $attribute5;


    /**
     * @var string $attribute6
     *
     * @ORM\Column(name="attribute6", type="text", nullable=true)
     */
     protected $attribute6;


    /**
     * @var \Shopware\Models\Order\Order
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Order\Order", inversedBy="attribute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orderID", referencedColumnName="id")
     * })
     */
    protected $order;
    


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
    

    public function getAttribute1()
    {
        return $this->attribute1;
    }

    public function setAttribute1($attribute1)
    {
        $this->attribute1 = $attribute1;
        return $this;
    }
    

    public function getAttribute2()
    {
        return $this->attribute2;
    }

    public function setAttribute2($attribute2)
    {
        $this->attribute2 = $attribute2;
        return $this;
    }
    

    public function getAttribute3()
    {
        return $this->attribute3;
    }

    public function setAttribute3($attribute3)
    {
        $this->attribute3 = $attribute3;
        return $this;
    }
    

    public function getAttribute4()
    {
        return $this->attribute4;
    }

    public function setAttribute4($attribute4)
    {
        $this->attribute4 = $attribute4;
        return $this;
    }
    

    public function getAttribute5()
    {
        return $this->attribute5;
    }

    public function setAttribute5($attribute5)
    {
        $this->attribute5 = $attribute5;
        return $this;
    }
    

    public function getAttribute6()
    {
        return $this->attribute6;
    }

    public function setAttribute6($attribute6)
    {
        $this->attribute6 = $attribute6;
        return $this;
    }
    

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
    
}