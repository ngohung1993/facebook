<?php

namespace common\models;

use common\models\base;

class AuthItem extends base\AuthItem
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
