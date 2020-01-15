<?php

namespace backend\controllers;

use common\helpers\FunctionHelper;
use common\models\Album;
use common\models\Image;
use common\models\SeoTool;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\models\Product;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AdminController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Product::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $products = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')->all();

        return $this->render('index', [
            'products' => $products,
            'pages' => $pagination
        ]);
    }

    /**
     * Displays a single Product model.
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
     * @param $id
     * @return string
     */
    public function actionAlbum($id)
    {
        $model = $this->findModel($id);
        $album = new Album();
        $albums = Album::find()->joinWith('images')
            ->where(['=', 'album.product_id', $id])->all();

        if ($album->load(Yii::$app->request->post()) && $album->save()) {
            $this->refresh();
        }

        return $this->render('album', [
            'model' => $model,
            'album' => $album,
            'albums' => $albums
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $seo = new SeoTool();

        if ($model->load(Yii::$app->request->post())) {
            $seo->save();
            $model->seo_tool_id = $seo->id;
            $model->user_id = $this->user->id;
            $model->save();

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            foreach (json_decode($model->images) as $key => $value) {
                $image = new Image();

                if ($key == 0) {
                    $model->avatar = $value;
                }

                $image->avatar = $value;
                $image->product_id = $model->id;

                $image->save();
            }

            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);
        $images = Image::find()->where(['=', 'product_id', $id])->all();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            foreach ($images as $key => $value) {
                $value->delete();
            }

            foreach (json_decode($model->images) as $key => $value) {
                $image = new Image();

                if ($key == 0) {
                    $model->avatar = $value;
                }

                $image->avatar = $value;
                $image->product_id = $model->id;

                $image->save();
            }

            $seo->save();
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
            'images' => $images
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
