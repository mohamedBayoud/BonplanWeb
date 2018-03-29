<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participerevent
 *
 * @ORM\Table(name="participerevent", indexes={@ORM\Index(name="idEvent", columns={"idEvent", "idpersonne"}), @ORM\Index(name="idpersonne", columns={"idpersonne"}), @ORM\Index(name="IDX_128847C32C6A49BA", columns={"idEvent"})})
 * @ORM\Entity
 */
class Participerevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idparticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="idEvent")
     * })
     */
    private $idevent;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;


}

