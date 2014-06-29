/*
Navicat MySQL Data Transfer

Source Server         : Januar Fonti
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : db_elearning

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-06-30 01:42:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_enroll
-- ----------------------------
DROP TABLE IF EXISTS `tbl_enroll`;
CREATE TABLE `tbl_enroll` (
  `id_enroll` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_mk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enroll`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_enroll
-- ----------------------------
INSERT INTO `tbl_enroll` VALUES ('29', '3', '13');
INSERT INTO `tbl_enroll` VALUES ('30', '0', '0');
INSERT INTO `tbl_enroll` VALUES ('31', '0', '0');
INSERT INTO `tbl_enroll` VALUES ('32', '0', '0');
INSERT INTO `tbl_enroll` VALUES ('33', '3', '12');
INSERT INTO `tbl_enroll` VALUES ('34', '24', '0');
INSERT INTO `tbl_enroll` VALUES ('40', '24', '16');
INSERT INTO `tbl_enroll` VALUES ('38', '24', '13');
INSERT INTO `tbl_enroll` VALUES ('39', '24', '12');

-- ----------------------------
-- Table structure for tbl_hasil
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hasil`;
CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) NOT NULL,
  `no_soal` int(11) NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `salah` int(5) NOT NULL,
  `benar` int(5) NOT NULL,
  `hasil` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hasil`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of tbl_hasil
-- ----------------------------
INSERT INTO `tbl_hasil` VALUES ('16', '13', '1', 'januarfonti', '0', '2', '100.0', null);
INSERT INTO `tbl_hasil` VALUES ('17', '13', '1', 'januarfonti', '1', '1', '50.0', null);
INSERT INTO `tbl_hasil` VALUES ('18', '13', '1', 'januarfonti', '2', '0', '0.0', null);
INSERT INTO `tbl_hasil` VALUES ('19', '13', '1', 'januarfonti', '2', '0', '0.0', null);
INSERT INTO `tbl_hasil` VALUES ('20', '13', '1', 'januarfonti', '0', '2', '100.0', null);
INSERT INTO `tbl_hasil` VALUES ('21', '13', '1', 'januarfonti', '1', '1', '50.0', '2014-06-10 17:20:15');
INSERT INTO `tbl_hasil` VALUES ('22', '13', '1', 'januarfonti', '1', '1', '50.0', '2014-06-10 17:56:41');
INSERT INTO `tbl_hasil` VALUES ('23', '13', '1', 'januarfonti', '1', '1', '50.0', '2014-06-11 23:03:16');
INSERT INTO `tbl_hasil` VALUES ('24', '13', '1', 'cahyo', '1', '1', '50.0', '2014-06-12 00:57:09');
INSERT INTO `tbl_hasil` VALUES ('25', '13', '1', 'cahyo', '0', '2', '100.0', '2014-06-17 03:13:22');

-- ----------------------------
-- Table structure for tbl_kuis
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kuis`;
CREATE TABLE `tbl_kuis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `soal` text,
  `jawaban` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_kuis
-- ----------------------------
INSERT INTO `tbl_kuis` VALUES ('1', '13', 'Soal Rekayasa Perangkat Lunak', 'Apa kepanjangan dari RPL ?', 'Rekayasa Perangkat Lunak');
INSERT INTO `tbl_kuis` VALUES ('2', '12', 'Coba', 'Coba', 'Coba');
INSERT INTO `tbl_kuis` VALUES ('3', '16', 'Soal psikologi', 'Persamaan sinting ?', 'Gila');

-- ----------------------------
-- Table structure for tbl_matkul
-- ----------------------------
DROP TABLE IF EXISTS `tbl_matkul`;
CREATE TABLE `tbl_matkul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(50) DEFAULT NULL,
  `enroll` varchar(50) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_matkul
-- ----------------------------
INSERT INTO `tbl_matkul` VALUES ('13', 'Rekayasa Perangkat Lunak', 'rpl2007', '14');
INSERT INTO `tbl_matkul` VALUES ('12', 'Sistem Terdistribusi', 'sister2007', '2');
INSERT INTO `tbl_matkul` VALUES ('16', 'Psikologi', 'psikologi2007', '23');
INSERT INTO `tbl_matkul` VALUES ('17', 'Game Production', 'gamepro2007', '25');

-- ----------------------------
-- Table structure for tbl_namasoal
-- ----------------------------
DROP TABLE IF EXISTS `tbl_namasoal`;
CREATE TABLE `tbl_namasoal` (
  `id_namasoal` int(11) NOT NULL AUTO_INCREMENT,
  `nama_soal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_namasoal`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_namasoal
-- ----------------------------
INSERT INTO `tbl_namasoal` VALUES ('1', 'Soal RPL minggu pertama');

-- ----------------------------
-- Table structure for tbl_nilai
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nilai`;
CREATE TABLE `tbl_nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_nilai
-- ----------------------------
INSERT INTO `tbl_nilai` VALUES ('1', '13', '3', '0', '2014-06-27 11:27:24');
INSERT INTO `tbl_nilai` VALUES ('2', '13', '3', '0', '2014-06-27 11:31:24');
INSERT INTO `tbl_nilai` VALUES ('3', '13', '3', '0', '2014-06-27 12:36:35');
INSERT INTO `tbl_nilai` VALUES ('4', '13', '2', '18.75', '2014-06-27 13:20:38');
INSERT INTO `tbl_nilai` VALUES ('5', '12', '2', '75', '2014-06-27 13:20:12');
INSERT INTO `tbl_nilai` VALUES ('6', '12', '3', '88.8889', '2014-06-27 13:35:35');
INSERT INTO `tbl_nilai` VALUES ('7', '12', '3', '50', '2014-06-27 13:59:21');
INSERT INTO `tbl_nilai` VALUES ('8', '12', '3', '25', '2014-06-27 14:00:36');
INSERT INTO `tbl_nilai` VALUES ('9', '13', '3', '50', '2014-06-27 14:12:50');
INSERT INTO `tbl_nilai` VALUES ('10', '13', '3', '54.5455', '2014-06-27 14:14:25');
INSERT INTO `tbl_nilai` VALUES ('11', '12', '3', '50', '2014-06-27 14:15:03');
INSERT INTO `tbl_nilai` VALUES ('12', '12', '3', '33.3333', '2014-06-27 14:15:58');
INSERT INTO `tbl_nilai` VALUES ('13', '16', '24', '100', '2014-06-27 14:42:19');
INSERT INTO `tbl_nilai` VALUES ('14', '13', '3', '89.3617', '2014-06-28 16:06:20');

-- ----------------------------
-- Table structure for tbl_soal
-- ----------------------------
DROP TABLE IF EXISTS `tbl_soal`;
CREATE TABLE `tbl_soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_matkul` int(11) DEFAULT NULL,
  `no_soal` int(11) DEFAULT NULL,
  `pertanyaan` text,
  `jwb_a` varchar(100) DEFAULT NULL,
  `jwb_b` varchar(100) DEFAULT NULL,
  `jwb_c` varchar(100) DEFAULT NULL,
  `jwb_d` varchar(100) DEFAULT NULL,
  `kunci` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_soal
-- ----------------------------
INSERT INTO `tbl_soal` VALUES ('1', '13', '1', 'Bahasa pemrograman untuk membuat website adalah', 'PHP', 'Pascal', 'Java', 'Phyton', 'a');
INSERT INTO `tbl_soal` VALUES ('2', '13', '1', 'Apa nama diagram untuk melihat alur dari data suatu program', 'Flowchart', 'Data Flow Diagram', 'Use Case', 'Sequence', 'b');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(10) DEFAULT NULL,
  `nama` varchar(70) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_user` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'Admin', 'Januar Fonti', 'januarfonti', 'januarfonti', 'Aktif', '2014-06-04 18:50:52', '2014-06-04 18:51:01');
INSERT INTO `tbl_user` VALUES ('2', 'Dosen', 'Aditya Kurniawan', 'adyt', 'adyt', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('3', 'Mahasiswa', 'Cahyo Sri Agus', 'cahyo', 'cahyo', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('4', 'Mahasiswa', 'Alfa Yazid', 'alfayazid', 'alfayazid', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('25', 'Dosen', 'Rahman Anam', 'anam', 'anam', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('14', 'Dosen', 'Gunawan Dwi Yanto', 'gunawan', 'gunawan', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('23', 'Dosen', 'Anisya', 'anisya', 'anisya', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('24', 'Mahasiswa', 'Afe Faleniko', 'afe', 'afe', 'Aktif', null, null);

-- ----------------------------
-- View structure for view_matkul
-- ----------------------------
DROP VIEW IF EXISTS `view_matkul`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_matkul` AS SELECT
tbl_matkul.nama_matkul AS nama_matkul,
tbl_matkul.enroll AS enroll,
tbl_user.nama AS nama,
tbl_matkul.id
from (`tbl_matkul` join `tbl_user` on((`tbl_user`.`id` = `tbl_matkul`.`id_dosen`))) ; ;

-- ----------------------------
-- View structure for view_namasoal
-- ----------------------------
DROP VIEW IF EXISTS `view_namasoal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `view_namasoal` AS SELECT
tbl_namasoal.nama_soal
FROM
tbl_namasoal
INNER JOIN tbl_soal ON tbl_namasoal.id_namasoal = tbl_soal.no_soal ;
