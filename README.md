
### 使用方法：

 - 下载文件，放到框架extend目录（*放置的位置不同，需要自己修改命名空间*）
 - 导入两张数据表，注意是否设置前缀，设置了就给表名加上前缀
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
 
 #### 错误接管
 如果需要自定义接管框架异常处理，在配置文件中配置exception_handle的值为`\\trace\\Http`，当发生错误时则会将一些错误信息记录到数据库，日志文件中将不再记录

### 使用注意:
- 使用`Tracelog`时，如果在事务中使用且事务进行了回滚，则`Tracelog`类的方法不会记录信息，如需记录错误信息请在rollback之后使用
- 使用错误接管`Http`类时，如果使用了try catch手动捕获异常，则错误接管无效，需手动处理
