<?php

// src/fbeck/AdminBundle/Controller/HomeController.php

namespace fbeck\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use fbeck\UserBundle\Entity\User;
use fbeck\UserBundle\Form\UserType;


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

    $userManager = $this->get('fos_user.user_manager');
    $users = $userManager->findUsers();
    $user = $userManager->findUserBy(array('id' => $id));
    $redirect = false;

    $usertype = new UserType($user->getUsername(), $user->getEmail(), $user->isAccountNonLocked(), $user->isAccountNonExpired(), $user->hasRole('ROLE_ADMIN') );
  	$form = $this->createForm($usertype);
    $request = $this->get('request');
    if ($request->getMethod() == 'POST'){
      $form->bind($request);
      if ($form->isValid()) {
        $data = $form->getData();

        if (isset($data['username']))
          $user->setUsername($data['username']);
        if (isset($data['email']))
          $user->setEmail($data['email']);
        if ($data['admin'] == true && !$user->hasRole('ROLE_ADMIN'))
        {
            $user->addRole('ROLE_ADMIN');
        }
        else if ($data['admin'] == false && $user->hasRole('ROLE_ADMIN'))
        {
          $currentuser = $this->container->get('security.context')->getToken()->getUser();
          if ($currentuser === $user){
            $redirect = true;
          }
          $user->removeRole('ROLE_ADMIN');
        }
        $user->setLocked($data['locked']);
        $user->setExpired($data['expired']);
        $userManager->updateUser($user);
        if ($redirect == true) {
          $this->container->get('security.context')->setToken(NULL);
          return $this->render('fbeckHomeBundle:Home:index.html.twig');
        } else {
          return $this->render('fbeckAdminBundle:Admin:view.html.twig', array('user' => $user));
        }
      }
    }
		return $this->render('fbeckAdminBundle:Admin:edit.html.twig', array(
			'id' => $id, 'user' => $user, 'form' => $form->createView()
			));
  }

  public function deleteAction($id)
  {
  	$userManager = $this->get('fos_user.user_manager');
    $user = $userManager->findUserBy(array('id' => $id));
    if ($user !== NULL) {
      $currentuser = $this->container->get('security.context')->getToken()->getUser();
      if ($currentuser === $user){
         $this->container->get('security.context')->setToken(NULL);
         $userManager->deleteUser($user);
         return $this->render('fbeckHomeBundle:Home:index.html.twig');
      }
      else {
        $userManager->deleteUser($user);
      }
    }
    $users = $userManager->findUsers();
    return $this->render('fbeckAdminBundle:Admin:index.html.twig', array('users' => $users));
  }
}