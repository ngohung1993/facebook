<?php

namespace backend\controllers;

use common\helpers\FunctionHelper;
use common\models\Category;
use common\models\SeoTool;
use common\models\Post;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use fproject\components\DbHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;
use backend\controllers\base\AdminController;
use common\models\Page;
use common\models\GeneralInformation;
use yii\web\UploadedFile;
/**
 * GeneralInformationController implements the CRUD actions for GeneralInformation model.
 */
class GeneralInformationController extends AdminController
{
    /**
     * Lists all GeneralInformation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $general = GeneralInformation::findOne(1);

		if ( $general->load( Yii::$app->request->post() ) ) {

            if($general->fileUpLoad = UploadedFile::getInstance($general, 'fileUpLoad')){
                if ($name = $general->upload()) {
                    $table = 'general_information';
                    $attributes = [
                        '0' => 'site_name',
                        '1' => 'home_page_header',
                        '2' => 'home_page_description',
                        '3' => 'email_notify',
                        '4' => 'address',
                        '5' => 'phone',
                        '6' => 'page_facebook',
                        '7' => 'video_intro',
                        '8' => 'google_analytics',
                        '9' => 'facebook_pixel',
                    ];
                    $file = '../..'.$name;
                    GeneralInformation::findOne(1)->delete();
                    FunctionHelper::import_data_excel_col($table, $attributes, $file);
                }

            }else{
                $general->save();
            }

			return $this->redirect( [ 'index' ] );
		}

		return $this->render( 'index', [
			'general' => $general
		] );
	}

    /**
     * @return \yii\web\Response
     */
    public function actionImportExamplePost()
    {

        $categories = FunctionHelper::get_categories_by_page_key('news-page');

        $seo_tool_id_max = SeoTool::find()->orderBy('id ASC')->one()['id'];

        $titles = $this->read_folder('title', 'html');
        $contents = $this->read_folder('content', 'html');
        $describes = $this->read_folder('describe', 'html');
        $images = $this->read_folder('image', 'jpg', false);

        $posts = [];
        $seo_tools = [];

        foreach ($categories as $key => $value) {

            shuffle($titles);
            shuffle($contents);
            shuffle($describes);

            for ($i = 0; $i < 5; $i++) {
                $post = [];

                $seo_tool = [];

                $seo_tool['id'] = ++$seo_tool_id_max;

                $post['title'] = $titles[$i];

                $post['slug'] = FunctionHelper::slug($post['title']) . '-' . time();

                $post['avatar'] = '/uploads/core/data/images/' . $images[$i];
                $post['content'] = $contents[$i];
                $post['describe'] = $describes[$i];
                $post['seo_tool_id'] = $seo_tool['id'];
                $post['category_id'] = $value['id'];
                $post['status'] = 1;
                $post['example'] = 1;
                $posts[] = $post;
                $seo_tools[] = $seo_tool;
            }
        }

        DbHelper::insertMultiple('seo_tool', $seo_tools);
        DbHelper::insertMultiple('post', $posts);

        return $this->redirect(['extension/simple-data']);
    }

    /**
     * @param $folder
     * @param $extension
     * @param bool $read
     * @return array
     */
    function read_folder($folder, $extension, $read = true)
    {

        $content = [];

        for ($i = 1; $i <= 5; $i++) {

            $file_name = '../../uploads/core/data/' . $folder . '/' . $i . '.' . $extension;

            if ($read) {
                $file = fopen($file_name, "r");

                $content[] = fread($file, filesize($file_name));
                fclose($file);

            } else {
                $content[] = $i . '.' . $extension;
            }
        }

        return $content;

    }

