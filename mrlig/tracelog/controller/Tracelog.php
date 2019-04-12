<?php
namespace mrlig\tracelog\controller;

use mrlig\tracelog\model\TraceLogList;
use mrlig\tracelog\model\TraceLogData;
use think\Db;
use think\Controller;

class TraceLog extends Controller
{
    public function test()
    {
        return 222;
    }

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
        return json(['list' => $list, 'count' => $count]);
    }

    public function detail()
    {
        $id = input('param.id') ?? 0;
        $log = TraceLogList::get($id);
        if (!$log) {
            sendError('记录不存在');
        }
        $log->content;
        sendSuccess('', $log);
    }

    public function delete()
    {
        $id = input('param.id') ?? 0;
        $log = TraceLogList::get($id);
        if (!$log) {
            sendError('记录不存在');
        }
        if (!$log->delete()) {
            sendError('删除失败');
        }
        sendSuccess('删除成功');
    }

    public function clear()
    {
        $sql1 = 'truncate cys_trace_log_list';
        $sql2 = 'truncate cys_trace_log_data';
        Db::execute($sql1);
        Db::execute($sql2);
        sendSuccess('清空成功');
    }
}