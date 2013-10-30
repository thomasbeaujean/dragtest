<?php

namespace dragtest\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circle
 *
 * @ORM\Entity
 * @ORM\Table(name="circle")
 */
class Circle
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
     * @ORM\OneToMany(targetEntity="Friend", mappedBy="circle")
     **/
    protected $friends;

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
     * @return Circle
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
     * Get nb friend
     *
     * @return integer
     */
    public function getFriendNumber()
    {
        return count($this->getFriends());
    }
    /**
     * Constructor
     *
     * @return nothing
     */
    public function __construct()
    {
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add friends
     *
     * @param \dragtest\TestBundle\Entity\Friend $friends friends
     *
     * @return Circle
     */
    public function addFriend(\dragtest\TestBundle\Entity\Friend $friends)
    {
        $this->friends[] = $friends;

        return $this;
    }

    /**
     * Remove friends
     *
     * @param \dragtest\TestBundle\Entity\Friend $friends friends
     *
     * @return nothing
     */
    public function removeFriend(\dragtest\TestBundle\Entity\Friend $friends)
    {
        $this->friends->removeElement($friends);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friends;
    }
}
