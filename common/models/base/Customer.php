<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $full_name
 * @property string $avatar
 * @property string $email
 * @property int $gender
 * @property string $phone
 * @property string $address
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone'], 'required'],
            [['gender'], 'integer'],
            [['address'], 'string'],
            [['full_name', 'avatar', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'avatar' => 'Avatar',
            'email' => 'Email',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }
}
