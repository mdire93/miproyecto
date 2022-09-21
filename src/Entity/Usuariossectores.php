<?php

namespace App\Entity;

use App\Repository\UsuariossectoresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuariossectoresRepository::class)
 */
class Usuariossectores
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_usuario;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_sector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdSector(): ?int
    {
        return $this->id_sector;
    }

    public function setIdSector(int $id_sector): self
    {
        $this->id_sector = $id_sector;

        return $this;
    }
}
