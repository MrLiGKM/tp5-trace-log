
### 使用方法：

 - 下载文件，放到框架extend目录（*放置的位置不同，需要自己修改命名空间*）
 - 在需要记录的文件`use` `TraceLog`类直接调用
 #### 方法说明：
 ##### `$message`为字符串或数组（模型查询出的对象实例会自动转为数组）
 
 ##### 一般
 - `TraceLog::info($message)` 
  ##### 警告
 - `TraceLog::warning($message)` 
 ##### 错误
 - `TraceLog::error($message)` 
 ##### SQL
 - `TraceLog::sql('begin')` 开始标记
 - `TraceLog::sql('end')` 结束标记
