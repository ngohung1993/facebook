<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "tab".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property int $setting_id
 * @property int $classified_id
 * @property int $product_id
 * @property int $post_id
 * @property int $serial
 * @property string $avatar
 * @property string $describe
 * @property string $content
 * @property int $status
 * @property string $slug
 * @property string $images
 * @property string $code
 *
 * @property Image[] $images0
 * @property Category $category
 * @property Classified $classified
 * @property Post $post
 * @property Product $product
 * @property Setting $setting
 */
class Tab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['category_id', 'setting_id', 'classified_id', 'product_id', 'post_id', 'serial', 'status'], 'integer'],
            [['describe', 'content', 'images', 'code'], 'string'],
            [['title', 'avatar', 'slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['classified_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classified::className(), 'targetAttribute' => ['classified_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Setting::className(), 'targetAttribute' => ['setting_id' => 'id']],
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
            'category_id' => 'Category ID',
            'setting_id' => 'Setting ID',
            'classified_id' => 'Classified ID',
            'product_id' => 'Product ID',
            'post_id' => 'Post ID',
            'serial' => 'Serial',
            'avatar' => 'Avatar',
            'describe' => 'Describe',
            'content' => 'Content',
            'status' => 'Status',
            'slug' => 'Slug',
            'images' => 'Images',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages0()
    {
        return $this->hasMany(Image::className(), ['tab_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassified()
    {
        return $this->hasOne(Classified::className(), ['id' => 'classified_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(Setting::className(), ['id' => 'setting_id']);
    }
}
