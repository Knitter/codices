
<?php

/*
 * m161102_161831_adds_account_id_to_series.php
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
class m161102_161831_adds_account_id_to_series extends Migration {
    
    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn('Series', 'accountId', $this->integer()->notNull());
        $this->addForeignKey('fkSeriesAccoun', 'Series', 'accountId', 'Account', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        echo "m161102_161831_adds_account_id_to_series cannot be reverted.\n";
        return false;
    }
}
