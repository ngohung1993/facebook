<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\LoginForm;
use common\helpers\ClientHelper;
use frontend\models\SignupForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $user = null;

        if (Yii::$app->user->isGuest) {
            $this->layout = 'site';
        } else {
            $user = $this->findModel(Yii::$app->user->identity->getId());
        }

        return $this->render('index', [
            'user' => $user
        ]);
    }

    /**
     * @param null $code
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionLogin($code = null)
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $client = new Client();

        $header = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $post_data = array(
            'api_key' => ClientHelper::$config['client_id'],
            'code' => $code
        );

        $body = http_build_query([
            'client_id' => ClientHelper::$config['client_id'],
            'sig' => $this->generate_sig($post_data, ClientHelper::$config['client_secret']),
            'code' => $code
        ]);

        $response = $client->post(ClientHelper::$config['url_user_info_server'], $body, $header)->send();

        if ($response->isOk) {
            $user = User::findByUsername($response->data['username']);

            if (!$user) {
                $model = new SignupForm();

                $model->username = $response->data['username'];
                $model->email = $response->data['username'];
                $model->password = 'Thangngo@123';

                $user = $model->signup();
            }

            if ($user) {

                $user['avatar'] = $response->data['avatar'];
                $user['last_name'] = $response->data['name'];

                $user->save();

                $model = new LoginForm();

                $model->username = $response->data['username'];
                $model->password = 'Thangngo@123';

                if ($model->login()) {
                    return $this->redirect(['site/index']);
                }
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render('login');

    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    /**
     * @param $post_data
     * @param $secret_key
     *
     * @return string
     */
    private function generate_sig($post_data, $secret_key)
    {
        $text_sig = '';
        foreach ($post_data as $key => $value) {
            $text_sig .= '$key=$value';
        }

        $text_sig .= $secret_key;
        $text_sig = md5($text_sig);

        return $text_sig;
    }
}