<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /** Déclaration de la page d'accueil
     * @Route("/", name="accueil")
     */
    public function accueilController(){
        return $this->render('accueil.html.twig');
    }


    /**
    * @Route("/guides", name="guides")
    */
    public function guidesController(){
        return $this->render('guides.html.twig');
    }

    /**
     * @Route("/shadowland", name="shadowland")
     */

    public function shadowlandController(){
        return $this->render('shadowland.html.twig');
    }







}