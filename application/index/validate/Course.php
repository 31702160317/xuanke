<?php


namespace app\index\validate;


use think\Validate;

class Course extends Validate
{
    protected $rule=[
        ['couname','require|unique:course|max:26'],

    ];
    protected $message=[


        'couname.require'=>'课程不能为空',
        'couname.unique'=>'课程名不能重复',
        'couname.max'=>'课程名长度不得大于26字符',



    ];
    //场景设置
    protected $scene=[
        'add'=>['couname'],
    ];
}