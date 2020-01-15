<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "ad_type".
 *
 * @property int $id
 * @property string $title
 * @property int $rank
 * @property double $price
 *
 * @property Classified[] $classifieds
 */
class AdType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank'], 'integer'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'rank' => Yii::t('backend', 'Rank'),
            'price' => Yii::t('backend', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classified::className(), ['ad_type_id' => 'id']);
    }
}
