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
                'PHP_AUTH_PW' => '4045487',
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
                'PHP_AUTH_PW' => '4045487',
            ]
        );
        $crawler = $client->request('GET', '/article/create');
        $Nametest = $crawler->filter('div#article > div > label')->text();
        $this->assertContains('Name', $Nametest); //ok

        $descriptionTest = $crawler->filter('div#article > div > label')
            ->eq(1)
            ->text();
        $this->assertContains('Description', $descriptionTest); //ok

        $createdAtTest = $crawler->filter('div#article > div > label')
            ->eq(2)
            ->text();
        $this->assertContains('Created at', $createdAtTest); //ok

        $form = $crawler->selectButton('Submit')->form();
        $form['article[name]'] = 'hello test';
        $form['article[description]'] = 'hello test';
        $client->submit($form);

        $crawler = $client->request('GET', '/article');
        $this->assertContains('hello test', $crawler->filter('body > ul > li')->text());//ok
        $this->assertContains('hello test', $crawler->filter('body > ul > li')->text());//ok
    }

    public function testUpdateAction()
    {
        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => 'Anton',
                'PHP_AUTH_PW' => '4045487',
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
                'PHP_AUTH_PW' => '4045487',
            ]
        );
        $crawler = $client->request('GET', '/article');

        $link = $crawler->filter('a:contains("delete")')
            ->eq(0)
            ->link();
        $crawler = $client->click($link);

        $this->assertTrue($client->getResponse()->isRedirect('/article'));
    }
}
