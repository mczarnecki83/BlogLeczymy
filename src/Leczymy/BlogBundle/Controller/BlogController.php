<?php

namespace Leczymy\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use AppBundle\Entity\Todo;
use Leczymy\BlogBundle\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//use Leczymy\BlogBundle\Service\Notification;





class BlogController extends Controller
{
	protected $itemLimit =3;

    /**
     * @Route(
	 * "/{page}",
	 * defaults= {"page" =1},
	 *  name="blog_list",
	 * requirements = {"page" = "\d+"}
	 * )
     */
    public function listAction($page)
    {
    	$posts = $this->getDoctrine()
		->getRepository('LeczymyBlogBundle:Blog')
		//->findAll();
		->findBy(array(),array('createDate'=>'desc'));
		
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate($posts,$page,$this->itemLimit);
		
		
        // if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            // $guzk = 'aaaa';
        // }else{
            // $guzk = 'bbbb';
        // }
			
        return $this->render('blog/index.html.twig',array(
		'posts' => $posts,
	
		'pagination' => $pagination
		));
    }
	
	 /**
     * @Route("/create", name="blog_create")
     */
    public function createAction(Request $request)
    {
    	$blog = new Blog;
		$form= $this->createFormBuilder($blog)
		->add('name', TextType::class, array('label'=>'Tytuł','attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
		->add('description', TextareaType::class, array('label'=>'Opis','attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
		//->add('Createdate', DateTimeType::class, array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
		->add('Publicatedate', DateTimeType::class, array('label'=>'Data publikacji','attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
		->add('submit', SubmitType::class, array('label'=>'zapisz','attr'=>array('class'=>'btn btn-primary','style'=>'margin-bottom:15px')))
		->getForm();
		
		$form->handleRequest($request);
		
		  $Session = $this->get('session');
		  
		  
		if($form->isSubmitted() && $form->isValid() ){
		//	die('wyslano');
		
		$name=$form['name']->getData();
		$description=$form['description']->getData();
		$publicatedate=$form['Publicatedate']->getData();
		
		$now = new\DateTime('now');
		
		$blog->setName($name);
		$blog->setDescription($description);
		$blog->setCreateDate($now);
		$blog->setPublicateDate($publicatedate);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($blog);
		$em->flush();
		
		//$this->addFlash(
		//'notice',
		//'Rekord dodany'
		//);
		//teraz przez serwis 
		$this->get('blog_notification')->addSuccess('Rekord dodany');
		//$this->get('leczymy_blog.notification')->addNotice('Rekord dodany');
		
		
		return $this->redirectToRoute('blog_list');
		}
		
        return $this->render('blog/create.html.twig',array(
		'form' => $form->createView()
		));
    }


	
	
}
