<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 21/03/2018
 * Time: 12:52
 */

namespace PartageExperienceBundle\Controller;


use PartageExperienceBundle\Form\PartageHType;
use PartageExperienceBundle\Form\RechercheAjax;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PartageExperienceBundle\Entity\PartageH;


use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AvisController extends Controller
{
    public function AvisAction()
    {

        return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig');

    }

    public function AjouterAvisAction(Request $request)
    {
        $PartageH = new PartageH();
        $form = $this->createForm(PartageHType::class,$PartageH);

        $form->handleRequest($request);

            if ($form->isValid()) { // suite au clic sur le bouton

                $em = $this->getDoctrine()->getManager();
                $PartageH->setDateCommentaireH(new \Datetime('today'));



                $em->persist($PartageH);
                $em->flush();
                $this->addFlash('notice','Vous avez bien ajouté votre avis');
                return $this->redirectToRoute("Avis");

            }
            return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig', array(

                "form" => $form->createView()

            ));
    }

    public function ListAvisAction()
    {
        $em = $this->getDoctrine()->getManager();
        $PartageH = $em->getRepository('PartageExperienceBundle:PartageH')->findAll();
        return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig', array(
            "partages" => $PartageH));

    }

    public function ModifierPartageAction(Request $request)
    {
        $id=$request->get("idPartageH");
        $em=$this->getDoctrine()->getManager();
        $PartageH=$em->getRepository("PartageExperienceBundle:PartageH")->find($id);
        $form = $this->createForm(PartageHType::class,$PartageH);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($PartageH);
            $em->flush();
            return $this->redirectToRoute("List");

        }
        return $this->render('PartageExperienceBundle:Avis:modifier.html.twig',array(

            "Form" => $form->createView()

        ));
    }
    public function SupprimerPartageAction($idPartageH){

        $em=$this->getDoctrine()->getManager();
        $PartageH=$em->getRepository("PartageExperienceBundle:PartageH")->find($idPartageH);
        $em->remove($PartageH);


        $em->flush();

        return $this->redirectToRoute("List");
    }

    public function rechercheAjaxAction(Request $request)
    {
        $partageH=new PartageH();
        $em = $this->getDoctrine()->getManager();
        $partageh = $em->getRepository("PartageExperienceBundle:PartageH")->findAll();
        $Form=$this->createForm(RechercheAjax::class,$partageH);
        $Form->handleRequest($request);
        if ($Form->isValid())
        {
         $date=$partageH->getDateCommentaireH();
         $partageh=$em->getRepository('PartageExperienceBundle:PartageH')->findSerieDQL($date);

        }
        return $this->render("PartageExperienceBundle:Avis:PartageAvis.html.twig",
            array('F' =>$Form->createView(),'P'=>$partageh

            )
        );

    }
}