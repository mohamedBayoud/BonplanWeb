<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 26/03/2018
 * Time: 10:44
 */

namespace PromotionBundle\Controller;


use Endroid\QrCode\QrCode;
use PromotionBundle\Entity\Promotion;
use PromotionBundle\Form\PromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PromotionController extends Controller
{
    public function PromotionAction()
    {

        return $this->render('PromotionBundle:Promotion:Promotion.html.twig');

    }



    public function AjoutPromotionAction(Request $request)
    {
        $Promotion = new Promotion();
        $form = $this->createForm(PromotionType::class,$Promotion);

        $form->handleRequest($request);

        if ($form->isValid()) { // suite au clic sur le bouton

            $file=$Promotion->getImage();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$filename
            );
            $Promotion->setImage($filename);
            $em = $this->getDoctrine()->getManager();



            $em->persist($Promotion);
            $em->flush();
            return $this->redirectToRoute("AffichePromotion");

        }
        return $this->render('PromotionBundle:Promotion:Promotion.html.twig', array(

            "form" => $form->createView()

        ));
    }
    public function AffichePromotionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion= $em->getRepository('PromotionBundle:Promotion')->findAll();
        return $this->render('PromotionBundle:Promotion:AffichePromotion.html.twig', array(
            "Promotions" => $Promotion));

    }
    public function ModifierPromotionAction(Request $request)
    {
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Promotion=$em->getRepository("PromotionBundle:Promotion")->find($id);
        $form = $this->createForm(PromotionType::class,$Promotion);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($Promotion);
            $em->flush();
            return $this->redirectToRoute("AffichePromotion");

        }
        return $this->render('PromotionBundle:Promotion:ModifierPromotion.html.twig',array(

            "Form" => $form->createView()

        ));
    }

    public function SupprimerPromotionAction($id){

        $em=$this->getDoctrine()->getManager();
        $Promotion=$em->getRepository("PromotionBundle:Promotion")->find($id);
        $em->remove($Promotion);
        $em->flush();

        return $this->redirectToRoute("AffichePromotion");
    }

    public function AfficherPromotionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion= $em->getRepository('PromotionBundle:Promotion')->findAll();
        return $this->render('PromotionBundle:Promotion:AfficherPromotions.html.twig', array(
            "Promotions" => $Promotion));

    }
    public function DetailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $Promotion = $em->getRepository("PromotionBundle:Promotion")->findBy(array('id' => $id));

        return $this->render('PromotionBundle:Promotion:Details.html.twig', array(
            "Promo" => $Promotion));
    }




}