create database freshleaf_website;
use freshleaf_website;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` char(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `role` enum('User','Admin') DEFAULT 'User',
  `avatar` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL
);

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `phone`, `role`, `avatar`, `address`) VALUES
(1, 'nguyenvandat', '$2y$10$sFGmXdL2NrteioGCkDncKOl1qa2Mka48jT1u7eHaUa8e2HbPJbzG2', 'ngaichi2004@gmail.com', '383225512', 'Admin', NULL, 'QB'),
(2, 'Bẹp', '$2y$10$jlq4IUTDeBva.QqClIsBleeAPGSQC8a.dmoXWy3CeoXd05jddFdKy', 'ngaichi204@gmail.com', '383225512', 'User', NULL, 'QB'),
(3, 'Tố Nga', '$2y$10$E.wxWv1jFN4qdwI.xwC9AuhvhvcwEqGsyC/zGb63XSJeYeS25seje', 'ngaichi24@gmail.com', '383225512', 'User', NULL, 'QB'),
(4, 'Minh Khiêm', '$2y$10$lIhF1OeLmuQelY73LstsH.3zbLwn.Ac9J/rSEQfO.OT3kc1IR8w5m', 'minhkhiem@gmail.com', '387287713', 'User', NULL, 'TPHCM'),
(5, 'Minh Vũ', '$2y$10$sT.cZuxli8vCZLPolGclf./dj2T1ejVU1sc5jyGF3pAEIcdFL/l4W', 'minhvu42@gmail.com', '388474414', 'User', NULL, 'QB'),
(6, 'Cọp thúi', '$2y$10$SX2rBmynfM60K0TNXuIMG.0hYIfbACwLSqpHgDRapqLNMhVQAzTSC', 'minhvu4222@gmail.com', '0388474410', 'User', 'cop.jpg', 'QB'),
(7, 'Gấu', '$2y$10$9Hc0IsfPLZMPo18aoTM.qu9QN7UZV3wkP5NgcfghprKbGkVJBP5g.', 'ngaichi20024@gmail.com', '383225512', 'User', NULL, 'QB'),
(8, 'Minh Ngọc', '$2y$10$.C0yCQeefrXARDmnA0KWjOjpuhxSa2JeO3xKkMoeqdqv7XOSBVIa6', 'minhngoc@gmail.com', '383225522', 'User', NULL, 'ĐN'),
(9, 'Nga Nguyễn', '$2y$10$7trKgbBwUUBbt.pmVVg.1u5ScDtkRbMlw8RsVrDpGA8EqnDVnauAy', 'nganguyen@gmail.com', '398442215', 'User', '20240104_OiXkGFPleL.jpeg', 'TPHCM'),
(10, 'Bẹp thúi', '$2y$10$skt3n5mSi5yiHJsWlTMP/uSlXXBhpvHhRKa63.UR3aTJCHoyiNchy', 'bep@gmail.com', '398662413', 'User', 'avta.jpg', 'HN'),
(11, 'Đạt Nguyễn', '$2y$10$cWI2RAYUoZ4NgMSw8WxPzuyCEMjHFWspLBelKJwC/ot7QI6cRWhfK', 'datnguyen@gmail.com', '387548794', 'User', NULL, 'ĐN'),
(12, 'to nga', '$2y$10$qfvLZAnvUoDyDefPeGpNLeU/ECSwtoKNKMFco4Y/FE/TCyr0.I0we', 'datnguyen123@gmail.com', '387548794', 'User', '....png', 'ĐN'),
(13, 'Khiêm', '$2y$10$hrYTodlk4eHp6pi6Dde.uegUTx8yIAWlPgR.npC6TGHqv9TnCeov.', 'khiem@gmail.com', '377345543', 'User', 'avt1.jpg', 'HN'),
(14, 'Khiêm', '$2y$10$BynLSEpeLYf3vUTjPNL0meOSkaQimDlCVFWJCU4LkiA3wVcTV4MkS', 'buu@gmail.com', '552278899', 'User', '....png', 'VT'),
(15, 'Kim', '$2y$10$Rs1objpyNCBWEsRi6Q9LvePQG6j9BkSG0IlCHDphasorYmiTHkTR6', 'kim@gmail.com', '123456789', 'User', 'a1ee94780c268900bb8e322a48d147f7.jpg', 'VT');

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
);


INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(5, 'Dried Foods'),
(3, 'Fruits'),
(2, 'Roots'),
(4, 'Seeds'),
(1, 'Vegetables');

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` char(20) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `product_image` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
);

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `unit`, `stock_quantity`, `product_image`, `category_id`) VALUES
(0, 'Garlic', 'Garlic – An essential kitchen ingredient with a pungent flavor and distinctive aroma. Garlic not only enhances the taste of dishes but is also packed with nutrients, boosting immunity and supporting heart health. Perfect for frying, sautéing, steaming, or roasting!\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 20.000, 'Kg', 50, 'https://i.pinimg.com/736x/9e/89/6c/9e896cf80c938b5aa1ddcc779ee27520.jpg', 5),
(1, 'Bok Choy', 'Bok choy is a vegetable very close to Vietnamese and Chinese dishes... It is easy to eat, not too flavorful like other vegetables... Bok choy is known by other names: bok choy, bok choy. Because each leaf sheath bends to look like a spoon. Cabbage has a beautiful green color in the leaves, the stem is fat, a bit short but the sheath is large, the base of the sheath is white. Bok choy is easy to eat, not too flavorful like other vegetables, so it is very popular. Furthermore, this is not an expensive food, but it is good for the body.', 25.000, 'Bunch', 20, 'https://lalanh.com/wp-content/uploads/2021/11/caithia.jpg', 1),
(2, 'Choy Sum', 'Choy Sum – Thin leafy greens with tender stems and a naturally sweet flavor. Often used in stir-frying, soups, or boiling, it adds a refreshing taste to your meals.', 18.000, 'Bunch', 25, 'https://st.quantrimang.com/photos/image/2020/11/11/rau-cai-3.jpg', 1),
(3, 'Napa Cabbage', 'Napa Cabbage – A vegetable with soft leaves and white stalks, commonly used in dishes like kimchi, soups, or hot pots, bringing a naturally sweet and mild flavor.', 26.000, 'Head', 30, 'https://i.pinimg.com/736x/92/72/4c/92724ccad1927d0caf05118f56590e0b.jpg', 1),
(4, 'Spinach', 'Spinach – Packed with vitamins and minerals, spinach is highly nutritious and beneficial for health. It’s commonly used in stir-fries, soups, or smoothies.', 22.000, 'Bunch', 15, 'https://image-us.eva.vn/upload/3-2021/images/2021-09-11/image1-1631355146-889-width770height627.png', 1),
(5, 'Mustard Greens', 'Mustard Greens – With a slightly bitter taste, mustard greens are often used in soups and stir-fries, making them an excellent choice for comforting dishes during the colder seasons.', 20.000, 'Bunch', 20, 'https://www.mediplus.vn/wp-content/uploads/2021/07/ba-bau-3-thang-dau-hoan-toan-co-the-an-cai-xanh-1.jpg', 1),
(6, 'Blueberry', 'Blueberry – A small, dark blue berry with a mildly sweet flavor and rich in antioxidants. Blueberries are not only delicious but also healthy, often enjoyed in desserts, smoothies, or as a fresh snack.', 21.000, 'Kg', 18, 'https://i.pinimg.com/736x/88/18/8b/88188beff26669d2c09e448a9548a5b6.jpg', 3),
(7, 'Korean Carrots', 'Korean Carrots – Rich in beta-carotene, vitamin A, and antioxidants, Korean carrots enhance vision, promote healthy skin, and support heart health. Grown in ideal climatic conditions, they offer a naturally sweet taste and a delightfully crunchy texture.', 50.000, 'Kg', 100, 'https://i.pinimg.com/736x/2b/39/a3/2b39a367156d1a57ff11f9137ff92991.jpg', 2),
(8, 'Beetroot', 'Beetroot – A nutrient-rich root vegetable with a deep natural red color, packed with vitamins, minerals, and antioxidants. Its mildly sweet flavor makes it versatile for dishes like salads, juices, soups, or stir-fries, bringing both health benefits and great taste to your family meals.', 15.000, 'Kg', 20, 'https://th.bing.com/th/id/OIP.jOAKHg8QvNftdCdrWejrrAHaGv?rs=1&pid=ImgDetMain', 2),
(9, 'Golden Waxy Corn', 'Fresh Corn – A nutritious cereal with golden kernels, naturally sweet, and rich in fiber. Perfect for boiling, grilling, soups, or as an ingredient in cakes and healthy snacks.', 20.000, 'Kg', 20, 'https://i.pinimg.com/736x/e7/7f/7f/e77f7f6719e5d3579ed9f2abbd178880.jpg', 5),
(10, 'Fresh Lime', 'Fresh Lime – A small fruit with thin, bright green skin, rich in vitamin C and a natural citrus aroma. Perfect for refreshing beverages, seasoning dishes, or adding a zesty touch to desserts.', 50.000, 'Kg', 100, 'https://i.pinimg.com/736x/83/02/cb/8302cb21c646b117e03ca4a51552f4dc.jpg', 3),
(11, 'Eggplant ', 'Eggplant – A glossy purple fruit with tender flesh, rich in fiber and antioxidants. Versatile and easy to prepare, it’s perfect for stir-fries, grilling, stews, or as a key ingredient in delicious and nutritious vegetarian dishes.', 25.000, 'Kg', 30, 'https://i.pinimg.com/736x/94/fa/d6/94fad6b5326ee97c4b6f4f8056bdd9c7.jpg', 2),
(12, 'Bell Pepper', 'Bell Pepper – A vibrant fruit available in red, yellow, and green, rich in vitamin C, antioxidants, and a mildly sweet flavor. Perfect for stir-fries, grilling, salads, or as a decorative ingredient, adding both taste and color to your dishes.', 25.000, 'Kg', 10, 'https://i.pinimg.com/736x/5c/1f/26/5c1f264d86169921b83e0c40bcdb1c81.jpg', 3),
(13, 'Water Spinach', 'Water Spinach – A familiar green vegetable with a crunchy texture, rich in fiber, iron, and essential vitamins. Ideal for stir-frying, boiling, or making soups, it brings a nutritious and refreshing touch to family meals.', 20.000, 'Bunch', 20, 'https://i.pinimg.com/736x/76/f9/ab/76f9abe279692dbc323cc7a732c2ff1e.jpg', 1),
(14, 'Broccoli ', 'Broccoli – A nutrient-rich vegetable with an appealing shape, packed with vitamin C, fiber, and antioxidants. With a naturally sweet and crunchy texture, it’s perfect for stir-frying, boiling, steaming, or as an ingredient in nutritious salads and soups.', 25.000, 'Head', 8, 'https://i.pinimg.com/736x/60/f9/fd/60f9fd2eb0df2fe442cf91d56b831704.jpg', 1),
(15, 'Lettuce ', 'Lettuce – A soft, vibrant green leafy vegetable rich in vitamins and minerals, offering a mild and refreshing taste. Perfect for raw consumption, making salads, spring rolls, or garnishing dishes, bringing freshness and nutrition to your meals.', 15.000, 'Bunch', 45, 'https://i.pinimg.com/736x/39/19/7b/39197bca31001122a4b7752f71b57f4e.jpg', 1),
(16, 'Hana Strawberries', 'Hana Strawberries – A premium variety of strawberries, celebrated for their sweet, refreshing flavor, juicy texture, and vibrant red color. Grown organically, Hana Strawberries ensure freshness, quality, and health safety. Perfect for desserts, smoothies, or simply enjoying fresh!', 100.000, 'Kg', 50, 'https://i.pinimg.com/736x/0c/e0/ba/0ce0ba765bede58fa03519f7421f362b.jpg', 3),
(17, 'White Radish', 'White Radish – Not only delicious but also packed with health benefits. With its naturally sweet flavor and distinctive crunch, white radish enhances the appeal of any dish. Rich in vitamin C, it boosts immunity and promotes healthy skin. High fiber content aids digestion, while antioxidants help detoxify the body. Especially versatile, white radish is easy to prepare in soups, stir-fries, or pickled dishes, offering fresh and nutritious flavors.', 30.000, 'Kg', 20, 'https://i.pinimg.com/736x/8c/9b/7a/8c9b7a5ff23de1e183b7bcde06d7a66d.jpg', 2),
(18, 'Mangosteen', '\r\nMangosteen – The \"Queen of Fruits\" with an eye-catching deep purple rind and soft, juicy white segments inside. Rich in vitamin C and antioxidants, mangosteen is not only delicious but also great for your health. Indulge in this exquisite tropical delight today!', 70.000, 'Kg', 30, 'https://i.pinimg.com/736x/38/a8/8f/38a88fb652c4389dc3b2ad4e3727ef31.jpg', 3),
(19, 'Cauliflower', 'Cauliflower – A delicate vegetable with smooth white florets, rich in nutrients and easy to prepare. Perfect for steaming, stir-frying, or making soups, it brings a light flavor and wholesome nutrition to your family meals!\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 25.000, 'Head', 15, 'https://i.pinimg.com/736x/89/05/3c/89053c546d4a53aea6769c2da24f4533.jpg', 1),
(20, 'Ginger', 'Ginger root has many health benefits, such as supporting digestion, reducing inflammation, boosting the immune system, and improving blood circulation. It also helps reduce stress, supports weight loss, and alleviates nausea. With its antibacterial and antiviral properties, ginger is a valuable natural ingredient for daily health care.', 5.000, 'Kg', 45, 'https://i.pinimg.com/736x/10/96/f1/1096f1d97e1d3f176eb2a31f912efdb3.jpg', 5),
(21, 'Turmeric', 'Turmeric is a root with an orange-yellow color, commonly used in cooking and as a spice. It contains curcumin, a compound with anti-inflammatory, antibacterial, and antioxidant properties. Additionally, turmeric is known for improving digestion, brightening the skin, and supporting the treatment of inflammatory conditions.', 7.000, 'Kg', 20, 'https://i.pinimg.com/736x/88/39/44/8839440347c64a65fd238c9aeace38bc.jpg', 5);

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL
);

INSERT INTO `orders` (`order_id`, `order_date`, `status`, `user_id`) VALUES
(1, '2024-12-18 18:39:55', 'pending', 1),
(2, '2024-12-18 18:39:55', 'completed', 2),
(3, '2024-12-18 18:39:55', 'completed', 4),
(4, '2024-12-18 18:39:55', 'cancelled', 3),
(5, '2024-12-18 18:39:55', 'pending', 5),
(6, '2024-12-26 17:43:03', 'pending', 14),
(7, '2024-12-26 17:45:32', 'pending', 13),
(8, '2024-12-27 05:22:41', 'pending', 15),
(13, '2024-12-27 08:42:11', 'pending', 10);

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
);

