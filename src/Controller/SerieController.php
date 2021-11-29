<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/serie", name="serie_list")
     */
    public function list(): Response
    {
        //@todo : récup en BDD
        $serieRepo = $this->getDoctrine()->getRepository(Serie::class);
        //$series = $serieRepo->findBy([], ["vote" => "DESC"], 30);
        //$series = $serieRepo->findGoodSeries();
        $series = $serieRepo->findGoodSeriesQB();


        return $this->render('serie/list.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/serie/{id}", name="serie_detail",
     *     requirements={"id": "\d+"},
     *     methods={"GET"})
     */
    public function detail($id): Response
    {
        //@todo : récup en BDD
        $serieRepo = $this->getDoctrine()->getRepository(Serie::class);
        $serie = $serieRepo->find($id);

        if(empty($serie))
        {
            throw $this->createNotFoundException("La serie n'existe pas!");
        }

        return $this->render('serie/detail.html.twig', [
            'serie' => $serie,
        ]);
    }

    /**
     * @Route("/serie/add", name="serie_add")
     */
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());

        $serieForm = $this->createForm(SerieType::class, $serie);

        $serieForm->handleRequest($request);
        if($serieForm->isSubmitted() && $serieForm->isValid())
        {
            //dump($serie);

            $em->persist($serie);
            $em->flush();

            $this->addFlash("success", "La serie a été créer.");

            return $this->redirectToRoute("serie_detail", ['id'=>$serie->getId()]);
        }

        return $this->render('serie/add.html.twig',
        ["Formulaire" => $serieForm->createView() ]);
    }

    /**
     * @Route("/serie/delete/{id}",name="serie_delete", requirements={"id": "\d+"})
     */
    public function delete($id, EntityManagerInterface $em)
    {
        $serieRepo = $this->getDoctrine()->getRepository(Serie::class);
        $serie = $serieRepo->find($id);
        $em->remove($serie);
        $em->flush();
        $this->addFlash('success', "La serie a bien été supprimer!");
        return $this->redirectToRoute('home');

    }


}
