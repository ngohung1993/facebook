<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 2/2/2018
 * Time: 6:02 PM
 */

namespace backend\controllers;

use common\models\SeoTool;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Response;
use yii\web\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use common\helpers\FunctionHelper;
use common\models\Album;
use common\models\Category;
use common\models\Image;
use common\models\Post;
use common\models\Product;
use common\models\Supporter;
use common\models\User;
use common\models\PhotoLocation;
use common\models\Setting;
use common\models\Page;
use common\models\base\Tab;

/**
 * AjaxController
 */
class FaceBookAjaxController extends Controller
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




}