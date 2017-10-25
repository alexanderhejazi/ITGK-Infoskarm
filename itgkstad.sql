SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `post` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` datetime NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `news` (`id`, `user`, `post`, `created`, `valid`, `type`) VALUES
(1, 2, 'Anmälan och betalningen inför DreamHack-resan måste göras innan fredagen 13/10. Görs inte detta får man inte följa med.', '2017-10-12 12:15:00', '2017-10-14 17:19:40', 0),
(2, 1, 'I morgon är det öppet hus på skolan. Var noga med att städa klassrummen idag och sätt upp stolarna!', '2017-10-13 10:18:28', '2017-10-13 21:19:40', 0),
(3, 2, 'Mellan den 27/10 och 29/10 kommer det att arrangeras ett LAN på ITG Kristianstad. Anmäl dig på itgkstad.se/lan', '2017-10-11 10:19:50', '2017-10-27 08:19:40', 0),
(4, 1, 'Studie- och yrkesvägledare Mats Hermansson är nu under hösten på skolan följande datum:\r\n\r\n- 4 Dec\r\n- 11 Dec\r\n\r\nFör enskilt samtal kring frågor och funderingar om studier, boka tid hos Marie.', '2017-09-27 10:21:55', '2017-12-11 17:19:40', 1),
(9, 2, 'Den 27 oktober kommer det att vara Halloween och då måste man vara utklädd.', '2017-10-16 09:02:37', '2017-10-27 14:00:00', 0),
(10, 2, 'Det finns nu plats för 1 lag till att anmäla sig till Gymnasiecupen. Kontakta Jonathan Friberg i TE15 för mer info och anmälan.', '2017-10-19 06:22:42', '2017-10-19 12:45:00', 1),
(11, 2, 'Glöm inte anmäla ert lag till LANet i helgen! Gå in på itgkstad.se/lag för att anmäla ett lag.', '2017-10-25 06:00:00', '2017-10-27 22:19:40', 0);

CREATE TABLE `prov` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `department` varchar(5) NOT NULL,
  `assignment` varchar(128) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `prov` (`id`, `user`, `subject`, `department`, `assignment`, `deadline`) VALUES
(1, 1, 4, 'TE15', 'Prov kapitel 1', '2017-10-24 14:00:00'),
(3, 1, 1, 'TE15', 'Testuppgift klar', '2017-10-27 15:00:00');

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `shortcode` varchar(64) NOT NULL,
  `subject` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO `subjects` (`id`, `shortcode`, `subject`) VALUES
(1, 'DAODIG0', 'Dator- och kommunikationsteknik'),
(2, 'ENTENR0', 'Entreprenörskap'),
(3, 'KEMKEM01', 'Kemi 1'),
(4, 'MATMAT04', 'Matematik 4'),
(5, 'PRRPRR02', 'Programmering 2'),
(6, 'SVESVE03', 'Svenska 3'),
(7, 'WESWEB02', 'Webbserverprogrammering 2');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'ITG Kristianstad'),
(2, 'Elevrådet');


ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `prov`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
ALTER TABLE `prov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
