<?php

namespace App\Controller;

use App\Entity\TelNumber;
use App\Form\TelNumberType;
use App\Repository\NumberRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * @Route("/tel_number")
 */
class TelNumberController
{
    /**
     * @var Environment
     */
    private Environment $twig;
    /**
     * @var NumberRepository
     */
    private NumberRepository $numberRepository;
    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $registry;
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    public function __construct(
        Environment $twig,
        NumberRepository $numberRepository,
        FormFactoryInterface $formFactory,
        ManagerRegistry $registry,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->numberRepository = $numberRepository;
        $this->formFactory = $formFactory;
        $this->registry = $registry;
        $this->router = $router;
    }

    /**
     * @Route("/", name="tel_number_index", methods={"GET"})
     */
    public function index(): Response
    {
        return new Response($this->twig->render('tel_number/index.html.twig', [
            'tel_numbers' => $this->numberRepository->findAll(),
        ]));
    }

    /**
     * @Route("/new", name="tel_number_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $telNumber = new TelNumber();
        $form = $this->formFactory->create(TelNumberType::class, $telNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->registry->getManager();
            $entityManager->persist($telNumber);
            $entityManager->flush();

            return new RedirectResponse($this->router->generate('tel_number_index'), 302);
        }

        return new Response($this->twig->render('tel_number/new.html.twig', [
            'tel_number' => $telNumber,
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/{id}", name="tel_number_show", methods={"GET"})
     */
    public function show(TelNumber $telNumber): Response
    {
        return new Response($this->twig->render('tel_number/show.html.twig', [
            'tel_number' => $telNumber,
        ]));
    }

    /**
     * @Route("/{id}/edit", name="tel_number_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TelNumber $telNumber): Response
    {
//        $form = $this->createForm(TelNumberType::class, $telNumber);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('tel_number_index');
//        }
//
//        return $this->render('tel_number/edit.html.twig', [
//            'tel_number' => $telNumber,
//            'form' => $form->createView(),
//        ]);
    }

    /**
     * @Route("/{id}", name="tel_number_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TelNumber $telNumber): Response
    {
//        if ($this->isCsrfTokenValid('delete' . $telNumber->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($telNumber);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('tel_number_index');
    }
}
