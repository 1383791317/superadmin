<?php
/**
 * 《------------------------------》
 *   |  Author：大鱼              |
 *   |  E_mail: yc_1224@163.com  |
 *   |  Date  : 2021/7/5          |
 *   |  Time  : 15:29          |
 *   | --------------------------|
 */
declare(strict_types=1);

namespace app\common\controller;

use app\BaseController;
use think\facade\View;

class AdminBaseController extends BaseController
{
    public function index()
    {
        if ($this->request->isAjax()){

        }
        return $this->fetch();
    }


    protected function fetch(string $template = '')
    {
        return View::fetch($template);
    }

    protected function assign(...$vars)
    {
        View::assign(...$vars);
    }
}