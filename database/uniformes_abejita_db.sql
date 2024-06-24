-- Creation of the database and selection of it
DROP DATABASE IF EXISTS `la-abejita-22-db`;
CREATE DATABASE `la-abejita-22-db`;
USE `la-abejita-22-db`;

-- Creation of the password_reset_tokens table
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) PRIMARY KEY NOT NULL,
  `token` TEXT NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) PRIMARY KEY NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Creation of the Users table
CREATE TABLE `users` (
  `user_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_first_name` VARCHAR(50) NOT NULL,
  `user_last_name` VARCHAR(50) NOT NULL,
  `user_email` VARCHAR(70) NOT NULL UNIQUE, 
  `user_username` VARCHAR(20) NOT NULL, 
  `user_password` TEXT NULL, 
  `user_address` VARCHAR(30) DEFAULT NULL, 
  `user_phone_number` DECIMAL(10,0) DEFAULT NULL, 
  `user_image_url` VARCHAR(100) DEFAULT '/images/users/nf.jpg',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Users table
INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_username`, `user_password`, `user_address`, `user_phone_number`, `user_image_url`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Andrés', 'Gutiérrez Hurtado', 'andres52885241@gmail.com', 'Andres_Gutierrez', '$2y$12$WeRROaP2Nbj/86uv7CEFFeSJlQoj02W5kzdv0pts4Nxz/.MttOrvS', 'Dg. 68D Sur 70C-31', 3209202177, '/images/users/1.jpg', '2024-06-21 19:46:14', '2024-06-22 21:24:56', 2),
(2, 'Wendy Alejandra', 'Navarro Arias', 'nwendy798@gmail.com', 'Wendy_Navarro', '$2y$12$FlutKN6QO79GoAH3p0iPx.HXoN9P2kGKwY7fdywbymql9ycTWxM86', 'Kalamary V', 3044462452, '/images/users/nf.jpg', '2024-06-22 23:39:02', '2024-06-22 23:35:34', 1);

-- Creation of the Roles table
CREATE TABLE `roles` (
  `role_id` INT PRIMARY KEY NOT NULL, 
  `role_name` VARCHAR(20) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Roles table
INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'cliente'),
(2, 'administrador');

-- Creation of the Products table
CREATE TABLE `products` (
  `product_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
  `product_name` VARCHAR(100) NOT NULL, 
  `product_description` VARCHAR(100) NOT NULL,
  `product_materials` TEXT NOT NULL DEFAULT 'buena tela.',
  `product_image_url` VARCHAR(100) DEFAULT '/images/products/nf.jpg',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Products table
INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image_url`) VALUES
(1, 'Blazer escolar', 'Blazer para uniforme escolar.', '/images/products/1.jpg'),
(2, 'Chaleco negro', 'Chaleco formal para uniforme escolar.', '/images/products/2.jpg'),
(3, 'Camisa blanca', 'Camisa blanca para uniforme escolar.', '/images/products/3.jpg'),
(4, 'Pantalón gris', 'Pantalón de vestir gris para uniforme escolar.', '/images/products/4.jpg'),
(5, 'Corbata', 'Corbata azul obscura para uniforme escolar.', '/images/products/5.jpg'),
(6, 'Jardinera', 'Jardinera de mezclilla para uniforme escolar.', '/images/products/6.jpg'),
(7, 'Chaqueta sudadera', 'Chaqueta estilo sudadera para uniforme escolar.', '/images/products/7.jpg'),
(8, 'Pantalón sudadera', 'Pantalón estilo sudadera para uniforme escolar.', '/images/products/8.jpg'),
(9, 'Camiseta polo', 'Camiseta tipo polo para uniforme escolar.', '/images/products/9.jpg'),
(10, 'Pantaloneta', 'Pantaloneta para actividades deportivas escolares.', '/images/products/10.jpg');

-- Creation of the Product Media table
CREATE TABLE `product_media` (
  `media_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `media_url` VARCHAR(255) NOT NULL,
  `media_type` ENUM('image', 'video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Product media table
INSERT INTO `product_media` (`product_id`, `media_url`, `media_type`) VALUES
(6, '/images/products/extra/6_0.20240624153959.mp4', 'video'),
(6, '/images/products/extra/6_1.20240624154000.jpg', 'image');

-- Creation of the Sizes table
CREATE TABLE `sizes` (
  `size_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `size_name` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Sizes table
INSERT INTO `sizes` (`size_id`, `size_name`) VALUES
(1, '4'),
(2, '6'),
(3, '8'),
(4, '10'),
(5, '12'),
(6, '14'),
(7, '16'),
(8, 'S'),
(9, 'M'),
(10, 'L'),
(11, 'XL'),
(12, 'U');

-- Creation of the Products Sizes table
CREATE TABLE `products_sizes` (
  `product_size_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `product_size_stock` INT NOT NULL,
  `product_size_price` DECIMAL(10,0) NOT NULL,
  `size_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion of the proudct and sizes
INSERT INTO `products_sizes` (`product_id`, `product_size_stock`, `product_size_price`, `size_id`) VALUES
-- Blazer escolar
(1, 5, 100000.00, 1),
(1, 5, 100000.00, 2),
(1, 5, 100000.00, 3),
(1, 5, 100000.00, 4),
(1, 5, 110000.00, 5),
(1, 5, 110000.00, 6),
(1, 5, 110000.00, 7),
(1, 5, 120000.00, 8),
(1, 5, 120000.00, 9),
(1, 5, 120000.00, 10),
(1, 5, 130000.00, 11),

-- Chaleco negro
(2, 5, 42000.00, 1),
(2, 5, 44000.00, 2),
(2, 5, 46000.00, 3),
(2, 5, 48000.00, 4),
(2, 5, 50000.00, 5),
(2, 5, 52000.00, 6),
(2, 5, 54000.00, 7),
(2, 5, 56000.00, 8),
(2, 5, 58000.00, 9),
(2, 5, 60000.00, 10),
(2, 5, 62000.00, 11),

(3, 5, 30000.00, 1),
(3, 5, 30000.00, 2),
(3, 5, 30000.00, 3),
(3, 5, 30000.00, 4),
(3, 5, 30000.00, 5),
(3, 5, 35000.00, 6),
(3, 5, 35000.00, 7),
(3, 5, 35000.00, 8),
(3, 5, 35000.00, 9),
(3, 5, 35000.00, 10),
(3, 5, 40000.00, 11),

(4, 5, 35000.00, 1),
(4, 5, 35000.00, 2),
(4, 5, 35000.00, 3),
(4, 5, 35000.00, 4),
(4, 5, 35000.00, 5),
(4, 5, 35000.00, 6),
(4, 5, 40000.00, 7),
(4, 5, 40000.00, 8),
(4, 5, 40000.00, 9),
(4, 5, 40000.00, 10),
(4, 5, 45000.00, 11),

(5, 5, 10000.00, 12),

(6, 5, 54000.00, 1),
(6, 5, 55000.00, 2),
(6, 5, 56000.00, 3),
(6, 5, 58000.00, 4),
(6, 5, 60000.00, 5),
(6, 5, 63000.00, 6),
(6, 5, 65000.00, 7),
(6, 5, 70000.00, 8),
(6, 5, 75000.00, 9),
(6, 5, 80000.00, 10),
(6, 5, 85000.00, 11),

(7, 5, 55000.00, 1),
(7, 5, 60000.00, 2),
(7, 5, 62000.00, 3),
(7, 5, 64000.00, 4),
(7, 5, 66000.00, 5),
(7, 5, 68000.00, 6),
(7, 5, 70000.00, 7),
(7, 5, 72000.00, 8),
(7, 5, 74000.00, 9),
(7, 5, 76000.00, 10),
(7, 5, 78000.00, 11),

(8, 5, 40000.00, 1),
(8, 5, 42000.00, 2),
(8, 5, 44000.00, 3),
(8, 5, 46000.00, 4),
(8, 5, 48000.00, 5),
(8, 5, 50000.00, 6),
(8, 5, 52000.00, 7),
(8, 5, 54000.00, 8),
(8, 5, 56000.00, 9),
(8, 5, 58000.00, 10),
(8, 5, 60000.00, 11),

(9, 5, 25000.00, 1),
(9, 5, 25000.00, 2),
(9, 5, 25000.00, 3),
(9, 5, 30000.00, 4),
(9, 5, 30000.00, 5),
(9, 5, 30000.00, 6),
(9, 5, 35000.00, 7),
(9, 5, 35000.00, 8),
(9, 5, 35000.00, 9),
(9, 5, 35000.00, 10),
(9, 5, 35000.00, 11),

(10, 5, 25000.00, 1),
(10, 5, 25000.00, 2),
(10, 5, 25000.00, 3),
(10, 5, 25000.00, 4),
(10, 5, 25000.00, 5),
(10, 5, 25000.00, 6),
(10, 5, 25000.00, 7),
(10, 5, 25000.00, 8),
(10, 5, 25000.00, 9),
(10, 5, 25000.00, 10),
(10, 5, 25000.00, 11);

-- Creation of the Schools table
CREATE TABLE `schools` (
  `school_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `school_name` VARCHAR(100) NOT NULL,
  `school_address` VARCHAR(200) NOT NULL,
  `school_image_url` VARCHAR(100) NOT NULL DEFAULT '/images/schools/nf.jpg',
  `school_use_guide_url` VARCHAR(100) NOT NULL DEFAULT '/pdf/ejemplo.pdf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Schools table
INSERT INTO `schools` (`school_id`,`school_name`,`school_address`, `school_image_url`) VALUES
(1, 'IED El Ensueño', 'Tv. 70c #11 a 67a, Bogotá', '/images/schools/1.jpg'),
(2, 'Colegio Angela Restrepo Moreno', 'Cl. 69 Sur #71g-12, Bogotá', '/images/schools/2.jpg'),
(3, 'Colegio Emma Reyes', 'Cra. 80b #6-71, Bogotá', '/images/schools/3.jpg'),
(4, 'Colegio María Mercedes Carranza', 'El Perdomo, Tv. 70g #65 Sur-2, Bogotá', '/images/schools/4.jpg'),
(5, 'Colegio Distrital Agudelo Restrepo IED', 'Tv. 70d, Bogotá', '/images/schools/nf.jpg');

-- Creación de la tabla intermedia product_school
CREATE TABLE `school_products` (
  `product_school_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `product_id` INT NOT NULL,
  `school_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos de ejemplo en la tabla school_products
INSERT INTO `school_products` (`product_id`, `school_id`) VALUES
-- Colegio El Ensueño
(1, 1), -- Blazer escolar
(2, 1), -- Chaleco negro
(3, 1), -- Camisa blanca
(4, 1), -- Pantalón gris
(5, 1), -- Corbata
(6, 1), -- Jardinera
(7, 1), -- Chaqueta sudadera
(8, 1), -- Pantalón sudadera
(9, 1), -- Camiseta polo
(10, 1), -- Pantaloneta
-- Colegio Angela Restrepo Moreno
(1, 2), -- Blazer escolar
(2, 2), -- Chaleco negro
(3, 2), -- Camisa blanca
(4, 2), -- Pantalón gris
(5, 2), -- Corbata
(6, 2), -- Jardinera
(7, 2), -- Chaqueta sudadera
(8, 2), -- Pantalón sudadera
(9, 2), -- Camiseta polo
(10, 2), -- Pantaloneta
-- Colegio Emma Reyes
(1, 3), -- Blazer escolar
(2, 3), -- Chaleco negro
(3, 3), -- Camisa blanca
(4, 3), -- Pantalón gris
(5, 3), -- Corbata
(6, 3), -- Jardinera
(7, 3), -- Chaqueta sudadera
(8, 3), -- Pantalón sudadera
(9, 3), -- Camiseta polo
(10, 3), -- Pantaloneta
-- Colegio María Mercedes Carranza
(4, 4), -- Pantalón gris
-- Colegio Distrital Agudelo Restrepo IED
(3, 5), -- Camisa blanca
(4, 5); -- Pantalón gris

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
  `size_id` INT NOT NULL,
  `product_quantity` INT NOT NULL,
  `product_price` DECIMAL(10, 2)
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

ALTER TABLE `product_media` 
ADD CONSTRAINT `fk_product_media_product_id`
FOREIGN KEY (`product_id`) 
REFERENCES `products`(`product_id`) 
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
ON DELETE CASCADE,
ADD CONSTRAINT 'fk_sold_product_size_id'
FOREIGN KEY (`size_id`)
REFERENCES `sizes`(`size_id`)
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


-- ------------------------------- TRIGGER -------------------------------


DELIMITER //

CREATE TRIGGER check_multimedia_limit
BEFORE INSERT ON `product_media`
FOR EACH ROW
BEGIN
  DECLARE multimedia_count INT;
  SET multimedia_count = (SELECT COUNT(*) FROM `product_media` WHERE `product_id` = NEW.`product_id`);
  IF multimedia_count >= 4 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Maximum of 4 multimedia files per product is allowed';
  END IF;
END //

DELIMITER ;