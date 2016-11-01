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

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Sometimes books are sold or grouped in collections. This entity aims to manage those collections that are less 
 * common than series and usually created by the publisher.
 * 
 * @property integer $id
 * @property string $name
 * @property integer $bookCount The total number of books in this collection.
 * @property integer $accountId The user that owns the collection.
 * @property integer $ownCount The number of owned books in the collection.
 * 
 * @property Account $owner
 * @property Book[] $books
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Collection extends ActiveRecord {

    public $hash;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Collection';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'accountId'], 'required'],
                [['name'], 'string', 'max' => 255],
                [['accountId', 'bookCount'], 'integer']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner() {
        return $this->hasOne(Account::className(), ['id' => 'accountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks() {
        return $this->hasMany(Book::className(), ['collectionId' => 'id'])->inverseOf('collection');
    }

}
