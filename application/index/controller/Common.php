<?php


namespace app\index\controller;


use think\Controller;

class Common extends  Controller
{


    public function _initialize()
    {
        if(!(session('?username')&&session('?auth'))){
            $this->error("请先登录！",url('login/index'));
        }

    }
}