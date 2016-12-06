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

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Represents a database series that groups related books.
 * 
 * @property integer $id
 * @property string $name
 * @property integer $bookCount
 * @property integer $ownCount
 * @property integer $finished
 * @property integer $accountId
 * @property integer $authorId
 *
 * @property Book[] $books
 * @property Account $account
 * @property Author $author
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Series extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Series';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name'], 'required'],
                [['name'], 'string', 'max' => 255],
                [['finished', 'bookCount', 'accountId', 'authorId'], 'integer']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks() {
        return $this->hasMany(Book::className(), ['seriesId' => 'id'])->inverseOf('series');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount() {
        return $this->hasOne(Account::className(), ['id' => 'accountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(Author::className(), ['id' => 'authorId']);
    }

}
