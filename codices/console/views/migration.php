<?php

/**
 * migration.php
 */

/* @var $className string the new migration class name */
?>

<?= "<?php\n" ?>

/*
 * <?= $className ?>.php
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
class <?= $className ?> extends Migration {
    
    /**
     * @inheritdoc
     */
    public function up() {
    }

    /**
     * @inheritdoc
     */
    public function down() {
        echo "<?= $className ?> cannot be reverted.\n";
        return false;
    }

    // Use safeUp/safeDown to run migration code within a transaction
    // /**
    //  * @inheritdoc
    //  */
    // public function safeUp() {
    // }
    
    // /**
    //  * @inheritdoc
    //  */
    // public function safeDown() {
    // }
}
