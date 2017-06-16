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
        $descriptionTest = $crawler->filter('div#article > div > label')
            ->eq(1)
            ->text();
        $this->assertContains('Description', $descriptionTest); //ok
        //assertCreatedAt
        $createdAtTest = $crawler->filter('div#article > div > label')
            ->eq(2)
            ->text();
        $this->assertContains('Created at', $createdAtTest); //ok

// переход по кнопке сабмит
        $form = $crawler->selectButton('Submit')->form();
      //  var_dump($linkCreate);
   //   $linkCreate = $crawler->selectLink('div > button("Submit")')->eq(0)->link();
        //$form = $crawler = $client->click($linkCreate);
        $form['article[name]'] = 'hello test';
        $form['article[description]'] = 'hello test';
        $client->submit($form);

        $crawler = $client->request('GET', '/article');
        $this->assertContains('hello test', $crawler->filter('body > ul:nth-child(21) > li:nth-child(1)')->text());//ok
        $this->assertContains('hello test', $crawler->filter('body > ul:nth-child(21) > li:nth-child(2)')->text());//ok
    }

    public function testUpdateAction()
    {
        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => 'Anton',
                'PHP_AUTH_PW'   => '4045487',
            ]
        );
        $crawler = $client->request('GET', '/article');

        $link = $crawler->filter('a:contains("edit")')
            ->eq(0)
            ->link();
        $crawler = $client->click($link);

        $form = $crawler->selectButton('Submit')->form();
        $form['article[name]'] = 'change test';
        $form['article[description]'] = 'change test';
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/article'));//ok Халлилуя!!!!!
    }

    public function testDeleteAction()
    {
        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => 'Anton',
                'PHP_AUTH_PW'   => '4045487',
            ]
        );
        $crawler = $client->request('GET', '/article');

        $link = $crawler->filter('a:contains("delete")')
            ->eq(3)
            ->link();
        $crawler = $client->click($link);

        $this->assertTrue($client->getResponse()->isRedirect('/article'));
    }
}
