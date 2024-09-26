/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.32-MariaDB : Database - testespassu
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`testespassu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `testespassu`;

/*Table structure for table `assunto` */

DROP TABLE IF EXISTS `assunto`;

CREATE TABLE `assunto` (
  `CodAs` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`CodAs`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Table structure for table `autor` */

DROP TABLE IF EXISTS `autor`;

CREATE TABLE `autor` (
  `CodAu` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(40) NOT NULL,
  PRIMARY KEY (`CodAu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Table structure for table `livro` */

DROP TABLE IF EXISTS `livro`;

CREATE TABLE `livro` (
  `Cod` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(40) DEFAULT NULL,
  `Editora` varchar(40) DEFAULT NULL,
  `Edicao` int(11) DEFAULT NULL,
  `AnoPublicacao` varchar(4) DEFAULT NULL,
  `Preco` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Cod`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Table structure for table `livro_assunto` */

DROP TABLE IF EXISTS `livro_assunto`;

CREATE TABLE `livro_assunto` (
  `Livro_Cod` int(11) NOT NULL,
  `Assunto_CodAs` int(11) NOT NULL,
  KEY `Livro_Assunto_FKIndex1` (`Livro_Cod`),
  KEY `Livro_Assunto_FKIndex2` (`Assunto_CodAs`),
  CONSTRAINT `Livro_Assunto_FKIndex1` FOREIGN KEY (`Livro_Cod`) REFERENCES `livro` (`Cod`),
  CONSTRAINT `Livro_Assunto_FKIndex2` FOREIGN KEY (`Assunto_codAs`) REFERENCES `assunto` (`CodAs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Table structure for table `livro_autor` */

DROP TABLE IF EXISTS `livro_autor`;

CREATE TABLE `livro_autor` (
  `Livro_Cod` int(11) NOT NULL,
  `Autor_CodAu` int(11) NOT NULL,
  KEY `Livro_Autor_FKIndex1` (`Livro_Cod`),
  KEY `Livro_Autor_FKIndex2` (`Autor_CodAu`),
  CONSTRAINT `Livro_Autor_FKIndex1` FOREIGN KEY (`Livro_Cod`) REFERENCES `livro` (`Cod`),
  CONSTRAINT `Livro_Autor_FKIndex2` FOREIGN KEY (`Autor_CodAu`) REFERENCES `autor` (`CodAu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Table structure for table `vw_lista_livros` */
/*!50001 DROP TABLE IF EXISTS `vw_lista_livros` */;
DROP VIEW IF EXISTS `vw_lista_livros`;
CREATE ALGORITHM=UNDEFINED DEFINER=`TesteSpassu`@`%` SQL SECURITY DEFINER VIEW `vw_lista_livros` AS select distinct `l`.`Cod` AS `Cod`,`l`.`Titulo` AS `Titulo`,`l`.`Editora` AS `Editora`,`l`.`Edicao` AS `Edicao`,`l`.`AnoPublicacao` AS `AnoPublicacao`,`l`.`Preco` AS `Preco`,`assu`.`Assunto_CodAs` AS `Assunto_CodAs`,`assunto`.`Descricao` AS `Descricao` from ((`livro` `l` left join `livro_assunto` `assu` on(`l`.`Cod` = `assu`.`Livro_Cod`)) left join `assunto` on(`assunto`.`CodAs` = `assu`.`Assunto_CodAs`));

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
