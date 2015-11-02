<?php

namespace Poc\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Poc\ApiBundle\Entity\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task {

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
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="tasks", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="tasks_categories")
     * @ORM\JoinColumn(nullable=true)
     * */
    private $categories;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="parent")
     * */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * */
    private $parent;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $done;

    /**
     * Constructor
     */
    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Task
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Task
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
     * Add category
     *
     * @param \Poc\ApiBundle\Entity\Category $category
     *
     * @return Task
     */
    public function addCategory(\Poc\ApiBundle\Entity\Category $category) {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Poc\ApiBundle\Entity\Category $category
     */
    public function removeCategory(\Poc\ApiBundle\Entity\Category $category) {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Add child
     *
     * @param \Poc\ApiBundle\Entity\Task $child
     *
     * @return Task
     */
    public function addChild(\Poc\ApiBundle\Entity\Task $child) {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Poc\ApiBundle\Entity\Task $child
     */
    public function removeChild(\Poc\ApiBundle\Entity\Task $child) {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Poc\ApiBundle\Entity\Task $parent
     *
     * @return Task
     */
    public function setParent(\Poc\ApiBundle\Entity\Task $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Poc\ApiBundle\Entity\Task
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Set done
     *
     * @param \DateTime $done
     *
     * @return Task
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return \DateTime
     */
    public function getDone()
    {
        return $this->done;
    }
}
