<?php


namespace App\Controller\Admin\Parts;


use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Service\FormsManager;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    private ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/admin/project/add", name="admin_project_add")
     */
    public function adminProjectAddAction(Request $request) {
        $project = new Project();
        $projectForm = $this->createForm(ProjectType::class, $project);

        $projectForm->handleRequest($request);
        if($projectForm->isSubmitted()){
            $project = $projectForm->getData();
            $file = $projectForm->get('image')->getData();
            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $project->setImage($newFileName);
            }
            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info', "project : ".$project->getName()." well added");
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('pages/admin/projects/project_add.html.twig', ['projectForm'=>$projectForm->createView()]);
    }

    /**
     * @Route("/admin/project/update/{id}", name="admin_project_update")
     */
    public function adminProjectUpdateAction(Request $request,$id) {
        $project  = $this->projectRepository->find($id);
        $projectForm = $this->createForm(ProjectType::class, $project);

        $projectForm->handleRequest($request);
        if($projectForm->isSubmitted()){
            $project = $projectForm->getData();
            $file = $projectForm->get('image')->getData();
            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $project->setImage($newFileName);
            }
            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info', "project : ".$project->getName()." well updated");
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('pages/admin/projects/project_add.html.twig', ['projectForm'=>$projectForm->createView()]);
    }



    public function projectsTablesAction(){
        $projects = $this->projectRepository->findAll();
        return $this->render('pages/admin/components/tables/table.html.twig', ['headers' => ['id', 'name'], 'rows' => $projects, 'update' => 'admin_project_update']);
    }
}