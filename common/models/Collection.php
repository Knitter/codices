<?php

/*
 * Collection.php
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
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * A collection of books can be defined by a user, as a way to organize the list of books, or officially released by a
 * publisher, e.g. as part of a campaign or promotional event, etc.
 *
 * @property int                    $id          PK, record ID, auto-increment
 * @property string                 $name        Collection name
 * @property int                    $ownedById   FK, user account the record belongs to
 * @property int|null               $publishYear Publishing year, for collections created by publishers or authors,
 *           special events, etc.
 * @property int|null               $bookCount   Total number of books that are in the collection
 * @property int|null               $ownedCount  Number of currently owned books that belong to this collection
 *
 * @property \common\models\Account $owner
 *
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Collection extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName(): string {
        return '{{Collection}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return [
            'name' => Yii::t('codices', 'Name'),
            'publishYear' => Yii::t('codices', 'Year'),
            'bookCount' => Yii::t('codices', 'No. of Books'),
            'ownedCount' => Yii::t('codices', 'No. of Owned Books')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner(): ActiveQuery {
        return $this->hasOne(Account::class, ['id' => 'accountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getBooks(): ActiveQuery {
        return $this->hasMany(Book::class, ['id' => 'bookId'])
            ->viaTable('{{BookCollection}}', ['collectionId' => 'id']);
    }
}