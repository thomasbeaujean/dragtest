<?php

namespace dragtest\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friend
 *
 * @ORM\Entity
 * @ORM\Table(name="friend")
 */
class Friend
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Circle", inversedBy="friends")
     * @ORM\JoinColumn(name="circle_id", referencedColumnName="id")
     **/
    protected $circle;

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
     * Set name
     *
     * @param string $name name
     *
     * @return Friend
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
     * Get circle name
     *
     * @return string
     */
    public function getCircleName()
    {
        $name = '';

        if ($this->getCircle() !== null) {
            $name = $this->getCircle()->getName();
        }
        return $name;
    }
    /**
     * Set circle
     *
     * @param \dragtest\TestBundle\Entity\Circle $circle circle
     *
     * @return Friend
     */
    public function setCircle(\dragtest\TestBundle\Entity\Circle $circle = null)
    {
        $this->circle = $circle;

        return $this;
    }

    /**
     * Get circle
     *
     * @return \dragtest\TestBundle\Entity\Circle
     */
    public function getCircle()
    {
        return $this->circle;
    }
}
