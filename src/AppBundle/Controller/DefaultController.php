<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        $authChecker = $this->get('security.authorization_checker');

//        dump($this->getUser());die();

//        $this->denyAccessUnlessGranted('ROLE_FRONTEND', null, 'Unable to access this page!');

        // replace this example code with whatever you need
        return $this->render('AppBundle:default:base.html.twig');
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
