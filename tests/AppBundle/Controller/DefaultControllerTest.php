<?php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => 'Anton',
                'PHP_AUTH_PW'   => '4045487',
            ]
        );

        $crawler = $client->request('GET', '/article');

        $this->assertEquals(200, $client->getResponse()->getStatusCode()); //ok

        $this->assertTrue($client->getResponse()->isOk()); //ok

    }

    public function testCreateAction()
    {

        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => 'Anton',
                'PHP_AUTH_PW'   => '4045487',
            ]
        );
        $crawler = $client->request('GET', '/article/create');
        //assertName
        $Nametest = $crawler->filter('div#article > div > label')->text();
        $this->assertContains('Name', $Nametest); //ok
        //assertDescription
        $descriptionTest = $crawler->filter('div#article > div > label')->eq(1)->text();
        $this->assertContains('Description', $descriptionTest); //ok
        //assertCreatedAt
        $createdAtTest = $crawler->filter('div#article > div > label')->eq(2)->text();
        $this->assertContains('Created at', $createdAtTest); //ok


        $linkCreate = $crawler->selectButton('Submit');
      // var_dump($linkCreate->count());
   //   $linkCreate = $crawler->selectLink('div > button("Submit")')->eq(0)->link();
    $crawler = $client->click($linkCreate);
        var_dump($crawler->count());

    }

    public function updateActionTest()
    {

    }

    public function deleteActionTest()
    {

    }

}
