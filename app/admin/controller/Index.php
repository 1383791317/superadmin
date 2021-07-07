<?php
/**
 * 《------------------------------》
 *   |  Author：大鱼              |
 *   |  E_mail: yc_1224@163.com  |
 *   |  Date  : 2021/7/5          |
 *   |  Time  : 15:27          |
 *   | --------------------------|
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\common\controller\AdminBaseController;

class Index extends AdminBaseController
{
    public function index()
    {
        return $this->fetch();
    }

    public function console()
    {
        return $this->fetch();
    }
}