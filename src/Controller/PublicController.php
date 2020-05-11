<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{

    private SkillRepository $skillRepository;
    private ProjectRepository $projectRepository;
    private TechnoRepository $technoRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(SkillRepository $skillRepository, ProjectRepository $projectRepository, TechnoRepository $technoRepository, CategoryRepository $categoryRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->projectRepository = $projectRepository;
        $this->categoryRepository = $categoryRepository;
        $this->technoRepository = $technoRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request){

        $skills = $this->skillRepository->findAll();
        shuffle($skills);
        $skills = array_slice($skills, 0, 4);
        return $this->render('pages/public/home.html.twig', ["skills"=>$skills]);
    }

    /**
     * @Route("/skills/{category}/{techno}", name="skills", defaults={"category"=null, "techno"=null})
     */
    public function skillsAction(Request $request, $category, $techno){

        $skills = null;

        if (!$category){
            $skills = $this->skillRepository->findAll();
        }

        return $this->render('pages/public/skills.html.twig', ["skills"=>$skills]);

    }

    public function renderNavbar(){
        $skills = $this->skillRepository->findAll();
        return $this->render('pages/public/components/sidenavigation.html.twig', ['skills' => $skills]);
    }
}