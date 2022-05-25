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
        $week = null;
        $days = [[date('l', strtotime('-3 day')), date('d M', strtotime('-3 day'))], [date('l', strtotime('-2 day')), date('d M', strtotime('-2 day'))], [date('l', strtotime('-1 day')), date('d M', strtotime('-1 day'))], [date('l', strtotime('now')), date('d M', strtotime('now'))], [date('l', strtotime('+1 day')), date('d M', strtotime('+1 day'))], [date('l', strtotime('+2 day')), date('d M', strtotime('+2 day'))], [date('l', strtotime('+3 day')), date('d M', strtotime('+3 day'))]];
        #$this->setContainer($this->container);
        $this->em = $this->doctrine->getManager();
        $ID = $this->em->createQueryBuilder()->select('MAX(w.id)')->from('App:Week', 'w')->getQuery()->getSingleScalarResult();
        #var_dump($ID);
        $actual_week = $this->doctrine->getRepository(Week::class)->find($ID);
        $time_interval = $actual_week->getTimeInterval();
        $opening_hour = $actual_week->getOpeningHour();
        $opening_min = $actual_week->getOpeningMin();
        $closing_hour = $actual_week->getClosingHour();
        $closing_min = $actual_week->getClosingMin();
        $is_holiday = $actual_week->isIsHoliday();
        $hour_ranges[] = array();
        $x = 0;
        $now = null;
        $ff = date('H:i', strtotime($opening_hour . ':' . $opening_min));
        $gg = date('H:i', strtotime($closing_hour . ':' . $closing_min));
        $one[] = array();
        $two[] = array();
        $three[] = array();
        $four[] = array();
        $five[] = array();
        $six[] = array();
        $seven[] = array();
        do {
            $ff = date('H:i', strtotime($ff . '+' . $time_interval . 'min'));
            if (date(strtotime($ff)) < date(strtotime('now'))) {
                $one[$x] = array($ff, 0);
                $two[$x] = array($ff, 0);
                $three[$x] = array($ff, 0);
                $four[$x] = array($ff, 0);
                $five[$x] = array($ff, 0);
                $six[$x] = array($ff, 0);
                $seven[$x] = array($ff, 0);
            } elseif ($ff >= $now) {
                $one[$x] = array($ff, 1);
                $two[$x] = array($ff, 1);
                $three[$x] = array($ff, 1);
                $four[$x] = array($ff, 1);
                $five[$x] = array($ff, 1);
                $six[$x] = array($ff, 1);
                $seven[$x] = array($ff, 1);
            }
            $x++;
        } while ($ff < $gg);

        $hour_ranges = [
            $one,
            $two,
            $three,
            $four,
            $five,
            $six,
            $seven,
            $days
        ];
        $range_size = count($four);


        return $this->render('user_dashboard/udashboard.html.twig', ['days' => $days, 'time_ranges' => $hour_ranges, 'range_size' => $range_size]);
    }
}
