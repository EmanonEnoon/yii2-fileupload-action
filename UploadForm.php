<?php

namespace osenyursa\fileupload;


use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public $rules;

    public $savePath;

    public function rules()
    {
        return $this->rules;
    }

    public function upload()
    {
        if ($this->validate()) {

            FileHelper::createDirectory($this->savePath);
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}