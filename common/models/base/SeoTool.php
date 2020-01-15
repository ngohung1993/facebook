<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "seo_tool".
 *
 * @property int $id
 * @property string $seo_title
 * @property string $meta_keywords
 * @property string $meta_description
 *
 * @property Category[] $categories
 * @property Post[] $posts
 * @property Product[] $products
 */
class SeoTool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_tool';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_description'], 'string'],
            [['seo_title', 'meta_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seo_title' => 'Seo Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['seo_tool_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['seo_tool_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['seo_tool_id' => 'id']);
    }
}
