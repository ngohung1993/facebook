<?php

namespace common\models;

use Yii;
use common\models\base;
use yii\web\UploadedFile;

class GeneralInformation extends base\GeneralInformation
{
    /**
     * @var UploadedFile
     */
    public $fileUpLoad;

    /**
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [[['fileUpLoad'], 'file', 'skipOnEmpty' => true, 'extensions' => ['xlsx', 'xlsm'],'checkExtensionByMimeType'=>false]]);

    }

    /**
     * @return bool|null|string
     */
    public function upload()
    {
        if ($this->validate()) {
            $name = null;
            $temp = '/uploads/core/excel/' . $this->fileUpLoad->baseName . time() . '.' . $this->fileUpLoad->extension;
            if ($this->fileUpLoad->saveAs('../..' . $temp, false)) {
                $name = $temp;
            }

            return $name;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'email_notify' => Yii::t('backend', 'Email Notify'),
            'phone' => Yii::t('backend', 'Phone'),
            'address' => Yii::t('backend', 'Address'),
        ]);
    }
}
