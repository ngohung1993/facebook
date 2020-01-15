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
class ChangePassController extends Controller
{
    public function actionChangePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (!Yii::$app->user->isGuest) {
            if (isset($post['password_old']) && isset($post['password']) && isset($post['re_password'])) {
                $user = User::findOne(Yii::$app->user->identity->getId());
                if ($user) {
                    if (Yii::$app->security->validatePassword($post['password_old'], $user->password_hash)) {
                        if ($post['password'] == $post['re_password']) {
                            if (strlen($post['password']) >= 6) {
                                $user->setPassword($post['password']);

                                return $user->save();
                            } else {
                                return 'Mật khẩu mới nhỏ hơn 6 kí tự';
                            }
                        } else {
                            return 'Mật khẩu mới không giống nhau';
                        }
                    } else {
                        return 'Mật khẩu cũ không đúng';
                    }
                }
            }
        }

        return false;
    }
}