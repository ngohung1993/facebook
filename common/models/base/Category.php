<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $describe
 * @property int $serial
 * @property int $parent_id
 * @property string $content
 * @property int $page_id
 * @property int $display_homepage
 * @property int $featured
 * @property int $status
 * @property int $seo_tool_id
 * @property string $slug
 * @property string $key
 * @property string $code
 * @property string $link
 * @property string $images
 *
 * @property Album[] $albums
 * @property Page $page
 * @property Category $parent
 * @property Category[] $categories
 * @property SeoTool $seoTool
 * @property Image[] $images0
 * @property Post[] $posts
 * @property Product[] $products
 * @property Tab[] $tabs
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'page_id'], 'required'],
            [['describe', 'content', 'code', 'images'], 'string'],
            [['serial', 'parent_id', 'page_id', 'display_homepage', 'featured', 'status', 'seo_tool_id'], 'integer'],
            [['title', 'avatar', 'slug', 'key', 'link'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['seo_tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoTool::className(), 'targetAttribute' => ['seo_tool_id' => 'id']],
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
            'describe' => 'Describe',
            'serial' => 'Serial',
            'parent_id' => 'Parent ID',
            'content' => 'Content',
            'page_id' => 'Page ID',
            'display_homepage' => 'Display Homepage',
            'featured' => 'Featured',
            'status' => 'Status',
            'seo_tool_id' => 'Seo Tool ID',
            'slug' => 'Slug',
            'key' => 'Key',
            'code' => 'Code',
            'link' => 'Link',
            'images' => 'Images',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
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
    public function getImages0()
    {
        return $this->hasMany(Image::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(Tab::className(), ['category_id' => 'id']);
    }
}
