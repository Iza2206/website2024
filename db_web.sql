/*
 Navicat Premium Data Transfer

 Source Server         : Website RSUD
 Source Server Type    : MySQL
 Source Server Version : 80039 (8.0.39-0ubuntu0.20.04.1)
 Source Host           : localhost:3306
 Source Schema         : db_web

 Target Server Type    : MySQL
 Target Server Version : 80039 (8.0.39-0ubuntu0.20.04.1)
 File Encoding         : 65001

 Date: 25/10/2024 10:41:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dt_addsubspesialis
-- ----------------------------
DROP TABLE IF EXISTS `dt_addsubspesialis`;
CREATE TABLE `dt_addsubspesialis`  (
  `id_addsubspesialis` int NOT NULL AUTO_INCREMENT,
  `kd_addsubspesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_subspesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_addsubspesialis`) USING BTREE,
  INDEX `idx_kd_addklinik`(`kd_klinik` ASC) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  INDEX `idx_kd_subspesialis`(`kd_subspesialis` ASC) USING BTREE,
  CONSTRAINT `fk_addsubspesialis_dokterdetail` FOREIGN KEY (`kd_dokterdetail`) REFERENCES `dt_dokterdetail` (`kd_dokterdetail`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_addsubspesialis_klinik` FOREIGN KEY (`kd_klinik`) REFERENCES `dt_klinik` (`kd_klinik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_addsubspesialis_subspesialis` FOREIGN KEY (`kd_subspesialis`) REFERENCES `dt_subspesialis` (`kd_subspesialis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_addsubspesialis
-- ----------------------------
INSERT INTO `dt_addsubspesialis` VALUES (1, 'lKBt', 'U8IA', 'PbMt', 'TIsD', '2024-10-17 11:41:25');
INSERT INTO `dt_addsubspesialis` VALUES (2, 'MjRW', 'U8IA', 'PbMt', 'KYpH', '2024-10-17 11:55:21');
INSERT INTO `dt_addsubspesialis` VALUES (3, 'eBoQ', 'aKG8', 'V5Ee', 'mP2I', '2024-10-21 10:35:17');

-- ----------------------------
-- Table structure for dt_bidangkeahlian
-- ----------------------------
DROP TABLE IF EXISTS `dt_bidangkeahlian`;
CREATE TABLE `dt_bidangkeahlian`  (
  `id_bidangkeahlian` int NOT NULL AUTO_INCREMENT,
  `kd_bidangkeahlian` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_subspesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_bidangkeahlian` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bidangkeahlian`) USING BTREE,
  INDEX `idx_kd_bidangkeahlian`(`kd_bidangkeahlian` ASC) USING BTREE,
  INDEX `fk_kd_klinik_new`(`kd_klinik` ASC) USING BTREE,
  INDEX `fk_kd_subspesialis_new`(`kd_subspesialis` ASC) USING BTREE,
  CONSTRAINT `fk_kd_klinik_new` FOREIGN KEY (`kd_klinik`) REFERENCES `dt_klinik` (`kd_klinik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kd_subspesialis_new_v2` FOREIGN KEY (`kd_subspesialis`) REFERENCES `dt_subspesialis` (`kd_subspesialis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_bidangkeahlian
-- ----------------------------
INSERT INTO `dt_bidangkeahlian` VALUES (14, '1XjP', 'aKG8', 'mP2I', 'Gastrointestinal (GI) Tract', '2024-10-17 09:43:03');
INSERT INTO `dt_bidangkeahlian` VALUES (15, 'DTwi', 'aKG8', 'mP2I', 'Hepatologi', '2024-10-17 09:43:29');
INSERT INTO `dt_bidangkeahlian` VALUES (16, '8eDV', 'U8IA', 'TIsD', 'Pertumbuhan dan Perkembangan', '2024-10-17 11:19:03');
INSERT INTO `dt_bidangkeahlian` VALUES (17, 'gBfZ', 'U8IA', 'TIsD', 'Vaksinasi', '2024-10-17 11:19:10');
INSERT INTO `dt_bidangkeahlian` VALUES (18, 'R9C8', 'U8IA', 'TIsD', 'Nutrisi Anak', '2024-10-17 11:19:17');
INSERT INTO `dt_bidangkeahlian` VALUES (19, 'CtiZ', 'U8IA', 'TIsD', 'Pencegahan Penyakit', '2024-10-17 11:19:30');
INSERT INTO `dt_bidangkeahlian` VALUES (20, '3OoB', 'U8IA', 'RWTn', 'Gangguan Pertumbuhan', '2024-10-19 15:09:00');
INSERT INTO `dt_bidangkeahlian` VALUES (21, 'w6xD', 'U8IA', 'RWTn', 'Diabetes Melitus pada Anak', '2024-10-19 15:09:05');
INSERT INTO `dt_bidangkeahlian` VALUES (22, 'dvZC', 'U8IA', 'RWTn', 'Masalah Pubertas', '2024-10-19 15:09:11');
INSERT INTO `dt_bidangkeahlian` VALUES (23, 'zTZE', 'U8IA', 'RWTn', 'Gangguan Tiroid', '2024-10-19 15:09:16');
INSERT INTO `dt_bidangkeahlian` VALUES (24, 'YSWQ', 'U8IA', 'RWTn', 'Masalah Hormonal Terkait Berat Badan', '2024-10-19 15:09:21');
INSERT INTO `dt_bidangkeahlian` VALUES (25, 'bIco', 'U8IA', 'RWTn', 'Gangguan Adrenal', '2024-10-19 15:09:28');

-- ----------------------------
-- Table structure for dt_commentnews
-- ----------------------------
DROP TABLE IF EXISTS `dt_commentnews`;
CREATE TABLE `dt_commentnews`  (
  `id_commentnews` int NOT NULL AUTO_INCREMENT,
  `kd_commentnews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_news` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_commentnews` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_commentnews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi_commentnews` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentnews`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_commentnews
-- ----------------------------
INSERT INTO `dt_commentnews` VALUES (1, 'M6uf', 'EKjT', 'izatunnisa', 'izatunnisa06@gmail.com', 'fasdfasdf', '2024-10-10 03:58:01');
INSERT INTO `dt_commentnews` VALUES (2, 'ine1', 'EKjT', 'dvfdsg', 'izatunnisa06@gmail.com', 'sfasf sfadf', '2024-10-10 03:59:44');
INSERT INTO `dt_commentnews` VALUES (3, 'ey54', 'EKjT', 'amal', 'amal@gmail.com', 'djifhds dsfijghds fdasjofh dfjohsd dfgjhds', '2024-10-10 04:02:28');
INSERT INTO `dt_commentnews` VALUES (4, 'KjCN', 'EKjT', 'amal', 'amal@gmail.com', 'djifhds dsfijghds fdasjofh dfjohsd dfgjhds', '2024-10-10 04:02:30');
INSERT INTO `dt_commentnews` VALUES (5, 'y0LJ', 'EKjT', 'amal', 'amal@gmail.com', 'djifhds dsfijghds fdasjofh dfjohsd dfgjhds', '2024-10-10 04:02:31');
INSERT INTO `dt_commentnews` VALUES (6, 'USun', 'EKjT', 'amal', 'amal@gmail.com', 'djifhds dsfijghds fdasjofh dfjohsd dfgjhds', '2024-10-10 04:02:31');
INSERT INTO `dt_commentnews` VALUES (7, 'jK1d', 'EKjT', 'amal', 'amal@gmail.com', 'djifhds dsfijghds fdasjofh dfjohsd dfgjhds', '2024-10-10 04:02:31');
INSERT INTO `dt_commentnews` VALUES (8, '9TWD', 'EKjT', 'beni', 'beni@gmail.com', 'kfngjvsd dsjogkhfsd fijdusg', '2024-10-10 04:04:38');

-- ----------------------------
-- Table structure for dt_crousel
-- ----------------------------
DROP TABLE IF EXISTS `dt_crousel`;
CREATE TABLE `dt_crousel`  (
  `id_crousel` int NOT NULL AUTO_INCREMENT,
  `kd_crousel` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_crousel` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_crousel` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_crousel` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_crousel`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_crousel
-- ----------------------------
INSERT INTO `dt_crousel` VALUES (1, 'Jywd', 'contoh 2.jpg', '-', 'Aktif');
INSERT INTO `dt_crousel` VALUES (2, 'RyuX', 'CAROUSEL STUNTING II.jpg', '-', 'Aktif');
INSERT INTO `dt_crousel` VALUES (3, 'jy9Z', 'CAROUSEL PSC.jpg', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (4, 'SKW9', 'CAROUSEL HUT RI.jpg', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (5, 'JjVg', 'CAROUSEL BEROBAT JALAN GRATIS.jpg', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (6, 'e37m', 'banner_new_ds_sehat.jpg', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (10, 'iQ8W', 'Nude Playful Happy Birthday Facebook Post.png', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (11, 'od15', 'download.jpeg', '-', 'Non-aktif');
INSERT INTO `dt_crousel` VALUES (12, 'zqA3', 'New Wireframe 1.png', '-', 'Aktif');
INSERT INTO `dt_crousel` VALUES (13, 'EtbT', 'CAROUSEL STUNTING.jpg', '-', 'Non-aktif');

-- ----------------------------
-- Table structure for dt_dokterbidangkeahlian
-- ----------------------------
DROP TABLE IF EXISTS `dt_dokterbidangkeahlian`;
CREATE TABLE `dt_dokterbidangkeahlian`  (
  `id_dokterbidangkeahlian` int NOT NULL AUTO_INCREMENT,
  `kd_dokterbidangkeahlian` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_dokterbidangkeahlian` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dokterbidangkeahlian`) USING BTREE,
  INDEX `idx_kd_dokterbidangkeahlian`(`kd_dokterbidangkeahlian` ASC) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  CONSTRAINT `fk_bidangkeahlian` FOREIGN KEY (`kd_dokterbidangkeahlian`) REFERENCES `dt_bidangkeahlian` (`kd_bidangkeahlian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dokterdetail_bidangkeahlian` FOREIGN KEY (`kd_dokterdetail`) REFERENCES `dt_dokterdetail` (`kd_dokterdetail`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_dokterbidangkeahlian
-- ----------------------------

-- ----------------------------
-- Table structure for dt_dokterdetail
-- ----------------------------
DROP TABLE IF EXISTS `dt_dokterdetail`;
CREATE TABLE `dt_dokterdetail`  (
  `id_dokterdetail` int NOT NULL AUTO_INCREMENT,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_spesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_dokterdetail` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_dokterdetail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_jeniskelamin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dokterdetail`) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  INDEX `fk_jeniskelamin`(`kd_jeniskelamin` ASC) USING BTREE,
  INDEX `fk_klinik`(`kd_klinik` ASC) USING BTREE,
  INDEX `fk_spesialis`(`kd_spesialis` ASC) USING BTREE,
  CONSTRAINT `fk_jeniskelamin` FOREIGN KEY (`kd_jeniskelamin`) REFERENCES `dt_jeniskelamin` (`kd_jeniskelamin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_klinik` FOREIGN KEY (`kd_klinik`) REFERENCES `dt_klinik` (`kd_klinik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_spesialis` FOREIGN KEY (`kd_spesialis`) REFERENCES `dt_spesialis` (`kd_spesialis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_dokterdetail
-- ----------------------------
INSERT INTO `dt_dokterdetail` VALUES (5, '6Tl3', '8MQg', 'dr. M. Isa Anshari, Sp.PD', '6Tl3.png', 'DC7h', 'aKG8', '2024-10-16 10:39:32');
INSERT INTO `dt_dokterdetail` VALUES (6, 'V5Ee', '8MQg', 'dr. Wirandi Dalimunthe, M.Ked(PD), Sp.PD', 'V5Ee.png', 'DC7h', 'aKG8', '2024-10-16 10:54:13');
INSERT INTO `dt_dokterdetail` VALUES (7, 'PbMt', 'fw6M', 'dr. Dwi Herawati, Sp.A', 'PbMt.png', '41lh', 'U8IA', '2024-10-17 11:08:56');

-- ----------------------------
-- Table structure for dt_dokterjadwal
-- ----------------------------
DROP TABLE IF EXISTS `dt_dokterjadwal`;
CREATE TABLE `dt_dokterjadwal`  (
  `id_dokterjadwal` int NOT NULL AUTO_INCREMENT,
  `kd_dokterjadwal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_hari` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_awal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_akhir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kd_MasterjamPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dokterjadwal`) USING BTREE,
  INDEX `idx_kd_dokterjadwal`(`kd_dokterjadwal` ASC) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  INDEX `idx_kd_hari`(`kd_hari` ASC) USING BTREE,
  INDEX `fk_masterjam_jadwal`(`kd_MasterjamPP` ASC) USING BTREE,
  CONSTRAINT `fk_dokterdetail_jadwal` FOREIGN KEY (`kd_dokterdetail`) REFERENCES `dt_dokterdetail` (`kd_dokterdetail`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hari_jadwal` FOREIGN KEY (`kd_hari`) REFERENCES `dt_hari` (`kd_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_masterjam_jadwal` FOREIGN KEY (`kd_MasterjamPP`) REFERENCES `dt_masterjampp` (`kd_MasterjamPP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_dokterjadwal
-- ----------------------------
INSERT INTO `dt_dokterjadwal` VALUES (1, 'y3Fg', 'V5Ee', '5w8R', '08:00', '14:00', '2024-10-16 10:57:24', 'zFSY');
INSERT INTO `dt_dokterjadwal` VALUES (2, 'nkQd', 'V5Ee', '5w8R', '15:00', '17:00', '2024-10-16 10:57:42', '9LoM');
INSERT INTO `dt_dokterjadwal` VALUES (3, 'felC', 'V5Ee', '7odN', '08:00', '14:00', '2024-10-16 10:57:58', 'zFSY');
INSERT INTO `dt_dokterjadwal` VALUES (4, 'xX9w', 'V5Ee', 'B3we', '15:00', '17:00', '2024-10-16 10:58:12', '9LoM');
INSERT INTO `dt_dokterjadwal` VALUES (5, 'QtK0', '6Tl3', '7odN', '15:00', '17:00', '2024-10-16 11:24:52', '9LoM');
INSERT INTO `dt_dokterjadwal` VALUES (6, 'zx9A', '6Tl3', 'B3we', '08:00', '14:00', '2024-10-16 11:25:50', 'zFSY');
INSERT INTO `dt_dokterjadwal` VALUES (7, 'horf', '6Tl3', 'XfW2', '08:00', '14:00', '2024-10-16 11:26:13', 'zFSY');
INSERT INTO `dt_dokterjadwal` VALUES (8, '37Fl', 'PbMt', '7odN', '14:00', '16:00', '2024-10-17 12:10:13', '9LoM');
INSERT INTO `dt_dokterjadwal` VALUES (9, '14RS', 'PbMt', 'XfW2', '14:00', '16:00', '2024-10-17 12:10:59', '9LoM');
INSERT INTO `dt_dokterjadwal` VALUES (10, 'bBKi', 'PbMt', 'TCMc', '08:00', '14:00', '2024-10-17 12:11:15', 'zFSY');
INSERT INTO `dt_dokterjadwal` VALUES (11, 'IL7J', 'PbMt', 'y8bx', '08:00', '14:00', '2024-10-17 12:11:37', 'zFSY');

-- ----------------------------
-- Table structure for dt_dokterprestasi
-- ----------------------------
DROP TABLE IF EXISTS `dt_dokterprestasi`;
CREATE TABLE `dt_dokterprestasi`  (
  `id_dokterprestasi` int NOT NULL AUTO_INCREMENT,
  `kd_dokterprestasi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_dokterprestasi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dokterprestasi`) USING BTREE,
  INDEX `idx_kd_dokterprestasi`(`kd_dokterprestasi` ASC) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  CONSTRAINT `fk_dokterdetail_dokterprestasi` FOREIGN KEY (`kd_dokterdetail`) REFERENCES `dt_dokterdetail` (`kd_dokterdetail`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_dokterprestasi
-- ----------------------------
INSERT INTO `dt_dokterprestasi` VALUES (1, 'vpg8', '6Tl3', 'dokter muda terbaik ', '2024-10-16 11:56:06');
INSERT INTO `dt_dokterprestasi` VALUES (2, 'ZiMJ', 'V5Ee', 'Penghargaan Penelitian dan Inovasi', '2024-10-19 15:27:42');
INSERT INTO `dt_dokterprestasi` VALUES (3, 'gCL6', 'V5Ee', 'Publikasi Ilmiah di Jurnal Ternama', '2024-10-19 15:27:47');
INSERT INTO `dt_dokterprestasi` VALUES (4, 'igwh', 'PbMt', 'Dokter Teladan', '2024-10-19 15:28:06');
INSERT INTO `dt_dokterprestasi` VALUES (5, '3KwF', 'PbMt', 'Penghargaan Layanan Kemanusiaan', '2024-10-19 15:28:11');
INSERT INTO `dt_dokterprestasi` VALUES (6, '3QMI', 'PbMt', 'Posisi Kepemimpinan dalam Lembaga Kesehatan', '2024-10-19 15:28:17');

-- ----------------------------
-- Table structure for dt_dokterriwayatpendidikan
-- ----------------------------
DROP TABLE IF EXISTS `dt_dokterriwayatpendidikan`;
CREATE TABLE `dt_dokterriwayatpendidikan`  (
  `id_dokterriwayatpendidikan` int NOT NULL AUTO_INCREMENT,
  `kd_dokterriwayatpendidikan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_dokterdetail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_riwayatpendidikan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_univ` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahunmasuk` year NOT NULL,
  `tahunkeluar` year NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dokterriwayatpendidikan`) USING BTREE,
  INDEX `idx_kd_dokterriwayatpendidikan`(`kd_dokterriwayatpendidikan` ASC) USING BTREE,
  INDEX `idx_kd_dokterdetail`(`kd_dokterdetail` ASC) USING BTREE,
  INDEX `fk_riwayatpendidikan`(`kd_riwayatpendidikan` ASC) USING BTREE,
  CONSTRAINT `fk_dokterdetail_riwayatpendidikan` FOREIGN KEY (`kd_dokterdetail`) REFERENCES `dt_dokterdetail` (`kd_dokterdetail`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_riwayatpendidikan` FOREIGN KEY (`kd_riwayatpendidikan`) REFERENCES `dt_riwayatpendidikan` (`kd_riwayatpendidikan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_dokterriwayatpendidikan
-- ----------------------------
INSERT INTO `dt_dokterriwayatpendidikan` VALUES (2, 'YWz6', 'PbMt', 'ZVkC', 'USU', 2008, 2012, '2024-10-17 11:09:38');

-- ----------------------------
-- Table structure for dt_employeex
-- ----------------------------
DROP TABLE IF EXISTS `dt_employeex`;
CREATE TABLE `dt_employeex`  (
  `id_EmployeEx` int NOT NULL AUTO_INCREMENT,
  `kd_EmployeEx` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul_EmployeEx` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_EmployeEx` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_EmployeEx` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_EmployeEx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_employeex
-- ----------------------------
INSERT INTO `dt_employeex` VALUES (2, 'sPBA', 'Peagawai teladan bulan september tahun 2024', 'safsafsafasf\r\nPemberian Penghargaan kepada pegawai teladan oleh Bapak Direktur dr. Hanip Fahri, MM, M.Ked(KJ), Sp.KJ. Penghargaan ini diberikan kepada Tetty Samaria Sitepu (Staf Radiologi)', 'bd850ba8cd56f45aabd9a6aca5e9c63a.jpg', '2024-09-20 12:14:53');
INSERT INTO `dt_employeex` VALUES (3, 'l3IX', 'Pegawai teladan bulan oktobertahun 2024', 'dr. Hanip Fahri, MM, M.Ked(KJ), Sp.KJ. Penghargaan ini diberikan kepada Tetty Samaria Sitepu (Staf Radiologi)', '6843ab2734040245527b4f1bead32c90.jpg', '2024-09-20 12:26:06');
INSERT INTO `dt_employeex` VALUES (4, 'wlgR', 'Pegawai Teladan bulan 11 2023', 'dfsdgfgh pegawai teladan oleh Bapak Direktur dr. Hanip Fahri, MM, M.Ked(KJ), Sp.KJ. Penghargaan ini diberikan kepada Tetty Samaria Sitepu (Staf Radiologi)', 'download (2).jpeg', '2024-09-20 16:09:22');
INSERT INTO `dt_employeex` VALUES (5, 'foxq', 'Pegawai Teladan bulan 7 2023', 'dr. Hanip Fahri, MM, M.Ked(KJ), Sp.KJ. Penghargaan ini diberikan kepada Tetty Samaria Sitepu (Staf Radiologi)', 'Flexfree_Clinic_Mengenal_Lebih_Dekat_Dengan_Rehab_Medik_UYLw9.jpg', '2024-09-20 16:09:41');

-- ----------------------------
-- Table structure for dt_filepdfprofilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_filepdfprofilrs`;
CREATE TABLE `dt_filepdfprofilrs`  (
  `id_filepdfProfilRS` int NOT NULL AUTO_INCREMENT,
  `kd_filepdfProfilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_filepdfProfilRS` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_filepdfProfilRS`) USING BTREE,
  INDEX `idx_kd_filepdfProfilRS`(`kd_filepdfProfilRS` ASC) USING BTREE,
  INDEX `fk_filepdf_profilRS`(`kd_profilRS` ASC) USING BTREE,
  CONSTRAINT `fk_filepdf_profilRS` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_filepdfprofilrs
-- ----------------------------

-- ----------------------------
-- Table structure for dt_fotonews
-- ----------------------------
DROP TABLE IF EXISTS `dt_fotonews`;
CREATE TABLE `dt_fotonews`  (
  `id_fotonews` int NOT NULL AUTO_INCREMENT,
  `kd_fotonews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_news` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_fotonews` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_fotonews`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_fotonews
-- ----------------------------
INSERT INTO `dt_fotonews` VALUES (9, 'kuAz', 'ruCP', 'kuAz_20240925_120004.jpeg', '2024-10-08 03:18:03');
INSERT INTO `dt_fotonews` VALUES (10, 'j2mX', 'news_66f250947e0ae', 'j2mX_20240925_120310.jpeg', '2024-10-08 03:18:03');
INSERT INTO `dt_fotonews` VALUES (11, 'QeSw', 'ruCP', 'QeSw_20240925_122046.jpg', '2024-10-08 03:18:03');
INSERT INTO `dt_fotonews` VALUES (12, 'ipJR', 'p4Rq', 'ipJR_20240925_152902.jpeg', '2024-10-08 03:18:03');
INSERT INTO `dt_fotonews` VALUES (13, '6MJ9', 'EKjT', '6MJ9_20241008_113830.jpeg', '2024-10-08 04:38:30');
INSERT INTO `dt_fotonews` VALUES (14, 'kS2e', 'EKjT', 'kS2e_20241008_113921.jpg', '2024-10-08 04:39:21');
INSERT INTO `dt_fotonews` VALUES (15, 'De20', 'EKjT', 'De20_20241008_115852.jpg', '2024-10-08 04:58:52');
INSERT INTO `dt_fotonews` VALUES (16, 'sdnJ', 'EKjT', 'sdnJ_20241008_162924.jpg', '2024-10-08 09:29:24');
INSERT INTO `dt_fotonews` VALUES (17, 'KAgT', 'UDbr', 'KAgT_20241008_163055.jpeg', '2024-10-08 09:30:55');
INSERT INTO `dt_fotonews` VALUES (18, '2oa1', 'UDbr', '2oa1_20241008_163224.jpeg', '2024-10-08 09:32:24');
INSERT INTO `dt_fotonews` VALUES (19, 'WO4q', 'UDbr', 'WO4q_20241008_163330.jpg', '2024-10-08 09:33:30');

-- ----------------------------
-- Table structure for dt_fotoprofilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_fotoprofilrs`;
CREATE TABLE `dt_fotoprofilrs`  (
  `id_fotoProfilRS` int NOT NULL AUTO_INCREMENT,
  `kd_fotoProfilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_fotoProfilRS` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_fotoProfilRS`) USING BTREE,
  INDEX `idx_kd_fotoProfilRS`(`kd_fotoProfilRS` ASC) USING BTREE,
  INDEX `fk_fotoprofilrs`(`kd_profilRS` ASC) USING BTREE,
  CONSTRAINT `fk_fotoprofilrs` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_fotoprofilrs
-- ----------------------------
INSERT INTO `dt_fotoprofilrs` VALUES (1, 'j3EB', '8Ryz', 'j3EB_20240927_001635.png');
INSERT INTO `dt_fotoprofilrs` VALUES (2, '2vYl', '8Ryz', '2vYl_20240927_001843.png');

-- ----------------------------
-- Table structure for dt_hari
-- ----------------------------
DROP TABLE IF EXISTS `dt_hari`;
CREATE TABLE `dt_hari`  (
  `id_hari` int NOT NULL AUTO_INCREMENT,
  `kd_hari` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_hari` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_hari`) USING BTREE,
  INDEX `idx_kd_hari`(`kd_hari` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_hari
-- ----------------------------
INSERT INTO `dt_hari` VALUES (1, '5w8R', 'Senin');
INSERT INTO `dt_hari` VALUES (2, '7odN', 'Selasa');
INSERT INTO `dt_hari` VALUES (3, 'B3we', 'Rabu');
INSERT INTO `dt_hari` VALUES (4, 'XfW2', 'Kamis');
INSERT INTO `dt_hari` VALUES (5, 'TCMc', 'Jumat');
INSERT INTO `dt_hari` VALUES (6, 'y8bx', 'Sabtu');
INSERT INTO `dt_hari` VALUES (7, 'qgG0', 'Minggu');

-- ----------------------------
-- Table structure for dt_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `dt_jadwal`;
CREATE TABLE `dt_jadwal`  (
  `id_Jadwal` int NOT NULL AUTO_INCREMENT,
  `kd_Jadwal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_MasterJB` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterJB` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_awal` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_akhir` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_Jadwal`) USING BTREE,
  INDEX `fk_masterjb_jadwal`(`kd_MasterJB` ASC) USING BTREE,
  CONSTRAINT `fk_masterjb_jadwal` FOREIGN KEY (`kd_MasterJB`) REFERENCES `dt_masterjb` (`kd_MasterJB`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_jadwal
-- ----------------------------
INSERT INTO `dt_jadwal` VALUES (3, 's0UT', '6lpX', 'Rawat Inap', '-', '11:00', '13:00');
INSERT INTO `dt_jadwal` VALUES (4, 'Xt64', 'jyxp', 'Instalasi Perawatan Intensif (IPI)', 'Pagi', '07:00', '08:00');
INSERT INTO `dt_jadwal` VALUES (5, '7Txg', 'jyxp', 'Instalasi Perawatan Intensif (IPI)', 'Malam', '19:00', '20:00');

-- ----------------------------
-- Table structure for dt_jadwalpp
-- ----------------------------
DROP TABLE IF EXISTS `dt_jadwalpp`;
CREATE TABLE `dt_jadwalpp`  (
  `id_jadwalPP` int NOT NULL AUTO_INCREMENT,
  `kd_jadwalPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_MasterjamPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterjamPP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_MasterjadwalPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterjadwalPP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_awal_pp` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_akhir_pp` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_jadwalPP`) USING BTREE,
  INDEX `idx_kd_MasterjamPP`(`kd_MasterjamPP` ASC) USING BTREE,
  INDEX `idx_kd_MasterjadwalPP`(`kd_MasterjadwalPP` ASC) USING BTREE,
  CONSTRAINT `fk_dt_jadwalpp_masterjadwalpp` FOREIGN KEY (`kd_MasterjadwalPP`) REFERENCES `dt_masterjadwalpp` (`kd_MasterjadwalPP`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dt_jadwalpp_masterjampp` FOREIGN KEY (`kd_MasterjamPP`) REFERENCES `dt_masterjampp` (`kd_MasterjamPP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_jadwalpp
-- ----------------------------
INSERT INTO `dt_jadwalpp` VALUES (2, 'O4be', 'zFSY', 'Klinik Pagi', '2Z1B', 'Senin - Kamis', '08:00', '13:00');
INSERT INTO `dt_jadwalpp` VALUES (3, '4xfE', 'zFSY', 'Klinik Pagi', 'hnEo', 'Jumat', '08:00', '11:00');
INSERT INTO `dt_jadwalpp` VALUES (4, 'geN1', 'zFSY', 'Klinik Pagi', 'rd0s', 'Sabtu', '08:00', '13:00');
INSERT INTO `dt_jadwalpp` VALUES (5, 'AoT4', '9LoM', 'Klinik Sore', 'XqSx', 'Senin - Sabtu', '14:00', '16:00');

-- ----------------------------
-- Table structure for dt_jeniskelamin
-- ----------------------------
DROP TABLE IF EXISTS `dt_jeniskelamin`;
CREATE TABLE `dt_jeniskelamin`  (
  `id_jeniskelamin` int NOT NULL AUTO_INCREMENT,
  `kd_jeniskelamin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_jeniskelamin` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jeniskelamin`) USING BTREE,
  INDEX `idx_kd_jeniskelamin`(`kd_jeniskelamin` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_jeniskelamin
-- ----------------------------
INSERT INTO `dt_jeniskelamin` VALUES (1, 'DC7h', 'Laki - Laki', '2024-10-11 04:47:59');
INSERT INTO `dt_jeniskelamin` VALUES (2, '41lh', 'Perempuan', '2024-10-11 04:48:05');

-- ----------------------------
-- Table structure for dt_kategorinews
-- ----------------------------
DROP TABLE IF EXISTS `dt_kategorinews`;
CREATE TABLE `dt_kategorinews`  (
  `id_kategorinews` int NOT NULL AUTO_INCREMENT,
  `kd_kategorinews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_kategorinews` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategorinews`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_kategorinews
-- ----------------------------
INSERT INTO `dt_kategorinews` VALUES (1, 'tlN4', 'Artikel Kesehatan');
INSERT INTO `dt_kategorinews` VALUES (2, 'eQCl', 'Covid 19');
INSERT INTO `dt_kategorinews` VALUES (3, 'KvFw', 'Diklat');
INSERT INTO `dt_kategorinews` VALUES (4, 'NTF4', 'General');
INSERT INTO `dt_kategorinews` VALUES (5, '3x18', 'News');
INSERT INTO `dt_kategorinews` VALUES (6, '5sqF', 'Uncategorized');
INSERT INTO `dt_kategorinews` VALUES (7, 'ieKa', 'ZI');

-- ----------------------------
-- Table structure for dt_klinik
-- ----------------------------
DROP TABLE IF EXISTS `dt_klinik`;
CREATE TABLE `dt_klinik`  (
  `id_klinik` int NOT NULL AUTO_INCREMENT,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_klinik` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_klinik`) USING BTREE,
  INDEX `idx_kd_klinik`(`kd_klinik` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_klinik
-- ----------------------------
INSERT INTO `dt_klinik` VALUES (1, 'aKG8', 'Klinik Penyakit Dalam (Internis)', '2024-10-11 14:38:56');
INSERT INTO `dt_klinik` VALUES (2, 'R5at', 'Klinik Kardiologi (Spesialis Jantung)', '2024-10-11 14:39:07');
INSERT INTO `dt_klinik` VALUES (3, 'SWPZ', 'Klinik Neurologi (Spesialis Saraf)', '2024-10-11 14:39:47');
INSERT INTO `dt_klinik` VALUES (4, 'rI7L', 'Klinik Pulmonologi (Spesialis Paru)', '2024-10-11 14:39:57');
INSERT INTO `dt_klinik` VALUES (5, '8dIg', 'Klinik Bedah Umum (Spesialis Bedah)', '2024-10-11 14:40:09');
INSERT INTO `dt_klinik` VALUES (6, 'ubQt', 'Klinik Bedah Ortopedi (Spesialis Tulang dan Sendi)', '2024-10-11 14:40:18');
INSERT INTO `dt_klinik` VALUES (7, 's8Jd', 'Klinik Urologi (Spesialis Saluran Kemih dan Reproduksi Pria)', '2024-10-11 14:40:31');
INSERT INTO `dt_klinik` VALUES (8, 'Ezqv', 'Klinik Endokrinologi (Spesialis Hormon)', '2024-10-11 14:40:39');
INSERT INTO `dt_klinik` VALUES (9, 'i2PC', 'Klinik Hematologi-Onkologi (Spesialis Kanker dan Darah)', '2024-10-11 14:40:46');
INSERT INTO `dt_klinik` VALUES (10, 'xzl4', 'Klinik Gastroenterologi (Spesialis Pencernaan)', '2024-10-11 14:40:56');
INSERT INTO `dt_klinik` VALUES (11, 'tEaH', 'Klinik Nefrologi (Spesialis Ginjal)', '2024-10-11 14:41:02');
INSERT INTO `dt_klinik` VALUES (12, '9Uuq', 'Klinik Mata (Oftalmologi)', '2024-10-11 14:41:11');
INSERT INTO `dt_klinik` VALUES (13, 'VHmq', 'Klinik THT (Telinga, Hidung, Tenggorokan) (Otolaringologi)', '2024-10-11 14:41:24');
INSERT INTO `dt_klinik` VALUES (14, '5Hdg', 'Klinik Kulit dan Kelamin (Dermatologi)', '2024-10-11 14:41:29');
INSERT INTO `dt_klinik` VALUES (15, 'iqfH', 'Klinik Kebidanan dan Kandungan (Obgyn)', '2024-10-11 14:41:35');
INSERT INTO `dt_klinik` VALUES (16, 'U8IA', 'Klinik Anak (Pediatri)', '2024-10-11 14:41:40');
INSERT INTO `dt_klinik` VALUES (17, 'NrzH', 'Klinik Psikiatri (Spesialis Kesehatan Mental)', '2024-10-11 14:41:46');
INSERT INTO `dt_klinik` VALUES (18, 'PIpN', 'Klinik Gigi dan Mulut (Spesialis Gigi)', '2024-10-11 14:41:51');
INSERT INTO `dt_klinik` VALUES (19, 'eEir', 'Klinik Rehabilitasi Medik', '2024-10-11 14:42:03');

-- ----------------------------
-- Table structure for dt_lvluser
-- ----------------------------
DROP TABLE IF EXISTS `dt_lvluser`;
CREATE TABLE `dt_lvluser`  (
  `id_lvluser` int NOT NULL AUTO_INCREMENT,
  `kd_lvluser` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_lvluser` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_lvluser`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_lvluser
-- ----------------------------
INSERT INTO `dt_lvluser` VALUES (1, 'o3wj', 'Superadmin');
INSERT INTO `dt_lvluser` VALUES (2, '15Oh', 'Filosofi dan makna Logo');
INSERT INTO `dt_lvluser` VALUES (3, 'xgkw', 'User');

-- ----------------------------
-- Table structure for dt_masterjadwalpp
-- ----------------------------
DROP TABLE IF EXISTS `dt_masterjadwalpp`;
CREATE TABLE `dt_masterjadwalpp`  (
  `id_MasterjadwalPP` int NOT NULL AUTO_INCREMENT,
  `kd_MasterjadwalPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterjadwalPP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_MasterjadwalPP`) USING BTREE,
  INDEX `idx_kd_MasterjadwalPP`(`kd_MasterjadwalPP` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_masterjadwalpp
-- ----------------------------
INSERT INTO `dt_masterjadwalpp` VALUES (1, '2Z1B', 'Senin - Kamis');
INSERT INTO `dt_masterjadwalpp` VALUES (2, 'hnEo', 'Jumat');
INSERT INTO `dt_masterjadwalpp` VALUES (3, 'rd0s', 'Sabtu');
INSERT INTO `dt_masterjadwalpp` VALUES (4, 'XqSx', 'Senin - Sabtu');

-- ----------------------------
-- Table structure for dt_masterjampp
-- ----------------------------
DROP TABLE IF EXISTS `dt_masterjampp`;
CREATE TABLE `dt_masterjampp`  (
  `id_MasterjamPP` int NOT NULL AUTO_INCREMENT,
  `kd_MasterjamPP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterjamPP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_MasterjamPP`) USING BTREE,
  INDEX `idx_kd_MasterjamPP`(`kd_MasterjamPP` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_masterjampp
-- ----------------------------
INSERT INTO `dt_masterjampp` VALUES (4, 'zFSY', 'Klinik Pagi');
INSERT INTO `dt_masterjampp` VALUES (5, '9LoM', 'Klinik Sore');

-- ----------------------------
-- Table structure for dt_masterjb
-- ----------------------------
DROP TABLE IF EXISTS `dt_masterjb`;
CREATE TABLE `dt_masterjb`  (
  `id_MasterJB` int NOT NULL AUTO_INCREMENT,
  `kd_MasterJB` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterJB` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_MasterJB`) USING BTREE,
  INDEX `idx_kd_MasterJB`(`kd_MasterJB` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_masterjb
-- ----------------------------
INSERT INTO `dt_masterjb` VALUES (1, '6lpX', 'Rawat Inap', 0);
INSERT INTO `dt_masterjb` VALUES (2, 'jyxp', 'Instalasi Perawatan Intensif (IPI)', 0);

-- ----------------------------
-- Table structure for dt_masternavbar2
-- ----------------------------
DROP TABLE IF EXISTS `dt_masternavbar2`;
CREATE TABLE `dt_masternavbar2`  (
  `id_masternavbar2` int NOT NULL AUTO_INCREMENT,
  `kd_masternavbar2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_masternavbar2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_masternavbar2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_masternavbar2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_masternavbar2`) USING BTREE,
  INDEX `idx_kd_masternavbar2`(`kd_masternavbar2` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_masternavbar2
-- ----------------------------
INSERT INTO `dt_masternavbar2` VALUES (1, 'MzmA', 'Beranda', '/website/', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (2, 'Tb13', 'Tentang Kami', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (3, 'SjIW', 'Layanan', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (4, '5jGa', 'Dokter', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (5, 'Lr0O', 'Berita', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (6, 'EF9k', 'Informasi', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (17, 'M1Fg', 'SKM', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (18, 'AWQ0', 'Diklat', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (19, 'lg6p', 'Zona Integritas', '-', 'Aktif');
INSERT INTO `dt_masternavbar2` VALUES (20, 'KW1P', 'PPID', '-', 'Aktif');

-- ----------------------------
-- Table structure for dt_masterruanganritarif
-- ----------------------------
DROP TABLE IF EXISTS `dt_masterruanganritarif`;
CREATE TABLE `dt_masterruanganritarif`  (
  `id_MasterRuanganRITarif` int NOT NULL AUTO_INCREMENT,
  `kd_MasterRuanganRITarif` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_MasterRuanganRITarif` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_MasterRuanganRITarif`) USING BTREE,
  INDEX `idx_kd_MasterRuanganRITarif`(`kd_MasterRuanganRITarif` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_masterruanganritarif
-- ----------------------------
INSERT INTO `dt_masterruanganritarif` VALUES (1, 'YOKe', 'Kelas III', 0);
INSERT INTO `dt_masterruanganritarif` VALUES (2, 'hTUi', 'Kelas II', 0);
INSERT INTO `dt_masterruanganritarif` VALUES (3, '8Zwl', 'Kelas I', 0);
INSERT INTO `dt_masterruanganritarif` VALUES (4, 'LnhC', 'VIP', 0);
INSERT INTO `dt_masterruanganritarif` VALUES (5, 'Pof7', 'Perawatan ICU/ICCU', 0);

-- ----------------------------
-- Table structure for dt_misiprofilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_misiprofilrs`;
CREATE TABLE `dt_misiprofilrs`  (
  `id_misiProfilRS` int NOT NULL AUTO_INCREMENT,
  `kd_misiProfilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_misiProfilRS` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_misiProfilRS`) USING BTREE,
  INDEX `idx_kd_misiProfilRS`(`kd_misiProfilRS` ASC) USING BTREE,
  INDEX `fk_misiprofilrs`(`kd_profilRS` ASC) USING BTREE,
  CONSTRAINT `fk_misiprofilrs` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_profilRS` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_misiprofilrs
-- ----------------------------
INSERT INTO `dt_misiprofilrs` VALUES (1, 'K41N', '8Ryz', 'Meningkatkan profesionalisme, sumber daya manusia melalui pendidikan, pelatihan dan penelitian secara berkesinambungan.');
INSERT INTO `dt_misiprofilrs` VALUES (2, 'OQpN', '8Ryz', 'Mengembangkan pelayanan unggulan untuk meningkatkan daya saing serta membangun jejaring dengan institusi lain dalam pelayanan kesehatan.');
INSERT INTO `dt_misiprofilrs` VALUES (3, 'NfS8', '8Ryz', 'Mengedepankan rasa kemanusiaan serta pengabdian dalam melayani masyarakat.');
INSERT INTO `dt_misiprofilrs` VALUES (4, 'gH5A', '8Ryz', 'Menyediakan sarana dalam mendidik mahasiswa fakultas Kedokteran menjadi Dokter yang memiliki Kompetensi Medik, Kepekaan sosial dan berguna bagi Nusa dan Bangsa.');

-- ----------------------------
-- Table structure for dt_mitrawork
-- ----------------------------
DROP TABLE IF EXISTS `dt_mitrawork`;
CREATE TABLE `dt_mitrawork`  (
  `id_mitrawork` int NOT NULL AUTO_INCREMENT,
  `kd_mitrawork` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_mitrawork` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_mitrawork` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_mitrawork` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_mitrawork`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_mitrawork
-- ----------------------------
INSERT INTO `dt_mitrawork` VALUES (1, 'P9oG', 'Mandiri', 'Aktif', 'mandiri.jpg');
INSERT INTO `dt_mitrawork` VALUES (2, 'F5hB', 'BPJS Kesehatan', 'Aktif', 'BPJS Kesehatan.png');
INSERT INTO `dt_mitrawork` VALUES (3, '2IVg', 'BPJS Ketenagakerjaan', 'Aktif', 'BPJS Ketenagakerjaan.png');
INSERT INTO `dt_mitrawork` VALUES (4, '9MZz', 'Jasa Raharja', 'Aktif', 'JASARAHARJA.png');
INSERT INTO `dt_mitrawork` VALUES (5, 'PuSd', 'PERSI', 'Aktif', 'PERSI.png');
INSERT INTO `dt_mitrawork` VALUES (6, 'LnXI', 'KARS', 'Aktif', 'KARS.png');
INSERT INTO `dt_mitrawork` VALUES (7, 'PBJh', 'Kementerian Kesehatan', 'Aktif', 'Kementerian.png');
INSERT INTO `dt_mitrawork` VALUES (8, 'w36c', 'ARSADA', 'Aktif', 'Arsada.png');

-- ----------------------------
-- Table structure for dt_navinfo
-- ----------------------------
DROP TABLE IF EXISTS `dt_navinfo`;
CREATE TABLE `dt_navinfo`  (
  `id_navinfo` int NOT NULL AUTO_INCREMENT,
  `kd_navinfo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_navinfo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos_navinfo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_navinfo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp_navinfo` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp2_navinfo` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_navinfo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_navinfo
-- ----------------------------
INSERT INTO `dt_navinfo` VALUES (1, '10ci', 'jln.thamrin, Lubuk Pakam', '20511', 'rsuddrs.hat@gmail.com', '(061)795-2068', '08116591949');

-- ----------------------------
-- Table structure for dt_news
-- ----------------------------
DROP TABLE IF EXISTS `dt_news`;
CREATE TABLE `dt_news`  (
  `id_news` int NOT NULL AUTO_INCREMENT,
  `kd_news` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_kategorinews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_news` datetime NOT NULL,
  `kec_news` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul_news` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi_news` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_news`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_news
-- ----------------------------
INSERT INTO `dt_news` VALUES (1, 'news_66f250947e0ae', 'KvFw', '2024-09-24 00:00:00', 'Lubuk Pakam', 'RSUD Drs. H. AMRI TAMBUNAN Dapat Melakukan Tindakan Argon Plasma Coagulation (APC)', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">RSUD Drs. H. Amri Tambunan sudah dapat melakukan tindakan Argon Plasma Coagulation (APC) pada Collitis Radiasi lho ! Tapi, apa sih Argon Plasma Coagulation dan Collitis Radiasi itu?</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Argon Plasma Coagulation (APC) adalah teknik endoskopi yang menggunakan gas argon yang dilewatkan melalui probe elektrokoagulasi. Gas argon diberikan dalam bentuk plasma pada jaringan yang terkena, menghasilkan energi panas yang membakar dan mengkoagulasi jaringan tersebut. Teknik ini telah digunakan secara luas dalam berbagai kondisi gastrointestinal, termasuk dalam pengobatan collitis radiasi.</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Collitis radiasi adalah peradangan pada usus besar yang disebabkan oleh paparan radiasi terapi, seringkali sebagai bagian dari pengobatan kanker. Collitis radiasi dapat menyebabkan berbagai gejala yang mengganggu, termasuk diare, nyeri perut, perdarahan, dan bahkan perforasi usus. Pengobatan collitis radiasi merupakan tantangan, tetapi teknik terapeutik seperti Argon Plasma Coagulation (APC) dapat membantu mengurangi gejala dan memperbaiki kualitas hidup pasien. Artikel ini akan membahas tindakan APC dalam pengelolaan collitis radiasi.</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Tindakan APC untuk Collitis Radiasi :</p><ol style=\"padding: 0px; margin: 5px 0px 20px; color: rgb(102, 102, 102); font-family: Quicksand; font-size: 14px; letter-spacing: normal; background-color: rgb(248, 248, 248);\"><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Koagulasi Lesi Mucosal :<br></strong>APC dapat digunakan untuk koagulasi dan penghancuran lesi-lesi mucosal yang terjadi akibat collitis radiasi. Lesi-lesi ini sering kali merupakan sumber perdarahan dan gejala lainnya. Dengan menggunakan APC, energi panas dilewatkan ke daerah yang terkena, menyebabkan penghancuran lesi dan koagulasi pembuluh darah yang bocor.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Pengurangan Vaskularitas :<br></strong>Collitis radiasi sering kali menyebabkan peningkatan vaskularitas (pembuluh darah yang berlebihan) pada mukosa usus besar. Keberadaan pembuluh darah yang tidak normal ini dapat menyebabkan perdarahan dan gejala lainnya. Melalui tindakan APC, pembuluh darah yang berlebihan dapat dihancurkan dan di-koagulasi, mengurangi perdarahan dan meredakan gejala.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Modulasi Inflamasi :<br></strong>Collitis radiasi dicirikan oleh peradangan pada jaringan usus besar. APC dapat membantu mengurangi peradangan dengan menghancurkan area yang terkena dan memicu respons penyembuhan. Pemusnahan jaringan yang terkena oleh energi panas dapat merangsang proliferasi sel-sel baru dan memicu penyembuhan jaringan yang lebih sehat.</li></ol><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Keuntungan dan Pertimbangan :</p><ul style=\"padding: 0px; margin: 5px 0px 20px; list-style: none; color: rgb(102, 102, 102); font-family: Quicksand; font-size: 14px; letter-spacing: normal; background-color: rgb(248, 248, 248);\"><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Non-invasif : APC adalah tindakan non-invasif yang dilakukan melalui endoskopi, mengurangi risiko komplikasi bedah yang berpotensi.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Aksesibilitas : Tindakan APC dapat dilakukan dengan mudah selama prosedur endoskopi, tanpa memerlukan alat atau instrumen tambahan yang kompleks.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Pengurangan Gejala : Dengan menghancurkan lesi, mengurangi vaskularitas, dan mengurangi peradangan, APC dapat membantu mengurangi gejala yang terkait dengan collitis radiasi.</li></ul><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Namun, penting untuk diingat bahwa APC bukanlah pengobatan yang menyembuhkan collitis radiasi secara permanen. Ini adalah tindakan yang bertujuan untuk meredakan gejala dan memperbaiki kualitas hidup pasien. Perawatan jangka panjang yang komprehensif dan terintegrasi, termasuk manajemen nutrisi dan pengobatan simtomatik, juga harus diberikan.&nbsp;Salam&nbsp;sehat!</p>');
INSERT INTO `dt_news` VALUES (2, 'p4Rq', 'KvFw', '2024-09-17 00:00:00', 'Kutalimbaru', 'KPK Geledah Rumah Eks Gubernur Kaltim Awang Faroek', '<h1>Berita Terbaru<o:p></o:p></h1><p class=\"MsoNormal\">Judul: Pembangunan Jalan Baru di Kota Lubuk Pakam<br>\r\nTanggal: 24 September 2024<br>\r\n<br>\r\nIsi Berita:<br>\r\nPemerintah Kabupaten Deli Serdang baru saja mengumumkan proyek pembangunan\r\njalan baru yang akan menghubungkan Kota Lubuk Pakam dengan daerah sekitarnya.\r\nProyek ini bertujuan untuk meningkatkan aksesibilitas dan memfasilitasi\r\ntransportasi barang dan orang.<br>\r\n<br>\r\nMenurut Kepala Dinas Pekerjaan Umum, proyek ini diharapkan selesai dalam waktu\r\nsatu tahun dan akan memberikan dampak positif bagi perekonomian daerah.\r\n\"Dengan adanya jalan baru ini, kami berharap dapat mengurangi kemacetan\r\ndan mempercepat distribusi barang,\" ungkapnya.<br>\r\n<br>\r\nPembangunan jalan ini juga akan menciptakan lapangan pekerjaan bagi warga\r\nsetempat, sehingga diharapkan dapat membantu meningkatkan kesejahteraan\r\nmasyarakat.</p><p class=\"MsoNormal\"><span style=\"text-indent: -18pt;\">1. Dfsdgs</span></p><p class=\"MsoNormal\"><span style=\"text-indent: -18pt;\">2.</span><span style=\"text-indent: -18pt;\">Tefsdegsd</span></p><p class=\"MsoNormal\"><span style=\"text-indent: -18pt;\">3. Dsfgsdgds</span></p><p class=\"MsoNormal\"><span style=\"text-indent: -18pt;\">4. Dfsdfgsdg</span></p><p class=\"MsoNormal\"><span style=\"text-indent: -18pt;\">5. sdgsdg</span></p>');
INSERT INTO `dt_news` VALUES (5, 'ruCP', 'tlN4', '2024-09-24 00:00:00', '', 'RSUD Drs. H. AMRI TAMBUNAN Dapat Melakukan Tindakan Argon Plasma Coagulation (APC)', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">RSUD Drs. H. Amri Tambunan sudah dapat melakukan tindakan Argon Plasma Coagulation (APC) pada Collitis Radiasi lho ! Tapi, apa sih Argon Plasma Coagulation dan Collitis Radiasi itu?</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Argon Plasma Coagulation (APC) adalah teknik endoskopi yang menggunakan gas argon yang dilewatkan melalui probe elektrokoagulasi. Gas argon diberikan dalam bentuk plasma pada jaringan yang terkena, menghasilkan energi panas yang membakar dan mengkoagulasi jaringan tersebut. Teknik ini telah digunakan secara luas dalam berbagai kondisi gastrointestinal, termasuk dalam pengobatan collitis radiasi.</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Collitis radiasi adalah peradangan pada usus besar yang disebabkan oleh paparan radiasi terapi, seringkali sebagai bagian dari pengobatan kanker. Collitis radiasi dapat menyebabkan berbagai gejala yang mengganggu, termasuk diare, nyeri perut, perdarahan, dan bahkan perforasi usus. Pengobatan collitis radiasi merupakan tantangan, tetapi teknik terapeutik seperti Argon Plasma Coagulation (APC) dapat membantu mengurangi gejala dan memperbaiki kualitas hidup pasien. Artikel ini akan membahas tindakan APC dalam pengelolaan collitis radiasi.</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Tindakan APC untuk Collitis Radiasi :</p><ol style=\"padding: 0px; margin: 5px 0px 20px; color: rgb(102, 102, 102); font-family: Quicksand; font-size: 14px; letter-spacing: normal; background-color: rgb(248, 248, 248);\"><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Koagulasi Lesi Mucosal :<br></strong>APC dapat digunakan untuk koagulasi dan penghancuran lesi-lesi mucosal yang terjadi akibat collitis radiasi. Lesi-lesi ini sering kali merupakan sumber perdarahan dan gejala lainnya. Dengan menggunakan APC, energi panas dilewatkan ke daerah yang terkena, menyebabkan penghancuran lesi dan koagulasi pembuluh darah yang bocor.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Pengurangan Vaskularitas :<br></strong>Collitis radiasi sering kali menyebabkan peningkatan vaskularitas (pembuluh darah yang berlebihan) pada mukosa usus besar. Keberadaan pembuluh darah yang tidak normal ini dapat menyebabkan perdarahan dan gejala lainnya. Melalui tindakan APC, pembuluh darah yang berlebihan dapat dihancurkan dan di-koagulasi, mengurangi perdarahan dan meredakan gejala.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\"><strong style=\"color: rgb(0, 0, 0);\">Modulasi Inflamasi :<br></strong>Collitis radiasi dicirikan oleh peradangan pada jaringan usus besar. APC dapat membantu mengurangi peradangan dengan menghancurkan area yang terkena dan memicu respons penyembuhan. Pemusnahan jaringan yang terkena oleh energi panas dapat merangsang proliferasi sel-sel baru dan memicu penyembuhan jaringan yang lebih sehat.</li></ol><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Keuntungan dan Pertimbangan :</p><ul style=\"padding: 0px; margin: 5px 0px 20px; list-style: none; color: rgb(102, 102, 102); font-family: Quicksand; font-size: 14px; letter-spacing: normal; background-color: rgb(248, 248, 248);\"><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Non-invasif : APC adalah tindakan non-invasif yang dilakukan melalui endoskopi, mengurangi risiko komplikasi bedah yang berpotensi.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Aksesibilitas : Tindakan APC dapat dilakukan dengan mudah selama prosedur endoskopi, tanpa memerlukan alat atau instrumen tambahan yang kompleks.</li><li style=\"height: auto; line-height: 1.71429; padding: 2px 0px; list-style-position: inside;\">Pengurangan Gejala : Dengan menghancurkan lesi, mengurangi vaskularitas, dan mengurangi peradangan, APC dapat membantu mengurangi gejala yang terkait dengan collitis radiasi.</li></ul><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-size: 14px; font-family: Quicksand; vertical-align: baseline; color: rgb(102, 102, 102); line-height: 1.71429; letter-spacing: normal; background-color: rgb(248, 248, 248);\">Namun, penting untuk diingat bahwa APC bukanlah pengobatan yang menyembuhkan collitis radiasi secara permanen. Ini adalah tindakan yang bertujuan untuk meredakan gejala dan memperbaiki kualitas hidup pasien. Perawatan jangka panjang yang komprehensif dan terintegrasi, termasuk manajemen nutrisi dan pengobatan simtomatik, juga harus diberikan.&nbsp;Salam&nbsp;sehat!</p>');
INSERT INTO `dt_news` VALUES (6, 'UO7r', 'eQCl', '2024-09-23 00:00:00', '', 'Apa ya fhgrte rehth frgjrtgj hgffdgh', '<p><font style=\"\" color=\"#000000\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Sejumlah elite Gerindra dan pimpinan Komisi I yang menyambut kedatangannya di antaranya Meutya Hafid, Sugiono, Prasetyo Hadi, dan Budisatrio Djiwandono.</span><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Wamenhan Herindra, Menkumham Supratman Andi Agtas, hingga Jubir Dahnil Anzar Simanjuntak pun sudah menanti Prabowo di kompleks parlemen dan ikut menyambutnya.</span><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Kemudian, para tenaga ahli Partai Gerindra juga ikut serta. Mereka kompak mengenakan kemeja putih dan celana krem khas partai berlambang garuda itu.</span><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Di depan pintu masuk ruang rapat Komisi I, terdapat satu pot bunga yang dikhususkan untuk Prabowo. Rangkaian bunga juga tampak di meja tempat ia duduk.</span><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Baca artikel CNN Indonesia \"Rapat ke DPR Jelang Pelantikan, Prabowo Disambut Meriah Anggota Dewan\" selengkapnya di sini:&nbsp;</span><a href=\"https://www.cnnindonesia.com/nasional/20240925150816-32-1148246/rapat-ke-dpr-jelang-pelantikan-prabowo-disambut-meriah-anggota-dewan\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; text-decoration: inherit; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">https://www.cnnindonesia.com/nasional/20240925150816-32-1148246/rapat-ke-dpr-jelang-pelantikan-prabowo-disambut-meriah-anggota-dewan</a><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">.</span><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><br style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: 0.5s; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; -webkit-font-smoothing: antialiased; backface-visibility: hidden; font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\"><span style=\"font-family: CNNsans, sans-serif; font-size: medium; letter-spacing: normal;\">Download Apps CNN Indonesia sekarang https://app.cnnindonesia.com/</span></font><br></p>');
INSERT INTO `dt_news` VALUES (7, 'EKjT', 'tlN4', '2024-10-08 00:00:00', 'Lubuk Pakam', 'Pentingnya Kesehatan Mental di Era Digital', '<p><strong>Jakarta, 8 Oktober 2024</strong> — Di tengah kemajuan teknologi dan meningkatnya penggunaan media sosial, kesehatan mental menjadi perhatian utama bagi banyak orang. Penelitian terbaru menunjukkan bahwa 1 dari 4 orang dewasa mengalami masalah kesehatan mental, seperti kecemasan dan depresi.</p><p>Dr. Siti Rahmawati, psikolog dari Universitas Indonesia, mengungkapkan bahwa paparan konten negatif di media sosial dapat memicu perasaan cemas dan rendah diri. \"Masyarakat sering kali membandingkan diri mereka dengan kehidupan sempurna yang ditampilkan orang lain di media sosial, yang dapat menyebabkan stres dan ketidakpuasan,\" jelasnya.</p><p>Untuk mengatasi masalah ini, Dr. Rahmawati menyarankan beberapa langkah sederhana. Pertama, batasi waktu penggunaan media sosial dan pilih konten yang positif. Kedua, luangkan waktu untuk aktivitas yang menyenangkan dan berolahraga secara teratur. \"Olahraga terbukti dapat meningkatkan suasana hati dan mengurangi gejala kecemasan,\" tambahnya.</p><p>Selain itu, pentingnya dukungan sosial tidak bisa diabaikan. Berbagi perasaan dengan teman atau keluarga dapat membantu individu merasa lebih terhubung dan didukung.</p><p>Kampanye kesadaran tentang kesehatan mental juga semakin digalakkan. Organisasi non-profit seperti \"Sehat Mental Indonesia\" melakukan berbagai program edukasi untuk meningkatkan pemahaman masyarakat tentang pentingnya menjaga kesehatan mental.</p><p>Dengan perhatian yang lebih besar terhadap kesehatan mental, diharapkan masyarakat dapat lebih bijak dalam menggunakan teknologi dan menjaga keseimbangan hidup yang sehat.</p>');
INSERT INTO `dt_news` VALUES (8, 'UDbr', 'NTF4', '2024-10-08 00:00:00', 'Lubuk Pakam', 'Cuaca Ekstrem Mengguncang Beberapa Wilayah di Indonesia', '<p><strong>Jakarta</strong> – Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) mengeluarkan peringatan cuaca ekstrem yang diperkirakan akan melanda beberapa wilayah di Indonesia dalam beberapa hari ke depan. Hujan lebat disertai angin kencang diprediksi akan terjadi di pulau Sumatra, Jawa, dan Bali.</p><p>Menurut laporan BMKG, fenomena ini disebabkan oleh sistem tekanan rendah yang terbentuk di perairan Samudera Hindia. \"Kami menghimbau masyarakat untuk tetap waspada dan mengikuti perkembangan informasi cuaca terkini,\" ujar Kepala BMKG, Dwikorita Karnawati, dalam konferensi pers hari ini.</p><p>Beberapa daerah yang diperkirakan akan terkena dampak paling parah antara lain Aceh, Lampung, DKI Jakarta, dan Bali. Di Jakarta, potensi banjir lokal diprediksi meningkat akibat curah hujan yang tinggi.</p><p>Pihak berwenang telah mempersiapkan langkah-langkah mitigasi, termasuk penguatan infrastruktur dan penempatan petugas di titik-titik rawan banjir. \"Kami akan bekerja sama dengan pihak terkait untuk memastikan keselamatan masyarakat,\" tambah Dwikorita.</p><p>Masyarakat diimbau untuk menghindari perjalanan yang tidak mendesak dan memastikan peralatan darurat siap digunakan. Selain itu, penting bagi warga untuk memantau informasi dari sumber resmi terkait perkembangan cuaca.</p><p>Dengan semakin meningkatnya frekuensi cuaca ekstrem, pemerintah mengingatkan pentingnya kesadaran akan perubahan iklim dan dampaknya terhadap lingkungan. Masyarakat diharapkan lebih siap menghadapi potensi bencana yang mungkin terjadi.</p><p><strong>Untuk informasi lebih lanjut, kunjungi situs resmi BMKG.</strong></p>');

-- ----------------------------
-- Table structure for dt_passusers
-- ----------------------------
DROP TABLE IF EXISTS `dt_passusers`;
CREATE TABLE `dt_passusers`  (
  `id_passusers` int NOT NULL AUTO_INCREMENT,
  `kd_passusers` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_lvluser` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_userslgn` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username_passusers` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `passwd_passusers` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_passusers`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_passusers
-- ----------------------------
INSERT INTO `dt_passusers` VALUES (1, '8705', '15Oh', 'ftA6', 'iza@gmail.com', '$2y$10$rx6iePgywr.ZeQv7cZf86.TnmTpDhpgBReudzHQlf9TVMoxLMQNDm', '2024-08-21 11:42:36');

-- ----------------------------
-- Table structure for dt_profilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_profilrs`;
CREATE TABLE `dt_profilrs`  (
  `id_profilRS` int NOT NULL AUTO_INCREMENT,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_profilRS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_profilRS`) USING BTREE,
  UNIQUE INDEX `uk_kd_profilRS`(`kd_profilRS` ASC) USING BTREE,
  INDEX `idx_kd_profilRS`(`kd_profilRS` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_profilrs
-- ----------------------------
INSERT INTO `dt_profilrs` VALUES (1, '8Ryz', '<p><span style=\"font-weight: bolder;\">Rumah Sakit Umum Daerah Drs. H. Amri Tambunan terletak di Kota Lubuk Pakam, Ibukota Kabupaten Deli Serdang.</span></p><p>Rumah Sakit Umum Daerah Deli Serdang kini telah berganti nama menjadi Rumah Sakit Umum Daerah Drs. H. AMRI TAMBUNAN, merupakan Rumah Sakit Umum milik Pemerintah Kabupaten Deli Serdang, merupakan Pusat Rujukan Pelayanan dengan status Kelas B Pendidikan</p><p><br></p><p>RSUD Drs. H. AMRI TAMBUNAN telah menyandang status Lulus Paripurna Bintang Lima pada Survei Akreditasi Rumah Sakit di Tahun 2019. Pada tahun 2022 yaitu tanggal 2, 4 dan 5 November 2022, RSUD Drs. H. AMRI TAMBUNAN melaksanakan survei reakreditasi dengan menggunakan Standar Akreditasi Rumah Sakit Kementerian kesehatan (STARKES) yang dilaksanakan oleh Komisi Akreditasi Rumah Sakit (KARS) dengan hasil Paripurna Bintang Lima.</p><p><br></p><p>Selain itu, RSUD Drs. H. AMRI TAMBUNAN juga merupakan rumah sakit pendidikan yang ditetapkan berdasarkan Surat Keputusan Menteri Kesehatan Republik Indonesia Nomor HK.02.02/I/1121/2017 tanggal 20 April 2017, sebagai Rumah Sakit Pendidikan Utama untuk Fakultas Kedokteran Universitas Muhammadiyah Sumatera Utara. Status ini diperbarui pada tahun 2022 dalam SK Menteri Kesehatan RI Nomor HK.01.07/Menkes/1348/2022.</p><p><br></p><p>Saat ini RSUD Drs. H. AMRI TAMBUNAN telah berubah status menjadi Unit Organisasi Bersifat Khusus pada Dinas Kesehatan Kabupaten Deli Serdang sesuai dengan Peraturan Bupati Deli Serdang No.18 Tahun 2024 yang ditetapkan pada tanggal 19 April 2024.</p>', '2024-09-26 23:51:44');

-- ----------------------------
-- Table structure for dt_ritarif
-- ----------------------------
DROP TABLE IF EXISTS `dt_ritarif`;
CREATE TABLE `dt_ritarif`  (
  `id_RITarif` int NOT NULL AUTO_INCREMENT,
  `kd_RITarif` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_MasterRuanganRITarif` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_Pelayanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tarif` int NOT NULL,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_RITarif`) USING BTREE,
  INDEX `idx_kd_RITarif`(`kd_RITarif` ASC) USING BTREE,
  INDEX `fk_masterruanganritarif`(`kd_MasterRuanganRITarif` ASC) USING BTREE,
  CONSTRAINT `fk_masterruanganritarif` FOREIGN KEY (`kd_MasterRuanganRITarif`) REFERENCES `dt_masterruanganritarif` (`kd_MasterRuanganRITarif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_ritarif
-- ----------------------------
INSERT INTO `dt_ritarif` VALUES (1, 'o95u', 'YOKe', 'Akomodasi', 85000, 0);
INSERT INTO `dt_ritarif` VALUES (2, 'XnMb', 'YOKe', 'Bayi Baru Lahir', 37500, 0);
INSERT INTO `dt_ritarif` VALUES (3, '5dSD', 'YOKe', 'Visit Dokter Umum', 25600, 0);
INSERT INTO `dt_ritarif` VALUES (4, 'VDaA', 'YOKe', 'Visit Dokter Spsialis', 64000, 0);
INSERT INTO `dt_ritarif` VALUES (5, 'yuz2', 'hTUi', 'Akomodasi', 195000, 0);
INSERT INTO `dt_ritarif` VALUES (6, 'sc2o', 'hTUi', 'Bayi Baru Lahir', 97500, 0);
INSERT INTO `dt_ritarif` VALUES (7, 'rFj0', 'hTUi', 'Visit Dokter Umum', 32600, 0);
INSERT INTO `dt_ritarif` VALUES (8, 'PdfQ', 'hTUi', 'Visit Dokter Spsialis', 80000, 0);
INSERT INTO `dt_ritarif` VALUES (9, 'twbS', '8Zwl', 'Akomodasi', 320000, 0);
INSERT INTO `dt_ritarif` VALUES (10, 'X1Ih', '8Zwl', 'Bayi Baru Lahir', 115500, 0);
INSERT INTO `dt_ritarif` VALUES (11, 'PX1K', '8Zwl', 'Visit Dokter Umum', 40600, 0);
INSERT INTO `dt_ritarif` VALUES (12, 'FZcd', '8Zwl', 'Visit Dokter Spsialis', 100000, 0);
INSERT INTO `dt_ritarif` VALUES (13, 'lh8Z', 'LnhC', 'Akomodasi', 400000, 0);
INSERT INTO `dt_ritarif` VALUES (14, 'J7Pw', 'LnhC', 'Bayi Baru Lahir', 225500, 0);
INSERT INTO `dt_ritarif` VALUES (15, '96Ij', 'LnhC', 'Visit Dokter Umum', 50000, 0);
INSERT INTO `dt_ritarif` VALUES (16, 'QkbN', 'LnhC', 'Visit Dokter Spsialis', 125000, 0);
INSERT INTO `dt_ritarif` VALUES (17, '0xZg', 'Pof7', 'Akomodasi', 300000, 0);
INSERT INTO `dt_ritarif` VALUES (18, 'Eqx9', 'Pof7', 'Visit Tim Dokter Spesialis', 150000, 0);
INSERT INTO `dt_ritarif` VALUES (19, '9EeI', 'Pof7', 'Visit Dokter Spesialis', 75000, 0);

-- ----------------------------
-- Table structure for dt_riwayatpendidikan
-- ----------------------------
DROP TABLE IF EXISTS `dt_riwayatpendidikan`;
CREATE TABLE `dt_riwayatpendidikan`  (
  `id_riwayatpendidikan` int NOT NULL AUTO_INCREMENT,
  `kd_riwayatpendidikan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_riwayatpendidikan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_riwayatpendidikan`) USING BTREE,
  INDEX `idx_kd_riwayatpendidikan`(`kd_riwayatpendidikan` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_riwayatpendidikan
-- ----------------------------
INSERT INTO `dt_riwayatpendidikan` VALUES (1, 'ZVkC', 'Dokter Umum (dr.)', '2024-10-10 09:14:05');
INSERT INTO `dt_riwayatpendidikan` VALUES (2, 'xpUq', 'Ujian Kompetensi Mahasiswa Program Profesi Dokter (UKMPPD)', '2024-10-10 09:14:28');
INSERT INTO `dt_riwayatpendidikan` VALUES (3, 'rmGY', 'Program Internship Dokter', '2024-10-10 09:14:39');

-- ----------------------------
-- Table structure for dt_ruangankhusus
-- ----------------------------
DROP TABLE IF EXISTS `dt_ruangankhusus`;
CREATE TABLE `dt_ruangankhusus`  (
  `id_RuanganKhusus` int NOT NULL AUTO_INCREMENT,
  `kd_RuanganKhusus` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_RuanganKhusus` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_Rk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_RuanganKhusus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_ruangankhusus
-- ----------------------------
INSERT INTO `dt_ruangankhusus` VALUES (1, '7bZx', 'Ruangan Asoka', 'Perawatan Infeksius');
INSERT INTO `dt_ruangankhusus` VALUES (2, 'IsU2', 'Ruangan Anggrek', 'Perawatan Infeksius');

-- ----------------------------
-- Table structure for dt_sejarahprofilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_sejarahprofilrs`;
CREATE TABLE `dt_sejarahprofilrs`  (
  `id_sejarahProfilRS` int NOT NULL AUTO_INCREMENT,
  `kd_sejarahProfilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_sejarahProfilRS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul_sejarahProfilRS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_sejarahProfilRS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_sejarahProfilRS`) USING BTREE,
  INDEX `idx_kd_sejarahProfilRS`(`kd_sejarahProfilRS` ASC) USING BTREE,
  INDEX `fk_sejarahprofilrs`(`kd_profilRS` ASC) USING BTREE,
  CONSTRAINT `fk_sejarahprofilrs` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_sejarahprofilrs
-- ----------------------------
INSERT INTO `dt_sejarahprofilrs` VALUES (2, 'UpNR', '8Ryz', '1958', 'Perubahan Status RSUD Deli Serdang', 'Rumah Sakit Pembantu.');
INSERT INTO `dt_sejarahprofilrs` VALUES (4, 'Utsy', '8Ryz', '1979', 'Perubahan Status RSUD Deli Serdang', 'Rumah Sakit Umum Kelas D (KepMenkes RI Nomor: 51/ Menkes/ SK/ II/ 1979).');
INSERT INTO `dt_sejarahprofilrs` VALUES (5, 'bVnL', '8Ryz', '1987', 'Perubahan Status RSUD Deli Serdang', 'Rumah Sakit Umum Daerah Kelas C (KepMenkes RI Nomor: 303/ Menkes/ SK/ IV/ 1987 tanggal 30 April 1987) (UPT. DINAS KESEHATAN KABUPATEN )');
INSERT INTO `dt_sejarahprofilrs` VALUES (6, 'ouE6', '8Ryz', '2002', 'Perubahan Status RSUD Deli Serdang', 'Lembaga Teknis Daerah berbentuk Badan (Keputusan Bupati Deli Serdang Nomor: 264 Tahun 2002 Tanggal 15 April 2002) (Perda Kabupaten Deli Serdang Nomor: 16 Tahun 2002, Tanggal 01 Mei 2002) (LEMBAGA TEKNIS DAERAH KABUPATEN).');
INSERT INTO `dt_sejarahprofilrs` VALUES (7, 'r961', '8Ryz', '2008-04-25', 'Perubahan Struktur Organisasi', 'Rumah Sakit Umum Kelas B Non Pendidikan (KepMenkes RI Nomor: 405/ MENKES/ SK/ IV/ 2008) Tgl 25 April 2008. Kedudukan tetap sebagai Lembaga Teknis Daerah');
INSERT INTO `dt_sejarahprofilrs` VALUES (8, '0D4O', '8Ryz', '2014-03-05', 'Perubahan Struktur Organisasi', 'Struktur Organisasi RSUD Deli Serdang Nomor I tahun 2014,');
INSERT INTO `dt_sejarahprofilrs` VALUES (9, 'pbZl', '8Ryz', '2016', 'Perubahan Struktur RS', 'Struktur Organisasi RSUD Deli Serdang sebagai lembaga otonom di bawah UPT Dinas Kesehatan berbentuk BLUD sesuai dengan PP No 18 tahun 2016 dan Perda no. 3 tanuh 2016.');
INSERT INTO `dt_sejarahprofilrs` VALUES (10, 'yXT0', '8Ryz', '2016-12-30', 'Akreditasi KARS Versi 2012', 'Lulus dengan bintang 4 tingkat utama dari KARS, dengan NOMOR : KARS-SERT/361/X11/2016 sebagai RSUD TIPE B berdasarkan KEPMENKES RI NOMOR : 405/MENKES/SK/IV/2018.');
INSERT INTO `dt_sejarahprofilrs` VALUES (11, 'owiW', '8Ryz', '2019-11-11', 'Akreditasi KARS Versi SNARS Ed.1', 'Lulus dengan bintang 5 tingkat Paripurna dari KARS, dengan Nomor : KARS-SERT/1475/III/2020');
INSERT INTO `dt_sejarahprofilrs` VALUES (12, '8VmZ', '8Ryz', '2021-11-12', 'Perubahan nama rumah sakit', 'Peresmian perubahan nama RSUD Deli Serdang menjadi RSUD Drs. H. Amri Tambunan');
INSERT INTO `dt_sejarahprofilrs` VALUES (13, 'IToX', '8Ryz', '2022-08-18', 'Penetapan Rumah Sakit Pendidikan Utama', 'Penetapan Rumah Sakit Umum Daerah Drs. H. AMRI TAMBUNAN sebagai Rumah Sakit  Pendidikan Utama untuk Fakultas Kedokteran UMSU (Berdasarkan Keputusan Menteri Kesehatan RI Nomor HK.01.07/MENKES/1348/2022)');
INSERT INTO `dt_sejarahprofilrs` VALUES (14, 'S4Z7', '8Ryz', '2022-11-09', 'Lulus Paripurna Standar Akreditasi Kemenkes Tahun 2022', 'Lulus Paripurna Standar Akreditasi Kemenkes dari Komisi Akreditasi Rumah Sakit (Sertifikat Nomor KARS-SERT/327/XI/2022)');
INSERT INTO `dt_sejarahprofilrs` VALUES (15, 'w3lk', '8Ryz', '2024-04-19', 'Penetapan Rumah Sakit sebagai Unit Organisasi Bersifat Khusus pada Dinas Kesehatan Kabupaten Deli Serdang', 'Penetapan Rumah Sakit Umum Daerah Drs. H. AMRI TAMBUNAN sebagai Unit Organisasi Bersifat Khusus pada Dinas Kesehatan Kabupaten Deli Serdang sesuai dengan Peraturan Bupati Deli Serdang No.18 Tahun 2024 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi serta Tata Kerja RSUD Drs. H. AMRI TAMBUNAN');

-- ----------------------------
-- Table structure for dt_serviceex
-- ----------------------------
DROP TABLE IF EXISTS `dt_serviceex`;
CREATE TABLE `dt_serviceex`  (
  `id_serviceEx` int NOT NULL AUTO_INCREMENT,
  `kd_serviceEx` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_serviceEx` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_serviceEx` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_serviceEx` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_serviceEx` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_serviceEx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 590 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_serviceex
-- ----------------------------
INSERT INTO `dt_serviceex` VALUES (1, '6wmL', 'Bedah Saraf', 'Pelayanan bedah saraf didukung oleh tenaga dokter bedah saraf yang berpengalaman, serta didukung oleh alat kesehatan yang canggih', 'Aktif', 'a6519502cbd28ed765682fc1fec8570d.jpg');
INSERT INTO `dt_serviceex` VALUES (2, 'sZNg', 'Bedah Urologi', 'Pelayanan dan pengobatan terkait penyakit saluran kemih dan organ reproduksi pria yang didukung dokter spesialis Urologi dan alat yang canggih', 'Aktif', 'd0c1cb8824d6926a53e60a8ac9f41cd9.jpg');
INSERT INTO `dt_serviceex` VALUES (3, 'Lrqi', 'Endoscopy Center', 'Target pelayanan diagnosa dapat ditegakkan dalam waktu 1 x 24 Jam dengan tindakan endoskopi. Perdarahan dapat diatasi dalam waktu 1 x 24 Jam', 'Aktif', 'endoscopy-center2.jpg');
INSERT INTO `dt_serviceex` VALUES (4, '0ZQh', 'IPI', 'Merupakan ruang khusus bagi pasien kritis yang perlu perawatan intensif dan pengawasan terus menerus', 'Aktif', '8129582c65f2917746864634b84aca84.jpeg');
INSERT INTO `dt_serviceex` VALUES (5, 'wPf7', 'Rehabilitasi Medik', 'Tim rehabilitasi medik RSUD Drs.H. Amri Tambunan terdiri dari dokter, terapis fisik dan terapis wicara yang bekerja sama untuk menyediakan perawatan terbaik bagi pasien.', 'Aktif', 'b222697ea6fbd7390c21e994dbd499ed.jpg');

-- ----------------------------
-- Table structure for dt_spesialis
-- ----------------------------
DROP TABLE IF EXISTS `dt_spesialis`;
CREATE TABLE `dt_spesialis`  (
  `id_spesialis` int NOT NULL AUTO_INCREMENT,
  `kd_spesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_spesialis` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_spesialis`) USING BTREE,
  INDEX `idx_kd_spesialis`(`kd_spesialis` ASC) USING BTREE,
  INDEX `fk_kd_klinik`(`kd_klinik` ASC) USING BTREE,
  CONSTRAINT `fk_kd_klinik` FOREIGN KEY (`kd_klinik`) REFERENCES `dt_klinik` (`kd_klinik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_spesialis
-- ----------------------------
INSERT INTO `dt_spesialis` VALUES (11, 'WsF5', 'R5at', 'Spesialis Kardiologi Umum', '2024-10-12 10:12:09');
INSERT INTO `dt_spesialis` VALUES (12, 'BZf4', 'R5at', 'Spesialis Kardiologi Intervensi', '2024-10-12 10:12:18');
INSERT INTO `dt_spesialis` VALUES (13, 'Mhjm', 'R5at', 'Spesialis Elektrofisiologi', '2024-10-12 10:12:25');
INSERT INTO `dt_spesialis` VALUES (14, 'Aoyj', 'R5at', 'Spesialis Kardiologi Pediatrik', '2024-10-12 10:12:30');
INSERT INTO `dt_spesialis` VALUES (15, 'cht3', 'R5at', 'Spesialis Kardiologi Preventif', '2024-10-12 10:12:37');
INSERT INTO `dt_spesialis` VALUES (16, 'WPi2', 'R5at', 'Ahli Ekokardiografi', '2024-10-12 10:12:47');
INSERT INTO `dt_spesialis` VALUES (17, 'C4SE', 'R5at', 'Spesialis Penyakit Jantung Gagal', '2024-10-12 10:12:55');
INSERT INTO `dt_spesialis` VALUES (18, '6RpL', 'R5at', 'Spesialis Transplantasi Jantung', '2024-10-12 10:13:01');
INSERT INTO `dt_spesialis` VALUES (19, 'sZrT', 'SWPZ', 'Spesialis Neurologi Umum', '2024-10-12 10:19:51');
INSERT INTO `dt_spesialis` VALUES (20, 'scyt', 'SWPZ', 'Spesialis Neurologi Anak (Pediatrik)', '2024-10-12 10:19:57');
INSERT INTO `dt_spesialis` VALUES (21, 'X8nd', 'SWPZ', 'Spesialis Epileptologi', '2024-10-12 10:20:02');
INSERT INTO `dt_spesialis` VALUES (22, 'fkOq', 'SWPZ', 'Spesialis Stroke', '2024-10-12 10:20:07');
INSERT INTO `dt_spesialis` VALUES (23, 'M9g3', 'SWPZ', 'Spesialis Neuromuskular', '2024-10-12 10:20:13');
INSERT INTO `dt_spesialis` VALUES (24, 'rT7h', 'SWPZ', 'Spesialis Neuropsikologi', '2024-10-12 10:20:18');
INSERT INTO `dt_spesialis` VALUES (25, 'SbUw', 'SWPZ', 'Spesialis Sakit Kepala', '2024-10-12 10:20:25');
INSERT INTO `dt_spesialis` VALUES (26, 'uO4V', 'SWPZ', 'Spesialis Geriatri Neurologi', '2024-10-12 10:20:31');
INSERT INTO `dt_spesialis` VALUES (27, 'PGk3', 'SWPZ', 'Spesialis Tidur', '2024-10-12 10:20:37');
INSERT INTO `dt_spesialis` VALUES (28, 'do5n', 'VHmq', 'Spesialis THT Umum', '2024-10-12 10:21:31');
INSERT INTO `dt_spesialis` VALUES (29, 'F3CH', 'VHmq', 'Spesialis Otologi', '2024-10-12 10:21:38');
INSERT INTO `dt_spesialis` VALUES (30, 'FVE3', 'VHmq', 'Spesialis Rinologi', '2024-10-12 10:21:44');
INSERT INTO `dt_spesialis` VALUES (31, '2Iq6', 'VHmq', 'Spesialis Laringologi', '2024-10-12 10:21:48');
INSERT INTO `dt_spesialis` VALUES (32, 'LqSo', 'VHmq', 'Spesialis Bedah Kepala dan Leher', '2024-10-12 10:22:01');
INSERT INTO `dt_spesialis` VALUES (33, '0ZUC', 'VHmq', 'Spesialis Alergi THT', '2024-10-12 10:22:05');
INSERT INTO `dt_spesialis` VALUES (34, 'BmrW', 'VHmq', 'Spesialis Audiologi', '2024-10-12 10:22:10');
INSERT INTO `dt_spesialis` VALUES (35, 'K8Pk', 'VHmq', 'Spesialis Pediatrik THT', '2024-10-12 10:22:15');
INSERT INTO `dt_spesialis` VALUES (38, '8MQg', 'aKG8', 'Spesialis Penyakit Dalam', '2024-10-16 10:27:32');
INSERT INTO `dt_spesialis` VALUES (39, 'fw6M', 'U8IA', 'Kesehatan Anak', '2024-10-17 11:08:37');

-- ----------------------------
-- Table structure for dt_subab1nav2
-- ----------------------------
DROP TABLE IF EXISTS `dt_subab1nav2`;
CREATE TABLE `dt_subab1nav2`  (
  `id_subab1nav2` int NOT NULL AUTO_INCREMENT,
  `kd_subab1nav2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_masternavbar2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_subab1nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_subab1nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_subab1nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_subab1nav2`) USING BTREE,
  INDEX `fk_masternavbar2_subab1nav2`(`kd_masternavbar2` ASC) USING BTREE,
  INDEX `idx_kd_subab1nav2`(`kd_subab1nav2` ASC) USING BTREE,
  CONSTRAINT `fk_masternavbar2_subab1nav2` FOREIGN KEY (`kd_masternavbar2`) REFERENCES `dt_masternavbar2` (`kd_masternavbar2`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_subab1nav2
-- ----------------------------
INSERT INTO `dt_subab1nav2` VALUES (1, 'NfOU', 'Tb13', 'Profil Rumah Sakit', '/RSUD/Website/ProfilRumahSakit', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (2, 'xeMn', 'Tb13', 'Filosofi dan Makna Logo', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (3, 'sWSi', 'Tb13', 'Struktur Organisasi', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (4, 'rmbA', 'Tb13', 'Sertifikat dan Penghargaan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (5, 'V8Jd', 'Tb13', 'Maklumat Pelayanan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (6, 'oJ9u', 'SjIW', 'Dokter ', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (7, 'QjpR', 'SjIW', 'Standar Pelayanan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (8, 'Fyv4', 'SjIW', 'Pelayanan Medis', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (9, 'w9dK', 'SjIW', 'Pelayanan Penunjang', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (10, 'AwLr', 'SjIW', 'Pelayanan Unggulan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (11, 'r89j', 'SjIW', 'Layanan Inovatif', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (12, '7Fzy', 'SjIW', 'Alur Pelayanan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (13, 'C8Yo', 'SjIW', 'Alat Medis', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (14, 'jJGX', 'SjIW', 'Fasilitas Lainnya', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (15, 'kjvW', 'SjIW', 'Tarif', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (16, 'ViKX', 'SjIW', 'Jam Berkunjung', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (17, 'wJ9T', '5jGa', 'Blog', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (18, '7gzN', '5jGa', 'Artikel Kesehatan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (19, 'sqh5', '5jGa', 'Brosur', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (20, 'xBDi', '5jGa', 'Pegawai Teladan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (21, '0BvI', '5jGa', 'Galeri', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (22, 'Gfse', '5jGa', 'Podcast', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (23, '8RfV', 'Lr0O', 'WBK/WBBM', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (24, 'cCpT', 'Lr0O', 'Whistle Blowing System', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (25, 'uJYG', 'Lr0O', 'SIPPN KemenPAN-RB', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (26, 'thQG', 'Lr0O', 'Informasi Billing', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (27, 'pYtl', 'Lr0O', 'Publikasi Zona Integritas ', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (28, 'T0dQ', 'Lr0O', 'Indikator Mutu Rumah Sakit', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (29, 'WPjh', 'Lr0O', 'Ketersediaan Tempat Tidur', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (30, 'zx52', 'Lr0O', 'SPBE ', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (31, 'Q6SX', 'Lr0O', 'APLIKASI', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (40, 'HEms', 'Lr0O', 'Website Pemkab Deli Serdang ', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (41, 'ZC2B', 'Lr0O', 'PPID RSUD ', '-', 'Non-aktif');
INSERT INTO `dt_subab1nav2` VALUES (42, 'l02c', 'Lr0O', 'Frequently Asked Question (FAQ)', '-', 'Non-aktif');
INSERT INTO `dt_subab1nav2` VALUES (43, 'hNrM', 'EF9k', 'Profil Diklat', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (44, 'zZtF', 'EF9k', 'Sarana Prasarana Diklat', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (45, 'oF73', 'EF9k', 'Kalender Diklat', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (47, 'xzWG', 'EF9k', 'HEMAT', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (48, 'GCDk', 'EF9k', 'Survei Kepuasan Peserta Pelatihan', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (49, 'gUh8', 'EF9k', 'KOMKORDIK', '-', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (50, 'yox5', 'EF9k', 'Gallery Diklat', '--', 'Aktif');
INSERT INTO `dt_subab1nav2` VALUES (55, 'r1hw', 'Tb13', 'Kontak', '-', 'Aktif');

-- ----------------------------
-- Table structure for dt_subab2nav2
-- ----------------------------
DROP TABLE IF EXISTS `dt_subab2nav2`;
CREATE TABLE `dt_subab2nav2`  (
  `id_subab2nav2` int NOT NULL AUTO_INCREMENT,
  `kd_subab2nav2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_masternavbar2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_subab1nav2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_subab2nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_subab2nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket_subab2nav2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_subab2nav2`) USING BTREE,
  INDEX `fk_masternavbar2_subab2nav2`(`kd_masternavbar2` ASC) USING BTREE,
  INDEX `fk_subab1nav2_subab2nav2`(`kd_subab1nav2` ASC) USING BTREE,
  CONSTRAINT `fk_masternavbar2_subab2nav2` FOREIGN KEY (`kd_masternavbar2`) REFERENCES `dt_masternavbar2` (`kd_masternavbar2`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_subab1nav2_subab2nav2` FOREIGN KEY (`kd_subab1nav2`) REFERENCES `dt_subab1nav2` (`kd_subab1nav2`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_subab2nav2
-- ----------------------------
INSERT INTO `dt_subab2nav2` VALUES (11, '1usF', 'SjIW', 'oJ9u', 'Dokter Kami', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (12, '9Y4w', 'SjIW', 'oJ9u', 'Jadwal Dokter', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (13, 'TEaI', 'SjIW', 'Fyv4', 'Instalasi Gawat Darurat', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (14, 'gen4', 'SjIW', 'Fyv4', 'Poliklinik', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (15, 'fjmb', 'SjIW', 'Fyv4', 'Layanan Rawat Inap', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (16, 'QD6r', 'SjIW', 'Fyv4', 'Instalasi Perawatan Intensif (IPI)', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (17, '75tL', 'SjIW', 'Fyv4', 'Medical Check Up (MCU)', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (18, '63Hz', 'SjIW', 'w9dK', 'Laboraturium', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (19, 'kyWf', 'SjIW', 'w9dK', 'Radiologi', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (20, 'lKzJ', 'SjIW', 'w9dK', 'Hemodialisa', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (21, 'Q0m1', 'SjIW', 'w9dK', 'Kamar bedah', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (22, 'fnWC', 'SjIW', 'AwLr', 'Bedah Saraf', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (23, 'mhxb', 'SjIW', 'AwLr', 'Bedah Urologi', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (24, 'nm0u', 'SjIW', 'AwLr', 'Endoscopy Center', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (25, 'rCeJ', 'SjIW', 'AwLr', 'IPI', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (26, 'DaW9', 'SjIW', 'AwLr', 'Rehabilitasi Medik', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (27, 'EcGf', 'Lr0O', 'Q6SX', 'SIDOKAR', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (28, '8p6j', 'Lr0O', 'Q6SX', 'RS Online', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (29, 'Sa7W', 'Lr0O', 'Q6SX', 'ASPAK', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (30, 'etwK', 'Lr0O', 'Q6SX', 'SIPD Deli Serdang', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (31, 'JTBD', 'Lr0O', 'cCpT', 'Pengaduan Layanan Publik', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (32, 'MOsy', 'Lr0O', 'cCpT', 'SP4N LAPOR', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (33, 'LklS', 'Lr0O', 'cCpT', 'Alur Penyampaian Komplain', '-', 'Aktif');
INSERT INTO `dt_subab2nav2` VALUES (34, '9T8S', 'Lr0O', 'cCpT', 'Laporan Pengaduan dan Komplain', '-', 'Aktif');

-- ----------------------------
-- Table structure for dt_subspesialis
-- ----------------------------
DROP TABLE IF EXISTS `dt_subspesialis`;
CREATE TABLE `dt_subspesialis`  (
  `id_subspesialis` int NOT NULL AUTO_INCREMENT,
  `kd_subspesialis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_klinik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_subspesialis` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_subspesialis`) USING BTREE,
  INDEX `idx_kd_spesialis`(`kd_subspesialis` ASC) USING BTREE,
  INDEX `fk_kd_klinik`(`kd_klinik` ASC) USING BTREE,
  CONSTRAINT `fk_kd_klinik_subspesialis` FOREIGN KEY (`kd_klinik`) REFERENCES `dt_klinik` (`kd_klinik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_subspesialis
-- ----------------------------
INSERT INTO `dt_subspesialis` VALUES (1, 'jp95', 'aKG8', 'Kardiologi', '2024-10-16 12:07:41');
INSERT INTO `dt_subspesialis` VALUES (2, 'IhQw', 'aKG8', 'Endokrinologi', '2024-10-16 12:08:31');
INSERT INTO `dt_subspesialis` VALUES (3, 'mP2I', 'aKG8', 'Gastroenterologi', '2024-10-16 12:08:36');
INSERT INTO `dt_subspesialis` VALUES (4, '23nT', 'aKG8', 'Hematologi', '2024-10-16 12:08:40');
INSERT INTO `dt_subspesialis` VALUES (5, 'l0RG', 'aKG8', 'Nefrologi', '2024-10-16 12:08:45');
INSERT INTO `dt_subspesialis` VALUES (6, 'Mgr5', 'aKG8', 'Pulmonologi', '2024-10-16 12:08:50');
INSERT INTO `dt_subspesialis` VALUES (7, 'scWQ', 'aKG8', 'Reumatologi', '2024-10-16 12:08:57');
INSERT INTO `dt_subspesialis` VALUES (8, '4oak', 'aKG8', 'Penyakit', '2024-10-16 12:09:01');
INSERT INTO `dt_subspesialis` VALUES (9, 'TIsD', 'U8IA', 'Pediatri Umum', '2024-10-17 11:17:32');
INSERT INTO `dt_subspesialis` VALUES (10, 'RWTn', 'U8IA', 'Pediatri Endokrinologi', '2024-10-17 11:17:40');
INSERT INTO `dt_subspesialis` VALUES (11, 'wjY1', 'U8IA', 'Pediatri Kardiologi', '2024-10-17 11:17:57');
INSERT INTO `dt_subspesialis` VALUES (12, 'xey9', 'U8IA', 'Pediatri Pulmonologi', '2024-10-17 11:18:04');
INSERT INTO `dt_subspesialis` VALUES (13, 'lWHp', 'U8IA', 'Pediatri Gastroenterologi', '2024-10-17 11:18:11');
INSERT INTO `dt_subspesialis` VALUES (14, 'wqZJ', 'U8IA', 'Pediatri Neurologi', '2024-10-17 11:18:19');
INSERT INTO `dt_subspesialis` VALUES (15, 'KYpH', 'U8IA', 'Pediatri Infeksi', '2024-10-17 11:18:32');

-- ----------------------------
-- Table structure for dt_syaratjb
-- ----------------------------
DROP TABLE IF EXISTS `dt_syaratjb`;
CREATE TABLE `dt_syaratjb`  (
  `id_SyaratJB` int NOT NULL AUTO_INCREMENT,
  `kd_SyaratJB` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_SyaratJB` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_SyaratJB`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_syaratjb
-- ----------------------------
INSERT INTO `dt_syaratjb` VALUES (1, '5tGa', 'Security mencatat nama pasien yang akan dikunjungi beserta nama ruangannya');
INSERT INTO `dt_syaratjb` VALUES (2, 'VW5v', 'Pengunjung harus menjaga kebersihan selama di lingkungan RSUD Drs. H Amri Tambunan');
INSERT INTO `dt_syaratjb` VALUES (3, '6ilf', 'Makanan dari luar tidak diperbolehkan untuk dibawa ke ruang rawat inap');
INSERT INTO `dt_syaratjb` VALUES (4, 'YR25', 'Pengunjung yang boleh masuk hanya 2 orang');

-- ----------------------------
-- Table structure for dt_tarif
-- ----------------------------
DROP TABLE IF EXISTS `dt_tarif`;
CREATE TABLE `dt_tarif`  (
  `id_tarif` int NOT NULL AUTO_INCREMENT,
  `kd_tarif` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Ket_tarif` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dokumen_tarif` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_tarifperda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_tarif`) USING BTREE,
  INDEX `idx_kd_tarif`(`kd_tarif` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_tarif
-- ----------------------------
INSERT INTO `dt_tarif` VALUES (1, '7t09', 'Sesuai Perbub No.32 Tahun 2022', '7t09_20241001_162126.pdf', '2024-10-01 16:21:26', 0);

-- ----------------------------
-- Table structure for dt_tarirj
-- ----------------------------
DROP TABLE IF EXISTS `dt_tarirj`;
CREATE TABLE `dt_tarirj`  (
  `id_tariRJ` int NOT NULL AUTO_INCREMENT,
  `kd_tariRJ` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_PelayananRJ` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tarifRJ` int NOT NULL,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_tariRJ`) USING BTREE,
  INDEX `idx_kd_tariRJ`(`kd_tariRJ` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_tarirj
-- ----------------------------
INSERT INTO `dt_tarirj` VALUES (1, 'IvUx', 'Rekam Medis', 10000, 0);
INSERT INTO `dt_tarirj` VALUES (2, 'Nkg5', 'Pemeriksaan Gigi / Klinik Umum', 45000, 0);
INSERT INTO `dt_tarirj` VALUES (3, 'pbhF', 'Pemeriksaan Gigi / Klinik Ahli', 60000, 0);
INSERT INTO `dt_tarirj` VALUES (4, 'eICT', 'Pemeriksaan Klinik Sub Spesial', 75000, 0);
INSERT INTO `dt_tarirj` VALUES (5, 'YGWm', 'IGD / Care', 76000, 0);
INSERT INTO `dt_tarirj` VALUES (6, 'gz7u', 'IGD Administrasi Rawat Inap ', 114000, 0);
INSERT INTO `dt_tarirj` VALUES (7, 'tHdS', 'Gizi Klinis / Farmasi Klinis', 30000, 0);
INSERT INTO `dt_tarirj` VALUES (8, 'khKn', 'Konsultasi Dokter / Konseling HIV / AIDS', 30000, 0);
INSERT INTO `dt_tarirj` VALUES (9, '3n7b', 'Psikologi', 30000, 0);
INSERT INTO `dt_tarirj` VALUES (10, 'FBvR', 'Dll', 30000, 0);

-- ----------------------------
-- Table structure for dt_users
-- ----------------------------
DROP TABLE IF EXISTS `dt_users`;
CREATE TABLE `dt_users`  (
  `id_userpanel` int NOT NULL AUTO_INCREMENT,
  `username_adm` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_useradmin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `passwd_adm` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_adm` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_userpanel`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_users
-- ----------------------------
INSERT INTO `dt_users` VALUES (1, 'master@gmail.com', 'gdJ7', '$2y$10$GkJgL15wx/TBHtRrOXkiuurjBna1Ml8jHk05oOtE/m07i5Mkadh9O', 'Master');

-- ----------------------------
-- Table structure for dt_userslogin
-- ----------------------------
DROP TABLE IF EXISTS `dt_userslogin`;
CREATE TABLE `dt_userslogin`  (
  `id_userslgn` int NOT NULL AUTO_INCREMENT,
  `kd_userslgn` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_userlgn` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_userslgn` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_lvluser` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_lvluser` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_userslgn`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_userslogin
-- ----------------------------
INSERT INTO `dt_userslogin` VALUES (2, 'ftA6', 'izatunnisa', 'iza@gmail.com', '15Oh', 'Admin', '2024-08-20 16:29:53');

-- ----------------------------
-- Table structure for dt_videonews
-- ----------------------------
DROP TABLE IF EXISTS `dt_videonews`;
CREATE TABLE `dt_videonews`  (
  `id_videonews` int NOT NULL AUTO_INCREMENT,
  `kd_videonews` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_news` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_videonews` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_videonews`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_videonews
-- ----------------------------
INSERT INTO `dt_videonews` VALUES (1, 'I3Md', 'ruCP', 'I3Md_20240925_122817.mp4', '2024-10-08 08:28:27');
INSERT INTO `dt_videonews` VALUES (2, 'LsUg', 'EKjT', 'LsUg_20241008_152902.mp4', '2024-10-08 08:29:02');

-- ----------------------------
-- Table structure for dt_visiprofilrs
-- ----------------------------
DROP TABLE IF EXISTS `dt_visiprofilrs`;
CREATE TABLE `dt_visiprofilrs`  (
  `id_visiProfilRS` int NOT NULL AUTO_INCREMENT,
  `kd_visiProfilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_profilRS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_visiProfilRS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_visiProfilRS`) USING BTREE,
  INDEX `idx_kd_visiProfilRS`(`kd_visiProfilRS` ASC) USING BTREE,
  INDEX `fk_visiprofilrs`(`kd_profilRS` ASC) USING BTREE,
  CONSTRAINT `fk_visiprofilrs` FOREIGN KEY (`kd_profilRS`) REFERENCES `dt_profilrs` (`kd_profilRS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dt_visiprofilrs
-- ----------------------------
INSERT INTO `dt_visiprofilrs` VALUES (1, 'kKe5', '8Ryz', 'MENJADI RUMAH SAKIT PENDIDIKAN YANG BERDAYA SAING DENGAN MENGUTAMAKAN PELAYANAN PROFESIONAL, INOVATIF DAN BERBUDAYA MENUJU RUMAH SAKIT BERSTANDAR INTERNASIONAL 2024');

-- ----------------------------
-- Triggers structure for table dt_masterjadwalpp
-- ----------------------------
DROP TRIGGER IF EXISTS `update_nm_MasterjadwalPP`;
delimiter ;;
CREATE TRIGGER `update_nm_MasterjadwalPP` AFTER UPDATE ON `dt_masterjadwalpp` FOR EACH ROW BEGIN
    UPDATE dt_jadwalpp
    SET nm_MasterjadwalPP = NEW.nm_MasterjadwalPP
    WHERE kd_MasterjadwalPP = NEW.kd_MasterjadwalPP;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_masterjampp
-- ----------------------------
DROP TRIGGER IF EXISTS `update_nm_MasterjamPP`;
delimiter ;;
CREATE TRIGGER `update_nm_MasterjamPP` AFTER UPDATE ON `dt_masterjampp` FOR EACH ROW BEGIN
    UPDATE dt_jadwalpp
    SET nm_MasterjamPP = NEW.nm_MasterjamPP
    WHERE kd_MasterjamPP = NEW.kd_MasterjamPP;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_masterjb
-- ----------------------------
DROP TRIGGER IF EXISTS `update_nm_masterjb`;
delimiter ;;
CREATE TRIGGER `update_nm_masterjb` AFTER UPDATE ON `dt_masterjb` FOR EACH ROW BEGIN
    UPDATE `dt_jadwal`
    SET `nm_MasterJB` = NEW.nm_MasterJB
    WHERE `kd_MasterJB` = NEW.kd_MasterJB;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_profilrs
-- ----------------------------
DROP TRIGGER IF EXISTS `update_kd_profilRS_in_misiprofil`;
delimiter ;;
CREATE TRIGGER `update_kd_profilRS_in_misiprofil` AFTER UPDATE ON `dt_profilrs` FOR EACH ROW BEGIN
    UPDATE `dt_misiprofilrs`
    SET `kd_profilRS` = NEW.kd_profilRS
    WHERE `kd_profilRS` = OLD.kd_profilRS;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_profilrs
-- ----------------------------
DROP TRIGGER IF EXISTS `update_kd_profilRS_in_visiprofil`;
delimiter ;;
CREATE TRIGGER `update_kd_profilRS_in_visiprofil` AFTER UPDATE ON `dt_profilrs` FOR EACH ROW BEGIN
    UPDATE `dt_visiprofilrs`
    SET `kd_profilRS` = NEW.kd_profilRS
    WHERE `kd_profilRS` = OLD.kd_profilRS;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_profilrs
-- ----------------------------
DROP TRIGGER IF EXISTS `update_kd_profilRS_in_fotoprofil`;
delimiter ;;
CREATE TRIGGER `update_kd_profilRS_in_fotoprofil` AFTER UPDATE ON `dt_profilrs` FOR EACH ROW BEGIN
    UPDATE `dt_fotoprofilrs`
    SET `kd_profilRS` = NEW.kd_profilRS
    WHERE `kd_profilRS` = OLD.kd_profilRS;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_profilrs
-- ----------------------------
DROP TRIGGER IF EXISTS `update_kd_profilRS_in_filepdfprofil`;
delimiter ;;
CREATE TRIGGER `update_kd_profilRS_in_filepdfprofil` AFTER UPDATE ON `dt_profilrs` FOR EACH ROW BEGIN
    UPDATE `dt_filepdfprofilrs`
    SET `kd_profilRS` = NEW.kd_profilRS
    WHERE `kd_profilRS` = OLD.kd_profilRS;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table dt_profilrs
-- ----------------------------
DROP TRIGGER IF EXISTS `update_kd_profilRS_in_sejarahprofil`;
delimiter ;;
CREATE TRIGGER `update_kd_profilRS_in_sejarahprofil` AFTER UPDATE ON `dt_profilrs` FOR EACH ROW BEGIN
    UPDATE `dt_sejarahprofilrs`
    SET `kd_profilRS` = NEW.kd_profilRS
    WHERE `kd_profilRS` = OLD.kd_profilRS;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
