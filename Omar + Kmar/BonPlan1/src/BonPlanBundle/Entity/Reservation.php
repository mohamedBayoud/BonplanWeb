<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="idPersonne", columns={"idPersonne"}), @ORM\Index(name="idPersonne_2", columns={"idPersonne"}), @ORM\Index(name="idPersonne_3", columns={"idPersonne"}), @ORM\Index(name="idPersonne_4", columns={"idPersonne"}), @ORM\Index(name="idPersonne_5", columns={"idPersonne"}), @ORM\Index(name="idPersonne_6", columns={"idPersonne"}), @ORM\Index(name="idPersonne_7", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrPersonnes", type="integer", nullable=true)
     */
    private $nbrpersonnes = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntree", type="date", nullable=false)
     */
    private $dateentree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSortie", type="date", nullable=false)
     */
    private $datesortie;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrChambre", type="integer", nullable=false)
     */
    private $nbrchambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrNuit", type="integer", nullable=false)
     */
    private $nbrnuit;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;


}

