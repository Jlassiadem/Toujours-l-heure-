<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Comment;

#[ORM\Entity]
class User
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id_user;

    #[ORM\Column(type: "string", length: 255)]
    private string $Fullname;

    #[ORM\Column(type: "integer")]
    private int $tele;

    #[ORM\Column(type: "integer")]
    private int $mail;

    #[ORM\Column(type: "string", length: 255)]
    private string $password;

    #[ORM\Column(type: "string", length: 255)]
    private string $role;

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($value)
    {
        $this->id_user = $value;
    }

    public function getFullname()
    {
        return $this->Fullname;
    }

    public function setFullname($value)
    {
        $this->Fullname = $value;
    }

    public function getTele()
    {
        return $this->tele;
    }

    public function setTele($value)
    {
        $this->tele = $value;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($value)
    {
        $this->mail = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    #[ORM\OneToMany(mappedBy: "user_id", targetEntity: Comment::class)]
    private Collection $comments;

        public function getComments(): Collection
        {
            return $this->comments;
        }
    
        public function addComment(Comment $comment): self
        {
            if (!$this->comments->contains($comment)) {
                $this->comments[] = $comment;
                $comment->setUser_id($this);
            }
    
            return $this;
        }
    
        public function removeComment(Comment $comment): self
        {
            if ($this->comments->removeElement($comment)) {
                // set the owning side to null (unless already changed)
                if ($comment->getUser_id() === $this) {
                    $comment->setUser_id(null);
                }
            }
    
            return $this;
        }
}
