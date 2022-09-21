<?php

namespace App\Entity;

use App\Repository\MonedasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MonedasRepository::class)
 */
class Monedas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $moneda;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=1)
     */
    private $valor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoneda(): ?string
    {
        return $this->moneda;
    }

    public function setMoneda(string $moneda): self
    {
        $this->moneda = $moneda;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }
}
