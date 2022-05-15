<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(HttpClientInterface $client): Response
    {
        $response = $client->request('GET','https://www.bbc.com/arabic/topics/c719d2ely7xt');


        $html = $response->getContent();

        $content = $this->HTMLToObj($html);
        dump($content);
        exit();


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    function HTMLToObj($html) {
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        foreach($dom->getElementsByTagName('article') as $el){
            $result[] = [
                'photo'=>$el->getElementsByTagName('img')?->item(0)?->getAttribute('src'),
                'title'=>$el->getElementsByTagName('a')?->item(0)?->getElementsByTagName('span')->item(0)->textContent,
                'body'=>$el->getElementsByTagName('div')?->item(3)->getElementsByTagName('p')->item(0)->textContent,
                'time'=>$el->getElementsByTagName('time')->item(0)->getElementsByTagName('span')?->item(1)->textContent,
                'link'=>$el->getElementsByTagName('a')?->item(0)->getAttribute('href'),
            ];
        }

        return $result;
    }
}
