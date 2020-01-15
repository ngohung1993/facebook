<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class InformationForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;

    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['first_name', 'last_name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update_information()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->getUser();
        $user->email = $this->email;
        $user['first_name'] = $this->first_name;
        $user['last_name'] = $this->last_name;
        $user['phone'] = $this->phone;

        return $user->save() ? $user : null;
    }
}
