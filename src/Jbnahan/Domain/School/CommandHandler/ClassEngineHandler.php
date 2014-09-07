<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jbnahan\Domain\School\CommandHandler;

use Jbnahan\Domain\School\Command;
use Jbnahan\Domain\School\Model;
use Broadway\CommandHandling\CommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

/**
 * Description of ClassCommandHandler
 *
 * @author jb
 */
class ClassEngineHandler extends CommandHandler {
    
    
    private $repository;

    public function __construct(EventSourcingRepository $repository){
        $this->repository = $repository;

    }
    
    /**
     * execute openClass Command
     * @param OpenClassCommand $command
     * @return void
     */
    public function openClass(Command\OpenClassCommand $command){
        if(null===$command->classId){
            throw new Exception("Error : classId is empty", 1);
            
        }
        $class = StudentClass::openClass($command);
        $this->repository->add($class);
        
    }
    /**
     * execute renameClass Command
     * @param OpenClassCommand $command
     * @return void
     */
    public function renameClass(Command\RenameClassCommand $command){
        if(null===$command->classId){
            throw new Exception("Error : classId is empty", 1);
            
        }
        $class = $this->repository->load($command->classId);
        
        $class->renameClass($command->name);
        
        $this->repository->add($class);
    }
}
