<?php


namespace App\Controller\Admin\Parts;


use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    private SkillRepository $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    /**
     * @Route("/admin/skill/add", name="admin_skill_add")
     */
    public function adminSkillAddAction(Request $request) {
        $skill = new Skill();
        $skillForm = $this->createForm(SkillType::class, $skill);

        $skillForm->handleRequest($request);
        if($skillForm->isSubmitted()){
            $skill = $skillForm->getData();
            $file = $skillForm->get('image')->getData();

            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $skill->setImage($newFileName);
            }
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info', "skill : ".$skill->getName()." well added");
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('pages/admin/skills/skill_add.html.twig', ['skillForm'=>$skillForm->createView()]);
    }


    /**
     * @Route("/admin/skill/update/{id}", name="admin_skill_update")
     */
    public function adminSkillUpdateAction(Request $request, $id) {
        $skill = $this->skillRepository->find($id);
        $skillForm = $this->createForm(SkillType::class, $skill);

        $skillForm->handleRequest($request);
        if($skillForm->isSubmitted()){
            $skill = $skillForm->getData();
            $file = $skillForm->get('image')->getData();

            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $skill->setImage($newFileName);
            }
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info', "skill : ".$skill->getName()." well updated");
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('pages/admin/skills/skill_add.html.twig', ['skillForm'=>$skillForm->createView()]);
    }

    public function skillsTablesAction(){
        $skills = $this->skillRepository->findAll();
        return $this->render('pages/admin/components/tables/table.html.twig', ['headers' => ['id', 'name'], 'rows' => $skills, 'update' => 'admin_skill_update']);
    }
}