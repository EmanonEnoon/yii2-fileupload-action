Yii2-FileUpload
===============
use in controller

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist osenyursa/yii2-fileupload "dev-master"
```

or add

```
"osenyursa/yii2-fileupload": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
// in controller
class FileController extends Controller
{
    public function actions()
    {
        return [
            'ajax-upload' => [
                'class' => UploadAction::className(),
                'rules' => ['skipOnEmpty' => false, 'maxFiles' => 4],
                'name' => 'cover',
                'savePath' => 'upload/' . date('Y-m-d') . '/',
            ]
        ];
    }

    public function actionUpload()
    {
        return $this->render('upload');
    }
}
```