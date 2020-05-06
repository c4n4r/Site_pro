<?php


namespace App\Controller;


use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{

    private SkillRepository $skillRepository;
    private ProjectRepository $projectRepository;

    public function __construct(SkillRepository $skillRepository, ProjectRepository $projectRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request){

        $skills = $this->skillRepository->findAll();
        $projects = $this->projectRepository->findAll();
         shuffle($skills);
         shuffle($projects);
        return $this->render('pages/public/home.html.twig', ["skills"=>$skills, "projects"=>$projects]);
    }


    public function renderNavbar(){
        $skills = $this->skillRepository->findAll();
        return $this->render('pages/public/components/navbar.html.twig', ['skills' => $skills]);
    }
}