<?php

namespace DiamondRecruiter\RecruiterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testCalendar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calendar');
    }

}
