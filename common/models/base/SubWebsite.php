<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "sub_website".
 *
 * @property int $id
 * @property int $website_id
 * @property string $path
 * @property int $category_classified_id
 *
 * @property Classified[] $classifieds
 * @property CategoryClassified $categoryClassified
 * @property Website $website
 */
class SubWebsite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_website';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['website_id', 'path', 'category_classified_id'], 'required'],
            [['website_id', 'category_classified_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['category_classified_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryClassified::className(), 'targetAttribute' => ['category_classified_id' => 'id']],
            [['website_id'], 'exist', 'skipOnError' => true, 'targetClass' => Website::className(), 'targetAttribute' => ['website_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'website_id' => 'Website ID',
            'path' => 'Path',
            'category_classified_id' => 'Category Classified ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classified::className(), ['sub_website_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryClassified()
    {
        return $this->hasOne(CategoryClassified::className(), ['id' => 'category_classified_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebsite()
    {
        return $this->hasOne(Website::className(), ['id' => 'website_id']);
    }
}
