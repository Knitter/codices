<?php

/*
 * Author.php
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
 * @property int                    $id        PK, record ID, auto-increment
 * @property string                 $name      Author's first name
 * @property int                    $ownedById FK, user account the record belongs to
 * @property string|null            $surname   Author's last name
 * @property string|null            $biography Short biography
 * @property string|null            $website   Website URL address
 * @property string|null            $photo     Author's photo, partial file path/name that needs to be merged with
 *           system settings for full path or URL
 *
 * @property \common\models\Account $owner
 *
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Author extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName(): string {
        return '{{Author}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return [
            'name' => Yii::t('codices', 'Name'),
            'surname' => Yii::t('codices', 'Surname'),
            'biography' => Yii::t('codices', 'Biography'),
            'website' => Yii::t('codices', 'Website'),
            'photo' => Yii::t('codices', 'Photo')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner(): ActiveQuery {
        return $this->hasOne(Account::class, ['id' => 'ownedById']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getBooks(): ActiveQuery {
        $this->hasMany(Book::class, ['id' => 'bookId'])
            ->viaTable('{{BookAuthor}}', ['authorId' => 'id']);
    }
}