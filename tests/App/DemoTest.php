<?php

namespace Test\App;

use PHPUnit\Framework\TestCase;

use App\App\Demo;
use App\Service\AppLogger;
use App\Util\HttpRequest;


class DemoTest extends TestCase
{

    public function test_foo()
    {
        $demo = new Demo(new AppLogger(AppLogger::TYPE_TPTPLOG), new HttpRequest());
        $this->assertEquals($demo->foo(), 'bar');
    }

    public function test_get_user_info()
    {
        $demo = new Demo(new AppLogger(AppLogger::TYPE_TPTPLOG), new HttpRequest());
        $result = $demo->get_user_info();
        $this->assertNotEquals($result, NULL);
        $this->assertEquals($result['id'] > 0, true);
        $this->assertEquals(strlen($result['username']) > 0, true);
    }
}
