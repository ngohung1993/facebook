<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "general_information".
 *
 * @property int $id
 * @property string $site_name
 * @property string $logo
 * @property string $favicon
 * @property string $home_page_header
 * @property string $home_page_description
 * @property string $email_notify
 * @property string $address
 * @property string $phone
 * @property string $page_facebook
 * @property string $video_intro
 * @property string $google_analytics
 * @property string $facebook_pixel
 * @property int $status
 */
class GeneralInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['home_page_description', 'address', 'page_facebook', 'video_intro', 'google_analytics', 'facebook_pixel'], 'string'],
            [['status'], 'integer'],
            [['site_name', 'logo', 'favicon', 'home_page_header', 'email_notify', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_name' => 'Site Name',
            'logo' => 'Logo',
            'favicon' => 'Favicon',
            'home_page_header' => 'Home Page Header',
            'home_page_description' => 'Home Page Description',
            'email_notify' => 'Email Notify',
            'address' => 'Address',
            'phone' => 'Phone',
            'page_facebook' => 'Page Facebook',
            'video_intro' => 'Video Intro',
            'google_analytics' => 'Google Analytics',
            'facebook_pixel' => 'Facebook Pixel',
            'status' => 'Status',
        ];
    }
}
