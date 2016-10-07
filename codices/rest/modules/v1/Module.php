<?php

/*
 * Module.php
 * 
 * Small book management software.
 * Copyright (C) 2016 Sérgio Lopes (knitter.is@gmail.com)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 * (c) 2016 Sérgio Lopes
 */

namespace app\modules\v1;

use Yii;
use yii\web\Response;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Module extends \yii\base\Module {
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
