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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__.'/../Resources/config/serializer/Entity.User.yml'));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer(array($normalizer));

        $data = $serializer->normalize($users, null, array('groups' => array('group2')));
  
        $data_serialized =  $this->get('serializer')->serialize($data, 'json');

        $response = new Response($data_serialized);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    $pseudo = $request->get('pseudo');
    $mail = $request->get('mail');
    $createdat = new DateTime();
        
    $data = new User;
    $data->setPseudo($pseudo);
    $data->setMail($mail);
    $data->setCreatedAt($createdat);

    $em = $this->getDoctrine()->getManager();
    $em->persist($data);
    $em->flush();

    $response = new Response();
    $response->setStatusCode(201);

    return $response;

    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $data =  $this->get('serializer')->serialize($user, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * Edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {

        $pseudo = $request->get('pseudo');
        $mail = $request->get('mail');
        $createdat = new DateTime();

        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $response = new Response();

       if (empty($user)) {

        $response->setStatusCode(404);
        return $response;
        } 

       elseif(!empty($pseudo) && !empty($mail)){
          $user->setPseudo($pseudo);
          $user->setMail($mail);
          $sn->flush();

          $response->setStatusCode(200);
          return $response;

        }
       elseif(empty($pseudo) && !empty($mail)){
          $user->setMail($mail);
          $sn->flush();

          $response->setStatusCode(200);
          return $response;
       }
       elseif(!empty($pseudo) && empty($mail)){
        $user->setPseudo($pseudo);
        $sn->flush();
        
        $response->setStatusCode(200);
        return $response;
       }
       else {
        $response->setStatusCode(406);
        return $response;
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
        $response->setStatusCode(404);
        return $response;
       }
       else {
        $sn->remove($user);
        $sn->flush();
       }
       $response->setStatusCode(200);
       return $response;
    }
}
