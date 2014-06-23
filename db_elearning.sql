/*
Navicat MySQL Data Transfer

Source Server         : januarfonti
Source Server Version : 50133
Source Host           : 127.0.0.1:3306
Source Database       : db_elearning

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2014-06-10 15:55:41
*/

SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id_hasil`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of tbl_hasil
-- ----------------------------
INSERT INTO `tbl_hasil` VALUES ('16', '13', '1', 'januarfonti', '0', '2', '100.0');
INSERT INTO `tbl_hasil` VALUES ('17', '13', '1', 'januarfonti', '1', '1', '50.0');
INSERT INTO `tbl_hasil` VALUES ('18', '13', '1', 'januarfonti', '2', '0', '0.0');
INSERT INTO `tbl_hasil` VALUES ('19', '13', '1', 'januarfonti', '2', '0', '0.0');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_matkul
-- ----------------------------
INSERT INTO `tbl_matkul` VALUES ('13', 'Rekayasa Perangkat Lunak', 'rpl2007', '14');
INSERT INTO `tbl_matkul` VALUES ('12', 'Sistem Terdistribusi', 'sister2007', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'Admin', 'Januar Fonti', 'januarfonti', 'januarfonti', 'Aktif', '2014-06-04 18:50:52', '2014-06-04 18:51:01');
INSERT INTO `tbl_user` VALUES ('2', 'Dosen', 'Aditya Kurniawan', 'adyt', 'adyt', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('3', 'Mahasiswa', 'Cahyo Sri Agus', 'cahyo', 'cahyo', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('4', 'Mahasiswa', 'Alfa Yazid', 'alfayazid', 'alfayazid', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('14', 'Dosen', 'Gunawan Dwi Yanto', 'gunawan', 'gunawan', 'Aktif', null, null);

-- ----------------------------
-- View structure for view_matkul
-- ----------------------------
DROP VIEW IF EXISTS `view_matkul`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `view_matkul` AS SELECT
tbl_matkul.nama_matkul AS nama_matkul,
tbl_matkul.enroll AS enroll,
tbl_user.nama AS nama,
tbl_matkul.id
from (`tbl_matkul` join `tbl_user` on((`tbl_user`.`id` = `tbl_matkul`.`id_dosen`))) ;

-- ----------------------------
-- View structure for view_namasoal
-- ----------------------------
DROP VIEW IF EXISTS `view_namasoal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `view_namasoal` AS SELECT
tbl_namasoal.nama_soal
FROM
tbl_namasoal
INNER JOIN tbl_soal ON tbl_namasoal.id_namasoal = tbl_soal.no_soal ;
