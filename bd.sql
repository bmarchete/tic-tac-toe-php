CREATE DATABASE IF NOT EXISTS `bd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;