-- m161124_181738_session_table_for_api.sql
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
CREATE TABLE `Session` (
`id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`accessToken` VARCHAR( 255 ) NOT NULL ,
`creationDate` DATETIME ,
`valid` TINYINT NOT NULL DEFAULT 0 ,
`accountId` INT ,
CONSTRAINT `fkSessionAccount` FOREIGN KEY (`accountId`) REFERENCES `Account`(`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci ;