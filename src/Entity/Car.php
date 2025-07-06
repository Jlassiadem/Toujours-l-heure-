<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Car
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id_car;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "string", length: 255)]
    private string $mark;

    #[ORM\Column(type: "string", length: 255)]
    private string $model;

    #[ORM\Column(type: "string", length: 255)]
    private string $matrucule;

    public function getId_car()
    {
        return $this->id_car;
    }

    public function setId_car($value)
    {
        $this->id_car = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getMark()
    {
        return $this->mark;
    }

    public function setMark($value)
    {
        $this->mark = $value;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($value)
    {
        $this->model = $value;
    }

    public function getMatrucule()
    {
        return $this->matrucule;
    }

    public function setMatrucule($value)
    {
        $this->matrucule = $value;
    }
}
