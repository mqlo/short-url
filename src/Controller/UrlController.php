<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Url\UseCase\Create;

/**
 * @Route ("/url")
*/
final class UrlController extends AbstractController
{
    /**
     * @Route("/new", name="url_new", methods={"GET","POST"})
     */
    public function new(Request $request, Create\Handler $handler): Response
    {
        $command = new Create\Command();
        $form = $this->createForm(Create\Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                return $this->redirectToRoute('home');
            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('url/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
