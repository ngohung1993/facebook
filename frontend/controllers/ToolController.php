<?php

namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

/**
 * Tool controller
 */
class ToolController extends BaseController
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
    public function actionIndex($act, $facebook = null, $search = null)
    {
        if (!in_array($act, $this->actions)) {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render($act, [
            'search' => $search,
            'facebook' => $facebook,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }

    /**
     * @param null $uid
     *
     * @return string
     */
    public function actionGetUidGroup($uid = null)
    {

        return $this->render('get-uid-group', [
            'uid' => $uid,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }

    /**
     * @return string
     */
    public function actionGetAllUidGroup()
    {
        return $this->render('get-all-uid-group', [
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }

    public function actionGetAllUidPost()
    {
        return $this->render('get-all-uid-post');
    }

    public function actionGetCommentPost()
    {
        return $this->render('get-comment-post');
    }

    public function actionGetUidShare()
    {
        return $this->render('get-uid-share');
    }

    public function actionGetUidSubscribers()
    {
        return $this->render('get-uid-subscribers');
    }

    public function actionGetUidReactions()
    {
        return $this->render('get-uid-reactions');
    }

    public function actionGetUidFriends()
    {
        return $this->render('get-uid-friends');
    }
}