<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $status
 * @property int $meta_location_id
 *
 * @property MetaLocation $metaLocation
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['status', 'meta_location_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['meta_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => MetaLocation::className(), 'targetAttribute' => ['meta_location_id' => 'id']],
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
            'content' => Yii::t('backend', 'Content'),
            'status' => Yii::t('backend', 'Status'),
            'meta_location_id' => Yii::t('backend', 'Meta Location ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetaLocation()
    {
        return $this->hasOne(MetaLocation::className(), ['id' => 'meta_location_id']);
    }
}
