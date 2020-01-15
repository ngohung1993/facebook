<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property double $price
 * @property int $amount
 * @property int $discount
 * @property int $serial
 * @property string $describe
 * @property string $content
 * @property string $link
 * @property int $status
 * @property int $released
 * @property int $category_id
 * @property int $display_homepage
 * @property int $featured
 * @property int $seo_tool_id
 * @property string $slug
 * @property int $created_at
 * @property int $views
 * @property int $user_id
 * @property string $images
 *
 * @property Album[] $albums
 * @property Image[] $images0
 * @property OrderDetail[] $orderDetails
 * @property Category $category
 * @property SeoTool $seoTool
 * @property User $user
 * @property Tab[] $tabs
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'user_id'], 'required'],
            [['price'], 'number'],
            [['amount', 'discount', 'serial', 'status', 'released', 'category_id', 'display_homepage', 'featured', 'seo_tool_id', 'created_at', 'views', 'user_id'], 'integer'],
            [['describe', 'content', 'images'], 'string'],
            [['title', 'avatar', 'link', 'slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'price' => 'Price',
            'amount' => 'Amount',
            'discount' => 'Discount',
            'serial' => 'Serial',
            'describe' => 'Describe',
            'content' => 'Content',
            'link' => 'Link',
            'status' => 'Status',
            'released' => 'Released',
            'category_id' => 'Category ID',
            'display_homepage' => 'Display Homepage',
            'featured' => 'Featured',
            'seo_tool_id' => 'Seo Tool ID',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'views' => 'Views',
            'user_id' => 'User ID',
            'images' => 'Images',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages0()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['product_id' => 'id']);
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
    public function getSeoTool()
    {
        return $this->hasOne(SeoTool::className(), ['id' => 'seo_tool_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(Tab::className(), ['product_id' => 'id']);
    }
}
