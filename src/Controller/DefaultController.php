<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'article_index')]
    public function index(HttpClientInterface $client,Request $request): Response
    {
        $bbcUrl = 'https://www.bbc.com/arabic/';
        $topic = 'topics/c719d2ely7xt';
        $page = '/page/';
        $start = $request->get('start') ?? 1;
        $end = $request->get('end') ??  1;

        for ($i = $start;$i<=$end;$i++){
            $response = $client->request('GET',$bbcUrl.$topic.$page.$i);

            $html = $response->getContent();

            $dom = new \DOMDocument();
            @$dom->loadHTML($html);

            foreach($dom->getElementsByTagName('article') as $el){
                $content[] = [
                    'photo'=>$el->getElementsByTagName('img')?->item(0)?->getAttribute('src'),
                    'title'=>$el->getElementsByTagName('a')?->item(0)?->getElementsByTagName('span')->item(0)?->textContent,
                    'body'=>$el->getElementsByTagName('div')?->item(3)->getElementsByTagName('p')->item(0)?->textContent,
                    'time'=>$el->getElementsByTagName('time')->item(0)->getElementsByTagName('span')?->item(1)?->textContent,
                    'link'=>$el->getElementsByTagName('a')?->item(0)->getAttribute('href'),
                ];
            }
        }

        return $this->json($content);
    }


    #[Route('/{link}', name: 'article_show')]
    public function show(HttpClientInterface $client,$link): Response
    {
        $url = 'https://www.bbc.com/arabic/'.$link;
        $response = $client->request('GET',$url);

        $html = $response->getContent();

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $main = $dom->getElementsByTagName('main')->item(0);

        $content = [
            'photo'=>$main->getElementsByTagName('img')?->item(0)?->getAttribute('src'),
            'title'=>$main->getElementsByTagName('h1')?->item(0)->textContent,
            'time'=>$main->getElementsByTagName('time')?->item(0)->textContent,
            'link'=>$url,
        ];

        return $this->json($content);
    }
}
