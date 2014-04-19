<?php
// src/fbeck/BlogBundle/Controller/BlogController.php

namespace fbeck\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
  public function indexAction()
  {
    $user = $this->getUser();
    $articles = array(
      array(
        'titre'   => 'Mon weekend a Phi Phi Island !',
        'id'      => 1,
        'auteur'  => 'winzou',
        'contenu' => 'Ce weekend était trop bien. Blabla…',
        'date'    => new \Datetime()),
      array(
        'titre'   => 'Repetition du National Day de Singapour',
        'id'      => 2,
        'auteur' => 'winzou',
        'contenu' => 'Bientôt prêt pour le jour J. Blabla…',
        'date'    => new \Datetime()),
      array(
        'titre'   => 'Chiffre d\'affaire en hausse',
        'id'      => 3, 
        'auteur' => 'M@teo21',
        'contenu' => '+500% sur 1 an, fabuleux. Blabla…',
        'date'    => new \Datetime())
    );

    return $this->render('fbeckBlogBundle:Blog:index.html.twig', array(
     'articles' => $articles
    ));
  }

  public function editAction($id)
  {
     if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
      throw new AccessDeniedHttpException('Access limited to Admin');
    }
    // Ici, on récupérera l'article correspondant à $id

    // Ici, on s'occupera de la création et de la gestion du formulaire

    $article = array(
      'id'      => 1,
      'titre'   => 'Mon weekend a Phi Phi Island !',
      'auteur'  => 'winzou',
      'contenu' => 'Ce weekend était trop bien. Blabla…',
      'date'    => new \Datetime()
    );
        
    // Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
    return $this->render('fbeckBlogBundle:Blog:edit.html.twig', array(
      'article' => $article
    ));
  }

  public function viewAction($id)
  {
    $article = array(
      'id'      => 1,
      'titre'   => 'Mon weekend a Phi Phi Island !',
      'auteur'  => 'winzou',
      'contenu' => 'Ce weekend était trop bien. Blabla…',
      'date'    => new \Datetime()
    );
    return $this->render('fbeckBlogBundle:Blog:view.html.twig', array(
     'article' => $article
    ));
  }

  public function addAction()
  {
    if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
      throw new AccessDeniedHttpException('Access limited to Admin');
    }
    // Bien sûr, cette méthode devra réellement ajouter l'article
    // Mais faisons comme si c'était le cas
    $this->get('session')->getFlashBag()->add('info', 'Article bien enregistré');

    // Le « flashBag » est ce qui contient les messages flash dans la session
    // Il peut bien sûr contenir plusieurs messages :
    $this->get('session')->getFlashBag()->add('info', 'Oui oui, il est bien enregistré !');
        
    // Puis on redirige vers la page de visualisation de cet article
    return $this->redirect( $this->generateUrl('fbeck_blog_view', array('id' => 5)) );
  }

  public function menuAction($nombre)
  {
    $liste = array(
      array('id' => 1, 'titre' => 'Title one'),
      array('id' => 2, 'titre' => 'Title two'),
      array('id' => 3, 'titre' => 'Title three')
    );
    
    return $this->render('fbeckBlogBundle:Blog:menu.html.twig', array(
      'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
    ));
  }

}