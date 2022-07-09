<?php

/**
 * m220524_000923_init_schema.php
 */

use yii\db\Migration;

class m220524_000923_init_schema extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('Account', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'active' => $this->boolean()->notNull(),
            'email' => $this->string(),
            'password' => $this->string()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');

        $this->createTable('Author', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
            'surname' => $this->string(),
            'biography' => $this->text(),
            'website' => $this->string(),
            'photo' => $this->string()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');

        $this->createTable('Genre', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');

        $this->createTable('Publisher', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
            'summary' => $this->string(),
            'website' => $this->string(),
            'logo' => $this->string()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkCollectionAccount', 'Collection', 'accountId', 'Account', 'id');

        $this->createTable('Series', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
            'finished' => $this->boolean()->notNull(),
            'bookCount' => $this->integer(),
            'ownedCount' => $this->integer()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkCollectionAccount', 'Collection', 'accountId', 'Account', 'id');

        $this->createTable('Collection', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
            'publishYear' => $this->integer(),
            'bookCount' => $this->integer(),
            'ownedCount' => $this->integer()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkCollectionAccount', 'Collection', 'accountId', 'Account', 'id');

        $this->createTable('Book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'ownedById' => $this->integer()->notNull(),
            'translated' => $this->boolean()->notNull(),
            'favorite' => $this->boolean()->notNull(),
            'read' => $this->boolean()->notNull(),
            'copies' => $this->integer()->notNull(),
            'subTitle' => $this->string(),
            'originalTitle' => $this->string(),
            'plot' => $this->text(),
            'isbn' => $this->string(25),
            'format' => $this->string(5),
            'pageCount' => $this->integer(),
            'publishDate' => $this->date(),
            'publishYear' => $this->integer(),
            'addedOn' => $this->dateTime(),
            'language' => $this->string(),
            'translatedIn' => $this->string(),
            'edition' => $this->string(),
            'publisherId' => $this->integer(),
            'rating' => $this->float(),
            'ownRating' => $this->float(),
            'url' => $this->string(),
            'review' => $this->text(),
            'cover' => $this->string(),
            'filename' => $this->string(),
            'orderInSeries' => $this->integer(),
            'seriesId' => $this->integer(),
            'duplicatesBookdId' => $this->integer()
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkBookSeries', 'Book', 'seriesId', 'Series', 'id');
        //$this->addForeignKey('fkBookAccount', 'Book', 'accountId', 'Account', 'id');

        $this->createTable('BookGenre', [
            'bookId' => $this->integer()->notNull(),
            'genreId' => $this->integer()->notNull(),
            'PRIMARY KEY(bookId, genreId)'
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');

        $this->createTable('BookAuthor', [
            'bookId' => $this->integer()->notNull(),
            'authorId' => $this->integer()->notNull(),
            'illustrator' => $this->boolean()->notNull(),
            'PRIMARY KEY(bookId, authorId)'
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkBookAuthorBook', 'BookAuthor', 'bookId', 'Book', 'id');
        //$this->addForeignKey('fkBookAuthorAuthor', 'BookAuthor', 'authorId', 'Author', 'id');

        $this->createTable('BookCollection', [
            'bookId' => $this->integer()->notNull(),
            'collectionId' => $this->integer()->notNull(),
            'PRIMARY KEY(bookId, collectionId)'
        ], 'ENGINE = InnoDB COLLATE utf8mb4_general_ci');
        //$this->addForeignKey('fkBookCollectionBook', 'BookCollection', 'bookId', 'Book', 'id');
        //$this->addForeignKey('fkBookCollectionCollection', 'BookCollection', 'collectionId', 'Collection', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('BookCollection');
        $this->dropTable('BookAuthor');
        $this->dropTable('BookGenre');
        $this->dropTable('Book');
        $this->dropTable('Collection');
        $this->dropTable('Series');
        $this->dropTable('Publisher');
        $this->dropTable('Genre');
        $this->dropTable('Author');
        $this->dropTable('Account');
    }
}
