<?php

declare(strict_types=1);

namespace June\Dingtalk\Oapi\Models;

use June\Dingtalk\Models\Model;

class RobotSendResponseBody extends Model
{
    /**
     * @var Number
     */
    public $errcode;
    /**
     * @var String
     */
    public $errmsg;
    protected $_name = [
        'errcode' => 'errcode',
        'errmsg' => 'errmsg'
    ];

    public function validate()
    {
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->errcode) {
            $res['errcode'] = $this->errcode;
        }
        if (null !== $this->errmsg) {
            $res['errmsg'] = $this->errmsg;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return OrgGroupSendResponseBody
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['errcode'])) {
            $model->errcode = $map['errcode'];
        }
        if (isset($map['errmsg'])) {
            $model->errmsg = $map['errmsg'];
        }
        return $model;
    }
}
