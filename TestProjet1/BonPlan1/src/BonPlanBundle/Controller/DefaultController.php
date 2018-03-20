<?php

namespace BonPlanBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BonPlanBundle:Default:index.html.twig');
    }

    public function DashBoardAction()
    {
        return $this->render('BonPlanBundle:Default:index2.html.twig');
    }






}
