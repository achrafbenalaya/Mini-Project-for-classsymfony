<?php

namespace region\regionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="region\regionBundle\Repository\RegionRepository")
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var ArrayCollection $departements
     *
     * @ORM\OneToMany(targetEntity="region\regionBundle\Entity\Departement", mappedBy="region", cascade={"persist", "remove", "merge"})
     */
    private $departements;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Region
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * @param BDepartement $departements
     */
    public function addDepartement(Departement $departement) {
        $departement->setRegion($this);
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->departements->contains($departement)) {
            $this->departements->add($departement);
        }
    }
    /**
     * @return ArrayCollection $departements
     */
    public function getDepartements() {
        return $this->departements;    }
    public function __construct() {
        $this->departements = new ArrayCollection();
    }
    public function __toString() {
        return $this->nom;}



}
