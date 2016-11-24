<?php

/*
 * RequestAuthorization.php
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

namespace app\filters;

use Yii;
use yii\base\ActionFilter;
use yii\filters\auth\AuthInterface;
use yii\web\UnauthorizedHttpException;
//-
use common\models\Session;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class RequestAuthorization extends ActionFilter implements AuthInterface {

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $response = Yii::$app->getResponse();
        if ($this->authenticate(Yii::$app->getUser(), Yii::$app->getRequest(), $response) !== null) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response) {
        $headers = $request->getHeaders();

        if (empty($headers['X-CODICESUSER-TOKEN']) ||
                !($session = Session::findOne(['accessToken' => $headers['X-CODICESUSER-TOKEN']]))) {

            throw new UnauthorizedHttpException('Wrong credentials.');
        }
        $account = $session->account;
        
        $user->switchIdentity($account);
        return $account;
    }

    /**
     * @inheritdoc
     */
    public function challenge($response) {
        //NOTE: DO NOTHING
    }

    /**
     * @inheritdoc
     */
    public function handleFailure($response) {
        //NOTE: DO NOTHING
    }

}
