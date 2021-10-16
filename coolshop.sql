-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2019 at 05:49 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coolshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `kupac`
--

CREATE TABLE `kupac` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ime` text NOT NULL,
  `lozinka` text NOT NULL,
  `adresa` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kupac`
--

INSERT INTO `kupac` (`id`, `email`, `ime`, `lozinka`, `adresa`) VALUES
(1, 'andja@gmail.com', 'Andja', 'fandja', 'adresa1'),
(3, 'milica@gmail.com', 'Milica', 'krupi', 'adresa2'),
(4, 'admin@gmail.com', 'admin', 'admin', 'admin'),
(5, 'marija@gmail.com', 'Marija', 'marijeta', 'adresa3'),
(7, 'mikamikic@gmail.com', 'Mika Mikic', 'mikamikic', 'Mike Mikica 12');

-- --------------------------------------------------------

--
-- Table structure for table `porudzbine`
--

CREATE TABLE `porudzbine` (
  `id` int(11) NOT NULL,
  `kupac` text NOT NULL,
  `proizvod` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `porudzbine`
--

INSERT INTO `porudzbine` (`id`, `kupac`, `proizvod`, `datum`) VALUES
(1, 'admin@gmail.com', 4, '2018-12-02 18:39:16'),
(8, 'admin@gmail.com', 5, '2018-12-02 23:29:04'),
(9, 'mikamikic@gmail.com', 6, '2018-12-02 23:30:17'),
(11, 'milica@gmail.com', 4, '2019-01-29 15:41:14'),
(12, 'milica@gmail.com', 7, '2019-01-29 15:41:27'),
(13, 'admin@gmail.com', 10, '2019-01-29 15:53:42'),
(14, 'admin@gmail.com', 12, '2019-01-29 15:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idproizvod` int(11) NOT NULL,
  `naziv` text COLLATE utf8_unicode_ci NOT NULL,
  `idtip` int(11) NOT NULL,
  `dimenzije` text COLLATE utf8_unicode_ci NOT NULL,
  `autor` text COLLATE utf8_unicode_ci NOT NULL,
  `godina` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `cena` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idproizvod`, `naziv`, `idtip`, `dimenzije`, `autor`, `godina`, `url`, `cena`) VALUES
(4, 'Dama s kamelijama', 1, '13 x 20 cm', 'Aleksandar Dima Sin', '2017.', '/slike/dama s kamelijama.jpg', 799.00),
(5, 'Veliki Getsbi', 1, '13 x 20 cm', 'F. Skot Ficdžerald', '2011.', '/slike/veliki getsbi.jpg', 799.00),
(6, 'Proces', 1, '13 x 20 cm', 'Franc Kafka', '2018.', '/slike/proces.jpg', 599.00),
(7, 'Peščani sat', 2, '13 x 20 cm', 'Trejsi Ris', '2018.', '/slike/pescani_sat-trejsi_ris_v.jpg', 1199.00),
(8, 'Dobra je ovaj život', 2, '13 x 20 cm', 'Aleks Kapi', '2018.', '/slike/dobar_je_ovaj_zivot-aleks_kapi_v.jpg', 699.00),
(9, 'A ako je to ipak istina', 2, '13 x 20 cm', 'Mark Levi', '2018.', '/slike/a ako je to sve istina.jpg', 499.00),
(10, 'Šesta faza sna', 3, '13 x 20 cm', 'Bernar Verber', '2018.', '/slike/sesta_faza_sna-bernar_verber_v.jpg', 1099.00),
(12, 'Farenhajt 451', 3, '13 x 20 cm', 'Rej Bredberi', '2015.', '/slike/farenhajt 451.jpg', 699.00),
(13, 'Susret sa Ramom', 3, '13 x 20 cm', 'Artur Klark', '2011.', '/slike/susret sa ramom.jpg', 899.00),
(14, 'Moć kreativnosti', 4, '13 x 20 cm', 'Džona Lerer', '2018.', '/slike/moc_kreativnosti-dzona_lerer_v.jpg', 799.00),
(15, 'Ne nauditi', 4, '13 x 20 cm', 'Henri Marš', '2018.', '/slike/ne_nauditi-henri_mars_v.jpg', 799.00),
(16, 'Ne tako savršena mama', 4, '13 x 20 cm', 'Sara Tarner', '2018.', '/slike/ne_tako_savrsena_mama_v.jpg', 799.00),
(17, 'Iščezla', 5, '13 x 20 cm', 'Bela Džilijen Flin', '2013.', '/slike/iscezla-dzilijen_flin_v.jpg', 1199.00),
(18, 'Rebeka', 5, '13 x 20 cm', 'Dafne di Morije', '2018.', '/slike/rebeka-dafne_di_morije_v.jpg', 799.00),
(19, 'Ako me jednom prevariš', 5, '13 x 20cm', 'Harlan Koben', '2017.', '/slike/ako_me_jednom_prevaris-harlan_koben_v.jpg', 899.00);

-- --------------------------------------------------------

--
-- Table structure for table `tipovi`
--

CREATE TABLE `tipovi` (
  `idtip` int(11) NOT NULL,
  `tip` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipovi`
--

INSERT INTO `tipovi` (`idtip`, `tip`) VALUES
(1, 'Klisici'),
(2, 'Ljubavni romani'),
(3, 'Naučna fantastika'),
(4, 'Psihologija'),
(5, 'Trileri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kupac`
--
ALTER TABLE `kupac`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `porudzbine`
--
ALTER TABLE `porudzbine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idproizvod`);

--
-- Indexes for table `tipovi`
--
ALTER TABLE `tipovi`
  ADD PRIMARY KEY (`idtip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kupac`
--
ALTER TABLE `kupac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `porudzbine`
--
ALTER TABLE `porudzbine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idproizvod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tipovi`
--
ALTER TABLE `tipovi`
  MODIFY `idtip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
