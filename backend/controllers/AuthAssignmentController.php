<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use backend\controllers\base\SeniorController;
use common\models\AuthAssignment;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends SeniorController
{
    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AuthAssignment::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $assignment = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
            'assignment' => $assignment,
            'pages' => $pagination
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $assignment = new AuthAssignment();
        $ass = AuthAssignment::find()->all();

        if ($assignment->load(Yii::$app->request->post())) {
            foreach (explode(',', $assignment->list_permission) as $key => $value) {
                if (!$ass) {
                    $model = new AuthAssignment();
                    $model->item_name = $value;
                    $model->user_id = $assignment->user_id;
                    $model->created_at = $assignment->created_at;
                    $model->save();
                } else {
                    foreach ($ass as $k => $val) {
                        if ($val['user_id'] != $assignment->user_id && $val['item_name'] != $value) {
                            $model = new AuthAssignment();
                            $model->item_name = $value;
                            $model->user_id = $assignment->user_id;
                            $model->created_at = $assignment->created_at;
                            $model->save();
                        }
                    }
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $assignment,
        ]);
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
