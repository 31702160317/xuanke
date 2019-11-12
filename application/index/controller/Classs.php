<?php


namespace app\index\controller;


use think\Controller;
use think\Loader;

class Classs extends Common
{
    public function lists(){
        $result=db('classs')->order('id desc')->paginate(5);
        $this->assign('count',count(db('classs')->select()));

        $this->assign('resClass',$result);
        return $this->fetch();
    }
    //班级学生列表
    public function listStudent(){
        $result=db('classs')->order('id desc')->paginate(5);
        $this->assign('count',count(db('classs')->select()));

        $this->assign('resClass',$result);
        return $this->fetch();
    }
    //点击展示对应班级学生
    public function listClassStudent(){
        $classId=request()->param('id');
        $classname=request()->param('classname');

        $currentStAll=model('student')->where('classid',$classId)->paginate(5);
        $this->assign('count',count(db('student')->where('classid',$classId)->select()));
       //$currentStAll['classname']=$classname;

        $this->assign('currentStAll',$currentStAll);
        $this->assign('classname',$classname);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isPost()){
            $data=input('post.');
            $validate=validate('classs');
            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }
            $insert=model('classs')->allowField(true)->save($data);
            if($insert!==false){
                return formatSuccessResult();
            }

        }else{
            return$this->fetch();
        }
    }

    public function edit(){
        if($this->request->isPost()){
            $data=input('post.');
            $validate=validate('Classs');

            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }
            $update=model('student')->allowField(true)->save($data,['id'=>$data['id']]);
            if($update!==false){
                return formatSuccessResult();
            }

        }else{
            $id=request()->param('id');

            $currentData= db('Classs')->find($id);
            $this->assign('currentData',$currentData);
            return$this->fetch();
        }
    }
    /**
     * 前置操作
     *
     * @var array
     */
    protected $beforeActionList = [
        'getSonIds' => ['only' => 'del'],
    ];
    public function getSonIds(){
        $classid=request()->param('id');
        model('student')->where('classid',$classid)->delete();
    }

    public function del(){
        $id= request()->param('id');
        $del=model('classs')->where('id',$id)->delete();
        if($del){
            return formatSuccessResult();
        }
        return formatResult(0,'删除失败');
    }



}