<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;

class NewsControllerTest extends PantherTestCase
{
    public function testNews()
    {
        $client = Client::createChromeClient();
        $crawler = $client->request('GET', 'http://localhost:8000/');

        $this->assertCount(2, $crawler->filter('h1'));
        $this->assertSame(['week-601', 'symfony-live-usa-2018'], $crawler->filter('article')->extract(['id']));

        $link = $crawler->selectLink('Join us at SymfonyLive USA 2018!')->link();
        $crawler = $client->click($link);

        $this->assertSame('Join us at SymfonyLive USA 2018!', $crawler->filter('h1')->text());
        $client->takeScreenshot('screen4.png'); // Yeah, screenshot!
    }
}