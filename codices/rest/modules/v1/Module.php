<?php

namespace app\modules\v1;

use Yii;
use yii\web\Response;

class Module extends \yii\base\Module {
    //public function behaviors() {
    //$behaviors = parent::behaviors();
    // remove authentication filter
    //$auth = $behaviors['authenticator'];
    //unset($behaviors['authenticator']);
    // add CORS filter
    //$behaviors['corsFilter'] = [
    //    'class' => \yii\filters\Cors::className(),
    //];
    // re-add authentication filter
    //$behaviors['authenticator'] = $auth;
    // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
    //$behaviors['authenticator']['except'] = ['options'];
    //return $behaviors;
    //}

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
    }

}
