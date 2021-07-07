<?php
/**
 * 《------------------------------》
 *   |  Author：大鱼              |
 *   |  E_mail: yc_1224@163.com  |
 *   |  Date  : 2020/11/20          |
 *   |  Time  : 15:43          |
 *   | --------------------------|
 */
declare (strict_types = 1);

namespace utils;

class ApiStatusCode
{
    // 格式 xyyzz
    // x 1严重错误 2警告错误 3提示信息
    // y 错误分类
    // z 错误详细
    const SUCCESS               = 0;
    const HTTP_ERROR            = 10100;//请求错误
    const SQL_ERROR             = 10200;//数据库错误
    const WEB_ERROR             = 10300;//前端交互错误

    const VALIDATE              = 20100;//验证不通过
}