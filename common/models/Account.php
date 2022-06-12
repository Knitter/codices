<?php

/*
 * Account.php
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

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer                     $id       PK, record ID, auto-increment
 * @property string                      $login    User login/account name, used for authentication
 * @property string                      $name     User's visible name, used for UI purposes
 * @property bool                        $active   Flag that marks this account record as being active
 * @property string|null                 $email    User's e-mail address, optional for accounts that are not used to
 *           access the application
 * @property string|null                 $password User's password, optional, and if not set or empty will mark this
 *           account as one that can't be used to log in into the application
 *
 * @property \common\models\Author[]     $authors
 * @property \common\models\Genre[]      $genres
 * @property \common\models\Publisher[]  $publishers
 * @property \common\models\Series[]     $series
 * @property \common\models\Collection[] $collections
 * @property \common\models\Book[]       $books
 *
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Account extends ActiveRecord implements IdentityInterface {

    /** @var string|null */
    public ?string $hash = null;

    /**
     * @inheritdoc
     */
    public static function tableName(): string {
        return '{{Account}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return [
            'login' => Yii::t('codices', 'Login'),
            'name' => Yii::t('codices', 'Name'),
            'active' => Yii::t('codices', 'Active'),
            'email' => Yii::t('codices', 'Email'),
            'password' => Yii::t('codices', 'Password')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors(): ActiveQuery {
        return $this->hasMany(Author::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenres(): ActiveQuery {
        return $this->hasMany(Genre::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishers(): ActiveQuery {
        return $this->hasMany(Publisher::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeries(): ActiveQuery {
        return $this->hasMany(Series::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollections(): ActiveQuery {
        return $this->hasMany(Collection::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks(): ActiveQuery {
        return $this->hasMany(Book::class, ['ownedById' => 'id'])
            ->inverseOf('owner');
    }

    /**
     * @inheritdoc
     */
    public function afterFind() {
        $this->hash = $this->password;
        $this->password = null;

        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert): bool {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password)) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            } else if (!empty($this->hash)) {
                $this->password = $this->hash;
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     * @throws \yii\base\NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface {
        throw new NotSupportedException();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(): ?string {
        return md5($this->id . $this->login . $this->hash);
    }

    /**
     * @inheritdoc
     */
    public function getId(): int|string {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey): ?bool {
        return $authKey === $this->getAuthKey();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id): Account|IdentityInterface|null {
        //TODO: Proper account validation and access
        return self::findOne((int)$id);
    }

    /**
     * @param string $password
     * @return boolean
     * @throws \yii\base\InvalidParamException
     */
    public function isPasswordValid(string $password): bool {
        return Yii::$app->security->validatePassword($password, $this->hash);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public static function generateRandomPassword(): string {
        return Yii::$app->security->generateRandomString(8);
    }

    /**
     * @return string
     */
    public function generateSessionToken() {
        return sha1($this->hash . $this->email . time() . $this->name);
    }

}
