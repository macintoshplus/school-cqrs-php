<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\Event;

use Broadway\Serializer\SerializableInterface;
use Jbnahan\Domain\School\Model\ClassIdentity;

/**
 * Description of ClassOpenedEvent
 *
 * @author jb
 */
class ClassOpened implements SerializableInterface {
    
    public $id;

    public $identity;

    public function __construct($id, $identity){
        $this->id = $id;
        $this->identity = $identity;
    }
    
    public static function deserialize(array $data){
    	$e = new ClassOpened($data['id'], new ClassIdentity($data['name'],$data['grade']));
		return $e; 
	}

    /**
     * @return array
     */
    public function serialize(){
    	return array("name"=>$this->identity->name, "grade"=>$this->identity->grade,"id"=>$this->id);
    }
}
