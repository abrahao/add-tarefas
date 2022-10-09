<?php

namespace App\Entity;

use App\Repository\TarefaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: TarefaRepository::class)]
class Tarefa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $titulo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface{
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self{
        $this->created_at;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface{
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self{
        $this->updated_at;
        return $this;
    }
}
