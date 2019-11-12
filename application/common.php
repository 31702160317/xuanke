<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * @param $tableName
 * @param $data
 * @return int
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException角色登录
 */
function isLogin($tableName,$data){
    $isUser= db($tableName)->where('username',$data['username'])->find();
    $isPw=db($tableName)->where('password',md5($data['password']))->find();
    $login=db($tableName)->where('username',$data['username'])->find();



    if(!$isUser){ //用户名x
        return 0;
    }
    if(!($login['password']==md5($data['password']))){ //密码x
        return 2;
    }



   /* if(!$isPw){ //密码 x

    }*/
   if(intval($data['auth'])==1){
        session('auth',1);
        session('authname','超级管理员');
        session('username',$data['username']);
    }else{
        session('auth',2);
        session('authname',$isPw['stuname']);
        session('username',$data['username']);


    }

    return 1;  //正确
    //
}


/**
 * @param null $data
 * @return \think\response\Json
 * 操作成功
 */
function formatSuccessResult($data = null,$msg='操作成功'){
    return json(['code' => 1,'msg' => $msg,'data' => $data]);
}

/**
 * @param int $code
 * @param string $errorMsg
 * @param string $data
 * @return array
 * 失败信息
 */
function formatResult($code,$errorMsg, $data = null){
    return json(['code' => $code,'msg' => $errorMsg,'data'=>$data]);
}


function status($status=1){
    switch ($status){
        case 1:
            return '<span class="label label-success radius">已选择</span>';
            break;
            case 0:
            return '<span class="label radius">未选择</span>';
            break;
    }
}