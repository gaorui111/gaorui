<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\Goods;
class Index extends Controller
{
   public function index()
   {
       return view('good');

   }
       public function insert()
       {
           $request = Request::instance();
           $data = $request->post();
           $goods = new Goods;
           $result = $goods->insertData($data);
           if ($result) {
               $this->success('新增成功', 'index/show');
           } else {
               $this->error('新增失败');
           }
       }
           //展示
           public function show()
       {
           $goods = new Goods;
           $arr = $goods->show();
           return $this->fetch('show',['arr' => $arr]);
       }
           //删除
           public function delete()
       {
           $request = Request::instance();
           $id = $request->get('id');
           $goods = new Goods;
           $result = $goods->deleteData($id);
           if ($result) {
               $this->success('删除成功', 'index/show');
           } else {
               $this->error('删除失败');
           }
       }
    public function update()
    {
        $request = Request::instance();
        $id = $request->get('id');
        $goods = new Goods;
        $res = $goods->findData($id);
        return view('update', ['res' => $res]);
    }
    //修改数据
                 public function save()
                {
                $id = $_POST['id'];
                $request = Request::instance();
                $data = $request->post();
                // var_dump($data);die;
                $goods = new Goods;
                $result = $goods->updateData($data,$id);
                if ($result){
                    $this->success('修改成功', 'index/show');
                }else {
                  $this->error('修改失败');
                }
                }
}