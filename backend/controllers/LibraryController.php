<?php

namespace backend\controllers;

use backend\controllers\base\AdminController;

/**
 * LibraryController implements the CRUD actions for GeneralInformation model.
 */
class LibraryController extends AdminController {
	/**
	 * Library.
	 * @return mixed
	 */
	public function actionIndex() {
		return $this->render( 'index' );
	}
}
