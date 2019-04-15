

### 安装扩展：
 项目根目录执行
`composer require mrlig/tracelog`

 管理页面地址：域名/traceloglist
### 导入数据库文件
数据库文件位于：项目根目录/vendor/mrlig/tracelog/src/database
导入方式：
 1. 直接在你的数据库中导入两张数据表

 2. 使用数据库迁移工具，首先创建两个迁移类，然后打开新建的迁移类，将`chnage`和`down`方法内容替换为`/vendor/mrlig/tracelog/src/database/migrations`目录下对应的内容，最后执行数据迁移，就创建好两张表了

##### 注意：如果你的数据库设置了表前缀，你需要修改新添加的这两个数据表的前缀

 ### 使用方法：

 
 `use mrlig\tracelog\TraceLog;`
 
 ##### 一般
 1. `TraceLog::info($message)` 
  ##### 警告
 2. `TraceLog::warning($message)` 
 ##### 错误
 3. `TraceLog::error($message)` 
 ##### SQL
 4. `TraceLog::sql('begin')` 开始标记
 5. `TraceLog::sql('end')` 结束标记
 
 #### 错误接管
 如果需要自定义接管框架异常处理，在配置文件中配置exception_handle的值为`\\mrlig\\tracelog\\Http`，当发生错误时则会将一些错误信息记录到数据库，日志文件中将不再记录

### 使用注意:
- 使用`Tracelog`时，如果在事务中使用且事务进行了回滚，则`Tracelog`类的方法不会记录信息，如需记录错误信息请在rollback之后使用
- 使用错误接管`Http`类时，如果使用了try catch手动捕获异常，则错误接管无效，需手动处理
