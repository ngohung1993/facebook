<?php

namespace frontend\controllers;

use common\models\Member;
use Yii;
use yii\web\NotFoundHttpException;
use common\models\File;
use common\models\Group;
use frontend\controllers\base\BaseController;

/**
 * Message controller
 */
class MessageController extends BaseController
{
    /**
     * @param $file_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($file_id = null)
    {

        $file = File::findOne($file_id);

        if (!$file) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $members = Member::find()->where(['file_id' => $file_id])->all();

        $data = '';
        foreach ($members as $value) {
            $data .= $value['uid'] . '|' . $value['name'] . "\n";
        }

        return $this->render('index', [
            'data' => $data,
            'members' => $members,
            'facebook_accounts' => $this->facebook_accounts
        ]);
    }

    /**
     * @param null $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGroup($id = null)
    {
        if ($id) {
            $group = Group::find()->where(['user_id' => $this->user->id])->andWhere(['id' => $id])->one();

            if (!$group) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }

            $files = File::find()->joinWith('members')->where(['group_id' => $id])->all();

            return $this->render('group-detail', [
                'group' => $group,
                'files' => $files,
                'user' => $this->user
            ]);
        }

        $groups = Group::find()->where(['user_id' => $this->user->id])->all();

        return $this->render('group', [
            'groups' => $groups,
            'user' => $this->user
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteGroup($id)
    {
        $group = Group::find()->where(['user_id' => $this->user->id])->andWhere(['id' => $id])->one();

        if (!$group) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $group->delete();

        return $this->redirect(['group']);

    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFile($id)
    {
        $file = File::findOne($id);

        if (!$file) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $members = Member::find()->where(['=', 'file_id', $id])->all();

        return $this->render('file', [
            'file' => $file,
            'members' => $members,
            'user' => $this->user
        ]);
    }
}
