<?php


namespace app\index\controller;


use think\Controller;
use think\Loader;

class Student extends Common
{
    public function lists(){
        $result= db('Student')->order('username desc')->alias("a")->field("a.*,b.*")->join('classs b','a.classid=b.id')->paginate(5);
       // $result=db('Student')->order('username desc')->alias('a')->join('Classs b')->where('a.classid','b.id')->paginate(5);

        $this->assign('count',count(db('student')->select()));
        $this->assign('resStudent',$result);
        return $this->fetch();
    }
    public function chooseCourseStudents(){

        $result= db('stucou')->order('stuno desc')->paginate(5);/*->alias("a")->field("a.*,b.*")->join('classs b','a.classid=b.id')->*/
       // $result=db('Student')->order('username desc')->alias('a')->join('Classs b')->where('a.classid','b.id')->paginate(5);

        $this->assign('count',count(db('stucou')->select()));
        $this->assign('resChoose',$result);
        return $this->fetch();
    }

    public function changPwd(){
        if($this->request->isPost()){
            $data=input('post.');

            $studentModel=model('student');
           /* $validate=validate('student');
            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }*/

            $insert=$studentModel->allowField(true)->save(['password'=>md5($data['password'])],['username'=>session('username')]);

            if($insert!==false){
                session(null);
                return formatSuccessResult();
            }

        }else{

            return$this->fetch();
        }
    }
    public function add(){
        if($this->request->isPost()){
            $data=input('post.');

            $studentModel=model('student');
            $validate=validate('student');
            if(!$validate->scene('add')->check($data)){
                return formatResult(0,$validate->getError());
            }

            $insert=$studentModel->allowField(true)->save($data);

            if($insert!==false){
                return formatSuccessResult();
            }

        }else{
            $classRes=model('Classs')->select();
            $this->assign('classRes',$classRes);
            return$this->fetch();
        }
    }

    public function edit(){
        if($this->request->isPost()){
            $data=input('post.');
            $validate=validate('Student');
            if(!$validate->scene('edit')->check($data)){
                return formatResult(0,$validate->getError());
            }
            $update=model('student')->allowField(true)->save($data,['id'=>$data['id']]);
            if($update!==false){
                return formatSuccessResult();
            }

        }else{
            $id=request()->param('id');
            $classRes=model('Classs')->select();
            $currentData= db('Student')->find($id);
            $this->assign('classRes',$classRes);
            $this->assign('currentData',$currentData);
            return$this->fetch();
        }
    }


    public function del(){
        $id= request()->param('id');
        $del=model('student')->where('id',$id)->delete();
        if($del){
            return formatSuccessResult();
        }
        return formatResult(0,'删除失败');
    }
    public function delAllStudent(){
         $all= db('stucou')->select();

         //删除一并还原课程报名人数
         foreach ($all as $v){
             db('course')->where('couno',$v['couno'])->setDec('willnum',1);
         }
        $del=db('stucou')->delete(true);
        if($del){
            return formatSuccessResult();
        }
        return formatResult(0,'删除失败');
    }



}