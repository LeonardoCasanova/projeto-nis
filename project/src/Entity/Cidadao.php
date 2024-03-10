<?php

namespace App\Entity;

use App\Repository\CidadaoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CidadaoRepository::class)]
class Cidadao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nome;

    #[ORM\Column(type: 'string', length: 11, unique: true)]
    private string $nis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNis(): string
    {
        return $this->nis;
    }

    public function setNis(string $nis): self
    {
        $this->nis = $nis;

        return $this;
    }
}
