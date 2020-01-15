<?php

namespace frontend\controllers;

use common\models\File;
use common\models\Member;
use Yii;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

/**
 * Facebook controller
 */
class FacebookController extends BaseController
{
    private $actions = ['add-friend', 'filter-friend', 'request-friend', 'shield-avatar', 'uid-friend', 'un-friend'];

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'user' => $this->user,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }

    /**
     * @param null $ct
     * @param null $file_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($ct = null, $file_id = null)
    {

        if (!in_array($ct, $this->actions)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $file = File::findOne($file_id);

        if (!$file && $file_id) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $members = Member::find()->where(['file_id' => $file_id])->all();

        $data = '';
        foreach ($members as $key => $value) {
            $data .= $value['uid'] . '|' . $value['name'] . ($key == count($members)-1 ? '' : "\n");
        }

        return $this->render($ct, [
            'data' => $data,
            'members' => $members,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }
}