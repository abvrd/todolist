<?php

namespace Poc\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Poc\ApiBundle\Entity\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $label;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $color;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Task", mappedBy="categories")
     * */
    private $task;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Category
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Category
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set task
     *
     * @param \Poc\ApiBundle\Entity\Task $task
     *
     * @return Category
     */
    public function setTask(\Poc\ApiBundle\Entity\Task $task = null) {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Poc\ApiBundle\Entity\Task
     */
    public function getTask() {
        return $this->task;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->task = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add task
     *
     * @param \Poc\ApiBundle\Entity\Task $task
     *
     * @return Category
     */
    public function addTask(\Poc\ApiBundle\Entity\Task $task) {
        $this->task[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \Poc\ApiBundle\Entity\Task $task
     */
    public function removeTask(\Poc\ApiBundle\Entity\Task $task) {
        $this->task->removeElement($task);
    }

}
