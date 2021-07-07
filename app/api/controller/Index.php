<?php
/**
 * 《------------------------------》
 *   |  Author：大鱼              |
 *   |  E_mail: yc_1224@163.com  |
 *   |  Date  : 2021/7/7          |
 *   |  Time  : 11:24          |
 *   | --------------------------|
 */
declare(strict_types=1);

namespace app\api\controller;

use app\common\controller\ApiBaseController;
use utils\ApiJson;

class Index extends ApiBaseController
{
    public function index()
    {
        return ApiJson::successful();
    }
}