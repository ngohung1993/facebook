<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "category_classified".
 *
 * @property int $id
 * @property string $title
 *
 * @property Classified[] $classifieds
 * @property SubWebsite[] $subWebsites
 */
class CategoryClassified extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_classified';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classified::className(), ['category_classified_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubWebsites()
    {
        return $this->hasMany(SubWebsite::className(), ['category_classified_id' => 'id']);
    }
}
