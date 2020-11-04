<?php

namespace App\Controller;

use App\Entity\Url\Url;
use App\Repository\UrlRepository;
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
                dd($e->getMessage());
//                $this->errors->handle($e);
//                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('url/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="url_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Url $url): Response
    {
        if ($this->isCsrfTokenValid('delete'.$url->getId(), $request->request->get('_token'))) {
            dd("delete url id {$url->getId()->getValue()}");
        }

        return $this->redirectToRoute('/');
    }
}
