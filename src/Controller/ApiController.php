<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/{entity}/get-image/{id}", name="api-get-image", methods={"GET"})
     */
    public function apiPreviewImage($entity, $id)
    {
        $class = "App\\Entity\\".$entity;
        $found = $this->getDoctrine()->getRepository($class)->find($id);
        return $this->json(['code'=>200, 'body' => ['message' => 'image data', 'data' => $found->getImage()]]);
    }
}
