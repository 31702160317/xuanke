<?php
namespace app\index\controller;

use think\Controller;

class Index extends Common
{
    public function index()
    {

        return $this->fetch();
    }
    public function welcome()
    {
        return "<h3>欢迎进入茂职院选课系统<h3>";
    }
    public function exitUser(){
        session(null);
         $this->success("退出成功",url('login/index'));
    }
}
