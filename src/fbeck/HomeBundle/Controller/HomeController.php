<?php

// src/fbeck/HomeBundle/Controller/HomeController.php

namespace fbeck\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
  public function indexAction()
  {
  	return $this->render('fbeckHomeBundle:Home:index.html.twig');
  }
  
  public function byeAction()
  {
  	return $this->render('fbeckHomeBundle:Home:bye.html.twig', array('nom' => 'winzou'));
  }

  public function contactAction()
  {
    $msg = null;
  	$request = $this->get('request');
    if ($request->getMethod() == 'POST'){
    	$form = $request->request;
      $name = $request->request->get('name');
      $subject = $request->request->get('subject');
      $email = $request->request->get('email');
      $body = $request->request->get('body');
      $message = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom($email)
        ->setTo('fbeck.awesome@gmail.com')
        ->setBody(
          "Email from $name\nEmail address: $email \nMessage:\n$body", 'text/plain')
    ;
    $this->get('mailer')->send($message);
    $msg = "Your email has been sent.  Awesome.";
  }

  	return $this->render('fbeckHomeBundle:Home:contact.html.twig', array('msg' => $msg));
  }
}