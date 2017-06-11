<?php

namespace tests\AppBundle;

use AppBundle\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testId()
    {
        $idTest = null;
        $testArticle = new Article();
        $testArticle->setId($idTest);
        $this->assertEquals(null, $testArticle->getId());
    }
    public function testName()
    {
        $nameTest = 'Test 1';
        $testArticle = new Article();
        $testArticle->setName($nameTest);
        $this->assertEquals($nameTest, $testArticle->getName());
    }
    public function testDescription()
    {
        $DescriptionTest = 'Test 1';
        $testArticle = new Article();
        $testArticle->setDescription($DescriptionTest);
        $this->assertEquals($DescriptionTest, $testArticle->getDescription());
    }
    public function testCreated()
    {
        $createdTest = new \DateTime('2017-01-01 00:00:00');
        $testArticle = new Article();
        $testArticle->setCreatedAt($createdTest);
        $this->assertEquals($createdTest, $testArticle->getCreatedAt());
    }
}