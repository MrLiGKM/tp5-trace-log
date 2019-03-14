<?php
namespace trace;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use trace\TraceLog;
use think\App;

class Http extends Handle
{

    public function render(Exception $e)
    {
        $data = [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'errorMessage' => $this->getMessage($e),
            'code' => $this->getCode($e),
            'datas' => $this->getExtendData($e)
        ];
        TraceLog::error($data);
        if (App::$debug) {
            return parent::render($e);
        }else{
            //此处定义自己的返回方法
            return failed('系统错误，请稍后再试！');
        }
    }

}