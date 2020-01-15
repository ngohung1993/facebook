<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $describe
 * @property string $key
 * @property string $code
 * @property string $slug
 * @property int $released
 *
 * @property Category[] $categories
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
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
            'id' => 'ID',
            'title' => 'Title',
            'describe' => 'Describe',
            'key' => 'Key',
            'code' => 'Code',
            'slug' => 'Slug',
            'released' => 'Released',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['page_id' => 'id']);
    }
}
