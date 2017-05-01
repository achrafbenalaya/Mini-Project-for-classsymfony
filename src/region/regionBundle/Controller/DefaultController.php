<?php

namespace region\regionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('regionBundle:Default:index.html.twig');
    }
}
