<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\User\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegistrationController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user, array(
            'action' => $this->generateUrl('inscription'),
            'method' => 'POST',
        ));

        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);

            $existingUser = $em->getRepository('AppBundle:User')->findOneBy(["email" => strtolower($user->getEmail())]);

            if (is_null($existingUser) && $form->isValid()) {
                $hash = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
                $user->setPassword($hash);

                $em->persist($user);
                $em->flush();

                $request->getSession()->getFlashBag()->add("success", "Votre inscription s'est bien déroulée.");

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('@App/registration/index.html.twig', array(
            'form'   => $form->createView(),
        ));
    }
}
