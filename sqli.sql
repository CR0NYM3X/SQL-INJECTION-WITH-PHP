# Host: 127.0.0.1  (Version 5.5.5-10.1.25-MariaDB)
# Date: 2017-09-29 17:55:34
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "info_cliente"
#

CREATE TABLE `info_cliente` (
  `user_agent` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "info_cliente"
#

INSERT INTO `info_cliente` VALUES ('Mozilla/5.0 (Windows NT 6.3; rv:55.0) Gecko/20100101 Firefox/55.0','127.0.0.1',1);

#
# Structure for table "login"
#

CREATE TABLE `login` (
  `usuario` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "login"
#

INSERT INTO `login` VALUES ('jose','123'),('luis','123'),('asasd','asdasd');

#
# Structure for table "productos"
#

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "productos"
#

INSERT INTO `productos` VALUES (1,'jamon','rico delicioso'),(2,'tortillas','gran paquete'),(3,'verduras','frescas y varatas'),(4,'sodas','cocacola'),(5,'sabritas','grandes'),(6,'pan','bimbo'),(7,'jose',' ');
