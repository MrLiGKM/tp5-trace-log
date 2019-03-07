<?php
namespace trace\model;

use app\common\model\Model;

class TraceLogData extends Model
{
    protected $autoWriteTimestamp = true;

    protected $type = [
        'create_time' => 'timestamp',
        'update_time' => 'timestamp',
    ];
}