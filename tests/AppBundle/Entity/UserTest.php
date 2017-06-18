<?php
/**
 * Created by PhpStorm.
 * User: antonkutovoj
 * Date: 09.06.17
 * Time: 19:09
 */

namespace tests\AppBundle;
namespace Tests\AppBundle\Util;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testName()
    {
        $nameTest = 'Name';
        $testUserName = new User();
        $testUserName->setUsername($nameTest);
        $this->assertEquals($nameTest, $testUserName->getUsername());
    }

    public function testPassword()
    {
        $passwordTest = '40454';
        $testUser = new User();
        $testUser->setPassword($passwordTest);
        $this->assertEquals($passwordTest, $testUser->getPassword());
    }
}