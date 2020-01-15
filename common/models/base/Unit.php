<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 *
 * @property Classifieds[] $classifieds
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
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
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classifieds::className(), ['unit_id' => 'id']);
    }
}
