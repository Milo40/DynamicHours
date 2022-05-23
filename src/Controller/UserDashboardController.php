<?php

namespace App\Controller;

use App\Entity\Week;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class UserDashboardController extends AbstractController
{
    public function __construct(ContainerInterface $container, ManagerRegistry $doctrine, EntityManagerInterface $em)
    {
        $this->container = $container;
        $this->doctrine = $doctrine;
        $this->em = $em;
    }

    #[Route('/dashboard', name: 'user_dashboard')]
    public function index(): Response
    {
        $days = [[date('l', strtotime('-3 day')), date('d M', strtotime('-3 day'))], [date('l', strtotime('-2 day')), date('d M', strtotime('-2 day'))], [date('l', strtotime('-1 day')), date('d M', strtotime('-1 day'))], [date('l', strtotime('now')), date('d M', strtotime('now'))], [date('l', strtotime('+1 day')), date('d M', strtotime('+1 day'))], [date('l', strtotime('+2 day')), date('d M', strtotime('+2 day'))], [date('l', strtotime('+3 day')), date('d M', strtotime('+3 day'))]];
        #$this->setContainer($this->container);
        $this->em = $this->doctrine->getManager();
        $ID = $this->em->createQueryBuilder()->select('MAX(w.id)')->from('App:Week', 'w')->getQuery()->getSingleScalarResult();
        #var_dump($ID);
        $actual_week = $this->doctrine->getRepository(Week::class)->find($ID);
        #var_dump($actual_week);
        $week = [$actual_week->getStart(), $actual_week->getEnd(), $actual_week->getOpeningHour(), $actual_week->getOpeningMin(), $actual_week->getClosingHour(), $actual_week->getClosingMin()];
        #var_dump($week);
        $time_interval = $actual_week->getTimeInterval();
        #var_dump($time_interval);

        return $this->render('user_dashboard/udashboard.html.twig', ['days' => $days, 'weeks' => $week]);
    }
}
