-- m161006_165508_init_schema.sql
--
-- Small book management software.
-- Copyright (C) 2016 Sérgio Lopes (knitter.is@gmail.com)
-- 
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU Affero General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
-- 
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU Affero General Public License for more details.
-- 
-- You should have received a copy of the GNU Affero General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>. 
-- (c) 2016 Sérgio Lopes
-- 
CREATE TABLE `Account` (
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`name` VARCHAR( 255 ) NOT NULL UNIQUE ,
`email` VARCHAR( 255 ) NOT NULL UNIQUE ,
`password` VARCHAR( 255 ) NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

CREATE TABLE `Collection` ( 
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`name` => $this->string()->notNull(),
`bookCount` => $this->integer(),
`accountId` => $this->integer()->notNull() ,
CONSTRAINT `fkCollectionAccount` FOREIGN KEY (`accountId`) REFERENCES `Account`(`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
        
CREATE TABLE `Author` ( 
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`name` VARCHAR( 255 ) NOT NULL ,
`biography` VARCHAR( 255 ) ,
`url` => VARCHAR( 255 ) ,
`photo` => VARCHAR( 255 ) 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

CREATE TABLE `Series` ( 
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`name` VARCHAR( 255 ) NOT NULL ,
`complete` INT ,
`bookCount` INT
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

CREATE TABLE `Book` ( 
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`title` VARCHAR( 255 ) NOT NULL ,
`plot` TEXT,
`isbn` VARCHAR( 25 ) ,
`format` VARCHAR( 5 ) ,
`pageCount` INT ,
`publicationDate` DATE ,
`addedOn` DATETIME ,
`language` VARCHAR( 255 ) ,
`edition` VARCHAR( 255 ) ,
`publisher` VARCHAR( 255 ) ,
`rating` FLOAT ,
`read` TINYINT NOT NULL DEFAULT 0 ,
`url` VARCHAR( 255 ) ,
`review` TEXT ,
`cover` VARCHAR( 255 ) ,
`order` INT ,
`seriesId` INT ,
`accountId` INT NOT NULL ,
CONSTRAINT `fkBookSeries` FOREIGN KEY (`seriesId`) REFERENCES `Series`(`id`) ,
CONSTRAINT `fkBookAccount` FOREIGN KEY (`accountId`) REFERENCES `Account`(`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

CREATE TABLE `BookAuthor` ( 
`bookId` INT NOT NULL ,
`authorId` INT NOT NULL ,
PRIMARY KEY(`bookId`, `authorId`) ,
CONSTRAINT `fkBookAuthorBook` FOREIGN KEY (`bookId`) REFERENCES `Book`(`id`) ,
CONSTRAINT `fkBookAuthorAuthor` FOREIGN KEY (`authorId`) REFERENCES `Author`(`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
        
CREATE TABLE `BookCollection` ( 
`bookId` INT NOT NULL ,
`collectionId` INT NOT NULL ,
PRIMARY KEY(`bookId`, `collectionId`) ,
CONSTRAINT `fkBookCollectionBook` FOREIGN KEY (`bookId`) REFERENCES `Book`(`id`) ,
CONSTRAINT `fkBookCollectionCollection` FOREIGN KEY (`collectionId`) REFERENCES `Collection`(`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

