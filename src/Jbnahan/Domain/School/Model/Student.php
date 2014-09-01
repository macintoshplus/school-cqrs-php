<?php

namespace Jbnahan\Domain\School\Model;

use LiteCQRS\AggregateRoot;
use Jbnahan\Domain\School\Event\StudentRegistred;

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

    protected $id;
    
    /**
     * 
     * @param Uuid $id
     */
    public function __construct($id) {
        $this->id=$id;
    }
    
	public function getId(){
		return $this->id;
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
    public function registration($data) {
        $identity = new StudentIdentity($data['firstName'],$data['lastName'],$data['bornOn']);
        
        $event = new StudentRegistred(array("class"=>get_class($this),"id"=>$this->id, "identity"=>$identity));
        
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
