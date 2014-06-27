<?php

namespace Jbnahan\Bundle\ScoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JbnahanScoolBundle:Default:index.html.twig', array('name' => $name));
    }
}
