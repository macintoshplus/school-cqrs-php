<?php

namespace Jbnahan\Bundle\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentSubscription
 */
class StudentSubscription
{
    /**
     * @var integer
     */
    //private $id;

    /**
     * @var string
     */
    private $studentId;

    /**
     * @var string
     */
    private $classId;

    /**
     * @var string
     */
    private $classFullName;


    /**
     * Get id
     *
     * @return integer 
     */
    /*public function getId()
    {
        return $this->id;
    }*/

    /**
     * Set studentId
     *
     * @param string $studentId
     * @return StudentSubscription
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }

    /**
     * Get studentId
     *
     * @return string 
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * Set classId
     *
     * @param string $classId
     * @return StudentSubscription
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * Get classId
     *
     * @return string 
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set classFullName
     *
     * @param string $classFullName
     * @return StudentSubscription
     */
    public function setClassFullName($classFullName)
    {
        $this->classFullName = $classFullName;

        return $this;
    }

    /**
     * Get classFullName
     *
     * @return string 
     */
    public function getClassFullName()
    {
        return $this->classFullName;
    }
}
