<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/18/2018
 * Time: 3:09 PM
 */

namespace console\controllers;

use common\models\Website;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use fproject\components\DbHelper;
use Exception;
use DOMDocument;
use DOMXPath;
use common\models\Classified;
use common\helpers\FunctionHelper;
use common\models\SubWebsite;

include_once('simple_html_dom.php');

class CronController extends Controller
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

        $sub_website = SubWebsite::find()
            ->joinWith('website')
            ->where(['=', 'sub_website.id', $this->message])
            ->asArray()->one();

        $model = Website::findOne($sub_website['website_id']);

        if ($model && $model['status'] == 1) {

            try {
                $context = stream_context_create(array(
                    'http' => array(
                        'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201')
                    ),
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                ));

                $count = 0;
                if ($model['paging']) {

                    $paging = explode('***', $model['paging']);

                    $rear = '';
                    if (count($paging) == 2) {
                        $rear = $paging[1];
                    }

                    for ($i = 21; $i <= 40; $i++) {

                        $data_new = [];
                        $data_old = ArrayHelper::index(Classified::find()->asArray()->all(), 'path');

                        if ($i == 1) {
                            $url = $sub_website['path'];
                        } else {
                            $url = str_replace($rear, '', $sub_website['path']) . $paging[0] . $i . $rear;
                        }

                        $html1 = file_get_html($url, false, $context);

                        $document = new DOMDocument('1.0', 'UTF-8');

                        $internalErrors = libxml_use_internal_errors(true);

                        $document->loadHTML($html1);

                        libxml_use_internal_errors($internalErrors);

                        $xpath = new DOMXPath($document);

                        if ($model['path_classified']) {
                            foreach ($xpath->query($model['path_classified']) as $k => $element) {
                                $href = str_replace($model['path'], '', $element->textContent);

                                if (empty($data_old[$href])) {
                                    $data = FunctionHelper::get_content($model, $href, $model['id'], $sub_website['id'], $sub_website['category_classified_id']);

                                    if ($data) {
                                        $temp = ArrayHelper::index($data_new, 'email');
                                        if (isset($data['email']) && empty($temp[$data['email']])) {
                                            $data_new[] = $data;
                                        }
                                    }
                                }
                            }
                        }

                        DbHelper::insertMultiple('classified', $data_new);
                        $count += count($data_new);
                        var_dump('Insert ' . $count . ' new record');
                        $html1->clear();
                        unset($html1);
                        unset($document);
                        unset($xpath);
                        unset($data_new);
                        unset($data_old);
                    }
                }

            } catch (Exception $exception) {
                echo $exception;
            }
        }
    }
}