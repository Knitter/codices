<?php

/*
 * Collection.php
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
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Collection extends Model {

    /** @var \common\models\Collection */
    private $collection;

    /** @var string */
    public $name;

    /** @var integer */
    public $bookcount;

    /**
     * @param \common\models\Movel $collection
     * @param array $config
     */
    public function __construct(\common\models\Collection $collection = null, $config = []) {
        $this->collection = $collection;

        if ($this->collection) {
            $this->name = $this->collection->name;
            $this->bookcount = $this->collection->bookCount;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return (new \common\models\Collection())->rules();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('codices', 'Name'),
            'bookCount' => Yii::t('codices', 'Book Count')
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

        if (!$this->collection) {
            $this->collection = new \common\models\Collection();
            $this->collection->accountId = Yii::$app->user->id;
        }

        $this->collection->name = $this->name;
        $this->collection->bookCount = $this->bookcount ?: null;

        if (!$this->collection->save()) {
            return false;
        }

        return true;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->collection ? $this->collection->id : 0;
    }

}
