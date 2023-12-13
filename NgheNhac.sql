-- create database nghenhac;
-- USE nghenhac;

CREATE TABLE account (
    username VARCHAR(20) PRIMARY KEY,
    password varchar(255)
);

CREATE TABLE song (
    id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    playedTime INT,
    linkSong VARCHAR(255),
    linkPicture VARCHAR(255)
);

CREATE TABLE artist (
	id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    linkPicture VARCHAR(255)
);

CREATE TABLE category (
	id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    linkPicture VARCHAR(255)
);

CREATE TABLE playlist (
	id VARCHAR(5) PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username varchar(20) REFERENCES account (username)
);

CREATE TABLE song_artist (
	id VARCHAR(5) PRIMARY KEY,
    id_song VARCHAR(5) REFERENCES song (id),
    id_artist VARCHAR(5) REFERENCES artist (id)
);

CREATE TABLE song_category (
	id VARCHAR(5) PRIMARY KEY,
    id_song VARCHAR(5) REFERENCES song (id),
    id_category VARCHAR(5) REFERENCES category (id)
);

CREATE TABLE song_playlist(
	id VARCHAR(5) PRIMARY KEY,
    id_song VARCHAR(5) REFERENCES song (id),
    id_playlist VARCHAR(5) REFERENCES playlist (id)
);

-- NHẬP DỮ LIỆU --
INSERT INTO `account` VALUES ('chuduchung','duchung123'),('tongdangtu','dangtu123'),('vungocchinh','ngocchinh123');
INSERT INTO `artist` VALUES ('10001','Sơn Tùng MTP','https://tongdangtu.000webhostapp.com/img/artist/Sơn Tùng.jpg'),('10002','Taylor Swift','https://tongdangtu.000webhostapp.com/img/artist/Taylor Swift.jpg'),('10003','Michael Jackson','https://tongdangtu.000webhostapp.com/img/artist/Michael Jackson.jpg');
INSERT INTO `category` VALUES ('10001','rock','https://tongdangtu.000webhostapp.com/img/category/rock.jpg'),('10002','jazz','https://tongdangtu.000webhostapp.com/img/category/jazz.jpg'),('10003','pop','https://tongdangtu.000webhostapp.com/img/category/pop.jpg');
INSERT INTO `playlist` VALUES ('10001','Tuyển tập Sơn Tùng','tongdangtu'),('10002','Nhạc trẻ','tongdangtu'),('10003','Top nhạc pop','chuduchung'),('10004','Nhạc ngoại','tongdangtu');
INSERT INTO `song` VALUES ('10001','Nơi này có anh',10,'https://tongdangtu.000webhostapp.com/song/Nơi này có anh.mp3','https://tongdangtu.000webhostapp.com/img/Nơi này có anh.jpg'),('10002','Red',2,'https://tongdangtu.000webhostapp.com/song/Red.mp3','https://tongdangtu.000webhostapp.com/img/Red.jpg'),('10003','Smooth Criminal',3,'https://tongdangtu.000webhostapp.com/song/Smooth Criminal.mp3','https://tongdangtu.000webhostapp.com/img/Crimson.jpg'),('10004','Chạy ngay đi',5,'https://tongdangtu.000webhostapp.com/song/Chạy ngay đi.mp3','https://tongdangtu.000webhostapp.com/img/Chạy ngay đi.jpg'),('10005','Em của ngày hôm qua',20,'https://tongdangtu.000webhostapp.com/song/Em của ngày hôm qua.mp3','https://tongdangtu.000webhostapp.com/img/Em của ngày hôm qua.jpg');
INSERT INTO `song_artist` VALUES ('10001','10001','10001'),('10002','10002','10002'),('10003','10003','10003'),('10004','10004','10001'),('10005','10005','10001');
INSERT INTO `song_category` VALUES ('10001','10001','10003'),('10002','10002','10001'),('10003','10003','10003'),('10004','10004','10003'),('10005','10005','10003');
INSERT INTO `song_playlist` VALUES ('10001','10001','10001'),('10002','10001','10002'),('10003','10001','10003'),('10004','10002','10004'),('10005','10002','10003'),('10006','10003','10004'),('10007','10004','10001'),('10008','10004','10002'),('10009','10004','10003'),('10010','10005','10001'),('10011','10005','10002'),('10012','10005','10003');


