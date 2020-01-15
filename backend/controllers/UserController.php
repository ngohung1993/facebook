<?php

namespace backend\controllers;

use common\models\AuthAssignment;
use Yii;
use yii\web\NotFoundHttpException;
use backend\controllers\base\SeniorController;
use common\models\SignupForm;
use common\models\User;

class UserController extends SeniorController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $users = User::find()->all();

        return $this->render('index', [
            'users' => $users
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $auth_assignment = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $auth_assignment->load(Yii::$app->request->post()) && $user = $model->signup()) {

            foreach (json_decode($auth_assignment->list_permission) as $key => $value) {
                $new_auth_assignment = new AuthAssignment();
                $new_auth_assignment->item_name = $value;
                $new_auth_assignment->user_id = $user->id;
                $new_auth_assignment->save();
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'auth_assignment' => $auth_assignment
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new SignupForm();

        $user = $this->findModel($id);

        $model->first_name = $user['first_name'];
        $model->last_name = $user['last_name'];
        $model->phone = $user['phone'];
        $model->address = $user['address'];

        $model->username = $user['username'];
        $model->email = $user['email'];

        $auth_assignment = new AuthAssignment();
        $auth_assignment_old = AuthAssignment::find()->where(['=', 'user_id', $id])->all();

        $temp = [];
        foreach ($auth_assignment_old as $key => $value) {
            $temp[] = $value['item_name'];
        }

        $auth_assignment->list_permission = json_encode($temp);

        if ($model->load(Yii::$app->request->post()) && $auth_assignment->load(Yii::$app->request->post())) {

            $user['first_name'] = $model->first_name;
            $user['last_name'] = $model->last_name;
            $user['phone'] = $model->phone;
            $user['address'] = $model->address;

            $user->save();

            foreach ($auth_assignment_old as $key => $value) {
                $value->delete();
            }

            $list_permission = json_decode($auth_assignment->list_permission);

            if ($list_permission) {
                foreach ($list_permission as $key => $value) {
                    $new_auth_assignment = new AuthAssignment();
                    $new_auth_assignment->item_name = $value;
                    $new_auth_assignment->user_id = $id;
                    $new_auth_assignment->save();
                }
            }

            $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'auth_assignment' => $auth_assignment
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
