<?php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('create', $crawler->filter('body > a'))->text();
        $this->assertContains('edit', $crawler->filter('body > a'))->text();
        $this->assertContains('delete', $crawler->filter('body > a'))->text();
    }

    public function testcreateAction()
    {

    }

    public function updateActionTest()
    {

    }

    public function deleteActionTest()
    {

    }

}
