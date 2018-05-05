<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserListener
{

    /**
     * On pre update entity user
     *
     * @param PreUpdateEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->em = $args->getEntityManager();
        
                $entity = $args->getEntity();
        
                $this->setCreatedAt($entity);

    }

    public function setCreatedAt(User $user){

        $user->setCreatedAt(new \DateTime());
    }



}