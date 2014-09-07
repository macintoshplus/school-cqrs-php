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
class ClassRenamed extends SerializableInterface {
    
    public $id;

    public $name;

    public static function deserialize(array $data){
    	$e = new ClassRenamed();
    	$e->id = $data['id'];
    	$e->name = $data['name'];
		return $e; 
	}

    /**
     * @return array
     */
    public function serialize(){
    	return array("name"=>$this->name, "id"=>$this->id);
    }
}
