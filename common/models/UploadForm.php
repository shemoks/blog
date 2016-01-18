<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $toFrontend = true;
    private $frontPath = '';
    public $uploadPath = 'uploads/'; //по умолчанию

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->toFrontend) {
            $this->frontPath = Yii::getAlias('@frontend') . '/web/';

        }
        if ($this->validate()) {
            $this->imageFile->saveAs(
                $this->frontPath .
                $this->uploadPath .
                $this->imageFile->baseName . '.' . $this->imageFile->extension
            );
            return true;
        } else {
            return false;
        }
    }
}
