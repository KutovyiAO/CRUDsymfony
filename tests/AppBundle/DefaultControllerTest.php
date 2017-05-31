<?php

namespace tests\AppBundle;

use AppBundle\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('create', $crawler->filter('body > a'))->text();
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
