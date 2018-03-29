<?php

namespace BonPlanBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use PartageExperienceBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PartageExperienceBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;

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

    public function ContactAdminAction()
    {
        return $this->render('BonPlanBundle:Admin:Contact.html.twig');
    }

    public function ListContactsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Contact = $em->getRepository('PartageExperienceBundle:Contact')->findAll();
       /* return $this->render('BonPlanBundle:Admin:Contact.html.twig',array(
            'contact'=>$Contact));*/


        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $contact = $em->getRepository(Contact::class)->findAll();
        $total = 0;
        foreach ($contact as $contacts) {
            $total = $total + $contacts->getId();
        }
        $data = array();
        $stat = ['name', 'id'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($contact as $classe) {
            $stat = array();
            array_push($stat, $classe->getName(), (($classe->getId()) * 100) / $total);
            $nb = ($classe->getId() * 100) / $total;
            $stat = [$classe->getName(), $nb];
            array_push($data, $stat);

        }
        $pieChart->getData()->setArrayToDataTable(
            $data);
        $pieChart->getOptions()->setTitle('Pourcentages de Personnes qui ont Commenté');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('BonPlanBundle:Admin:Contact.html.twig', array('piechart' => $pieChart,'contact'=>$Contact));

    }

    public function ModifierContactAction(Request $request)
    {
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Contact=$em->getRepository("PartageExperienceBundle:Contact")->find($id);
        $form = $this->createForm(ContactType::class,$Contact);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($Contact);
            $em->flush();
            return $this->redirectToRoute("ContactAdmin");

        }
        return $this->render('BonPlanBundle:Admin:Modifier.html.twig',array(

            "Form" => $form->createView()

        ));
    }

    public function SupprimerContactAction($id){

        $em=$this->getDoctrine()->getManager();
        $Contact=$em->getRepository("PartageExperienceBundle:Contact")->find($id);
        $em->remove($Contact);
        $em->flush();

        return $this->redirectToRoute("ContactAdmin");
    }
    public function ChartAction()
    {

    }

}
