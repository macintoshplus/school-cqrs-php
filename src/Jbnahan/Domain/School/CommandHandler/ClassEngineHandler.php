<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\CommandHandler;

use Jbnahan\Domain\School\Command;
use Jbnahan\Domain\School\Model;
use LiteCQRS\Bus\IdentityMap\IdentityMapInterface;

/**
 * Description of ClassCommandHandler
 *
 * @author jb
 */
class ClassEngineHandler {
    protected  $map;
    private $StudentsClass;
    
    public function __construct(IdentityMapInterface $map) {
        $this->map = $map;
        $this->StudentsClass = array();
    }
    
    public function openClass(Command\OpenClassCommand $command){
        if(null===$command->classId){
            throw new Exception("Error : classId is empty", 1);
            
        }
        $class = $this->findClassById($command->classId);
        $class->openClass($command->name, $command->grade);
        
    }

    private function findClassById($id){
        
        if(!array_key_exists($id, $this->StudentsClass)){
            $this->StudentsClass[$id]=new Model\StudentsClass($id);
            $this->map->add($this->StudentsClass[$id]);
        }

        return $this->StudentsClass[$id];
    }
}
