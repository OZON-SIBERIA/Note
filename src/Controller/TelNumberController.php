<?php

namespace App\Controller;

use App\Entity\TelNumber;
use App\Form\TelNumberType;
use App\Repository\CommentRepository;
use App\Repository\NumberRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
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
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;
    /**
     * @var CsrfTokenManagerInterface
     */
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        Environment $twig,
        NumberRepository $numberRepository,
        CommentRepository $commentRepository,
        FormFactoryInterface $formFactory,
        ManagerRegistry $registry,
        RouterInterface $router,
        CsrfTokenManagerInterface $csrfTokenManager
    )
    {
        $this->twig = $twig;
        $this->numberRepository = $numberRepository;
        $this->formFactory = $formFactory;
        $this->registry = $registry;
        $this->router = $router;
        $this->commentRepository = $commentRepository;
        $this->csrfTokenManager = $csrfTokenManager;
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
            $this->numberRepository->save($telNumber);
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
            'tel_number' => $telNumber
        ]));
    }

    /**
     * @Route("/{id}/edit", name="tel_number_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TelNumber $telNumber): Response
    {
        $form = $this->formFactory->create(TelNumberType::class, $telNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->numberRepository->save($telNumber);
            return new RedirectResponse($this->router->generate('tel_number_index'), 302);
        }

        return new Response($this->twig->render('tel_number/edit.html.twig', [
            'tel_number' => $telNumber,
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/{id}", name="tel_number_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TelNumber $telNumber): Response
    {
        if ($this->csrfTokenManager->isTokenValid(
            new CsrfToken('delete' . $telNumber->getId(),
                $request->get('_token'))
        )
        ) {
            $this->numberRepository->delete($telNumber);
        }

        return new RedirectResponse($this->router->generate('tel_number_index'), 302);
    }
}
