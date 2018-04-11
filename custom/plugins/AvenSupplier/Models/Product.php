<?php

namespace AvenSupplier\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_supplier")
 */
class Product extends ModelEntity
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
     * @var string $name
     *
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string $firstName
     *
     * @ORM\Column(type="text")
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(type="text")
     */
    private $lastName;

    /**
     * @var string email
     *
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * @var string $street
     *
     * @ORM\Column(type="text")
     */
    private $street;

    /**
     * @var string $place
     *
     * @ORM\Column(type="text")
     */
    private $place;

    /**
     * @var string note
     *
     * @ORM\Column(type="text")
     */
    private $note;
	
	    /**
     * @var string zipcode
     *
     * @ORM\Column(type="text")
     */
    private $zipcode;
	
	    /**
     * @var string phoneNumber
     *
     * @ORM\Column(type="text")
     */
    private $phoneNumber;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param string $firm
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @param  string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote(){
        $this->note;
    }
	
	    /**
     * @param  string $zipcode
     */
    public function setZipCode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getZipcode(){
        $this->zipcode;
    }
	
	    /**
     * @param  string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(){
        $this->phoneNumber;
    }

}
