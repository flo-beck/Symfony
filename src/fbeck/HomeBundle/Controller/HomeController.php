<?php

// src/fbeck/HomeBundle/Controller/HomeController.php

namespace fbeck\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
  public function indexAction()
  {
  	return $this->render('fbeckHomeBundle:Home:index.html.twig', array('nom' => 'winzou'));
  }
  
  public function byeAction()
  {
  	return $this->render('fbeckHomeBundle:Home:bye.html.twig', array('nom' => 'winzou'));
  }
}