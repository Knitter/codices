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

namespace codices\forms;

use Yii;
use yii\base\Model;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Series extends Model {

    /** @var \common\models\Series */
    private $series;

    public ?string $name = null;
    public ?string $finished = null;
    public ?string $bookCount = null;
    public ?string $ownedCount = null;

    /**
     * @param \common\models\Series|null $series
     * @param array                      $config
     */
    public function __construct(\common\models\Series $series = null, array $config = []) {
        $this->series = new \common\models\Series();
        if ($series) {
            $this->series = $series;

            $this->name = $series->name;
            $this->finished = $series->finished;
            $this->bookCount = $series->bookCount;
            $this->ownedCount = $series->ownedCount;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['finished', 'bookCount', 'ownedCount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->series->attributeLabels();
    }

    /**
     * Validates and saves the changes into the database.
     *
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if ($this->series->isNewRecord) {
            $this->series->ownedById = 1;
        }

        $this->series->name = $this->name;
        $this->series->bookCount = $this->bookCount ? (int)$this->bookCount : null;
        $this->series->finished = $this->finished ? 1 : 0;
        $this->series->ownedCount = $this->ownedCount ? (int)$this->ownedCount : null;

        if (!$this->series->save()) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->series ? $this->series->id : 0;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->series->isNewRecord;
    }
}
