<?php

namespace backend\controllers;

use common\helpers\FunctionHelper;
use common\models\Image;
use common\models\SeoTool;
use Yii;
use common\models\Classified;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClassifiedController implements the CRUD actions for Classified model.
 */
class ClassifiedController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Classified models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Classified::find();

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $query->count(),
        ]);

        $classifieds = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')->all();

        return $this->render('index', [
            'classifieds' => $classifieds,
            'pages' => $pagination
        ]);
    }

    /**
     * Displays a single Classified model.
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
     * Creates a new Classified model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Classified();
        $seo = new SeoTool();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $seo->save();

            $model->seo_tool_id = $seo->id;

            if ($model->save()) {
                foreach (json_decode($model->images) as $key => $value) {
                    if ($key == 0) {
                        $model->avatar = $value;
                    }

                    $image = new Image();
                    $image->avatar = $value;
                    $image->classified_id = $model->id;
                    $image->save();
                }

                $model->slug = FunctionHelper::slug($model->title) . '=' . $model->id;
                $model->save();

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo
        ]);
    }

    /**
     * Updates an existing Classified model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);
        $images = Image::find()->where(['=', 'Classified_id', $id])->all();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $model->slug = FunctionHelper::slug($model->title) . '=' . $model->id;

            foreach ($images as $key => $value) {
                $value->delete();
            }

            foreach (json_decode($model->images) as $key => $value) {
                if ($key == 0) {
                    $model->avatar = $value;
                    break;
                }
            }

            $seo->save();

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
            'images' => $images
        ]);
    }

    /**
     * Deletes an existing Classified model.
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
     * Finds the Classified model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classified the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classified::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
