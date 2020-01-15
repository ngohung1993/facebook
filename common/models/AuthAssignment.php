<?php

namespace common\models;

use common\models\base;

class AuthAssignment extends base\AuthAssignment
{
    public $list_permission;

    /**
     * @return array
     *
     */
    public function rules()
    {

        return array_merge(parent::rules(), [[['list_permission'], 'string']]);
    }
}
