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
class StudentSubscribedInClass implements SerializableInterface {
    
    public $id;

    public $classId;

    public $classFullName;

    public function __construct($id, $classId, $classFullName){
        $this->id = $id;
        $this->classId = $classId;
        $this->classFullName = $classFullName;
    }

    public static function deserialize(array $data){
        print_r($data);
    	$e = new StudentSubscribedInClass($data['id'], $data['classId'], $data['classFullName']);
		return $e; 
	}

    /**
     * @return array
     */
    public function serialize(){
    	return array("classId"=>$this->classId, "id"=>$this->id, "classFullName"=>$this->classFullName);
    }
}
