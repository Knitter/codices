<?php

/*
 * Author.php
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

/**
 * Form model that adapts the Account entity/model to the form view and handles validating and saving the user provided 
 * data.
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Account extends Model {

    /** @var \common\models\Account */
    private $account;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /**
     * @param \common\models\Account $account
     * @param array $config
     */
    public function __construct(\common\models\Account $account = null, $config = []) {
        $this->account = $account;

        if ($this->account) {
            $this->name = $account->name;
            $this->email = $account->email;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'email'], 'required'],
                [['name', 'email', 'password'], 'string', 'max' => 255],
                [['email'], 'checkUnique']
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function checkUnique($attribute, $params) {
        if (!empty($this->email) && ($this->getIsNewRecord() ||
                ($this->account->oldAttributes && $this->account->oldAttributes['email'] != $this->email))) {

            if ((\common\models\Account::find()->where(['email' => $this->email])->one()) != null) {
                $this->addError('email', Yii::t('codices', 'E-mail must be unique, an account using the same e-mail address is already present.'));
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('codices', 'Name'),
            'email' => Yii::t('codices', 'E-mail'),
            'password' => Yii::t('codices', 'Password')
        ];
    }

    /**
     * Validates and saves the changes into the database.
     * 
     * @return boolean
     */
    public function save() {
        if (!$this->validate()) {
            return false;
        }

        if (!$this->account) {
            $this->account = new \common\models\Account();
        }

        $this->account->name = $this->name;
        $this->account->email = $this->email;
        $this->account->password = $this->password;

        if (!$this->account->save()) {
            return false;
        }

        return true;
    }

    /**
     * Returns the account's ID, if the model as already been saved. If not, the ID is zero.
     * 
     * @return integer
     */
    public function getId() {
        return $this->account ? $this->account->id : 0;
    }

    /**
     * Since we're reusing the rules provided by the Account model class, and given that one of the rules requires 
     * searching the database, we're implementing one of the automatically invoced methods but only delegating to the 
     * standard model find().
     * 
     * @return \yii\db\ActiveQuery
     */
    public static function find() {
        return \common\models\Account::find();
    }

    /**
     * @return bool
     */
    public function getIsNewRecord(): bool {
        return ($this->account == null || $this->account->isNewRecord);
    }

}