    public function actionImportExampleCategory()
    {
        $table = 'category';

        $attributes = [
            'A' => 'serial',
            'B' => 'title'
        ];

        $file = '../../uploads/core/excel/data-example.xlsx';
        $start = 2;
        $end = 11;

        $inputFileName = $file;

        $pages = ArrayHelper::map(Page::find()->all(), 'title', 'id');

        if (!file_exists($inputFileName)) {
            throw new BadRequestHttpException('File doesn\'t exists.');
        }

        $inputFileName = $file;

        $spreadsheet = IOFactory::load($inputFileName);

        $sheetData = $spreadsheet->getSheetByName('category')->toArray(null, true, true, true);

        $data = [];
        foreach ($sheetData as $key => $value) {

            if ($key >= $start && $key <= $end) {
                $row = [];

                $row['id'] = $key - 1;

                foreach ($attributes as $key_att => $value_att) {
                    $row[$value_att] = $value[$key_att];
                }

                $row['page_id'] = $pages[$value['C']];
                $row['parent_id'] = $value['D'];
                $row['status'] = 1;
                $row['example'] = 1;
                $data[] = $row;
            }
        }
        DbHelper::insertMultiple($table, $data);

        return $this->redirect(['extension/simple-data']);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionDeleteExampleCategory(){
        $categories = Category::find()->where(['=','example',1])->all();
        if($categories){
            foreach ($categories as $key =>$value){
                $value->delete();
            }
            return $this->redirect(['extension/simple-data']);
        }
        return $this->redirect(['extension/simple-data']);
    }
    /**
     * @return \yii\web\Response
     */
    public function actionDeleteExamplePost(){
        $posts = Post::find()->where(['=','example',1])->all();
        if($posts){
            foreach ($posts as $key =>$value){
                $value->delete();
            }
            return $this->redirect(['extension/simple-data']);
        }
        return $this->redirect(['extension/simple-data']);
    }

    function addPost()
    {
        $table = 'post';

        $attributes = [
            'A' => 'serial',
            'B' => 'title',
            'C' => 'category_id',
            'D' => 'content',
            'E' => 'avatar'
        ];

        $file = '../../uploads/core/excel/data-example.xlsx';
        $start = 2;
        $end = 21;

        $inputFileName = $file;

        if (!file_exists($inputFileName)) {
            throw new BadRequestHttpException('File doesn\'t exists.');
        }

        $inputFileName = $file;

        $spreadsheet = IOFactory::load($inputFileName);

        $sheetData = $spreadsheet->getSheetByName('post')->toArray(null, true, true, true);
        $data = [];
        foreach ($sheetData as $key => $value) {

            if ($key >= $start && $key <= $end) {
                $row = [];

                //$row['id'] = $key - 1;

                foreach ($attributes as $key_att => $value_att) {
                    $row[$value_att] = $value[$key_att];
                }

                $row['status'] = 1;
                $data[] = $row;
            }
        }
        DbHelper::insertMultiple($table, $data);

        return $this->redirect(['site/index']);
    }


    function addImage()
    {
        $table = 'image';

        $attributes = [
            'A' => 'title',
            'B' => 'post_id',
            'C' => 'content',
            'D' => 'avatar'
        ];

        $file = '../../uploads/core/excel/data-example.xlsx';
        $start = 2;
        $end = 5;

        $inputFileName = $file;

        if (!file_exists($inputFileName)) {
            throw new BadRequestHttpException('File doesn\'t exists.');
        }

        $inputFileName = $file;

        $spreadsheet = IOFactory::load($inputFileName);

        $sheetData = $spreadsheet->getSheetByName('image')->toArray(null, true, true, true);
        $data = [];
        foreach ($sheetData as $key => $value) {

            if ($key >= $start && $key <= $end) {
                $row = [];

                //$row['id'] = $key - 1;

                foreach ($attributes as $key_att => $value_att) {
                    $row[$value_att] = $value[$key_att];
                }

                $row['status'] = 1;
                $data[] = $row;
            }
        }
        DbHelper::insertMultiple($table, $data);

        return $this->redirect(['site/index']);
    }


    function addSetting()
    {
        $table = 'setting';

        $attributes = [
            'A' => 'title',
            'B' => 'describe',
            'C' => 'key'
        ];

        $file = '../../uploads/core/excel/data-example.xlsx';
        $start = 2;
        $end = 3;

        $inputFileName = $file;

        if (!file_exists($inputFileName)) {
            throw new BadRequestHttpException('File doesn\'t exists.');
        }

        $inputFileName = $file;

        $spreadsheet = IOFactory::load($inputFileName);

        $sheetData = $spreadsheet->getSheetByName('setting')->toArray(null, true, true, true);
        $data = [];
        foreach ($sheetData as $key => $value) {

            if ($key >= $start && $key <= $end) {
                $row = [];

                //$row['id'] = $key - 1;

                foreach ($attributes as $key_att => $value_att) {
                    $row[$value_att] = $value[$key_att];
                }

                $row['status'] = 1;
                $data[] = $row;
            }
        }
        DbHelper::insertMultiple($table, $data);

        return $this->redirect(['site/index']);
    }


    /**
     * Finds the GeneralInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return GeneralInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeneralInformation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
