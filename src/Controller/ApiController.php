<?php

namespace App\Controller;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/{entity}/get-image/{id}", name="api-get-image", methods={"GET"})
     */
    public function apiPreviewImage($entity, $id)
    {
        $class  = "App\\Entity\\".$entity;
        $found = $this->getDoctrine()->getRepository($class)->find($id);
        if($found) return $this->json(['code'=>200, 'body' => ['message' => 'image data', 'data' => $found->getImage()]]);
        return $this->json(['code'=>404, 'body'=>['message'=>'entity not found for id : '.$id]]);
    }
}
