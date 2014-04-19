<?php

// src/fbeck/AdminBundle/Controller/HomeController.php

namespace fbeck\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use fbeck\AdminBundle\Entity\Profile;


class AdminController extends Controller
{
  public function indexAction()
  {
  		$userManager = $this->get('fos_user.user_manager');
    	$users = $userManager->findUsers();
  		return $this->render('fbeckAdminBundle:Admin:index.html.twig', array('users' => $users));
  }

  public function viewAction($id)
  {
  	$userManager = $this->get('fos_user.user_manager');
    $user = $userManager->findUserBy(array('id' => $id));
    // if ($user->hasRole('ROLE_ADMIN'))
    return $this->render('fbeckAdminBundle:Admin:view.html.twig', array(
     'user' => $user
    ));
  }

  public function editAction($id)
  {
  	// $profile = new Profile();
  	// $profile->username = "username";
  	// $profile->email = "email@email.com";
  	// $profile->roles = array('ROLE_USER');

  	// $form = $this->createFormBuilder($profile)
  	// 	->add('username', 'text')
  	// 	->add('email', 'text')
  	// 	->add('roles', 'text')
  	// 	->add('save', 'submit')
  	// 	->getForm();



  	// $request = $this->getRequest();
  	// var_dump($request);
  	// if ($request->isMethod('POST')) {
  	// 	$form = $this->get('form.admin_edit');
  	// 	$form->getData();
   //  	$form->submit($request);
  	// 	echo"GOT IT!!!\n";
  	// 	var_dump($form);
  	// }
  	// 	$form->getData();
  	// 	var_dump($form);
  	// }
  	// else
  	// {
  		$userManager = $this->get('fos_user.user_manager');
  		$user = $userManager->findUserBy(array('id' => $id));
    // if ($user->hasRole('ROLE_ADMIN'))
  		return $this->render('fbeckAdminBundle:Admin:edit.html.twig', array(
  			'id' => $id, 'user' => $user
  			));
  	// }
  }

  public function deleteAction($id)
  {
  	$userManager = $this->get('fos_user.user_manager');
    $user = $userManager->findUserBy(array('id' => $id));
    // if ($user->hasRole('ROLE_ADMIN'))
    return $this->render('fbeckAdminBundle:Admin:view.html.twig', array(
     'user' => $user
    ));
  }
}











// $request  = $this->getRequest();
// $postData = $request->request->get('test');