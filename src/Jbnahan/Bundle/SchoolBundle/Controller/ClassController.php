<?php

namespace Jbnahan\Bundle\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rhumsaa\Uuid\Uuid;
use Jbnahan\Domain\School\Command\OpenClassCommand;
use Jbnahan\Domain\School\Command\RenameClassCommand;
use Jbnahan\Bundle\SchoolBundle\Entity\StudentsClass;

class ClassController extends Controller
{
    public function openAction(Request $request)
    {
        $command = new OpenClassCommand();
        
        $form = $this->createFormBuilder($command)
            ->add('name', 'text',array(
                'required'=>true
            ))
            ->add('grade', 'text',array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            $command->classId = Uuid::uuid1()->toString();
            
            $this->get('command_bus')->handle($command);
            return $this->redirect($this->generateUrl('jbnahan_school_class_show',array('id'=>$command->classId)));
        }
        
        return $this->render('JbnahanSchoolBundle:Class:open.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function showAction(Request $request, StudentsClass $id)
    {
        return $this->render('JbnahanSchoolBundle:Class:show.html.twig', array(
                'class'=>$id,
            ));
    }

    public function renameAction(Request $request, StudentsClass $id)
    {
        $command = new RenameClassCommand();
        $command->classId = $id->getId();
        $command->name = $id->getName();
        
        $form = $this->createFormBuilder($command)
            ->add('name', 'text',array(
                'required'=>true
            ))
            ->add('classId', 'hidden',array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            
            $this->get('command_bus')->handle($command);
            return $this->redirect($this->generateUrl('jbnahan_school_class_show',array('id'=>$command->classId)));
        }
        
        return $this->render('JbnahanSchoolBundle:Class:rename.html.twig', array(
                'form' => $form->createView(),
            ));
    }


}
