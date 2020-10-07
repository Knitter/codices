
<?php

/**
 * m161006_165508_init_schema.php
 */
use yii\db\Migration;

class m161006_165508_init_schema extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('Account', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');

        $this->createTable('Collection', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'bookCount' => $this->integer(),
            'accountId' => $this->integer()->notNull()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->addForeignKey('fkCollectionAccount', 'Collection', 'accountId', 'Account', 'id');

        $this->createTable('Author', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'biography' => $this->string(),
            'url' => $this->string(),
            'photo' => $this->string()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');

        $this->createTable('Series', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'complete' => $this->integer(),
            'bookCount' => $this->integer()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');

        $this->createTable('Book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'plot' => $this->text(),
            'isbn' => $this->string(25),
            'format' => $this->string(5),
            'pageCount' => $this->integer(),
            'publicationDate' => $this->date(),
            'addedOn' => $this->dateTime(),
            'language' => $this->string(),
            'edition' => $this->string(),
            'publisher' => $this->string(),
            'rating' => $this->float(),
            'read' => 'TINYINT NOT NULL DEFAULT 0',
            'url' => $this->string(),
            'review' => $this->text(),
            'cover' => $this->string(),
            'order' => $this->integer(),
            'seriesId' => $this->integer(),
            'accountId' => $this->integer()->notNull()
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->addForeignKey('fkBookSeries', 'Book', 'seriesId', 'Series', 'id');
        $this->addForeignKey('fkBookAccount', 'Book', 'accountId', 'Account', 'id');

        $this->createTable('BookAuthor', [
            'bookId' => $this->integer()->notNull(),
            'authorId' => $this->integer()->notNull(),
            'PRIMARY KEY(bookId, authorId)'
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->addForeignKey('fkBookAuthorBook', 'BookAuthor', 'bookId', 'Book', 'id');
        $this->addForeignKey('fkBookAuthorAuthor', 'BookAuthor', 'authorId', 'Author', 'id');

        $this->createTable('BookCollection', [
            'bookId' => $this->integer()->notNull(),
            'collectionId' => $this->integer()->notNull(),
            'PRIMARY KEY(bookId, collectionId)'
                ], 'ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->addForeignKey('fkBookCollectionBook', 'BookCollection', 'bookId', 'Book', 'id');
        $this->addForeignKey('fkBookCollectionCollection', 'BookCollection', 'collectionId', 'Collection', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        
        $this->dropTable('BookCollection');
        $this->dropTable('BookAuthor');
        $this->dropTable('Book');
        $this->dropTable('Series');
        $this->dropTable('Author');
        $this->dropTable('Collection');
        $this->dropTable('Account');
    }

}
