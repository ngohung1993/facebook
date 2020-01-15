<?php
namespace common\models;

use common\models\base;

class User extends base\User
{
    const ROLE_SENIOR = 1;
    const ROLE_ADMIN = 2;
    const ROLE_STAFF = 3;
    const ROLE_USER = 4;
}
