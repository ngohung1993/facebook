<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $title
 * @property string $describe
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $skype
 * @property string $yahoo
 * @property string $company
 * @property string $address
 * @property string $content
 * @property string $status
 * @property string $created_at
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'full_name', 'phone'], 'required'],
            [['describe', 'content', 'status'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'full_name', 'phone', 'email', 'skype', 'yahoo', 'company', 'address'], 'string', 'max' => 255],
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
            'describe' => 'Describe',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'skype' => 'Skype',
            'yahoo' => 'Yahoo',
            'company' => 'Company',
            'address' => 'Address',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
