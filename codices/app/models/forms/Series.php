<?php

/*
 * Series.php
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
final class Series extends Model {

    /** @var \common\models\Series */
    private $series;

    /** @var string */
    public $name;

    /** @var integer */
    public $finished;

    /** @var integer */
    public $bookCount;

    /**
     * @param \common\models\Series $series
     * @param array $config
     */
    public function __construct(\common\models\Series $series = null, $config = []) {
        $this->series = $series;

        if ($this->series) {
            $this->name = $series->name;
            $this->finished = $series->finished;
            $this->bookCount = $series->bookCount;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name'], 'required'],
                [['name'], 'string', 'max' => 255],
                [['finished', 'bookCount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('codices', 'Name'),
            'finished' => Yii::t('codices', 'Finished Series'),
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

        if (!$this->series) {
            $this->series = new \common\models\Series();
            $this->series->accountId = Yii::$app->user->id;
        }

        $this->series->name = $this->name;
        $this->series->bookCount = $this->bookCount ?: 0;
        $this->series->finished = $this->finished ?: 0;

        if (!$this->series->save()) {
            return false;
        }

        return true;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->series ? $this->series->id : 0;
    }

}
