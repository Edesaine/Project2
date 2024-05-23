-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2024 lúc 04:17 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Lam Anh', 'xdarkrain178x@gmail.com', 'kinkin'),
(2, 'tung', 'tung@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authorbook`
--

CREATE TABLE `authorbook` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `name`, `country`) VALUES
(2, 'To Hoai', 'Viet Nam'),
(3, 'Nguyen Nhat Anh', 'Viet Nam'),
(4, 'J. K. Rowling', 'England'),
(5, 'Fujiko F.Fujio', 'Japan'),
(6, 'Akira Toriyama', 'Japan'),
(7, 'Stephen Hawking', 'United Kingdom'),
(8, 'DK', 'US'),
(9, 'Ryan Turner', 'Australia');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 0,
  `publisher_id` int(11) NOT NULL,
  `NumberOfAuthors` int(1) DEFAULT NULL,
  `NumberOfCategories` int(1) DEFAULT NULL,
  `NumberOfPages` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`id`, `name`, `quantity`, `price`, `description`, `image`, `status`, `publisher_id`, `NumberOfAuthors`, `NumberOfCategories`, `NumberOfPages`) VALUES
(10, 'Harry Potter and the Philosopher\'s Stone (Harry Potter 1)', 16, 25, 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin! These new editions of the classic and internationally bestselling, multi-award-winning series feature instantly pick-up-able new jackets by Jonny Duddle, with huge child appeal, to bring Harry Potter to the next generation of readers. It\'s time to PASS THE MAGIC ON ...', 'storage/uploads/books/1716456005.jpg', 0, 4, 2, 5, 332),
(11, 'A Brief History of Time', 80, 9.99, 'A landmark volume in science writing by one of the great minds of our time, Stephen Hawking’s book explores such profound questions as: How did the universe begin—and what made its start possible? Does time always flow forward? Is the universe unending—or are there boundaries? Are there other dimensions in space? What will happen when it all ends?\r\n\r\nTold in language we all can understand, A Brief History of Time plunges into the exotic realms of black holes and quarks, of antimatter and “arrows of time,” of the big bang and a bigger God—where the possibilities are wondrous and unexpected. With exciting images and profound imagination, Stephen Hawking brings us closer to the ultimate secrets at the very heart of creation.', 'storage/uploads/books/1716456265.jpg', 0, 1, 1, 1, 212),
(12, 'New adventure crickets', 17, 9.59, 'The Adventures of Cricket are considered exemplary pages of children\'s literature. It seems that every sentence, paragraph, and image has a strong impact on the reader\'s aesthetic thoughts and feelings. The work describes the adventures of a Cricket through the animal and human worlds.\r\n\r\nHot issues such as: good and evil, war and peace, ideals and reason for life are expressed gently, delicately and deeply. Men has gone through adventures in the animal world, overcoming countless risks and events, but step by step, Men has adjusted and self-aware to become a person rich in ideals and desires. understanding and the resilient bravery of a young man with his head held high and his feet on the ground.', 'storage/uploads/books/1716456451.jpg', 0, 4, 1, 2, 144),
(13, 'DRAGON BALL - 30TH ANNIV. SUPER HISTORY BOOK (VO JAPONAIS)', 2, 55.89, 'nterview/Toriyama Akira...etc Draw it, and withdraw the 30th anniversary memory; comics Treasured sketching. Treasured document. Treasured documents such as an animated cartoon and a game, the toy. Character design image document. Celebration illustration from a famous comic artist...ONE PIECE/NARUTO/HUNTER x HUNTER/GINTAMA...etc The last story of the first public exhibition of rough name. Special gift...Foil stamping storing box \'The illustration of Episode 1 and the last story includes it.\'', 'storage/uploads/books/1716456531.jpg', 0, 4, 2, 3, 248),
(14, 'Doraemon: Stand By Me', 9, 3.99, 'The plot combines the short stories \"All the Way From the Country of the Future\", \"Imprinting Egg\", \"Goodbye, Shizuka-chan\", \"Romance in Snowy Mountain\", \"Nobita\'s the night Before a Wedding\" and \"Goodbye, Doraemon...\" into a new complete story - from the first time Doraemon came to Nobita\'s house to Doraemon bidding farewell to Nobita.', 'storage/uploads/books/1716456782.jpg', 0, 4, 1, 2, 70),
(15, 'C++ Programming: Complete Guide to Learn the Basics of C++ Programming in 7 days', 6, 19.99, 'Learn C++ Programming in easy steps just in 7 Days with Practical Exercises\r\n\r\nC++ programming language is a properly structured high-level language enabling programmers to create every kind of software with ease. C++ has a huge number of open-source libraries, wide applications, and speedy run-time performance.\r\n\r\nThis C++ absolute beginner\'s guide is designed for beginners who want to learn C++ in 7 days. It is a perfect C++ Programming Guide for dummies. You will discover this language by making your programs while reading this book.\r\n\r\nHere is the Structure of C++ Crash Course: Complete Guide to Learn the Basics of C++ Programming in 7 Days', 'storage/uploads/books/1716456954.jpg', 0, 7, 1, 1, 164),
(16, 'IELTS Academic+ General Test: Writing Book by Career Launcher', 19, 17.4, 'Several years of teaching experience and extensive research have produced this book which is part of thematic. It provides a great learning experience since it encompasses concept-based learning that revolves around various relevant themes with an adequate number of practice exercises that reinforce learning. The topics and concepts are well researched, with diverse applications that enhance learning to a great extent. The unique learning methodology involves applying an integrated approach and testing at every step, which is an absolute requirement for success.', 'storage/uploads/books/1716457121.jpg', 0, 8, 1, 2, 124),
(17, 'The Math Book: Big Ideas Simply Explained (DK Big Ideas)', 7, 22.67, 'This captivating book will broaden your understanding of Math, with:\r\n\r\n- More than 85 ideas and events key to the development of mathematics\r\n- Packed with facts, charts, timelines and graphs to help explain core concepts\r\n- A visual approach to big subjects with striking illustrations and graphics throughout\r\n- Easy to follow text makes topics accessible for people at any level of understanding\r\n\r\nThe Math Book is a captivating introduction to the world’s most famous theorems, mathematicians and movements, aimed at adults with an interest in the subject and students wanting to gain more of an overview. Charting the development of math around the world from Babylon to Bletchley Park, this book explains how math help us understand everything from patterns in nature to artificial intelligence.', 'storage/uploads/books/1716457256.jpg', 0, 7, 1, 2, 352),
(18, 'The Biology Book: Big Ideas Simply Explained (DK Big Ideas)', 100, 15.59, 'This captivating book will broaden your understanding of Biology, with:\r\n\r\n- More than 95 ideas and events key to the development of biology and the life sciences\r\n- Packed with facts, charts, timelines and graphs to help explain core concepts\r\n- A visual approach to big subjects with striking illustrations and graphics throughout\r\n- Easy to follow text makes topics accessible for people at any level of understanding\r\n\r\nThe Biology Book is a captivating introduction to understanding the living world and explaining how its organisms work and interact – whether microbes, mushrooms, or mammals. Here you’ll discover key areas of the life sciences, including ecology, zoology, and biotechnology, through exciting text and bold graphics.', 'storage/uploads/books/1716459059.jpg', 0, 7, 1, 2, 336),
(19, 'The Physics Book: Big Ideas Simply Explained (DK Big Ideas)', 100, 15.69, 'This captivating book will broaden your understanding of Physics, with:\r\n\r\n- More than 100 ground-breaking ideas in this field of science\r\n- Packed with facts, charts, timelines and graphs to help explain core concepts\r\n- A visual approach to big subjects with striking illustrations and graphics throughout\r\n- Easy to follow text makes topics accessible for people at any level of understanding\r\n\r\nThe Physics Book is the perfect introduction to the science, aimed at adults with an interest in the subject and students wanting to gain more of an overview. Here you’ll discover more than 90 of the most important laws and theories in the history of physics and the great minds behind them. If you’ve ever wondered exactly how physicists formulated and proved groundbreaking abstract concepts, this is the perfect book for you.', 'storage/uploads/books/1716457394.jpg', 0, 7, 1, 2, 336),
(20, 'The Chemistry Book (DK Big Ideas)', 100, 17.92, 'This informative book on chemistry further features:\r\n\r\n-Profiles more than 95 ideas and events key to the development of chemistry and natural sciences, with thought-provoking graphics throughout that demystify the central concepts behind each idea\r\n-Features insightful and inspiring quotes from leading chemists including Nobel Laureates Marie Curie, Linus Pauling, and Osamu Shimomura, as well as thinkers in other fields\r\n-Global in scope, covering discoveries and innovations from around the world throughout human history\r\n-Combines creative typography, graphics, and accessible text to explore the most famous and important ideas in chemistry and the people behind them\r\n-Includes a directory section for easy localization\r\n\r\nWhether you are new to chemistry, a student of the sciences, or just want to keep up with and understand the latest news and scientific debates, The Chemistry Book is a must-have volume for all thinkers, learners and avid readers out there.', 'storage/uploads/books/1716457486.jpg', 0, 7, 1, 2, 336);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Science'),
(2, 'Manga'),
(3, 'Light Novel'),
(4, 'Horror and Mystery'),
(5, 'Domestic Folk Tale'),
(6, 'Foreign Folk Tale'),
(7, 'Memoirs'),
(8, 'For Child'),
(9, 'Adventure'),
(10, 'Science Fiction'),
(11, 'Action'),
(12, 'Supernatural'),
(13, 'Comedy'),
(14, 'Autobiographic');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorybook`
--

CREATE TABLE `categorybook` (
  `category_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` tinytext NOT NULL,
  `gender` int(11) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `account_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `image`, `account_status`) VALUES
