<?php

namespace Framework1\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Framework1HomeBundle:Default:index.html.twig', array('name' => $name));
    }
}
