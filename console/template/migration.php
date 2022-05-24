<?php

/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace $namespace;\n";
}
?>

use yii\db\Migration;

/**
 * Class <?= $className . "\n" ?>
 */
final class <?= $className ?> extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "<?= $className ?> cannot be reverted.\n";
        return false;
    }
}
