<?php

namespace Jbnahan\Domain\Scool\Model;

use LiteCQRS\AggregateRoot;
use Jbnahan\Domain\Scool\Event\StudentRegistred;

/**
 * Description of Student
 *
 * @author jb
 */
class Student extends AggregateRoot {
    
    /**
     *
     * @var StudentIdentity
     */
    protected $identity;
    
    /**
     * 
     * @param Uuid $id
     */
    public function __construct($id) {
        $this->setId($id);
    }
    
    /**
     * Compute the student Age
     * @return integer
     */
    public function getAge(){
        $now = date('Y');
        return $now - $this->identity->bornOn->format('Y');
    }
    
    /**
     * Apply registration
     * @param Uuis $id
     * @param string $firstName
     * @param string $lastName
     * @param \DateTime $bornOn
     */
    public function registration($id, $firstName, $lastName, \DateTime $bornOn) {
        $identity = new StudentIdentity($firstName,$lastName,$bornOn);
        
        $event = new StudentRegistred($id, $identity);
        
        $this->apply($event);
    }
    
    /**
     * Apply StudentRegistred Event
     * @param StudentRegistred $event
     */
    protected function applyStudentRegistred($event) {
        $this->identity = $event->identity;
    }
}
