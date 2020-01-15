<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $link
 * @property string $code
 * @property string $key
 * @property string $describe
 * @property string $content
 * @property int $released
 * @property int $status
 * @property string $slug
 * @property string $images
 *
 * @property Image[] $images0
 * @property Tab[] $tabs
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'key'], 'required'],
            [['code', 'describe', 'content', 'images'], 'string'],
            [['released', 'status'], 'integer'],
            [['title', 'avatar', 'link', 'key', 'slug'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'avatar' => 'Avatar',
            'link' => 'Link',
            'code' => 'Code',
            'key' => 'Key',
            'describe' => 'Describe',
            'content' => 'Content',
            'released' => 'Released',
            'status' => 'Status',
            'slug' => 'Slug',
            'images' => 'Images',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages0()
    {
        return $this->hasMany(Image::className(), ['setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(Tab::className(), ['setting_id' => 'id']);
    }
}
