<?php


namespace app\index\validate;


use think\Validate;

class Student extends Validate
{


    protected $rule=[
        ['username','require|unique:student|max:26'],
        ['stuname','require'],
    ];
    protected $message=[
        'username.require'=>'学号不能为空',
        'username.unique'=>'学号不能重复',
        'username.max'=>'学号长度不得大于26字符',

        'stuname.require'=>'姓名不能为空',
    ];
    //场景设置
    protected $scene=[
        'add'=>['username','classno','stuname'],
        'edit'=>['classno','stuname'],
    ];
}