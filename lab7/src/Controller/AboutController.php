<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class AboutController extends AbstractController
{
    /**
     * @Route("/", name="startpage")
     *@param BookRepository $bookRep
     *@param Request $request
     *
     * @return Response
     */
    public function index(BookRepository $bookRep,Request $request): Response
    {
        $books = $bookRep->findBy(
            [],
            ['dateRead' => 'DESC']
        );
        $user = '';
        if ($this->getUser() !== null) {
            $user = $this->getUser()->getUsername();
        }
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'books' => $books,
            'user' => $user,
        ]);
    }
}
