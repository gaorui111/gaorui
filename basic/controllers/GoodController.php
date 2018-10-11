<?php
namespace app\controllers;
header("content-type:text/html;charset=utf-8");
use Yii;
use yii\filters\AccessControl;
use yii\rest\IndexAction;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Good;
use app\models\Upload;
use yii\web\UploadedFile;
class GoodController  extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $model = new Good();
        $data = $model->find()->asArray()->all();
        return $this->render('index',['data'=>$data]);
    }
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionDoadd()
    {
        $model = new Good();
        $good_name = Yii::$app->request->post('good_name');
        $good_price = Yii::$app->request->post('good_price');
        $good_stock = Yii::$app->request->post('good_stock');
        $good_img = Yii::$app->request->post('good_img');
//        var_dump($good_name,$good_img,$good_stock,$good_price);die;
        $model->good_name=$good_name;
        $model->good_price=$good_price;
        $model->good_stock=$good_stock;
        $model->good_img=$good_img;
        $res = $model->insert();
        if ($res) {
            $this->redirect(['good/index']);

        }else{

        }
    }
//    修改
    public function actionUpd($id)
    {
        $model = new Good();
        $data = $model->findOne($id);
        return $this->render('upd',['data'=>$data]);
    }
    public function actionDoupd()
    {
        $good_name = Yii::$app->request->post('good_name');
        $good_stock = Yii::$app->request->post('good_stock');
        $good_price = Yii::$app->request->post('good_price');
        $id = yii::$app->request->post('id');
        $model = Good::findOne($id);
        $model->good_name = $good_name;
        $model->good_stock = $good_stock;
        $model->good_price = $good_price;
        $model->save();
        $this->redirect(['index']);
    }
//    删除
    public  function actionDelete()
    {
        $id= yii::$app->request->get('id');

        $model = new Good();
        $res = $model->deleteAll('id=:id',['id'=>$id]);
        if ($res) {
            $this->redirect(['good/index']);
        }
    }
////    普通文件上传
//    public function actionUpload()
//    {
//        $model = new Upload();
//        if (Yii::$app->request->isPost) {
//           $path = $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
//            if ($path) {
//                var_dump($path);die;
//                // 文件上传成功
//                return "上传成功";
//            }
//        }
//        return $this->render('upload', ['model' => $model]);
//    }
//    入库文件上传
    public function actionUpload()
    {
        $model = new Upload();
        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $path = $model->upload();
            if ($path) {
//                var_dump($path);die;
                // 文件上传成功
                return "上传成功";
            }
        }
        return $this->render('upload', ['model' => $model]);
    }
}