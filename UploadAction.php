<?php

namespace osenyursa\fileupload;

use yii\base\Action;
use yii\helpers\FileHelper;
use yii\validators\FileValidator;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Class UploadAction
 * @package osenyursa\fileupload
 */
class UploadAction extends Action
{
    /**
     * ```
     * ['skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4]
     * ```
     * @var
     */
    public $rules;

    /**
     * the name of the file input field.
     * @var string
     */
    public $name;

    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var string
     */
    public $savePath;

    /**
     * @var string
     */
    public $saveBaseName;


    public function run()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $this->file = UploadedFile::getInstanceByName($this->name);

        $validator = new FileValidator($this->rules);
        if (!$validator->validate($this->file, $error)) {
            return ['error' => $error];
        }

        $this->upload();

        return ['success' => '1'];

    }

    protected function upload()
    {
        FileHelper::createDirectory($this->savePath);

        $this->file->saveAs(implode('', [
            $this->savePath,
            $this->saveBaseName ?: $this->file->baseName,
            $this->file->extension
        ]));
    }
}