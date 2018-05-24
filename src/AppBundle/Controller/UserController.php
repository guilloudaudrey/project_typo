<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Schema\View;
use \Datetime;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use AppBundle\Form\UserType;


/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction(SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        $data =  $serializer->serialize($users, 'json', ['groups' => ['user']]);

        $response = new Response($data, Response::HTTP_OK, array('Content-Type', 'application/json'));
        return $response;
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/register", name="user_new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {

    $user = new User;
    $form = $this->createForm(UserType::class, $user);

    $form->submit($request->request->all());


    if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse($user, Response::HTTP_CREATED);
    } else {
        return new JsonResponse($form->getErrors());
    }
}

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user, SerializerInterface $serializer)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $data =  $serializer->serialize($user, 'json', ['groups' => ['user']]);
        $response = new Response($data, Response::HTTP_OK, array('Content-Type', 'application/json'));
        return $response;
    }


    /**
     * Edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("PATCH")
     */
    public function editAction(Request $request, User $user)
    {
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);


       if (empty($user)) {

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } 

        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse($user, Response::HTTP_OK);
        } else {
            return new JsonResponse($form->getErrors());
        }
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $response = new Response();

      if (empty($user)) {
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
       }
       else {
        $sn->remove($user);
        $sn->flush();
        return new JsonResponse($user, Response::HTTP_OK);
       }
    }
}
