<?php
/**
 * 《------------------------------》
 *   |  Author：大鱼              |
 *   |  E_mail: yc_1224@163.com  |
 *   |  Date  : 2020/11/20          |
 *   |  Time  : 14:59          |
 *   | --------------------------|
 */
declare (strict_types = 1);

namespace utils;

use think\Response;

class ApiJson
{
    private static $success = 'SUCCESS';
    private static $fail = 'FAIL';

    private static function make($status, string $msg,int $code, $data = null): Response
    {
        $res = compact('status','code','msg','data');
        if (is_null($res['data'])) $res['data'] = (object)[];
        return json($res);
    }

    public static function success($msg = '操作成功', $data = null): Response
    {
        if (is_array($msg) || is_object($msg)) {
            $data = $msg;
            $msg = 'ok';
        }
        return self::make(self::$success, $msg, ApiStatusCode::SUCCESS, $data);
    }

    public static function successful(...$args): Response
    {
        return self::success(...$args);
    }

    public static function fail($msg = '操作失败',$code = 200000, $data = null): Response
    {
        return self::make(self::$fail, $msg, $code, $data);
    }

    public static function status($status, $msg, $result = [])
    {
        $status = strtoupper($status);
        if (is_array($msg)) {
            $result = $msg;
            $msg = 'ok';
        }
        return self::success($msg, compact('status', 'result'));
    }
}