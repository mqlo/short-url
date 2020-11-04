<?php

namespace App\Controller;

use App\Entity\Url\Hash;
use App\Repository\UrlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Url\UseCase\Redirect;

final class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
    */
    public function index(Request $request, UrlRepository $repository)
    {
        return $this->render('url/index.html.twig', [
            'urls' => $repository->all(),
        ]);
    }

    /**
     * @Route("/{hash}", methods={"GET"})
    */
    public function redirectUrl(Request $request, Redirect\Handler $handler, string $hash)
    {
        $command = new Redirect\Command(new Hash($hash));

        return $this->redirect(
            $handler->handle($command)->getValue()
        );
    }
}