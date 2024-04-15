/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.4.22-MariaDB : Database - k_means
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`k_means` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `k_means`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`user`,`pass`) values ('admin','admin');

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`kode_alternatif`,`nama_alternatif`,`keterangan`) values ('A001','Institut Teknologi Bandung ',NULL),('A002','Universitas Gadjah Mada ',NULL),('A003','Institut Pertanian Bogor ',NULL),('A004','Universitas Indonesia ',NULL),('A005','Universitas Andalas ',NULL),('A006','Universitas Negeri Malang ',NULL),('A007','Universitas Negeri Yogyakarta ',NULL),('A008','Universitas Kristen Petra ',NULL),('A009','Politeknik Negeri Semarang ',NULL),('A010','Universitas Pendidikan Nasional ',NULL),('A011','Universitas Halu Oleo ',NULL),('A012','Universitas Sam Ratulangi ',NULL);

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`kode_kriteria`,`nama_kriteria`) values ('C01','Kualitas SDM'),('C02','Kualitas Manajemen'),('C03','Kualitas Keg Mahasiswa'),('C04','Kualitas Penelitian & Publikasi');

/*Table structure for table `tb_rel_alternatif` */

DROP TABLE IF EXISTS `tb_rel_alternatif`;

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_rel_alternatif` */

insert  into `tb_rel_alternatif`(`ID`,`kode_alternatif`,`kode_kriteria`,`nilai`) values (1,'A001','C01',3.93),(2,'A002','C01',3.99),(3,'A003','C01',4),(4,'A004','C01',3.86),(5,'A005','C01',3.61),(6,'A006','C01',3.89),(7,'A007','C01',3.74),(8,'A008','C01',3.22),(9,'A009','C01',2.84),(10,'A010','C01',3.22),(11,'A011','C01',3.53),(12,'A012','C01',3),(13,'A001','C02',3.9),(14,'A002','C02',4),(15,'A003','C02',3.9),(16,'A004','C02',3.9),(17,'A005','C02',3.6),(18,'A006','C02',3.8),(19,'A007','C02',3.5),(20,'A008','C02',3.9),(21,'A009','C02',3.4),(22,'A010','C02',3.2),(23,'A011','C02',2.2),(24,'A012','C02',3.1),(25,'A001','C03',1.9),(26,'A002','C03',4),(27,'A003','C03',1.8),(28,'A004','C03',1.6),(29,'A005','C03',0.2),(30,'A006','C03',0.3),(31,'A007','C03',0.6),(32,'A008','C03',0),(33,'A009','C03',0),(34,'A010','C03',0),(35,'A011','C03',0),(36,'A012','C03',0),(37,'A001','C04',4),(38,'A002','C04',3),(39,'A003','C04',3.1),(40,'A004','C04',3),(41,'A005','C04',1.9),(42,'A006','C04',1.4),(43,'A007','C04',1.7),(44,'A008','C04',1.7),(45,'A009','C04',0.4),(46,'A010','C04',0.2),(47,'A011','C04',0.7),(48,'A012','C04',0.4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
