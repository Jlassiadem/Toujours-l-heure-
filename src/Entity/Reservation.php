<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Reservation
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id_res;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateRes;

    #[ORM\Column(type: "integer")]
    private int $id_car;

    #[ORM\Column(type: "integer")]
    private int $user_id;

    #[ORM\Column(type: "string", length: 255)]
    private string $heureArrivee;

    #[ORM\Column(type: "string", length: 255)]
    private string $heureSortie;

    #[ORM\Column(type: "string", length: 255)]
    private string $typeCommande;

    #[ORM\Column(type: "string", length: 255)]
    private string $lieuDepart;

    #[ORM\Column(type: "string", length: 255)]
    private string $lieuArrivee;

    #[ORM\Column(type: "text")]
    private string $preferences;

    public function getId_res()
    {
        return $this->id_res;
    }

    public function setId_res($value)
    {
        $this->id_res = $value;
    }

    public function getdateRes()
    {
        return $this->dateRes;
    }

    public function setdateRes($value)
    {
        $this->dateRes = $value;
    }

    public function getId_car()
    {
        return $this->id_car;
    }

    public function setId_car($value)
    {
        $this->id_car = $value;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($value)
    {
        $this->user_id = $value;
    }

    public function getheureArrivee()
    {
        return $this->heureArrivee;
    }

    public function setheureArrivee($value)
    {
        $this->heureArrivee = $value;
    }

    public function getheureSortie()
    {
        return $this->heureSortie;
    }

    public function setheureSortie($value)
    {
        $this->heureSortie = $value;
    }

    public function gettypeCommande()
    {
        return $this->typeCommande;
    }

    public function settypeCommande($value)
    {
        $this->typeCommande = $value;
    }

    public function getlieuDepart()
    {
        return $this->lieuDepart;
    }

    public function setlieuDepart($value)
    {
        $this->lieuDepart = $value;
    }

    public function getlieuArrivee()
    {
        return $this->lieuArrivee;
    }

    public function setlieuArrivee($value)
    {
        $this->lieuArrivee = $value;
    }

    public function getPreferences()
    {
        return $this->preferences;
    }

    public function setPreferences($value)
    {
        $this->preferences = $value;
    }
}
