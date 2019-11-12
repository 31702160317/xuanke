<?php


namespace app\index\controller;


use think\Controller;

class Course extends Common
{


    public function lists(){
        $isStart=db('conf')->find(1);
        $result=db('course')->paginate(5);
        $this->assign('count',count(db('course')->select()));
        $this->assign('isStart',$isStart['conf']);

        $this->assign('resCourese',$result);

        return $this->fetch();
    }
    public function add(){

        if($this->request->isPost()){
            $data=input('post.');
            $validate=validate('Course');
            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }
            $insert=model('course')->allowField(true)->save($data);
            if($insert!==false){
                return formatSuccessResult();
            }

        }else{
            return$this->fetch();
        }


    }
    //是否开启选课
    public function isStart(){
        $status=intval(request()->param('id')==1?0:1);

        $update=db('conf')->where('id',1)->update(['conf'=>$status]);

            return formatSuccessResult();


    }
    public function edit(){
        if($this->request->isPost()){
            $data=input('post.');
            $validate=validate('Course');
            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }
            $insert=model('course')->allowField(true)->save($data,['couno'=>$data['couno']]);
            if($insert!==false){
                return formatSuccessResult();
            }

        }else{
            $couno=request()->param('id');
            $currentData= db('Course')->where('couno',$couno)->find();
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
    //删除课程也删除学生课表下的id
    public function getSonIds(){
        $id=request()->param('id');
        model('stucou')->where('couno',$id)->delete();


    }

    public function del(){
        $id= request()->param('id');
        $del=model('Course')->where('couno',$id)->delete();
        if($del){
            return formatSuccessResult();
        }
        return formatResult(0,'删除失败');
    }

}