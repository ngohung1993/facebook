<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property double $price
 * @property string $describe
 * @property int $leader
 * @property int $customer_id
 * @property string $content
 * @property string $duration
 * @property string $website_code
 * @property string $attachments
 * @property int $point
 * @property string $domain
 * @property string $folder
 * @property string $webmaster_account
 * @property string $webmaster_password
 * @property string $db_account
 * @property string $db_password
 * @property string $db_name
 * @property int $status
 *
 * @property Customer $customer
 * @property User $leader0
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['leader', 'customer_id', 'point', 'status'], 'integer'],
            [['content', 'attachments'], 'string'],
            [['duration'], 'safe'],
            [['title', 'describe', 'website_code', 'domain', 'folder', 'webmaster_account', 'webmaster_password', 'db_account', 'db_password', 'db_name'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['leader'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['leader' => 'id']],
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
            'price' => 'Price',
            'describe' => 'Describe',
            'leader' => 'Leader',
            'customer_id' => 'Customer ID',
            'content' => 'Content',
            'duration' => 'Duration',
            'website_code' => 'Website Code',
            'attachments' => 'Attachments',
            'point' => 'Point',
            'domain' => 'Domain',
            'folder' => 'Folder',
            'webmaster_account' => 'Webmaster Account',
            'webmaster_password' => 'Webmaster Password',
            'db_account' => 'Db Account',
            'db_password' => 'Db Password',
            'db_name' => 'Db Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeader0()
    {
        return $this->hasOne(User::className(), ['id' => 'leader']);
    }
}
