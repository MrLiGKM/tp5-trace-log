<?php
namespace mrlig\tracelog;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use mrlig\tracelog\TraceLog;
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
            return '系统错误，请稍后再试！';
        }
    }

}