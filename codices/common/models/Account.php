<?php

/*
 * Account.php
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

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * 
 * @property Collection $collections
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
class Account extends ActiveRecord implements IdentityInterface {

    public $hash;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Account';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollections() {
        return $this->hasMany(Collection::className(), ['accountId' => 'id'])->inverseOf('owner');
    }

    /**
     * @inheritdoc
     */
    public function afterFind() {
        $this->hashed = $this->password;
        $this->password = null;

        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password)) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            } else if (!empty($this->hashed)) {
                $this->password = $this->hashed;
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return md5($this->id . $this->email . $this->hashed);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $authKey == $this->getAuthKey();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return self::findOne((int) $id);
    }

    /**
     * @param string $password
     * @return boolean
     * 
     * @throws \yii\base\InvalidParamException
     */
    public function validarPassword($password) {
        return Yii::$app->security->validatePassword($password, $this->hashed);
    }

    /**
     * @return string
     */
    public static function randomPassword() {
        return Yii::$app->security->generateRandomString(8);
    }

}
