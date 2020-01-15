<?php

namespace frontend\controllers;

use common\models\File;
use common\models\Member;
use Yii;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

/**
 * Search controller
 */
class SearchController extends BaseController
{

    private $actions = ['scan-your-account', 'scan-comment-of-post', 'scan-emotion-of-post', 'scan-member-of-group', 'scan-friend-of-friend'];

    /**
     * @param $act
     * @param null $facebook
     * @param null $search
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($act, $facebook = null, $search = null, $file_id = null)
    {
        if (!in_array($act, $this->actions)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $file = File::findOne($file_id);

        if (!$file && $file_id) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $members = Member::find()->where(['file_id' => $file_id])->all();

        $data = '';
        foreach ($members as $value) {
            $data .= $value['uid'] . '|' . $value['name'] . "\n";
        }

        return $this->render($act, [
            'search' => $search,
            'facebook' => $facebook,
            'data' => $data,
            'members' => $members,
            'group' => $this->group,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }
}