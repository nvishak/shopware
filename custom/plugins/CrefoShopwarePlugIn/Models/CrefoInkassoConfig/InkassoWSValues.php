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

namespace CrefoShopwarePlugIn\Models\CrefoInkassoConfig;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_inkasso_ws_values")
 * @ORM\Entity(repositoryClass="InkassoConfigRepository")
 * @ORM\HasLifecycleCallbacks
 */
class InkassoWSValues extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $keyWS
     *
     * @ORM\Column(name="keyWS", nullable=false, unique=true)
     */
    private $keyWS;

    /**
     * @var string $textWS
     *
     * @ORM\Column(name="textWS", nullable=false)
     */
    private $textWS;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKeyWS()
    {
        return $this->keyWS;
    }

    /**
     * @return string
     */
    public function getTextWS()
    {
        return $this->textWS;
    }

    /**
     * @param string $key
     */
    public function setKeyWS($key)
    {
        $this->keyWS = $key;
    }

    /**
     * @param string $text
     */
    public function setTextWS($text)
    {
        $this->textWS = $text;
    }

}