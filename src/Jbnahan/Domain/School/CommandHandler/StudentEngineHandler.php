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
class StudentEngineHandler {
    protected  $map;
    private $students;
    
    public function __construct(IdentityMapInterface $map) {
        $this->map = $map;
        $this->students = array();
    }
    
    public function RegisterStudent(Command\RegisterStudentCommand $command){
        //$student = new Model\Student($command->studentId);
        $student = $this->findStudentById($command->studentId);
        
        $student->registration(array("firstName"=>$command->firstName, "lastName"=>$command->lastName, "bornOn"=>$command->bornOn));
        
        //$this->map->add($student);
    }

    private function findStudentById($id){
        
        if(!array_key_exists($id, $this->students)){
            $this->students[$id]=new Model\Student($id);
            $this->map->add($this->students[$id]);
        }

        return $this->students[$id];
    }
}
