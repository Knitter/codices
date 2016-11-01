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

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $biography
 * @property string $url
 * @property string $photo
 * @property string $surname
 * 
 * @property Book[] $books
 * @property Series[] $series
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
class Author extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Author';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'surname'], 'required'],
                [['name', 'biography', 'url', 'photo', 'surname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks() {
        return $this->hasMany(Book::className(), ['id' => 'bookId'])->viaTable('BookAuthor', ['authorId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeries() {
        return $this->hasMany(Series::className(), ['authorId' => 'id'])->inverseOf('author');
    }

    /**
     * Returns the author's full name, that for this version is assumed as the name followed by the surname.
     * 
     * @return string
     */
    public function getFullName() {
        return $this->name . ' ' . $this->surname;
    }

}
