<?php

namespace osenyursa\fileupload\actions;

use osenyursa\fileupload\model\UploadForm;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;

class UploadAction extends Action
{
    public $rule;

    /** @var  UploadForm */
    private $model;

    public function beforeRun()
    {
        $this->model = new UploadForm();
        $this->model->rules = $this->rule;

        return parent::beforeRun();
    }

    public function run()
    {
        if (Yii::$app->request->isPost) {
            $this->model->imageFiles = UploadedFile::getInstances($this->model, 'imageFiles');
            if ($this->model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->controller->render('upload', [
            'model' => $this->model,
        ]);

    }
}