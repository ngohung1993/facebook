<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\models\Image;
use common\models\PhotoLocation;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends AdminController
{
    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $locations = PhotoLocation::find()->where(['released' => 1])->all();
        $user = 'vanthoa225@gmail.com';
        $pass = 'Linhtinh225@';

//		$secretkey = '62f8ce9f74b12f84c123cc23437a4a32';
//		$api_key   = '882a8490361da98702bf97a021ddc14d';

        $secretkey = 'c1e620fa708a1d5696fb991c1bde5662';
        $api_key = '3e7c78e35a76a9299309885393b02d97';

        function tao_sig($postdata, $secretkey)
        {
            $textsig = "";
            foreach ($postdata as $key => $value) {
                $textsig .= "$key=$value";
            }
            $textsig .= $secretkey;
            $textsig = md5($textsig);

            return $textsig;
        }

        function getpage($url, $postdata = '')
        {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $url);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0');

            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);

            $page = curl_exec($c);
            curl_close($c);

            return $page;
        }

        $postdata = array(
            "api_key" => $api_key,
            "email" => $user,
            "format" => "JSON",
            "locale" => "vi_vn",
            "method" => "auth.login",
            "password" => $pass,
            "return_ssl_resources" => "0",
            "v" => "1.0"
        );

        $postdata['sig'] = tao_sig($postdata, $secretkey);

        http_build_query($postdata);

        $data = getpage("https://api.facebook.com/restserver.php", $postdata);

        var_dump($data);
        die;
        return $this->render('index', [
            'locations' => $locations
        ]);
    }

    /**
     * Displays a single Image model.
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
     * @throws NotFoundHttpException
     */
    public function actionCreate($id)
    {
        $location = PhotoLocation::findOne($id);
        if (!$location) {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }

        $images = Image::find()->where(['=', 'photo_location_id', $id])->all();

        return $this->render('create', [
            'images' => $images,
            'location' => $location
        ]);
    }

    /**
     * Updates an existing Image model.
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
     * Deletes an existing Image model.
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
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
