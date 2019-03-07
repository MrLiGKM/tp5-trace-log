<?php
namespace trace;

use think\Debug;
use think\Db;
use app\common\model\TraceLogList;
use app\common\model\TraceLogData;

class TraceLog
{
    protected static $sql_info = ['runtime' => '0s', 'memory' => '0KB', 'sql' => []];

    public static function sql($remark)
    {
        switch ($remark) {
            case 'begin':
                    self::traceSql();
                    return Debug::remark('begin');
                break;
            case 'end':
                    Debug::remark('end');
                    self::$sql_info['runtime'] = Debug::getRangeTime('begin','end').'s';
                    self::$sql_info['memory'] = Debug::getRangeMem('begin','end');
                    self::addTraceLog(TraceLogList::TYPE_SQL, self::$sql_info);
                break;
        }
    }

    private static function traceSql()
    {
        Db::listen(function($sql,$time,$explain){
            self::$sql_info['sql'][] = ['sql' => $sql, 'time' => $time.'s', 'explain' => $explain];
        });
    }

    public static function traceInfo($message)
    {
        self::addTraceLog(TraceLogList::TYPE_INFO, $message);
    }

    public static function traceError($message)
    {
        self::addTraceLog(TraceLogList::TYPE_ERROR, $message);
    }

    public static function traceWarning($message)
    {
        self::addTraceLog(TraceLogList::TYPE_WARNING, $message);
    }


    private static function addTraceLog($type, $message)
    {
        $model = new TraceLogList();
        $model->type = $type;
        $model->method = request()->method();
        $model->route = request()->baseUrl();
        $content = new TraceLogData();
        $content->params = json_encode(['GET' => request()->get(), 'POST' => request()->post(), 'PUT' => request()->put(), 'DELETE' => request()->delete()]);
        $content->message = json_encode($message);
        $model->content = $content;
        $model->together('content')->save();
    }
}