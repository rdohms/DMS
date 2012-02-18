<?php

namespace DMS\Bundles\LauncherBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * DMS\Bundles\LauncherBundle\Entity\PreUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DMS\Bundles\LauncherBundle\Entity\PreUserRepository")
 * @UniqueEntity(fields={"username"}, message="This username is taken")
 * @UniqueEntity(fields={"email"}, message="This email is already registered")
 *
 */
class PreUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $email
     *
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $email;

    /**
     * @var string $username
     *
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $username;

    /**
     * @var datetime $registeredOn
     *
     * @ORM\Column(type="datetime")
     */
    private $registeredOn;

    /**
     * @var string $token
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $token;

    /**
     * @var string $referrerUrl
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referrerUrl;

    /**
     * @var string $referrerToken
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $referrerToken;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set registeredOn
     *
     * @param datetime $registeredOn
     */
    public function setRegisteredOn($registeredOn)
    {
        $this->registeredOn = $registeredOn;
    }

    /**
     * Get registeredOn
     *
     * @return datetime 
     */
    public function getRegisteredOn()
    {
        return $this->registeredOn;
    }

    /**
     * Set token
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set referrerUrl
     *
     * @param string $referrerUrl
     */
    public function setReferrerUrl($referrerUrl)
    {
        $this->referrerUrl = $referrerUrl;
    }

    /**
     * Get referrerUrl
     *
     * @return string 
     */
    public function getReferrerUrl()
    {
        return $this->referrerUrl;
    }

    /**
     * Set referrerToken
     *
     * @param string $referrerToken
     */
    public function setReferrerToken($referrerToken)
    {
        $this->referrerToken = $referrerToken;
    }

    /**
     * Get referrerToken
     *
     * @return string 
     */
    public function getReferrerToken()
    {
        return $this->referrerToken;
    }
}