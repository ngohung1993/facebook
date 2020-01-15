<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $sub_photo
 * @property int $photo_location_id
 * @property int $serial
 * @property string $link
 * @property string $describe
 * @property int $featured
 * @property string $content
 * @property int $post_id
 * @property int $album_id
 * @property int $category_id
 * @property int $product_id
 * @property int $classified_id
 * @property int $setting_id
 * @property int $tab_id
 * @property int $status
 * @property string $code
 *
 * @property Album $album
 * @property Category $category
 * @property Classified $classified
 * @property PhotoLocation $photoLocation
 * @property Post $post
 * @property Product $product
 * @property Setting $setting
 * @property Tab $tab
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar'], 'required'],
            [['photo_location_id', 'serial', 'featured', 'post_id', 'album_id', 'category_id', 'product_id', 'classified_id', 'setting_id', 'tab_id', 'status'], 'integer'],
            [['describe', 'content', 'code'], 'string'],
            [['title', 'avatar', 'sub_photo', 'link'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['classified_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classified::className(), 'targetAttribute' => ['classified_id' => 'id']],
            [['photo_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoLocation::className(), 'targetAttribute' => ['photo_location_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Setting::className(), 'targetAttribute' => ['setting_id' => 'id']],
            [['tab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tab::className(), 'targetAttribute' => ['tab_id' => 'id']],
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
            'sub_photo' => 'Sub Photo',
            'photo_location_id' => 'Photo Location ID',
            'serial' => 'Serial',
            'link' => 'Link',
            'describe' => 'Describe',
            'featured' => 'Featured',
            'content' => 'Content',
            'post_id' => 'Post ID',
            'album_id' => 'Album ID',
            'category_id' => 'Category ID',
            'product_id' => 'Product ID',
            'classified_id' => 'Classified ID',
            'setting_id' => 'Setting ID',
            'tab_id' => 'Tab ID',
            'status' => 'Status',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
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
    public function getPhotoLocation()
    {
        return $this->hasOne(PhotoLocation::className(), ['id' => 'photo_location_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTab()
    {
        return $this->hasOne(Tab::className(), ['id' => 'tab_id']);
    }
}
