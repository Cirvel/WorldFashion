-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bidanglomba`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Wedding Planners Hyderabad Event', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis purus eu nisl interdum, eget venenatis odio lacinia. In at nisl diam. Phasellus maximus feugiat vulputate. Sed porttitor enim ac elit sagittis vestibulum. Duis at feugiat lectus. Vivamus in libero augue. Donec vulputate nisl nec enim congue ornare bibendum nec odio. Phasellus luctus urna porttitor tortor luctus, pretium gravida tellus maximus. Cras vestibulum justo tellus, a tincidunt arcu vehicula ac. Aliquam ullamcorper diam id enim elementum commodo.', 'fr5KSYG7N7oJSIa9.jpeg', '2024-05-30 09:57:09', '2024-05-30 09:57:09'),
(2, 'Yran Start', 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer viverra ultrices enim eu ornare. Sed ac nibh a quam venenatis feugiat ac at ex. Integer semper lobortis lectus, sed fermentum magna sagittis pretium. Vestibulum dignissim orci et turpis tempus, eu mattis sapien egestas. Nunc placerat, tellus at rhoncus convallis, eros sapien auctor ex, sit amet sagittis urna nisi sit amet odio. Integer nec venenatis massa. Nunc tincidunt, arcu at aliquet hendrerit, purus ipsum pharetra nibh, ac pretium nisl est vitae orci.', 'TRUEqUkvFHcgLLzj.webp', '2024-05-30 09:57:25', '2024-05-30 09:57:25'),
(3, 'COMM Waterfire', 'Curabitur eu gravida elit. Integer finibus nibh id enim sodales finibus. Sed hendrerit ornare lectus, sit amet vulputate lectus ultrices nec. Sed laoreet eleifend tristique. Ut mattis enim sit amet purus porta, eget fringilla metus luctus. Integer lobortis ac elit ac sagittis. Aenean vel imperdiet magna. Aenean sollicitudin condimentum dui, a maximus nulla vestibulum auctor. Nam volutpat tortor orci, nec viverra elit finibus in. Ut odio orci, bibendum sit amet nisl vel, laoreet cursus risus. Nulla blandit placerat placerat.', 'zN6cACB3Bcn24056.jpg', '2024-05-30 09:57:44', '2024-05-30 09:57:44'),
(4, 'NYC Tribalists', 'Fusce eget libero urna. Vestibulum sit amet fermentum dui. In non urna et tellus tristique malesuada quis eget turpis. Fusce volutpat felis ut leo feugiat, eget mattis erat condimentum. Suspendisse id lectus molestie, blandit neque vel, sodales eros. Aenean ullamcorper consectetur felis. Nam porta gravida tortor eu auctor. Mauris eleifend eget mauris sed dignissim. Vivamus a neque id neque tempus dapibus ut id enim. Phasellus elit risus, viverra at iaculis vel, fringilla at felis. Vestibulum est urna, eleifend sit amet turpis a, pulvinar cursus urna. Sed ac nulla condimentum, volutpat libero id, consectetur dui. Mauris tortor ligula, aliquam quis volutpat eu, cursus eu nulla. Nunc eu sapien neque.', 'KAeNdosk3XNYLajr.jpg', '2024-05-30 09:58:21', '2024-05-30 09:58:21'),
(5, 'Canberra Dragon Visit Festival', 'Integer nec lorem lectus. Curabitur augue diam, porttitor non euismod a, feugiat a risus. Sed vulputate pulvinar neque sit amet lacinia. Nunc egestas non leo a semper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Fusce turpis nunc, pretium in mattis eu, cursus commodo turpis. Aenean placerat nisi turpis, vitae mattis sapien fermentum malesuada. Quisque quis sodales magna, vel laoreet est.', 'ZYaBwAbPJ3E0pT7o.jpg', '2024-05-30 09:58:47', '2024-05-30 09:58:47'),
(6, 'Houston House STL Event', 'Pellentesque posuere purus nec libero molestie, non fermentum eros pellentesque. Aliquam semper maximus massa. Aliquam pharetra nibh sit amet risus tincidunt, in bibendum orci egestas. Etiam efficitur tempor mauris, vitae molestie felis porta sed. Vestibulum tincidunt mi orci, sed euismod neque suscipit vitae. Curabitur eleifend, nunc sit amet ullamcorper dapibus, lectus sapien vehicula mauris, ac hendrerit ex ligula a metus. Nam mollis diam erat. Fusce sit amet fringilla nulla. Integer purus quam, malesuada ac massa sed, tempor viverra diam. Mauris tincidunt, elit in scelerisque sagittis, orci leo sodales odio, vitae finibus nibh leo eu quam. Etiam vitae mattis felis. Donec pulvinar eu metus sed rutrum. Phasellus at fermentum erat. Morbi varius est eu nulla ultrices, vitae pulvinar sem congue.', 'NBORy15DYjUwvisq.jpg', '2024-05-30 09:59:08', '2024-05-30 09:59:08'),
(7, 'Eventful Event', 'Curabitur vitae nibh sagittis, cursus odio quis, elementum felis. Vivamus vehicula metus magna, nec sodales nisi laoreet non. In pretium nulla aliquam, elementum nisi in, consequat dolor. Curabitur nibh diam, porttitor eleifend auctor id, auctor eu mi. Duis feugiat lobortis bibendum. Nunc libero massa, egestas non est et, varius lobortis lectus. Vestibulum sit amet pellentesque nulla. Suspendisse sed felis quam. Nullam pulvinar tempus sagittis. Proin hendrerit nisl vel tincidunt lacinia. Praesent et est vel ex aliquam sagittis. Sed eu facilisis nibh. Nullam velit sem, faucibus at ullamcorper eu, eleifend eget mauris.', 'DS6D8uyetVFm0pXF.webp', '2024-05-30 09:59:23', '2024-05-30 09:59:23'),
(8, 'Corporate Event', 'Donec cursus arcu tellus, ut eleifend ante molestie et. Suspendisse suscipit metus sit amet ipsum euismod bibendum. Donec ut pellentesque purus, eget accumsan tellus. Vestibulum posuere turpis sit amet metus malesuada, sed gravida sem pharetra. Etiam ipsum libero, dignissim id mi at, ornare lacinia tellus. Cras lacinia dolor mi, ac varius nisl rhoncus et. Praesent tempor diam vitae eros faucibus ultrices. Pellentesque et mauris semper, mollis nulla condimentum, aliquam justo. Aliquam nec velit lobortis, placerat metus vitae, dignissim libero. Vestibulum mauris eros, interdum nec massa id, pulvinar consectetur eros. Mauris semper, mauris vitae porta consequat, felis nunc semper urna, eu maximus ex ex sed turpis. Nullam efficitur dui sem, vitae luctus nibh commodo quis.', 'BQvYxh9UXgvmNuke.webp', '2024-05-30 09:59:41', '2024-05-30 09:59:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
