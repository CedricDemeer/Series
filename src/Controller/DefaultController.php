<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $productsCount = 2599;
        $username = "Bertrand";
        $series = ["aa", "bb", "cc", "dd"];
        return $this->render("default/home.html.twig", [
            "productsCount" => $productsCount,
            "username" => $username,
            "series" =>$series
        ]);
    }
    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        $content = "<h1>blibliblib</h1>";
        return $this->render("default/test.html.twig", [
            "content" => $content,
        ]);
    }
}