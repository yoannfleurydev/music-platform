<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AlbumRepository")
 */
class Album
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string")
     * @Assert\NotBlank(message="Veuillez téléverser une image pour l'album")
     * @Assert\File()
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string")
     * @Assert\NotBlank(message="Veuillez téléverser une archive contenant l'album")
     * @Assert\File(mimeTypes={
     *     "application/zip",
     *     "application/gzip",
     *     "application/x-tar",
     *     "application/x-bzip2",
     *     "application/x-gtar"}
     * )
     */
    private $file;

    /**
     * @var array<Music>
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Music", mappedBy="album")
     */
    private $musics;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Album
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add music
     *
     * @param \ApiBundle\Entity\Music $music
     *
     * @return Album
     */
    public function addMusic(\ApiBundle\Entity\Music $music)
    {
        $this->musics[] = $music;

        return $this;
    }

    /**
     * Remove music
     *
     * @param \ApiBundle\Entity\Music $music
     */
    public function removeMusic(\ApiBundle\Entity\Music $music)
    {
        $this->musics->removeElement($music);
    }

    /**
     * Get musics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusics()
    {
        return $this->musics;
    }
}
