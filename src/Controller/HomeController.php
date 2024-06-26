<?php

namespace App\Controller;

use App\Repository\ListingsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:'symfony')]
    public function redirectTologin()
    {
        return $this->redirectToRoute('app_home');
    }
    #[Route('/home', name: 'app_home')]
    public function index( UserRepository $userRepository, ListingsRepository $listingsRepository): Response
    {
        if ($this->getUser()) {
            $user=$this->getUser()->getUserIdentifier();
            $user=$userRepository->findOneBy(array('email'=>$user));
            return $this->redirectToRoute('app_homeUser');
        }
        $annonces = $listingsRepository->findAll();
       return $this->render('home/index.html.twig',[
        'annonces'=>$annonces,
       ]);
    }
    #[Route('/homeUser', name: 'app_homeUser')]
    public function indexUser(ListingsRepository $listingsRepository):Response{
        $annonces = $listingsRepository->findAll();
        return $this->render('home/index.html.twig',[
         'annonces'=>$annonces,
        ]);
    }
}
