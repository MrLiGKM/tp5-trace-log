<?php
namespace mrlig\tracelog;

use think\Debug;
use think\Db;
use mrlig\tracelog\model\TraceLogList;
use mrlig\tracelog\model\TraceLogData;

class TraceLog
{
    protected static $sql_info = ['runtime' => '0s', 'memory' => '0KB', 'sql' => []];
    protected static $database_debug = false;

    public static function sql($remark)
    {
        switch ($remark) {
            case 'begin':
                    if (!config('database.debug')) {
                        self::$database_debug = true;
                        config('database.debug', true);
                    }
                    self::traceSql();
                    return Debug::remark('begin');
                break;
            case 'end':
                    Debug::remark('end');
                    self::$sql_info['runtime'] = Debug::getRangeTime('begin','end').'s';
                    self::$sql_info['memory'] = Debug::getRangeMem('begin','end');
                    self::addTraceLog(TraceLogList::TYPE_SQL, self::$sql_info);
                    if (self::$database_debug) {
                        self::$database_debug = false;
                        config('database.debug', false);
                    }
                break;
        }
    }

    private static function traceSql()
    {
        Db::listen(function($sql,$time,$explain){
            self::$sql_info['sql'][] = ['sql' => $sql, 'time' => $time.'s', 'explain' => $explain];
        });
    }

    public static function info($message)
    {
        self::addTraceLog(TraceLogList::TYPE_INFO, $message);
    }

    public static function error($message)
    {
        self::addTraceLog(TraceLogList::TYPE_ERROR, $message);
    }

    public static function warning($message)
    {
        self::addTraceLog(TraceLogList::TYPE_WARNING, $message);
    }


    private static function addTraceLog($type, $message)
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        $line = next($backtrace)['line'];
        $position = next($backtrace)['class'].'::'.current($backtrace)['function'];
        $model = new TraceLogList();
        $model->type = $type;
        $model->method = request()->method();
        $model->route = request()->baseUrl();
        $model->ip = request()->ip();
        $model->position = $position;
        $model->line = $line;
        $content = new TraceLogData();
        $params = [];
        !empty(request()->get()) && $params['GET'] = request()->get();
        !empty(request()->post()) && $params['POST'] = request()->post();
        !empty(request()->put()) && $params['PUT'] = request()->put();
        !empty(request()->delete()) && $params['DELETE'] = request()->delete();
        $content->params = json_encode($params);
        $content->message = json_encode($message);
        $model->content = $content;
        $model->together('content')->save();
    }
}