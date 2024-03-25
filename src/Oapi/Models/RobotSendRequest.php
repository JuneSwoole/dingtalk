<?php

declare(strict_types=1);

namespace June\Dingtalk\Oapi\Models;

use June\Dingtalk\Models\Model;

class RobotSendRequest extends Model
{
    /**
     * @example 自定义机器人调用接口的凭证
     *
     * @var string
     */
    public $access_token;

    /**
     * @example 自定义机器人调用接口的签名密钥
     *
     * @var string
     */
    public $secret;

    /**
     * @example 消息类型
     *
     * @var string
     */
    public $msgtype;

    /**
     * @example 文本类型消息
     *
     * @var array
     */
    public $text;

    /**
     * @example 被@的群成员信息
     *
     * @var array
     */
    public $at;

    /**
     * @example 链接类型消息
     *
     * @var array
     */
    public $link;

    /**
     * @example markdown类型消息
     *
     * @var array
     */
    public $markdown;

    /**
     * @example actionCard类型消息
     *
     * @var array
     */
    public $actionCard;

    /**
     * @example feedCard类型消息
     *
     * @var array
     */
    public $feedCard;

    protected $_name = [
        'access_token' => 'access_token',
        'secret'       => 'secret',
        'msgtype'      => 'msgtype',
        'text'         => 'text',
        'at'           => 'at',
        'link'         => 'link',
        'markdown'     => 'markdown',
        'actionCard'   => 'actionCard',
        'feedCard'     => 'feedCard'
    ];

    public function validate()
    {
        self::validateRequired("access_token", $this->access_token, true);
        self::validateRequired("msgtype", $this->msgtype, true);
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->access_token) {
            $res['access_token'] = $this->access_token;
        }
        if (null !== $this->secret) {
            $res['secret'] = $this->secret;
        }
        if (null !== $this->msgtype) {
            $res['msgtype'] = $this->msgtype;
        }
        if (null !== $this->text) {
            $res['text'] = $this->text;
        }
        if (null !== $this->at) {
            $res['at'] = $this->at;
        }
        if (null !== $this->link) {
            $res['link'] = $this->link;
        }
        if (null !== $this->markdown) {
            $res['markdown'] = $this->markdown;
        }
        if (null !== $this->actionCard) {
            $res['actionCard'] = $this->actionCard;
        }
        if (null !== $this->feedCard) {
            $res['feedCard'] = $this->feedCard;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return BatchOTOQueryRequest
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['access_token'])) {
            $model->access_token = $map['access_token'];
        }
        if (isset($map['secret'])) {
            $model->secret = $map['secret'];
        }
        if (isset($map['msgtype'])) {
            $model->msgtype = $map['msgtype'];
        }
        if (isset($map['text'])) {
            $model->text = $map['text'];
        }
        if (isset($map['at'])) {
            $model->at = $map['at'];
        }
        if (isset($map['link'])) {
            $model->link = $map['link'];
        }
        if (isset($map['markdown'])) {
            $model->markdown = $map['markdown'];
        }
        if (isset($map['actionCard'])) {
            $model->actionCard = $map['actionCard'];
        }
        if (isset($map['feedCard'])) {
            $model->feedCard = $map['feedCard'];
        }
        return $model;
    }

    public function getSign(int $timestamp): string
    {
        $Sign = "";
        if (null !== $this->secret) {
            $stringToSign = $timestamp . "\n" . $this->secret;
            $Sign = hash_hmac("sha256", $stringToSign, $this->secret, true);
        }
        return urlencode(base64_encode($Sign));
    }
}
