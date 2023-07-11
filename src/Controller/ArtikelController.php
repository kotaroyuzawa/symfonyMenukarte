<?php

namespace App\Controller;

use App\Entity\Artikel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ArtikelController extends AbstractController
{
    #[Route('/artikel', name: 'app_artikel')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $artikel = new Artikel();
        $artikel->setTitel('Unser erster Artikel');
        $em = $doctrine->getManager();
        //$em->persist($artikel);
        //$em->flush();

        $getArtikel = $em->getRepository(Artikel::class)->findOneBy([
            'id'=>1
        ]);

        $em->remove($getArtikel);
        $em->flush();
        //return new Response('Artikel wurde angelegt');
        return $this->render('artikel/index.html.twig', [
            'artikel' => $getArtikel
        ]);

    }
}

