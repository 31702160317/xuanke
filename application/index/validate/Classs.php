<?php


namespace app\index\validate;


use think\Validate;

class Classs extends Validate
{
    protected $rule=[
        ['classname','require|unique:classs|max:26'],

    ];
    protected $message=[


        'classname.require'=>'班级不能为空',
        'classname.unique'=>'班级名不能重复',
        'classname.max'=>'班级名长度不得大于26字符',



    ];
    //场景设置
    protected $scene=[
        'add'=>['classname'],
    ];
}