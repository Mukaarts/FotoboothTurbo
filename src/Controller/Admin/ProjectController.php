<?php

namespace App\Controller\Admin;

use App\Entity\CustomerLink;
use App\Entity\Project;
use App\Enum\ProjectStatus;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/project', name: 'admin_project_')]
class ProjectController extends AbstractController
{
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setOwner($this->getUser());
            $project->setStatus(ProjectStatus::DRAFT);

            $tarifTier = $form->get('tarifTier')->getData();
            $customerLink = new CustomerLink();
            $customerLink->setProject($project);
            $customerLink->setToken(bin2hex(random_bytes(32)));
            $customerLink->setTarifTier($tarifTier);
            $project->setCustomerLink($customerLink);

            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'Projekt "' . $project->getTitle() . '" erfolgreich erstellt.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/project/new.html.twig', ['form' => $form]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Project $project): Response
    {
        return $this->render('admin/project/show.html.twig', ['project' => $project]);
    }
}
