<?php

declare(strict_types=1);

namespace June\Dingtalk\Tests;

use June\Dingtalk\Oapi\Models\RobotSendRequest;
use PHPUnit\Framework\TestCase;
use June\Dingtalk\Oapi\RobotClient;

final class OapiRobotClientTest extends TestCase
{
    function testGreetsWithName()
    {
        $file = __DIR__ . '/../vendor/autoload.php';
        if (file_exists($file)) {
            require $file;
        } else {
            die("include composer autoload.php fail\n");
        }
        $robotClient = new RobotClient();
        $request = new RobotSendRequest([
            "access_token" => "",
            "msgtype" => "text",
            "text" => [
                "content" => "测试消息"
            ],
            "at" => [
                "isAtAll" => true
            ]
        ]);
        $result = $robotClient->send($request);
        var_dump($result);
        $this->assertEquals(200, $result->statusCode);
    }
}
