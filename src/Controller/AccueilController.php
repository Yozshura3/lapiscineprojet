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










}