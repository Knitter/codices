<?php

/**
 * migration.php
 */

/* @var $className string the new migration class name */
?>

<?= "<?php\n" ?>

/**
 * <?= $className ?>.php
 */

use yii\db\Migration;

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
