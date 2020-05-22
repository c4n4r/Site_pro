<?php


namespace App\Controller\Admin\Parts;


use App\Entity\Techno;
use App\Form\TechnoType;
use App\Repository\TechnoRepository;
use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TechnoController extends AbstractController
{

    private TechnoRepository $technoRepository;
    public function __construct(TechnoRepository $technoRepository)
    {
        $this->technoRepository = $technoRepository;

    }


    /**
     * @Route("/admin/techno/add", name="admin_techno_add")
     */
    public function adminTechnoAddAction(Request $request) {
        $techno  = new Techno();
        $technoForm = $this->createForm(TechnoType::class, $techno);

        $technoForm->handleRequest($request);

        if($technoForm->isSubmitted()) {
            $techno = $technoForm->getData();
            $file = $technoForm->get('image')->getData();
            if($file) {

                $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $techno->setImage($newFilename);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($techno);
                $manager->flush();
                return $this->redirectToRoute('admin_home');
            }
        }

        return $this->render('pages/admin/technos/techno_add.html.twig', ['technoForm' => $technoForm->createView()]);
    }

    /**
     * @Route("/admin/techno/update/{id}", name="admin_techno_update")
     */
    public function adminTechnoUpdateAction(Request $request, $id) {
        $techno = $this->technoRepository->find($id);
        $technoForm = $this->createForm(TechnoType::class, $techno);
        $technoForm->handleRequest($request);
        if($technoForm->isSubmitted()) {
            $techno = $technoForm->getData();
            $file = $technoForm->get('image')->getData();
            if($file) {
                $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $techno->setImage($newFilename);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($techno);
                $manager->flush();
                return $this->redirectToRoute('admin_home');
            }
        }
        return $this->render('pages/admin/technos/techno_add.html.twig', ['technoForm' => $technoForm->createView()]);

    }

    /**
     * @Route("/admin/techno/delete/{id}", name="admin_techno_delete")
     */
    public function adminTechnoDeleteAction(Request $request, $id) {
        $techno = $this->technoRepository->find($id);
        $this->getDoctrine()->getManager()->remove($techno);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_home');
    }

    public function technosTablesAction(){
        $technos = $this->technoRepository->findAll();
        return $this->render('pages/admin/components/tables/table.html.twig', ['headers' => ['id', 'name'], 'rows' => $technos, 'update' => 'admin_techno_update',  'delete'=>'admin_techno_delete']);
    }
}