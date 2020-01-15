<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\models\Province;
use common\helpers\FunctionHelper;
use common\models\District;

/**
 * ProvinceController implements the CRUD actions for Province model.
 */
class ProvinceController extends AdminController
{
    /**
     * Lists all Province models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->import();

        $province = Province::find()->all();
        return $this->render('index', [
            'province' => $province
        ]);
    }

    protected function import()
    {

        if (!Province::find()->asArray()->all()) {
            $table = 'province';

            $attributes = [
                'A' => 'id',
                'B' => 'ten',
                'C' => 'ten_tieng_anh',
                'D' => 'cap'
            ];

            $file = '../../uploads/core/excel/tinh.xlsx';

            $start = 2;
            $end = 64;

            FunctionHelper::import_data_excel($table, $attributes, $file, $start, $end);
        }

        if (!District::find()->asArray()->all()) {
            $table = 'district';
            $attributes = [
                'A' => 'id',
                'B' => 'ten',
                'C' => 'ten_tieng_anh',
                'D' => 'cap',
                'E' => 'province_id'
            ];

            $file = '../../uploads/core/excel/huyen.xlsx';

            $start = 2;
            $end = 714;

            FunctionHelper::import_data_excel($table, $attributes, $file, $start, $end);
        }
    }

    /**
     * Displays a single Province model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Province model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Province();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Province model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Province model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Province model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Province the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Province::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
