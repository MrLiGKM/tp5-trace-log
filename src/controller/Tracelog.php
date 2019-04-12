<?php
namespace mrlig\tracelog\controller;

use mrlig\tracelog\model\TraceLogList;
use mrlig\tracelog\model\TraceLogData;
use think\Db;
use think\Controller;

class TraceLog extends Controller
{
    const TRACE_VIEW = VENDOR_PATH.'mrlig/tracelog/src/view/tracelog/';

    public function index($page = 1, $pageCount = 10, $type = 0, $route = '')
    {
        $query = new TraceLogList;
        $where = $bind = [];
        if ($type) {
            $where['type'] = ['=', ':type'];
            $bind['type'] = $type;
        }
        if ($route) {
            $where['route'] = ['like', ':route'];
            $bind['route'] = '%'.$route.'%';
        }
        if ($where && $bind) {
            $query = $query->where($where)->bind($bind);
        }
        $query_count = clone $query;
        $count = $query_count->count('id');
        $list = $query->field(['update_time'], true)->page($page, $pageCount)->order('id DESC')->select();
        return $this->fetch(SELF::TRACE_VIEW.'index.html');
        return $this->returnSuccess(['list' => $list, 'count' => $count]);
    }

    public function detail()
    {
        $id = input('param.id') ?? 0;
        $log = TraceLogList::get($id);
        if (!$log) {
            return json($log);
            sendError();
        }
        $log->content;
        return $this->returnSuccess($log);
    }

    public function delete()
    {
        $id = input('param.id') ?? 0;
        $log = TraceLogList::get($id);
        if (!$log) {
            return $this->returnFailed('记录不存在');
        }
        if (!$log->delete()) {
            return $this->returnFailed('删除失败');
        }
        return $this->returnSuccess();
    }

    public function clear()
    {
        $sql1 = 'truncate trace_log_list';
        $sql2 = 'truncate trace_log_data';
        Db::execute($sql1);
        Db::execute($sql2);
        return $this->returnSuccess();
    }

    private function returnSuccess($data = [], $message = '成功')
    {
        return json(['status' => 1, 'data' => $data, 'message' => $message]);
    }

    private function returnFailed($message = '失败')
    {
        return json(['status' => 0, 'message' => $message]);
    }
}