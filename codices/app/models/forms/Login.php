<?php

/*
 * Login.php
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

namespace app\models\forms;

use Yii;
use yii\base\Model;
//-
use common\models\Account;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Login extends Model {

    const SESSSION_MAX = 604800;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['email', 'password'], 'required'],
                [['email'], 'email']
        ];
    }

    /**
     * Loads the POST data, validates the model and sets the logged in user if the authentication was successfull.
     * 
     * @return boolean
     */
    public function login($params) {
        if ($this->load($params) && $this->validate()) {
            if (($account = Account::findOne(['email' => $this->email]))) {
                try {
                    if ($account->validatePassword($this->password)) {
                        return Yii::$app->user->login($account, self::SESSSION_MAX);
                    }
                } catch (\yii\base\InvalidParamException $ex) {
                    //IGNORE
                }
            }

            $this->addError('email', Yii::t('codices', 'Wrong user or password.'));
            $this->addError('password', Yii::t('codices', 'Wrong user or password.'));

            return false;
        }
    }

}
