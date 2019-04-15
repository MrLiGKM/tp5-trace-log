<?php
/**
 * @Author: anchen
 * @Date:   2019-04-15 15:17:11
 * @Last Modified by:   anchen
 * @Last Modified time: 2019-04-15 15:46:23
 */
think\Route::group(
    'traceloglist', [
        ':id' => ['\mrlig\tracelog\controller\Tracelog@detail', ['method' => 'get'], ['id' => '\d+']],
        'del' => ['\mrlig\tracelog\controller\Tracelog@delete', ['method' => 'post']],
        'clear' => ['\mrlig\tracelog\controller\Tracelog@clear', ['method' => 'post']],
        'list' => ['\mrlig\tracelog\controller\Tracelog@list', ['method' => 'get']],
        '/' => ['\mrlig\tracelog\controller\Tracelog@index', ['method' => 'get']],    
]);