<?php

namespace App\Controller\Admin;

use App\Enum\ProjectStatus;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard', methods: ['GET'])]
    public function index(Request $request, ProjectRepository $projectRepository): Response
    {
        $status = $request->query->get('status')
            ? ProjectStatus::tryFrom($request->query->getString('status'))
            : null;
        $search = $request->query->get('q');
        $dateFrom = $request->query->get('date_from')
            ? new \DateTime($request->query->getString('date_from'))
            : null;
        $dateTo = $request->query->get('date_to')
            ? new \DateTime($request->query->getString('date_to'))
            : null;
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 12;

        $projects = $projectRepository->findByFilters(
            status: $status, search: $search, dateFrom: $dateFrom, dateTo: $dateTo, page: $page, limit: $limit,
        );
        $total = count($projects);

        return $this->render('admin/dashboard/index.html.twig', [
            'projects' => $projects,
            'statuses' => ProjectStatus::cases(),
            'currentFilters' => [
                'status' => $status?->value, 'q' => $search,
                'date_from' => $dateFrom?->format('Y-m-d'), 'date_to' => $dateTo?->format('Y-m-d'),
            ],
            'page' => $page,
            'totalPages' => max(1, (int) ceil($total / $limit)),
            'total' => $total,
        ]);
    }
}
