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
final class Collection extends Model {

    /** @var \common\models\Collection|null */
    private ?\common\models\Collection $collection;

    public ?string $name = null;
    public ?string $publishYear = null;
    public ?string $bookCount = null;
    public ?string $ownedCount = null;

    /**
     * @param \common\models\Collection|null $collection
     * @param array                          $config
     */
    public function __construct(\common\models\Collection $collection = null, array $config = []) {
        $this->collection = new \common\models\Collection();
        if ($collection) {
            $this->collection = $collection;

            $this->name = $collection->name;
            $this->publishYear = $collection->publishYear;
            $this->bookCount = $collection->bookCount;
            $this->ownedCount = $collection->ownedCount;
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
            [['publishYear', 'bookCount', 'ownedCount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->collection->attributeLabels();
    }

    /**
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if ($this->collection->isNewRecord) {
            //TODO: Fix after login process is ready
            $this->collection->ownedById = 1;
        }

        $this->collection->name = trim($this->name);
        $this->collection->publishYear = $this->publishYear ? (int)$this->publishYear : null;
        $this->collection->bookCount = $this->bookCount ? (int)$this->bookCount : null;
        $this->collection->ownedCount = $this->ownedCount ? (int)$this->ownedCount : null;

        if (!$this->collection->save()) {
            return false;
        }

        return true;
    }


    /**
     * @return int
     */
    public function getId(): int {
        return $this->collection->id;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->collection->isNewRecord;
    }
}
