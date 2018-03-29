<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 27/03/2018
 * Time: 13:45
 */

namespace PromotionBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PromotionRepository extends EntityRepository
{
    public function findID($id)
    {

        $query = $this->getEntityManager()
            ->createQuery("select m from PromotionBundle:Promotion m WHERE m.id=:id ")
            ->setParameter('id', $id);
        return $query->getResult();

    }
}