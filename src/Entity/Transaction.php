<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 * @ORM\EntityListeners({"App\Service\TransactionListener"})
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $method;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tr_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $tr_tmp;

    /**
     * @ORM\Column(type="float")
     */
    private $bamount;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $bcurr;

    /**
     * @ORM\Column(type="float")
     */
    private $tamount;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $tcurr;

    /**
     * @ORM\Column(type="float")
     */
    private $xrate;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $state;

    public function __construct()
    {
        $this->state = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getTrType(): ?string
    {
        return $this->tr_type;
    }

    public function setTrType(string $tr_type): self
    {
        $this->tr_type = $tr_type;

        return $this;
    }

    public function getTrTmp(): ?string
    {
        return $this->tr_tmp;
    }

    public function setTrTmp(string $tr_tmp): self
    {
        $this->tr_tmp = $tr_tmp;

        return $this;
    }

    public function getBamount(): ?float
    {
        return $this->bamount;
    }

    public function setBamount(float $bamount): self
    {
        $this->bamount = $bamount;

        return $this;
    }

    public function getBcurr(): ?string
    {
        return $this->bcurr;
    }

    public function setBcurr(string $bcurr): self
    {
        $this->bcurr = $bcurr;

        return $this;
    }

    public function getTamount(): ?float
    {
        return $this->tamount;
    }

    public function setTamount(float $tamount): self
    {
        $this->tamount = $tamount;

        return $this;
    }

    public function getTcurr(): ?string
    {
        return $this->tcurr;
    }

    public function setTcurr(string $tcurr): self
    {
        $this->tcurr = $tcurr;

        return $this;
    }

    public function getXrate(): ?float
    {
        return $this->xrate;
    }

    public function setXrate(float $xrate): self
    {
        $this->xrate = $xrate;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
