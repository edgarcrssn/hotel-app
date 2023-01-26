<?php

namespace App\Controller;

use App\Entity\Institution;
use App\Entity\Suite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class HotelController extends AbstractController
{
    #[Route('/hotel', name: 'app_hotel')]
    public function index(): Response
    {
        return $this->render('hotel/index.html.twig', [
            'controller_name' => 'HotelController',
        ]);
    }

    #[Route('/institutions')]
    public function institutions(ManagerRegistry $doctrine): Response
    {
        $institutionsRepository = $doctrine->getRepository(Institution::class);
        $institutions = $institutionsRepository->findAll();
        return $this->render('hotel/institutions/index.html.twig', ['institutions' => $institutions]);
    }
    #[Route('/institutions/{id}')]
    public function institutionById(ManagerRegistry $doctrine, int $id): Response
    {
        $institutionsRepository = $doctrine->getRepository(Institution::class);
        $institution = $institutionsRepository->find($id);
        $suitesRepository = $doctrine->getRepository(Suite::class);
        $suites = $suitesRepository->findBy(array('Institution' => $id));

        return $this->render('hotel/institutions/institution.html.twig', ['institution' => $institution, 'suites' => $suites]);
    }

    #[Route('/suites')]
    public function suites(ManagerRegistry $doctrine): Response
    {
        $suitesRepository = $doctrine->getRepository(Suite::class);
        $suites = $suitesRepository->findAll();
        return $this->render('hotel/suites/index.html.twig', ['suites' => $suites]);
    }
    #[Route('/suites/{id}')]
    public function suiteById(ManagerRegistry $doctrine, int $id): Response
    {
        $suitesRepository = $doctrine->getRepository(Suite::class);
        $suite = $suitesRepository->find($id);

        return $this->render('hotel/suites/suite.html.twig', ['suite' => $suite]);
    }
}
