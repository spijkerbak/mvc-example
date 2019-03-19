SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `note`;

CREATE TABLE `user` (
  `email` varchar(120) PRIMARY KEY,
  `salt` varchar(64) NOT NULL,
  `passwordHash` varchar(64) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`email`, `salt`, `passwordHash`, `level`) VALUES
('frans@spijkerman.nl', '12345678910', 'f618ae97c9f08912d346729818ac46fc', 2),
('henk@avans.nl', '3faeacc31559960dbfadf3bb5c7b6986', '', 1);

CREATE TABLE `note` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `title` varchar(80) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `owner` varchar(120),
  FOREIGN KEY (`owner`) REFERENCES `user`(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;
