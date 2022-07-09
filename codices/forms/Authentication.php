<?php

/*
 * Authentication.php
 *
 * Small book management software.
 * Copyright (C) 2016 - 2022 Sérgio Lopes (knitter.is@gmail.com)
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
 * (c) 2016 - 2022 Sérgio Lopes
 */

namespace codices\forms;

use Exception;
use Yii;
use yii\base\Model;
use common\models\Account;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Authentication extends Model {

    //TODO: Add session duration value
    //const SESSION_MAX = 604800;

    /** @var string|null */
    public ?string $accessId = null;

    /** @var string|null */
    public ?string $password = null;

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['accessId', 'password'], 'required'],
            [['accessId', 'password'], 'string']
        ];
    }

    /**
     * @return bool
     */
    public function authenticate(): bool {
        if ($this->validate()) {
            $access = trim($this->accessId);

            $account = Account::find()
                ->where(['email' => $access])
                ->orWhere(['login' => $access])
                ->one();

            if ($account) {
                try {
                    if ($account->isPasswordValid($this->password)) {
                        return Yii::$app->user->login($account, 0);
                    }
                } catch (Exception $ex) {
                    //IGNORE
                }
            }

            $this->addError('accessId', Yii::t('codices', 'Wrong login/email or password.'));
            $this->addError('password', Yii::t('codices', 'Wrong login/email or password.'));
        }

        return false;
    }
}
