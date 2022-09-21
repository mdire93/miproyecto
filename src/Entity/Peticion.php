<?php

namespace App\Entity;

use App\Repository\PeticionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeticionRepository::class)
 */
class Peticion
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
    private $consulta;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $respuesta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsulta(): ?string
    {
        return $this->consulta;
    }

    public function setConsulta(string $consulta): self
    {
        $this->consulta = $consulta;

        return $this;
    }

    public function getRespuesta(): ?string
    {
        return $this->respuesta;
    }

    public function setRespuesta(string $respuesta): self
    {
        $this->respuesta = $respuesta;

        return $this;
    }
}
