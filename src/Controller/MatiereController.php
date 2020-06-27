<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class MatiereController extends AbstractController
{
    /**
     * @Route("/admin/matiere", name="matiere")
     */
    public function index(HttpClientInterface $httpClient)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', "http://127.0.0.1:8001/api/matieres");
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();

        return $this->json($content);
        dd($content);
        $content = $response->toArray();
        $matieres= $content["hydra:member"];
        dd($matieres);

        /*return $this->render('matiere/index.html.twig', [
            'controller_name' => 'MatiereController',
        ]);*/
    }
}
