<?php
/**
 * *************************************
 * Author: 大鱼
 * E_mail: yc_1224@163.com
 * Date  : 2019/11/15 0015
 * *************************************
 */
namespace app\api;

use think\db\exception\DbException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\Log;
use think\Response;
use Throwable;
use utils\ApiJson;
use utils\ApiStatusCode;

class ApiExceptionHandle extends Handle
{
    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        $setStr = '';
        $setStr .= "操作日志开始        \tIP:'".$this->app->request->ip()."'\n";
        $setStr .= "请求地址：". $this->app->request->url() . "\n";
        $setStr .= "请求体：".json_encode($this->app->request->param()) . "\n";
        $setStr .= "错误信息：".$exception->getMessage() . "\n";
        $setStr .= "文件未知：".$exception->getFile().' '.$exception->getLine() . "\n";
        Log::channel('api_error_log')->record($setStr,'error');
//        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof ValidateException) return ApiJson::fail($e->getMessage(),ApiStatusCode::VALIDATE);

        // 获取开发模式
        $debug = $this->app->isDebug();
        // 添加自定义异常处理机制
        if ($debug){
            $data = [
                'message'     => $e->getMessage(),
                'http_status' => 500,
                'file'        => $e->getFile(),
                'line'        => $e->getLine(),
                'previous'    => $e->getPrevious(),
            ];

            if ($e instanceof DbException) return ApiJson::fail('数据异常',ApiStatusCode::SQL_ERROR, $data);
            if ($e instanceof HttpException) return ApiJson::fail('HTTP异常，检查你的请求方式及地址',ApiStatusCode::SQL_ERROR, $data);
            if ($e instanceof HttpResponseException) return ApiJson::fail('HTTP响应异常',ApiStatusCode::SQL_ERROR, $data);

        }else{
            $data = ['服务端错误，请检查接口传入数据，按文档规范请求。'];
        }
        return ApiJson::fail('未知错误',ApiStatusCode::HTTP_ERROR, $data);
    }
}