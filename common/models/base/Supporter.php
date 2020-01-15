<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "supporter".
 *
 * @property int $id
 * @property string $full_name
 * @property string $describe
 * @property string $avatar
 * @property int $serial
 * @property string $email
 * @property string $phone
 * @property string $yahoo
 * @property string $skype
 * @property int $status
 * @property string $slug
 */
class Supporter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supporter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['describe'], 'string'],
            [['serial', 'status'], 'integer'],
            [['full_name', 'avatar', 'email', 'phone', 'yahoo', 'skype', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'full_name' => Yii::t('backend', 'Full Name'),
            'describe' => Yii::t('backend', 'Describe'),
            'avatar' => Yii::t('backend', 'Avatar'),
            'serial' => Yii::t('backend', 'Serial'),
            'email' => Yii::t('backend', 'Email'),
            'phone' => Yii::t('backend', 'Phone'),
            'yahoo' => Yii::t('backend', 'Yahoo'),
            'skype' => Yii::t('backend', 'Skype'),
            'status' => Yii::t('backend', 'Status'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }
}
