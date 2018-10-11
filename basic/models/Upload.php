<?php

namespace app\models;
use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

class Upload extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
//普通上传
//    public function upload()
//    {
//        if ($this->validate()) {
//            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
//            return true;
//        } else {
//            return false;
//        }
//    }

//入库上传
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        } else {
            return false;
        }
    }
}