<?php

/*
 * AccountController.php
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

namespace codices\modules\v1\controllers;

use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;
//-
use common\models\Account;
use common\models\Session;
//-
use app\filters\RequestAuthorization;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class AccountController extends ActiveController {

    public $modelClass = '\common\models\Account';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = ['class' => Cors::className()];
        $behaviors['authenticator'] = [
            'class' => RequestAuthorization::className(),
            'except' => ['options', 'authenticate']
        ];

        return $behaviors;
    }

    public function actionAuthenticate() {
        $request = Yii::$app->request;

        $email = $request->post('email');
        $password = $request->post('password');

        if (empty($email) || empty($password)) {
            throw new UnauthorizedHttpException('Missing credentials.');
        }

        if (!($account = Account::find()->where(['email' => $email])->one())) {
            throw new NotFoundHttpException('Invalid user account.');
        }

        if (!$account->validatePassword($password)) {
            throw new UnauthorizedHttpException('Wrong credentials.');
        }

        $session = new Session();
        $session->accessToken = $account->generateSessionToken();
        $session->accountId = $account->id;

        if (!$session->save()) {
            throw new ServerErrorHttpException('Server error. Unable to create session id.');
        }

        return (object) [
                    'token' => $session->accessToken,
                    'account' => (object) [
                        'id' => $account->id,
                        'name' => $account->name,
                        'email' => $account->email
                    ]
        ];
    }

}
