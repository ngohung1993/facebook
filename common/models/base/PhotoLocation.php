<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "photo_location".
 *
 * @property int $id
 * @property string $title
 * @property string $describe
 * @property string $key
 * @property string $code
 * @property int $released
 * @property string $slug
 *
 * @property Image[] $images
 */
class PhotoLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'key'], 'required'],
            [['code'], 'string'],
            [['released'], 'integer'],
            [['title', 'describe', 'key', 'slug'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'describe' => Yii::t('backend', 'Describe'),
            'key' => Yii::t('backend', 'Key'),
            'code' => Yii::t('backend', 'Code'),
            'released' => Yii::t('backend', 'Released'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['photo_location_id' => 'id']);
    }
}
