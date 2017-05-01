<?php

namespace admin\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//            return $this->render('LoginBundle:Default:index.html.twig');
//        return $this->render('regionBundle:Default:index.html.twig');
//        return $this->render('regionBundle:Default:index.html.twig');
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('regionBundle:Region')->findAll();
        return $this->render('region/index.html.twig', array(
            'regions' => $regions,
        ));
    }
}
