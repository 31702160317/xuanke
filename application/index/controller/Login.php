<?php


namespace app\index\controller;


use think\Controller;

class Login extends Controller
{
  public function index(){
      return $this->fetch('login');
  }

  protected function _initialize()
  {
      if(session('?username')&&session('?auth')){
          $this->redirect(url('index/index'));
      }
  }

    public function check(){
      $isAuth=intval(input('post.auth'));
      $form=input("post.");
      switch ($isAuth){
         /* case 0://管理员
             // if (!captcha_check($form("post.code"))) { //验证码x

              if (!captcha_check(input("post.code"))) {
                  $this->error("验证码错误",url('index'));
                  return;
              }
              $result=  isLogin('admin',$form);
              if($result==0){
                  $this->error("管理员帐号不存在",url('index'));
              }else if($result==2){
                  $this->error("管理员密码错误",url('index'));
              }else{
                  $this->success("登录成功",url('index/index'));
              }

              break;*/
          case 1:  //管理员
              if (!captcha_check(input("post.code"))) {
                  $this->error("验证码错误",url('index'));
                  return;
              }
              $result=  isLogin('admin',$form);
              if($result==0){
                  $this->error("管理员帐号不存在",url('index'));
              }else if($result==2){
                  $this->error("管理员密码错误",url('index'));
              }else{
                  $this->success("登录成功",url('index/index'));
              }
              break;

          case 2:  //学生
              if (!captcha_check(input("post.code"))) {
                  $this->error("验证码错误",url('index'));
                  return;
              }
              $result=  isLogin('student',$form);
              if($result==0){
                  $this->error("学生帐号不存在",url('index'));
              }else if($result==2){
                  $this->error("学生帐号密码错误",url('index'));
              }else{
                  $this->success("登录成功",url('index/index'));
              }
              break;
        }

  }
}