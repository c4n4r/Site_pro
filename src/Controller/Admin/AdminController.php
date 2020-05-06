<?php


namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function adminHomeAction(Request $request) {
        return $this->render('pages/admin/home.html.twig');
    }
}