<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 *  @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="imageName")
     * @Groups("article:read")
     * @var File|null
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $pieces;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $terasse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $parking;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("article:read")
     */
    private $loyer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("article:read")
     */
    private $meuble;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:read")
     */
    private $transaction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo3;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="articles")
     */
    private $categorie;

    

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?File 
    {
        return $this->image;
    }
      /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

  /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $image
     */
    public function setImage(?File $image = null): void
    {
        $this->image = $image;

    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPieces(): ?string
    {
        return $this->pieces;
    }

    public function setPieces(string $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getTerasse(): ?string
    {
        return $this->terasse;
    }

    public function setTerasse(string $terasse): self
    {
        $this->terasse = $terasse;

        return $this;
    }

    public function getParking(): ?string
    {
        return $this->parking;
    }

    public function setParking(string $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getLoyer(): ?string
    {
        return $this->loyer;
    }

    public function setLoyer(?string $loyer): self
    {
        $this->loyer = $loyer;

        return $this;
    }

    public function getMeuble(): ?string
    {
        return $this->meuble;
    }

    public function setMeuble(?string $meuble): self
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getTransaction(): ?string
    {
        return $this->transaction;
    }

    public function setTransaction(string $transaction): self
    {
        $this->transaction = $transaction;

        return $this;
    }

    public function getPhoto1(): ?string
    {
        return $this->photo1;
    }

    public function setPhoto1(string $photo1): self
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(?string $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(?string $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getCategorie(): ?collection
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
     public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName =null): self
    {
        $this->imageName = $imageName;

        return $this;
    }
    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

  }