<?php
namespace mrlig\tracelog\model;

use think\Model;

class TraceLogData extends Model
{
    protected $autoWriteTimestamp = true;

    protected $type = [
        'create_time' => 'timestamp',
        'update_time' => 'timestamp',
    ];
}