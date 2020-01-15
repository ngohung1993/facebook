<?php

namespace backend\controllers;

use common\helpers\FunctionHelper;
use common\models\Image;
use common\models\User;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use backend\controllers\base\MiddleController;
use common\models\Setting;
use common\models\Tab;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends MiddleController
{
    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Setting::find();

        $render = 'index-senior';

        if ($this->user['permission'] != User::ROLE_SENIOR) {
            $query->where(['>', 'released', 0]);
            $render = 'index';
        }

        $settings = $query->all();

        return $this->render($render, [
            'settings' => $settings,
            'user' => $this->user
        ]);
    }

    /**
     * Displays a single Setting model.
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
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $images = Image::find()->where(['=', 'setting_id', $id])->all();
        $tabs = Tab::find()->where(['=', 'setting_id', $id])->all();
        if ($model->load(Yii::$app->request->post())) {

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            foreach ($images as $key => $value) {
                $value->delete();
            }
            if ($model->images) {
                foreach (json_decode($model->images) as $key => $value) {
                    $image = new Image();

                    $image->avatar = $value;
                    $image->setting_id = $model->id;

                    $image->save();
                }
            }


            if ($model->tab_setting) {
                foreach (json_decode($model->tab_setting) as $key => $value) {
                    if ($value->id) {
                        $tab_older = Tab::findOne($value->id);
                        $tab_older->title = $value->title;
                        $tab_older->content = $value->content;
                        $tab_older->slug = FunctionHelper::slug($tab_older->title) . '=' . $tab_older->id;
                        foreach ($value->images as $key_img => $value_img) {
                            if ($key_img == 0) {
                                $tab_older->avatar = $value_img->url;
                            }
                            if (!$value_img->id) {
                                $image = new Image();
                                $image->avatar = $value_img->url;
                                $image->tab_id = $tab_older->id;
                                $image->save();
                            }
                        }
                        $tab_older->save();
                    } else {
                        $tab = new Tab();
                        $tab->title = $value->title;
                        $tab->content = $value->content;
                        $tab->setting_id = $model->id;
                        $tab->save();
                        $tab->slug = FunctionHelper::slug($tab->title) . '=' . $tab->id;
                        foreach ($value->images as $key_img => $value_img) {
                            if ($key_img == 0) {
                                $tab->avatar = $value_img->url;
                            }

                            $image = new Image();
                            $image->avatar = $value_img->url;
                            $image->tab_id = $tab->id;
                            $image->save();
                        }
                        $tab->save();
                    }


                }
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        $render = 'update-senior';

        if ($this->user['permission'] != User::ROLE_SENIOR) {
            $render = 'update';
        }

        return $this->render($render, [
            'model' => $model,
            'images' => $images,
            'tabs' => $tabs
        ]);
    }

	/**
	 * Deletes an existing Setting model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete( $id ) {
		try {
			$this->findModel( $id )->delete();
		} catch ( StaleObjectException $e ) {
		} catch ( NotFoundHttpException $e ) {
		} catch ( \Throwable $e ) {
		}

		return $this->redirect( [ 'index' ] );
	}

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
