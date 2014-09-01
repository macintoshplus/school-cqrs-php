<?php

namespace Jbnahan\Bundle\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rhumsaa\Uuid\Uuid;
use Jbnahan\Domain\School\Command\RegisterStudentCommand;
use Jbnahan\Bundle\SchoolBundle\Entity\Student;

class StudentController extends Controller
{
    public function registerAction(Request $request)
    {
        $command = new RegisterStudentCommand();
        
        $form = $this->createFormBuilder($command)
            ->add('firstName', 'text',array(
                'required'=>true
            ))
            ->add('lastName', 'text',array(
                'required'=>true
            ))
            ->add('bornOn', 'date',array(
                'required'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            $command->studentId = Uuid::uuid1()->toString();
            
            $this->get('command_bus')->handle($command);
            //return $this->redirect($this->generateUrl('jbnahan_school_student_show',array('id'=>$command->studentId)));
        }
        
        return $this->render('JbnahanSchoolBundle:Student:register.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function showAction(Request $request, Student $id)
    {
        return $this->render('JbnahanSchoolBundle:Student:show.html.twig', array(
                'student'=>$id,
            ));
    }

}
