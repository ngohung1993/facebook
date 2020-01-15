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
class AjaxController extends Controller
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
     * @param id
     * @param table
     * @param api
     *
     * @return bool
     */
    public function actionRelease()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['table']) && isset($post['api'])) {
            $model = null;

            switch ($post['table']) {
                case 'page':
                    $model = Page::findOne($post['id']);

                    break;
                case 'photo-location':
                    $model = PhotoLocation::findOne($post['id']);

                    break;
                case 'setting':
                    $model = Setting::findOne($post['id']);

                    break;
                default:
                    break;
            }

            if ($model) {
                $model->released = $model->released ? 0 : 1;

                return $model->save();
            }

        }

        return false;
    }

    /**
     * @param id
     * @param table
     * @param api
     *
     * @return bool
     */
    public function actionEnableColumn()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['table']) && isset($post['api']) && isset($post['column'])) {
            $model = null;

            switch ($post['table']) {
                case 'category':
                    $model = Category::findOne($post['id']);

                    break;
                case 'post':
                    $model = Post::findOne($post['id']);

                    break;
                case 'setting':
                    $model = Setting::findOne($post['id']);

                    break;
                case 'product':
                    $model = Product::findOne($post['id']);
                    break;
                case 'supporter':
                    $model = Supporter::findOne($post['id']);
                    break;
                default:
                    break;
            }

            if ($model) {
                $model[$post['column']] = $model[$post['column']] ? 0 : 1;

                return $model->save();
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['images']) && isset($post['id']) && isset($post['column_parent_id'])) {
            $images = json_decode($post['images']);

            foreach ($images as $key => $value) {
                $image = new Image();

                $image->title = $value;
                $image->avatar = '/uploads/advertises/' . $value;
                $image->status = 1;
                $image[$post['column_parent_id']] = $post['id'];

                $image->save();
            }

            return true;

        }

        return false;

    }

    /**
     * @return bool|false|int
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $image = Image::findOne($post['id']);

            try {
                return $image->delete();
            } catch (StaleObjectException $e) {
            } catch (\Throwable $e) {
            }

        }

        return false;

    }

    /**
     * @return bool
     */
    public function actionSerial()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['serialize'])) {
            $serialize = json_decode($post['serialize']);

            foreach ($serialize as $key => $item) {
                $this->save_serial($item, $key + 1, null);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $item
     * @param $serial
     * @param $parent
     */
    private function save_serial($item, $serial, $parent)
    {
        $array = get_object_vars($item);

        $category = Category::findOne($array['id']);

        $category->serial = $serial;

        $category->parent_id = $parent;

        $category->save();

        if (count($array) == 2) {
            foreach ($array['children'] as $key_c => $item_c) {
                $this->save_serial($item_c, $key_c + 1, $array['id']);
            }
        }
    }

    /**
     * @param $page_id
     */
    public function actionGetCategoriesByPageId($page_id)
    {
        $categories = Category::find()
            ->where(['page_id' => $page_id])
            ->orderBy('id DESC')
            ->all();

        echo "<option value=''>" . Yii::t('backend', '-- Select category --') . "</option>";

        if (!empty($categories)) {
            FunctionHelper::show_categories_select($categories);
        }
    }

    /**
     * @return array|bool|mixed
     */
    public function actionEditColumn()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['name']) && isset($post['pk']) && isset($post['value'])) {

            $table_column = explode('#', $post['name']);

            if (count($table_column) === 2) {
                $table = $table_column[0];
                $column = $table_column[1];

                $model = null;

                switch ($table) {
                    case 'category':
                        $model = Category::findOne($post['pk']);
                        break;
                    case 'post':
                        $model = Post::findOne($post['pk']);
                        break;
                    case 'setting':
                        $model = Setting::findOne($post['pk']);
                        break;
                    case 'image':
                        $model = Image::findOne($post['pk']);
                        break;
                    case 'supporter':
                        $model = Supporter::findOne($post['pk']);
                        break;
                    case 'tab':
                        $model = Tab::findOne($post['pk']);
                        break;
                    default:
                        break;
                }

                if ($model) {
                    $model[$column] = $post['value'];

                    return $model->save();
                }

            }
        }

        return $post;
    }

    /**
     * @return array|bool
     */
    public function actionGetProductById()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $product = Product::find()->joinWith('images0')->where([
                '=',
                'product.id',
                $post['id']
            ])->asArray()->one();

            if ($product) {
                $albums = Album::find()->joinWith('images')->where([
                    '=',
                    'album.product_id',
                    $post['id']
                ])->asArray()->all();

                return [$product, $albums];
            }
        }

        return false;
    }

    /**
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function actionSendMail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['title']) && isset($post['email_root']) && isset($post['name_root']) && isset($post['email_guest']) && isset($post['name_guest']) && isset($post['content'])) {
            $mail = new PHPMailer(true);

            $mail->CharSet = 'UTF-8';

            $mail->isSMTP();

            $mail->SMTPDebug = 0;

            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPSecure = 'tls';

            $mail->SMTPAuth = true;

            $mail->Username = "cskhtigerweb@gmail.com";

            $mail->Password = "tamconmot";

            $mail->setFrom('cskhtigerweb@gmail.com', 'TIGERWEB.VN');

            $mail->addReplyTo($post['email_guest'], $post['name_guest']);

            $mail->addAddress($post['email_root'], $post['name_root']);

            $mail->Subject = $post['title'];

            $mail->msgHTML(file_get_contents('../../uploads/core/contents.html'));

            $mail->AltBody = 'This is a plain-text message body';

            if ($mail->send()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool|null|object
     */
    public function actionGetContentImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id'])) {
            $image = Image::findOne($post['id']);

            return $image;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionEditContentImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['content']) && isset($post['link']) && isset($post['describe'])) {
            $image = Image::findOne($post['id']);

            $image->content = $post['content'];
            $image->link = $post['link'];
            $image->describe = $post['describe'];

            return $image->save();
        }

        return false;
    }

    /**
     * @return bool|string
     */
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

    /**
     * @return bool
     */
    public function actionUpdatePost()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['id']) && isset($post['title']) && isset($post['category_id']) && isset($post['avatar']) && isset($post['featured']) && isset($post['display_homepage']) && isset($post['seo_title']) && isset($post['meta_keywords']) && isset($post['meta_description'])) {
            $post_find = Post::findOne($post['id']);

            $post_find->title = $post['title'];
            $post_find->category_id = (int)$post['category_id'];
            $post_find->avatar = $post['avatar'];
            $post_find->featured = $post['featured'];
            $post_find->display_homepage = $post['display_homepage'];

            if ($post_find->save()) {
                $seo = SeoTool::findOne($post_find->seo_tool_id);

                $seo->seo_title = $post['seo_title'];
                $seo->meta_keywords = $post['meta_keywords'];
                $seo->meta_description = $post['meta_description'];
                $seo->save();

                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionUpdatePostStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();

        if (isset($post['posts'])) {
            foreach ($post['posts'] as $key => $value){
                $post = null;
                $post = Post::findOne($value['id']);
                $post->status = (int)$value['status'];
                $post->save();
            }
            return true;
        }

        return false;
    }
    public function actionUpdateCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if (isset($post['id']) && isset($post['title']) && isset($post['avatar']) && isset($post['featured']) && isset($post['display_homepage']) && isset($post['seo_title']) && isset($post['meta_keywords']) && isset($post['meta_description'])) {
            $category_find = Category::findOne($post['id']);
            $category_find->title = $post['title'];
            $category_find->parent_id = $post['parent_id'];
            $category_find->avatar = $post['avatar'];
            $category_find->featured = $post['featured'];
            $category_find->display_homepage = $post['display_homepage'];

            if ($category_find->save()) {
                $seo = SeoTool::findOne($category_find->seo_tool_id);

                $seo->seo_title = $post['seo_title'];
                $seo->meta_keywords = $post['meta_keywords'];
                $seo->meta_description = $post['meta_description'];
                $seo->save();

                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function actionDeleteTab()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii:: $app->request->post();
        if ($post['id']) {
            $tab = Tab::findOne($post['id']);
            if ($tab->delete()) return true;
            return false;
        }
        return false;
    }
}