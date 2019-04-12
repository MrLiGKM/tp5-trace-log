<?php
namespace mrlig\tracelog\model;

use think\Model;
use mrlig\tracelog\model\TraceLogData;

class TraceLogList extends Model
{
    const TYPE_INFO = 1;
    const TYPE_WARNING = 2;
    const TYPE_ERROR = 3;
    const TYPE_SQL = 4;

    protected $autoWriteTimestamp = true;

    protected $type = [
        'create_time' => 'timestamp',
        'update_time' => 'timestamp',
    ];

    protected static function init()
    {
        TraceLogList::event('before_delete', function ($log) {
            TraceLogData::destroy(['log_id' => $log->id]);
        });
    }

    public function content()
    {
        return $this->hasOne('TraceLogData', 'log_id')->field('params, message');
    }

    public function getTypeAttr($value)
    {
        $arr = [self::TYPE_INFO => '信息', self::TYPE_WARNING => '警告', self::TYPE_ERROR => '错误', self::TYPE_SQL => 'SQL'];
        return $arr[$value];
    }
}