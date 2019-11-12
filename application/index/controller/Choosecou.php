<?php


namespace app\index\controller;


use think\Controller;

class Choosecou extends Common
{

    /**
     * 前置操作
     *
     * @var array
     */
    protected $beforeActionList = [
        'getSonIds' => ['only' => 'del'],//删除前得到其他一并删除
        'isStart' => ['except'=>'lists'],
    ];

    public function isStart(){


        $isStart=db('conf')->find(1);

        if(!$isStart['conf']){
            $this->error("不在选课时间");
        }
    }
    public function lists(){
//        $result= db('Student')->order('username desc')->alias("a")->field("a.*,b.*")->join('classs b','a.classid=b.id')->paginate(5);
        $isChoose=model('course')->alias('a')->field('b.couno')->join('stucou b','a.couno=b.couno')->find();
        $result=db('course')->paginate(5);
        $isSelet=model('stucou')->where('stuno',session('username'))->find();

        if($isSelet){
            $this->assign('Choose',intval($isSelet['couno']));
        }


        $this->assign('count',count(db('course')->select()));
        $this->assign('resCourese',$result);
        return $this->fetch();
    }

    public function choose(){

        $id= request()->param('id');
        if($last=model('stucou')->where('stuno',session('username'))->find()){
            db('course')->where('couno',$last['couno'])->setDec('willnum',1);
        }
        if(model('stucou')->where('stuno',session('username'))->delete()){

            //当数据库中有当前学号的数据就删除 并且自增willnull
            $data=array(
                'stuno'=>session('username'),
                'state'=>1,
                'couno'=>$id
            );
            $update=model('stucou')->save($data);
            db('course')->where('couno',$id)->setInc('willnum',1);
            if($update){
                return formatSuccessResult();
            }
        }else{
            $data=array(
                'stuno'=>session('username'),
                'state'=>1,
                'couno'=>$id
            );
            $update=model('stucou')->save($data);
            db('course')->where('couno',$id)->setInc('willnum',1);
            if($update){
                return formatSuccessResult();
            }
        }


        return formatResult(0,'操作失败');



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