<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "website".
 *
 * @property int $id
 * @property string $path
 * @property string $path_example
 * @property string $path_classified
 * @property string $extension
 * @property string $title
 * @property string $content
 * @property string $price
 * @property string $full_name
 * @property string $created_at
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $district
 * @property string $category_classified
 * @property string $paging
 * @property int $status
 * @property int $exported
 *
 * @property Classified[] $classifieds
 * @property SubWebsite[] $subWebsites
 */
class Website extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'website';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['status', 'exported'], 'integer'],
            [['path', 'path_example', 'path_classified', 'extension', 'title', 'content', 'price', 'full_name', 'created_at', 'address', 'phone', 'email', 'district', 'category_classified', 'paging'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'path_example' => 'Path Example',
            'path_classified' => 'Path Classified',
            'extension' => 'Extension',
            'title' => 'Title',
            'content' => 'Content',
            'price' => 'Price',
            'full_name' => 'Full Name',
            'created_at' => 'Created At',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'district' => 'District',
            'category_classified' => 'Category Classified',
            'paging' => 'Paging',
            'status' => 'Status',
            'exported' => 'Exported',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classified::className(), ['website_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubWebsites()
    {
        return $this->hasMany(SubWebsite::className(), ['website_id' => 'id']);
    }
}
