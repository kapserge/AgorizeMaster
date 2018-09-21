<?php
 namespace App\Entity;
 
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Article;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;/**
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
*/
class User implements UserInterface
{
   /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
   private $id;    /**
    * @ORM\Column(type="string", length=255)
    */
   private $firstname;    /**
    * @Assert\NotBlank()
    * @ORM\Column(type="string", length=255)
    */
   private $lastname;    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user")
    */    private $articles;    /**
    * @Assert\Email()
    * @ORM\Column(type="string", length=255)
    */
   private $email;    /**
    * @Assert\DateTime()
    * @ORM\Column(type="datetime", nullable=true)
    */
   private $birthday;    /**
    * @ORM\Column(type="simple_array")
    */
   private $roles;    /**
    *@ORM\Column(type="string", length=255)
    */
   private $password;
   
   /**
    * @ORM\OneToMany(targetEntity="App\Entity\Machine", mappedBy="user")
    */
   private $machines;    public function __construct()
   {
       $this->articles = new ArrayCollection();
       $this->roles = array('ROLE_USER');
       $this->machines = new ArrayCollection();
   }    public function getPassword()
   {
       return $this->password;
   }    public function setPassword( $password )
   {
       $this->password = $password ;
   }    public function getRoles()
   {
   return $this->roles;
   }    public function setRoles( $roles)
   {
   $this->roles = $roles;
   return $this;
   }
   
   public function getSalt()
   {
   return null;
   }
   
   public function getUsername()
   {
   return $this->email;
   }
   
   public function eraseCredentials()
   {
   }    public function getId()
   {
       return $this->id;
   }    public function getFirstname(): ?string
   {
       return $this->firstname;
   }    public function setFirstname(?string $firstname): self
   {
       $this->firstname = $firstname;        return $this;
   }    public function getLastname(): ?string
   {
       return $this->lastname;
   }    public function setLastname(?string $lastname): self
   {
       $this->lastname = $lastname;        return $this;
   }    public function getEmail(): ?string
   {
       return $this->email;
   }    public function setEmail(string $email): self
   {
       $this->email = $email;        return $this;
   }    public function getBirthday(): ?\DateTimeInterface
   {
       return $this->birthday;
   }    public function setBirthday(?\DateTimeInterface $birthday): self
   {
       $this->birthday = $birthday;        return $this;
   }    public function getArticles()
   {
       return $this->articles;
   }    public function setArticles($articles)
   {
       $this->articles = $articles;        return $this;
   }
   
   /**
    * @return Collection|Machine[]
    */
   public function getMachines(): Collection
   {
       return $this->machines;
   }
  
   public function addMachine(Machine $machine): self
   {
       if (!$this->machines->contains($machine)) {
           $this->machines[] = $machine;
           $machine->setUser($this);
       }
       
       return $this;
   }
   
   public function removeMachine(Machine $machine): self
   {
       if ($this->machines->contains($machine)) {
           $this->machines->removeElement($machine);
           // set the owning side to null (unless already changed)
           if ($machine->getUser() === $this) {
               $machine->setUser(null);
           }
       }

       return $this;
   }
}
