
<?php

/*
 * m161124_181738_session_table_for_api.php
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

use yii\db\Migration;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
class m161124_181738_session_table_for_api extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('Session', [
            'id' => $this->bigPrimaryKey(),
            'accessToken' => $this->string()->notNull(),
            'creationDate' => $this->dateTime(),
            'valid' => 'TINYINT NOT NULL DEFAULT 0',
            'accountId' => $this->integer()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->addForeignKey('fkSessionAccount', 'Session', 'accountId', 'Account', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('Session');
    }

}
