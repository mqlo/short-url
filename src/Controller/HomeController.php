<?php

namespace App\Controller;

use App\Entity\Url\Hash;
use App\Repository\UrlRepository;
use Doctrine\ORM\EntityNotFoundException;
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
        try {
            $command = new Redirect\Command(new Hash($hash));
            $source = $handler->handle($command);
            $this->redirect($source->getValue());
        } catch (EntityNotFoundException $e) {
            return $this->render('404.html.twig', ['code' => $e->getCode()]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return $this->redirectToRoute('home');

    }
}