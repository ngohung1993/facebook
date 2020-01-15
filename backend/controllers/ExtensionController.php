<?php

namespace backend\controllers;

use backend\controllers\base\AdminController;
use MatthiasMullie\Minify;

/**
 * ExtensionController implements the CRUD actions for GeneralInformation model.
 */
class ExtensionController extends AdminController {

	/**
	 * Library.
	 * @return mixed
	 */
	public function actionIndex() {
		return $this->render( 'index' );
	}

	/**
	 * @return string
	 */
	public function actionSimpleData() {
		return $this->render( 'simple-data' );
	}

	/**
	 * @return string
	 */
	public function actionZip() {

		$root_path = '../../uploads/theme';

		$files = $this->scan_folder( $root_path );

		$finish = [];

		foreach ( $files as $key => $value ) {

			switch ( pathinfo( $value, PATHINFO_EXTENSION ) ) {
				case 'css':
					$mini = new Minify\CSS( $value );
					$mini->minify( $value );

					$finish[] = str_replace( '../..', '', $value );

					break;
				case 'js':
					$mini = new Minify\JS( $value );
					$mini->minify( $value );

					$finish[] = str_replace( '../..', '', $value );

					break;
				default:
			}
		}

		$this->zip( $root_path );

		return $this->render( 'zip', [
			'finish' => $finish
		] );
	}

	/**
	 * @param $root_path
	 */
	private function zip( $root_path ) {
		$folders = scandir( $root_path );

		foreach ( $folders as $key => $value ) {
			if ( $value != '.' && $value != '..' ) {
				switch ( $folders ) {
					case 'css':
						$source_path = $root_path . '/' . $folders . '/' . $value;
						$mini        = new Minify\CSS( $source_path );

						$mini->minify( $source_path );

					case 'js':
					default:
				}
			}
		}
	}

	/**
	 * @param string $path
	 * @param array $name
	 *
	 * @return array
	 */
	private function scan_folder( $path = '', &$name = array() ) {
		$path  = $path == '' ? dirname( __FILE__ ) : $path;
		$lists = @scandir( $path );

		if ( ! empty( $lists ) ) {
			foreach ( $lists as $f ) {

				if ( is_dir( $path . '/' . $f ) && $f != ".." && $f != "." ) {
					$this->scan_folder( $path . '/' . $f, $name );
				} else {
					if ( $f != ".." && $f != "." ) {
						$name[] = $path . '/' . $f;
					}
				}
			}
		}

		return $name;
	}
}