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
final class Genre extends Model {

    /** @var ?\common\models\Genre */
    private ?\common\models\Genre $genre;
    private int $ownerId;

    public ?string $name = null;

    /**
     * @param int                       $ownerId
     * @param \common\models\Genre|null $genre
     * @param array                     $config
     */
    public function __construct(int $ownerId, \common\models\Genre $genre = null, array $config = []) {
        $this->ownerId = $ownerId;
        $this->genre = new \common\models\Genre();

        if ($genre) {
            $this->genre = $genre;

            $this->name = $genre->name;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->genre->attributeLabels();
    }

    /**
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if ($this->genre->isNewRecord) {
            $this->genre->ownedById = $this->ownerId;
        }

        $this->genre->name = $this->name;
        if (!$this->genre->save()) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->genre->id;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->genre->isNewRecord;
    }

    /**
     * @return array
     */
    public function getBooks(): array {
        return $this->genre ? $this->genre->books : [];
    }

}
