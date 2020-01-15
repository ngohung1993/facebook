<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/18/2018
 * Time: 3:09 PM
 */

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\ArrayHelper;
use fproject\components\DbHelper;
use common\helpers\FunctionHelper;
use common\models\TinRao;
use common\models\TrangWeb;

include_once('simple_html_dom.php');

class JsonController extends Controller
{
    public $message;

    public function options($actionID)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return ['m' => 'message'];
    }

    public function actionIndex()
    {
        set_time_limit(600);

        $model = TrangWeb::find()->where(['=', 'id', $this->message])->one();

        $apiTinRao = 'https://gateway.chotot.com/v1/public/ad-listing/';

        $apiProfile = 'https://gateway.chotot.com/v1/public/profile/';

        $regions = [12, 13];

        $count = 0;

        if ($model && $model['trang_thai'] == 1) {
            $context = stream_context_create(array(
                'http' => array(
                    'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            ));

            foreach ($regions as $key_region => $value_region) {

                $html = file_get_html('https://gateway.chotot.com/v1/public/ad-listing?region=' . $value_region . '&cg=1000', false, $context);

                $data_old = ArrayHelper::index(TinRao::find()->where(['=', 'id_trang_web', $this->message])->asArray()->all(), 'duong_dan');

                $data_new = [];

                foreach (get_object_vars(json_decode($html->plaintext))['ads'] as $key => $value) {
                    $value = get_object_vars($value);

                    $href = isset($value['ad_id']) ? $value['ad_id'] : null;

                    if (empty($data_old[$href])) {
                        $data['id_trang_web'] = $this->message;
                        $data['duong_dan'] = $href;
                        $data['gia'] = isset($value['price_string']) ? $value['price_string'] : null;
                        $data['ngay_dang'] = isset($value['list_time']) ? date('d/m/Y', $value['list_time'] / 1000 + 7 * 3600) : null;
                        $data['tieu_de'] = isset($value['subject']) ? $value['subject'] : null;
                        $data['ho_va_ten'] = isset($value['account_name']) ? $value['account_name'] : null;

                        $address = isset($value['area_name']) ? $value['area_name'] : '';
                        $address .= isset($value['region_name']) ? $value['region_name'] : '';

                        $data['id_tinh'] = FunctionHelper::check_address($address)[0];
                        $data['id_huyen'] = FunctionHelper::check_address($address)[1];

                        $html_content = file_get_html($apiTinRao . (isset($value['list_id']) ? $value['list_id'] : ''), false, $context);

                        $content = get_object_vars(get_object_vars(json_decode($html_content))['ad']);

                        $data['noi_dung'] = isset($content['body']) ? FunctionHelper::replace_4byte($content['body']) : null;

                        $html_profile = file_get_html($apiProfile . (isset($value['account_oid']) ? $value['account_oid'] : ''), false, $context);

                        $profile = get_object_vars(json_decode($html_profile));

                        $data['so_dien_thoai'] = isset($profile['phone']) ? $profile['phone'] : '';
                        $data['email'] = isset($profile['email']) ? $profile['email'] : '';

                        $data_new[] = $data;

                    }
                }

                DbHelper::insertMultiple('tin_rao', $data_new);
                $count += count($data_new);

            }
        }

        var_dump('Insert ' . $count . ' new record');
    }
}