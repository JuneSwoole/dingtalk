<?php
/*
 * @Author: juneChen && juneswoole@163.com
 * @Date: 2024-03-15 16:42:14
 * @LastEditors: juneChen && juneswoole@163.com
 * @LastEditTime: 2024-03-25 15:54:27
 * @Description: 机器人接口
 * 
 */

declare(strict_types=1);

namespace June\Dingtalk\Oapi;

use GuzzleHttp\Client;
use June\Dingtalk\Models\Model;
use GuzzleHttp\Psr7\Request;
use June\Dingtalk\Oapi\Models\RobotSendRequest;
use June\Dingtalk\Oapi\Models\RobotSendResponse;

class RobotClient
{
    private $base_url = "https://oapi.dingtalk.com/robot/";
    /**
     * 自定义机器人发送群消息
     *
     * @param RobotSendRequest $request
     * @return RobotSendResponse
     * @author juneChen <juneswoole@163.com>
     */
    public function send(RobotSendRequest $request)
    {
        $request->validate();
        $_request = new Request("POST", $this->base_url . "send", [
            'User-Agent'   => 'testing/1.0',
            'Accept'       => 'application/json',
            'Content-type' => "application/json;charset='utf-8'"
        ], self::toJSONString($request));

        $_options = [
            "query" => [
                "access_token" => $request->access_token
            ]
        ];
        $timestamp = intval(microtime(true) * 1000);
        $Sign = $request->getSign($timestamp);
        if (!empty($Sign)) {
            $_options['query']['timestamp'] = $timestamp;
            $_options['query']['sign'] = $Sign;
        }
        $_response = self::client()->send($_request, $_options);
        $_body = $_response->getBody();
        if ($_body->isSeekable()) {
            $_body->rewind();
        };
        return RobotSendResponse::fromMap([
            "headers"    => $_response->getHeaders(),
            "body"       => json_decode($_body->getContents(), true),
            "statusCode" => $_response->getStatusCode()
        ]);
    }

    /**
     * @return Client
     */
    public static function client(array $config = [])
    {
        return new Client($config);
    }

    public static function toJSONString($object)
    {
        if (is_string($object)) {
            return $object;
        }

        if ($object instanceof Model) {
            $object = $object->toMap();
        }

        return json_encode($object, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
    }
}