INSERT INTO `order_detail` (`order_detail_id`, `quantity`, `price`, `order_id`, `product_id`) VALUES
(1, 6, 15.000, 1, 15),
(2, 1, 25.000, 1, 14),
(3, 5, 20.000, 2, 13),
(4, 5, 25.000, 3, 11),
(5, 4, 50.000, 4, 10),
(6, 1, 50.000, 5, 7),
(7, 4, 20.000, 5, 9),
(8, 2, 25.000, 5, 1),
(9, 3, 50.000, 2, 7),
(10, 8, 25.000, 4, 12),
(11, 3, 15.000, 5, 3),
(20, 2, 15.000, 7, 15),
(21, 1, 100.000, 7, 16),
(22, 1, 21.000, 7, 6),
(23, 1, 20.000, 7, 9),
(24, 1, 20.000, 7, 0),
(25, 1, 15.000, 8, 15),
(26, 1, 26.000, 8, 3),
(35, 2, 21.000, 13, 6),
(37, 3, 70.000, 13, 18),
(39, 1, 20.000, 13, 9),
(40, 3, 5.000, 13, 20);


CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
);

CREATE TABLE `shipping_info` (
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` text NOT NULL,
  `city` char(30) NOT NULL,
  `note` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `shipping_info`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `order_id` (`order_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `shipping_info`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

ALTER TABLE `shipping_info`
  ADD CONSTRAINT `shipping_info_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
