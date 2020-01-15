<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 2/2/2018
 * Time: 6:02 PM
 */

namespace frontend\controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Yii;
use yii\web\Response;
use common\models\File;
use common\models\Group;
use common\models\Member;
use fproject\components\DbHelper;
use frontend\controllers\base\BaseController;

/**
 * AjaxController
 */
class AjaxController extends BaseController
{
    /**
     * @param $action
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionMember($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $members = Member::find()->where(['file_id' => $id])->asArray()->all();

        return $members;
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function actionSaveFile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if ($post['title'] && $post['group_id'] && $post['data']) {

            $file = new File();
            $file->group_id = $post['group_id'];
            $file->title = $post['title'];
            $file->created_at = date('Y-m-d H:i:s', time() + 7 * 3600);

            if ($file->save()) {
                $data = json_decode($post['data']);

                $rows = [];
                if ($data) {
                    foreach ($data as $key => $value) {
                        $row = [];
                        $row['uid'] = $value[0];
                        $row['name'] = $value[1];
                        $row['file_id'] = $file->id;

                        $rows[] = $row;
                    }

                    return DbHelper::insertMultiple('member', $rows);
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function actionAddMember()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if ($post['file_id'] && $post['data']) {

            $file = File::findOne($post['file_id']);

            if ($file) {
                $data = json_decode($post['data']);

                $rows = [];
                if ($data) {
                    foreach ($data as $key => $value) {
                        $row = [];
                        $row['uid'] = $value[0];
                        $row['name'] = $value[1];
                        $row['file_id'] = $file->id;

                        $rows[] = $row;
                    }

                    return DbHelper::insertMultiple('member', $rows);
                }
            }
        }

        return false;
    }

    /**
     * @return bool|Group
     */
    public function actionCreateGroup()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if ($post['title']) {

            $group = new Group();
            $group->title = $post['title'];
            $group->user_id = $this->user->id;
            $group->created_at = date('Y-m-d H:i:s', time() + 7 * 3600);

            if ($group->save()) {
                return $group;
            }
        }

        return false;
    }

    /**
     *
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function actionExportExcel()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if ($post['data']) {

            $fileName = 'template.xlsx';
            $inputFileName = '../../uploads/core/excel/' . $fileName;
            $activeSheetIndex = 0;

            $startDataRow = 1;
            $inputFileType = 'Xlsx';

            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
            $setCellValues = $objPHPExcel->getActiveSheet();

            $sheet = json_decode($post['data']);

            $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
            for ($i = 0; $i < count($sheet[0]); $i++) {
                $setCellValues->getColumnDimension($alphabet[$i])->setWidth($i == 0 ? 20 : 30);
            }

            if (count($sheet) > 1) {
                $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 1);
            }

            $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

            $newFile = '/uploads/core/result/' . time() . '.xlsx';
            $objWriter = IOFactory::createWriter($objPHPExcel, $inputFileType);
            $objWriter->save('../..' . $newFile);

            return $newFile;
        }

        return false;
    }

    /**
     * @return bool|string
     */
    function actionShield()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['access_token']) && isset($post['action'])) {
            $result = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=" . $post['access_token']), true);

            if (isset($result['id'])) {
                $headers2 = array();
                $headers2[] = 'Authorization: OAuth ' . $post['access_token'];
                $data = 'variables={"0":{"is_shielded":' . $post['action'] . ',"session_id":"9b78191c-84fd-4ab6-b0aa-19b39f04a6bc","actor_id":"' . $result['id'] . '","client_mutation_id":"b0316dd6-3fd6-4beb-aed4-bb29c5dc64b0"}}&method=post&doc_id=1477043292367183&query_name=IsShieldedSetMutation&strip_defaults=true&strip_nulls=true&locale=en_US&client_country_code=US&fb_api_req_friendly_name=IsShieldedSetMutation&fb_api_caller_class=IsShieldedSetMutation';
                $c = curl_init();
                curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/graphql");
                curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($c, CURLOPT_HTTPHEADER, $headers2);
                curl_setopt($c, CURLOPT_POST, 1);
                curl_setopt($c, CURLOPT_POSTFIELDS, $data);
                $page = curl_exec($c);
                curl_close($c);

                return true;
            }
        }
        return false;
    }
}