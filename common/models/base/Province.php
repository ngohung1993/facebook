<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property string $ten
 * @property string $ten_tieng_anh
 * @property string $cap
 * @property double $phi_van_chuyen
 *
 * @property Classifieds[] $classifieds
 * @property District[] $districts
 * @property Orders[] $orders
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten'], 'required'],
            [['phi_van_chuyen'], 'number'],
            [['ten', 'ten_tieng_anh', 'cap'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'ten' => Yii::t('backend', 'Ten'),
            'ten_tieng_anh' => Yii::t('backend', 'Ten Tieng Anh'),
            'cap' => Yii::t('backend', 'Cap'),
            'phi_van_chuyen' => Yii::t('backend', 'Phi Van Chuyen'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassifieds()
    {
        return $this->hasMany(Classifieds::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['province_id' => 'id']);
    }
}
