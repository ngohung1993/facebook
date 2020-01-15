<?php

namespace backend\controllers;

use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\helpers\FunctionHelper;
use common\models\Image;
use common\models\SeoTool;
use common\models\Category;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AdminController
{
    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = Category::find()
            ->joinWith('page')
            ->orderBy('category.serial ASC')->all();

        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $seo = new SeoTool();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $seo->save();
            $model->seo_tool_id = $seo->id;

            if ($model->parent_id == null) {
                $children = Category::find()->where(['is', 'parent_id', null])->all();
            } else {
                $children = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
            }

            $model->serial = count($children) + 1;

	        $model->save();

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);
        $images = Image::find()->where(['=', 'category_id', $id])->all();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            if ($model->parent_id == null) {
                $children = Category::find()->where(['is', 'parent_id', null])->all();
            } else {
                $children = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
            }

            $old = $model->getOldAttribute('parent_id');

            if ($old != $model->parent_id) {
                $model->serial = count($children) + 1;
            }

            foreach ($images as $key => $value) {
	            try {
		            $value->delete();
	            } catch ( StaleObjectException $e ) {
	            } catch ( \Throwable $e ) {
	            }
            }

            foreach (json_decode($model->images) as $key => $value) {
                $image = new Image();

                $image->avatar = $value;
                $image->category_id = $id;

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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->parent_id == null) {
            $children = Category::find()->where(['is', 'parent_id', null])->all();
        } else {
            $children = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
        }

        $serial_old = $model->serial;

        foreach ($children as $key => $value) {
            if ($value['id'] != $id && $value['serial'] > $serial_old) {
                $value['serial'] -= 1;

                $value->save(false);
            }
        }

	    try {
		    $model->delete();
	    } catch ( StaleObjectException $e ) {
	    } catch ( \Throwable $e ) {
	    }

	    return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