(5, 'Nguyễn Đức Lâm Anh', 'xdarkrain178x@gmail.com', '$2y$10$GavtcfqnVhFBnvDPjij//.aMNCO5E82EJJCyiPAFtbnfbzIH3xNNa', '0769002893', 1, 'Hà nội', '', 1),
(6, 'Nguyen Van A', 'VanA@gmail.com', '$2y$10$yI5vFr2HdosrRIiPk9MTqefa9pV/ciZJaZiceVi07mhcMQyBaoKWW', '0769002894', 1, 'Hà nội', '', 0),
(7, 'Tung', 'tung@gmail.com', '$2y$10$sp/IRLwkv/ulgcIV.CWjguTfU/E.A3ahOFkm7Nnpuw4K7ikVJOFfy', '0123456789', 0, 'Ha Noi', '', 1),
(8, 'Tam Tran', 'tam@gmail.com', '$2y$10$gLdyONf0zYIN3HETuhWQ8uO40fkcAs.xWn8wUQngYfaaL.XUrLh4a', '0123456789', 0, 'Saiyan', 'Tam.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_buy` date NOT NULL,
  `status` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(15) NOT NULL,
  `receiver_address` text NOT NULL,
  `amount` float NOT NULL,
  `payment_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `date_buy`, `status`, `customer_id`, `admin_id`, `receiver_name`, `receiver_phone`, `receiver_address`, `amount`, `payment_id`, `method_id`) VALUES
(6, '2024-05-23', 0, 8, 1, 'Tam Tran', '0123456789', 'Saiyan', 190.77, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `book_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sold_price` float DEFAULT NULL,
  `sold_quantity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`book_id`, `order_id`, `sold_price`, `sold_quantity`) VALUES
(10, 6, 25, 3),
(13, 6, 55.89, 2),
(14, 6, 3.99, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Cash on Delivery'),
(2, 'Online payment');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `publishers`
--

INSERT INTO `publishers` (`id`, `name`) VALUES
(1, 'PubA'),
(3, 'William Collins'),
(4, 'Kim Dong'),
(5, 'giao duc Viet Nam'),
(6, 'Lao Dong'),
(7, 'Nha Nam'),
(8, 'Pearson'),
(9, 'Wolters Kluwer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`) VALUES
(1, 'Fast Delivery'),
(2, 'Normal Delivery');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `authorbook`
--
ALTER TABLE `authorbook`
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categorybook`
--
ALTER TABLE `categorybook`
  ADD KEY `category_id` (`category_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `method_id` (`method_id`),
  ADD KEY `orders_ibfk_4` (`payment_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `authorbook`
--
ALTER TABLE `authorbook`
  ADD CONSTRAINT `authorbook_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `authorbook_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`);

--
-- Các ràng buộc cho bảng `categorybook`
--
ALTER TABLE `categorybook`
  ADD CONSTRAINT `categorybook_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categorybook_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`payment_id`) REFERENCES `shipping_methods` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
