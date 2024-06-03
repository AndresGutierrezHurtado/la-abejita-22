-- Creation of the database and selection of it
DROP DATABASE IF EXISTS `la-abejita-22-db`;
CREATE DATABASE `la-abejita-22-db`;
USE `la-abejita-22-db`;

-- Creation of the password_reset_tokens table
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Creation of the Users table
CREATE TABLE `users` (
  `user_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_first_name` VARCHAR(50) NOT NULL,
  `user_last_name` VARCHAR(50) NOT NULL,
  `user_email` VARCHAR(70) NOT NULL, 
  `user_username` VARCHAR(20) NOT NULL, 
  `user_password` VARCHAR(70) NOT NULL, 
  `user_address` VARCHAR(30) DEFAULT NULL, 
  `user_phone_number` DECIMAL(10,0) DEFAULT NULL, 
  `user_image_url` VARCHAR(100) DEFAULT '/images/users/nf.jpg',
  `role_id` INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Users table
INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_username`, `user_password`, `user_address`, `user_phone_number`, `user_image_url`, `role_id`) VALUES
(1 ,'Andrés', 'Gutiérrez Hurtado', 'andres52885241@gmail.com', 'Andres_Gutierrez', '1234', 'Dg 86D Sur 70C-31', 3209202177, '/images/users/nf.jpg', 2),
(2 ,'Wendy Alejandra', 'Navarro Arias', 'nwendy798@gmail.com', 'Wendy_Navarro', '1234', 'Kalamary V, El ensueño', 3044462452, '/images/users/nf.jpg', 1);

-- Creation of the Roles table
CREATE TABLE `roles` (
  `role_id` INT PRIMARY KEY NOT NULL, 
  `role_name` VARCHAR(20) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Roles table
INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'client'),
(2, 'administrator');

-- Creation of the Products table
CREATE TABLE `products` (
  `product_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
  `product_name` VARCHAR(100) NOT NULL, 
  `product_description` VARCHAR(100) NOT NULL, 
  `product_stock` INT NOT NULL, 
  `product_image_url` VARCHAR(100) DEFAULT '/images/products/nf.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Products table
INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image_url`) VALUES
(1, 'Camisa blanca', 'Camisa blanca para uniforme escolar.', '/images/products/nf.jpg'),
(2, 'Jardinera', 'Jardinera de mezclilla para uniforme escolar.', '/images/products/nf.jpg'),
(3, 'Pantalón gris', 'Pantalón de vestir gris para uniforme escolar.', '/images/products/nf.jpg'),
(4, 'Chaleco negro', 'Chaleco formal para uniforme escolar.', '/images/products/nf.jpg'),
(5, 'Blazer escolar', 'Blazer para uniforme escolar.', '/images/products/nf.jpg'),
(6, 'Corbata', 'Corbata azul obscura para uniforme escolar.', '/images/products/nf.jpg');

-- Creation of the Sizes table
CREATE TABLE `sizes` (
  `size_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `size_name` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Sizes table
INSERT INTO `sizes` (`size_id`, `size_name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, 'XXXL');

-- Creation of the Schools table
CREATE TABLE `schools` (
  `school_id` INT PRIMARY KEY NOT NULL,
  `school_name` VARCHAR(100) NOT NULL,
  `schoold_address` VARCHAR(200) NOT NULL,
  `school_image_url` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Schools table
INSERT INTO `schools` (`school_id`,`school_name`,`schoold_address`, `school_image_url`) VALUES
(1, 'IED El Ensueño', 'Tv. 70c #11 a 67a, Bogotá', '/images/schools/nf.jpg'),
(2, 'Colegio Angela Restrepo Moreno', 'Cl. 69 Sur #71g-12, Bogotá', '/images/schools/nf.jpg'),
(3, 'Colegio Emma Reyes', 'Cra. 80b #6-71, Bogotá', '/images/schools/nf.jpg'),
(4, 'Colegio María Mercedes Carranza', 'El Perdomo, Tv. 70g #65 Sur-2, Bogotá', '/images/schools/nf.jpg'),
(5, 'Colegio Distrital Agudelo Restrepo IED', 'Tv. 70d, Bogotá', '/images/schools/nf.jpg');

-- Creación de la tabla intermedia product_school
CREATE TABLE `school_products` (
  `product_school_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `product_id` INT NOT NULL,
  `school_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos de ejemplo en la tabla product_school
INSERT INTO `school_products` (`product_id`, `school_id`) VALUES
(1, 1), -- Camisa blanca asociada con IED El Ensueño
(2, 1), -- Jardinera asociada con IED El Ensueño
(3, 1), -- Pantalón gris asociado con IED El Ensueño
(4, 2), -- Chaleco negro asociado con Colegio Angela Restrepo Moreno
(5, 3), -- Blazer escolar asociado con Colegio Emma Reyes
(6, 4), -- Corbata asociada con Colegio María Mercedes Carranza
(1, 2), -- Camisa blanca también asociada con Colegio Angela Restrepo Moreno
(3, 3); -- Pantalón gris también asociado con Colegio Emma Reyes

-- Creation of the Products Sizes table
CREATE TABLE `products_sizes` (
  `product_size_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `size_id` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`),
  FOREIGN KEY (`size_id`) REFERENCES `sizes`(`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Products Sizes table
INSERT INTO `products_sizes` (`product_id`, `size_id`, `price`) VALUES
(1, 1, 29000), -- Camisa blanca, XS
(1, 2, 30000), -- Camisa blanca, S
(1, 3, 31000), -- Camisa blanca, M
(1, 4, 32000), -- Camisa blanca, L
(1, 5, 33000), -- Camisa blanca, XL
(2, 1, 59000), -- Jardinera, XS
(2, 2, 60000), -- Jardinera, S
(2, 3, 61000), -- Jardinera, M
(2, 4, 62000), -- Jardinera, L
(2, 5, 63000); -- Jardinera, XL

-- Creation of the Orders table
CREATE TABLE `orders` (
  `order_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` INT NOT NULL,
  `order_date` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creation of the Payment Details table
CREATE TABLE `payments_details` (
  `payment_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `order_id` INT NOT NULL,
  `payer_full_name` VARCHAR(70) NOT NULL,
  `payer_email` VARCHAR(70) NOT NULL,
  `payer_phone_number` DECIMAL(10, 0) NOT NULL,
  `payer_document_type` ENUM('CC', 'CE', 'TI') NOT NULL,
  `payer_document_number` DECIMAL(10, 0) NOT NULL,
  `payment_method` INT NOT NULL,
  `payment_status` INT NOT NULL,
  `payment_date` DATE NOT NULL,
  `payment_time` TIME NOT NULL,
	`payment_amount` DECIMAL(10, 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creation of the Sold Products table
CREATE TABLE `sold_products`(
	`order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `sold_product_quantity` INT NOT NULL,
  `sold_product_price` DECIMAL(10, 2)
);

-- ------------------------------- RELATIONSHIPS -------------------------------

ALTER TABLE `users`
ADD CONSTRAINT `fk_user_role_id`
FOREIGN KEY (`role_id`)
REFERENCES `roles`(`role_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE `products_sizes` 
ADD CONSTRAINT `fk_product_size_product_id`
FOREIGN KEY (`product_id`)
REFERENCES `products`(`product_id`)
ON UPDATE CASCADE
ON DELETE CASCADE,
ADD CONSTRAINT `fk_product_size_size_id`
FOREIGN KEY (`size_id`)
REFERENCES `sizes`(`size_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE `orders` 
ADD CONSTRAINT `fk_order_user_id`
FOREIGN KEY (`user_id`)
REFERENCES `users`(`user_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;


ALTER TABLE `payments_details` 
ADD CONSTRAINT `fk_payment_detail_order_id`
FOREIGN KEY (`order_id`)
REFERENCES `orders`(`order_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE `sold_products` 
ADD CONSTRAINT `fk_sold_product_product_id`
FOREIGN KEY (`product_id`)
REFERENCES `products`(`product_id`)
ON UPDATE CASCADE
ON DELETE CASCADE,
ADD CONSTRAINT `fk_sold_product_order_id`
FOREIGN KEY (`order_id`)
REFERENCES `orders`(`order_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE `school_products`
ADD CONSTRAINT `school_product_product_id`
FOREIGN KEY (`product_id`) 
REFERENCES `products`(`product_id`)
ON UPDATE CASCADE
ON DELETE CASCADE,
ADD CONSTRAINT `school_product_school_id`
FOREIGN KEY (`school_id`) 
REFERENCES `schools`(`school_id`)
ON UPDATE CASCADE
ON DELETE CASCADE;