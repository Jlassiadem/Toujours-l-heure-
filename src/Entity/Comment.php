<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\User;

#[ORM\Entity]
class Comment
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id_comment;

        #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "comments")]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id_user', onDelete: 'CASCADE')]
    private User $id_user;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $datePosted;

    #[ORM\Column(type: "boolean")]
    private bool $isReported;

    #[ORM\Column(type: "string", length: 255)]
    private string $reportReason;

    public function getId_comment()
    {
        return $this->id_comment;
    }

    public function setId_comment($value)
    {
        $this->id_comment = $value;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($value)
    {
        $this->id_user = $value;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($value)
    {
        $this->content = $value;
    }

    public function getdatePosted()
    {
        return $this->datePosted;
    }

    public function setdatePosted($value)
    {
        $this->datePosted = $value;
    }

    public function getisReported()
    {
        return $this->isReported;
    }

    public function setisReported($value)
    {
        $this->isReported = $value;
    }

    public function getreportReason()
    {
        return $this->reportReason;
    }

    public function setreportReason($value)
    {
        $this->reportReason = $value;
    }
}
