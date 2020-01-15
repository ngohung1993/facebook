<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\LoginForm;
use common\models\SignupForm;

/**
 * Site controller
 */
class SiteController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'index', 'logout', 'signup' ],
				'rules' => [
					[
						'actions' => [ 'signup' ],
						'allow'   => true,
						'roles'   => [ '?' ],
					],
					[
						'actions' => [ 'index', 'logout', 'profile' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					]
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {

		return $this->render( 'index' );
	}

	/**
	 *
	 * @throws NotFoundHttpException
	 */
	public function actionProfile() {
		$model = new SignupForm();

		$user = null;

		if ( ! Yii::$app->user->isGuest ) {
			$user = $this->findModel( Yii::$app->user->identity->getId() );
		}

		$model->first_name = $user['first_name'];
		$model->last_name  = $user['last_name'];
		$model->phone      = $user['phone'];
		$model->address    = $user['address'];

		$model->username = $user['username'];
		$model->email    = $user['email'];

		if ( $model->load( Yii::$app->request->post() ) ) {

			$user['first_name'] = $model->first_name;
			$user['last_name']  = $model->last_name;
			$user['phone']      = $model->phone;
			$user['address']    = $model->address;

			$user->save();

			$this->refresh();
		}

		return $this->render( 'profile', [
			'model' => $model,
			'user'  => $user
		] );
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		$this->layout = 'account';
		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ( $model->load( Yii::$app->request->post() ) && $model->login() ) {
			return $this->goBack();
		} else {
			return $this->render( 'login', [
				'model' => $model,
			] );
		}
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
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
	private function findModel( $id ) {
		if ( ( $model = User::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist . ' );
		}
	}
}
