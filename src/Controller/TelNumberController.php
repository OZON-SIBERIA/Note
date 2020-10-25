<?php

namespace App\Controller;

use App\Entity\TelNumber;
use App\Form\TelNumberType;
use App\Repository\NumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tel_number")
 */
class TelNumberController extends AbstractController
{
    /**
     * @Route("/", name="tel_number_index", methods={"GET"})
     */
    public function index(NumberRepository $numberRepository): Response
    {
        return $this->render('tel_number/index.html.twig', [
            'tel_numbers' => $numberRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tel_number_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $telNumber = new TelNumber();
        $form = $this->createForm(TelNumberType::class, $telNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($telNumber);
            $entityManager->flush();

            return $this->redirectToRoute('tel_number_index');
        }

        return $this->render('tel_number/new.html.twig', [
            'tel_number' => $telNumber,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tel_number_show", methods={"GET"})
     */
    public function show(TelNumber $telNumber): Response
    {
        return $this->render('tel_number/show.html.twig', [
            'tel_number' => $telNumber,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tel_number_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TelNumber $telNumber): Response
    {
        $form = $this->createForm(TelNumberType::class, $telNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tel_number_index');
        }

        return $this->render('tel_number/edit.html.twig', [
            'tel_number' => $telNumber,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tel_number_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TelNumber $telNumber): Response
    {
        if ($this->isCsrfTokenValid('delete'.$telNumber->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($telNumber);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tel_number_index');
    }
}
