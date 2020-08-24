<?php


namespace App\Controller\Admin\Parts;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/admin/category/add", name="admin_category_add")
     */
    public function adminCategoryAddAction(Request $request) {
        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted()){
            $category = $categoryForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('pages/admin/categories/category_add.html.twig', ['categoryForm' => $categoryForm->createView()]);
    }

    /**
     * @Route("/admin/category/update/{id}", name="admin_category_update")
     */
    public function adminCategoryUpdateAction(Request $request, $id) {
        $category = $this->categoryRepository->find($id);
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted()){
            $category = $categoryForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('pages/admin/categories/category_update.html.twig', ['categoryForm' => $categoryForm->createView()]);
    }


    /**
     * @Route("/admin/category/delete/{id}", name="admin_category_delete")
     */
    public function adminCategoryDeleteAction(Request $request, $id) {
        $category = $this->categoryRepository->find($id);
        $this->getDoctrine()->getManager()->remove($category);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_home');
    }


    public function categoriesTablesAction() {
        $categories = $this->categoryRepository->findAll();
        return $this->render('pages/admin/components/tables/table.html.twig', ['headers'=>['id', 'name'], 'rows' => $categories, "update" => 'admin_category_update',  'delete'=>'admin_skill_delete']);
    }
}