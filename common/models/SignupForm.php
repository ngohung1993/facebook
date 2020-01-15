<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $avatar;
    public $permission;
    public $address;
    public $phone;
    public $password;
    public $re_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\base\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'unique', 'targetClass' => '\common\models\base\User', 'message' => 'This username has already been taken.'],
            ['email', 'string', 'min' => 2, 'max' => 255],

            [['first_name', 'last_name', 'phone', 'avatar'], 'trim'],
            [['last_name'], 'required'],
            [['first_name', 'last_name', 'phone', 'avatar'], 'string', 'max' => 255],

            ['address', 'trim'],
            ['address', 'string'],

            ['permission', 'integer'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['re_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user['phone'] = $this->phone;
        $user['first_name'] = $this->first_name;
        $user['last_name'] = $this->last_name;
        $user['avatar'] = $this->avatar;
        $user['permission'] = $this->permission;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('backend', 'First Name'),
            'last_name' => Yii::t('backend', 'Last Name'),
            'rank' => Yii::t('backend', 'Phone'),
            'price' => Yii::t('backend', 'Address'),
        ];
    }
}
