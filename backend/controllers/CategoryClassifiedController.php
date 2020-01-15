<?php

namespace backend\controllers;

use fproject\components\DbHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Classified;
use common\helpers\FunctionHelper;
use common\models\CategoryClassified;

/**
 * CategoryClassifiedController implements the CRUD actions for CategoryClassified model.
 */
class CategoryClassifiedController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryClassified models.
     * @return mixed
     */
    public function actionIndex()
    {
        $category_classifieds = CategoryClassified::find()->all();

        return $this->render('index', [
            'category_classifieds' => $category_classifieds
        ]);
    }

    /**
     * @param $id
     */
    public function actionExport($id)
    {
        $classifieds = Classified::find()
            ->where(['=', 'exported', Classified::CAN_EXPORT])
            ->andWhere(['=', 'category_classified_id', $id])
            ->limit(1000)
            ->all();

        $fileName = 'template.xlsx';

        $inputFileName = './excel/' . $fileName;

        $activeSheetIndex = 0;

        $startDataRow = 2;
        $count = 0;
        $inputFileType = 'Xlsx';

        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
        $setCellValues = $objPHPExcel->getActiveSheet();

        $sheet = [];

        $classifieds_update = [];

        foreach ($classifieds as $key => $value) {
            $count++;

            $data['A'] = $count;
            $data['B'] = $value['contact_name'];
            $data['C'] = $value['email'];
            $data['B'] = $value['phone'];

            $sheet[] = $data;

            $classified_update['id'] = $value['id'];
            $classified_update['exported'] = Classified::EXPORTED;

            $classifieds_update[] = $classified_update;

        }

        DbHelper::updateMultiple('classified', $classifieds_update, 'id');

        if (count($sheet) > 1) {
            $setCellValues->insertNewRowBefore($startDataRow + 1, count($sheet) - 1);
        }

        $setCellValues->fromArray($sheet, null, 'A' . $startDataRow);

        $newFile = './result/' . date('d-m-Y', time() + 7 * 3600) . '.xlsx';
        $objWriter = IOFactory::createWriter($objPHPExcel, $inputFileType);
        $objWriter->save($newFile);

        FunctionHelper::download($newFile);
    }

    /**
     * Displays a single CategoryClassified model.
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
     * Creates a new CategoryClassified model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryClassified();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoryClassified model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoryClassified model.
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
     * Finds the CategoryClassified model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryClassified the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryClassified::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
