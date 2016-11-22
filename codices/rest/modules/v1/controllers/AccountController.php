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

namespace app\modules\v1\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;
use yii\rest\ActiveController;
//
use common\models\Account;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class AccountController extends ActiveController {

    public $modelClass = '\common\models\Account';

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

        if (!($token = $account->generateSessionId())) {
            throw new ServerErrorHttpException('Server error. Unable to create session id.');
        }

        return (object) [
                    'token' => $token,
                    'account' => (object) [
                        'id' => $account->id,
                        'name' => $account->name,
                        'email' => $account->email
                    ]
        ];
    }

}
