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
(1, 'Andrés', 'Gutiérrez Hurtado', 'andres52885241@gmail.com', 'Andres_Gutierrez', '$2y$12$WeRROaP2Nbj/86uv7CEFFeSJlQoj02W5kzdv0pts4Nxz/.MttOrvS', 'Dg. 68D Sur #70c-31', 3209202177, '/images/users/1.jpg', '2024-06-21 19:46:14', '2024-06-22 21:24:56', 2),
(2, 'Alexandra', 'Hurtado Medina', 'alexandrahurtadomedina@hotmail.com', 'Alexandra_Hurtado', '$2y$12$.RLrg9MG6k4S0hjgY0lReu.CnE8uCiGOSArb3dOJFkwrvrYKo23zG', 'Dg. 68D Sur #70c-31', 3124852078, '/images/users/nf.jpg', '2024-06-25 13:44:19', '2024-06-25 13:44:19', 2),
(3, 'Saydy', 'Hurtado Medina', 'saydyhurtado@gmail.com', 'Saydy_Hurtado', '$2y$12$egkT9USUOJpvXjeXXFBqNOYFPnTxB3eO4AAs2MMsQZa1lyY5BB0Ze', 'Cl. 57 Sur #2-2, Bogotá', 3174823449, '/images/users/nf.jpg', '2024-06-25 13:45:57', '2024-06-25 13:45:57', 2),
(4, 'Rosmari', 'Hurtado Medina', 'rhurtado@gmail.com', 'Rosmari_Hurtado', '$2y$12$Eif6sN9K1qN/az0le5Bp9uTh7wFe1u1HLIxl5J0w7NN4wjdcCoCvW', 'Dg. 68D Sur #70c-31', 3223888716, '/images/users/nf.jpg', '2024-06-25 13:46:51', '2024-06-25 13:46:51', 2),
(5, 'Wendy Alejandra', 'Navarro Arias', 'nwendy798@gmail.com', 'Wendy_Navarro', '$2y$12$FlutKN6QO79GoAH3p0iPx.HXoN9P2kGKwY7fdywbymql9ycTWxM86', '51-77 a, Cl. 68 Sur #51-99, Bogotá', 3044462452, '/images/users/nf.jpg', '2024-06-22 23:39:02', '2024-06-22 23:35:34', 1);

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
INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_materials`, `product_image_url`, `created_at`, `updated_at`) VALUES
(1, 'Blazer escolar', 'Blazer para uniforme escolar.', 'buena tela.', '/images/products/1.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(2, 'Chaleco negro', 'Chaleco formal para uniforme escolar.', 'buena tela.', '/images/products/2.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(3, 'Camisa blanca', 'Camisa blanca para uniforme escolar.', 'buena tela.', '/images/products/3.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(4, 'Pantalón gris', 'Pantalón de vestir gris para uniforme escolar.', 'buena tela.', '/images/products/4.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(5, 'Corbata', 'Corbata azul obscura para uniforme escolar.', 'buena tela.', '/images/products/5.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(6, 'Jardinera', 'Jardinera de mezclilla para uniforme escolar.', 'buena tela.', '/images/products/6.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(7, 'Chaqueta sudadera', 'Chaqueta estilo sudadera para uniforme escolar.', 'buena tela.', '/images/products/7.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(8, 'Pantalón sudadera', 'Pantalón estilo sudadera para uniforme escolar.', 'buena tela.', '/images/products/8.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(9, 'Camiseta polo', 'Camiseta tipo polo para uniforme escolar.', 'buena tela.', '/images/products/9.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(10, 'Pantaloneta', 'Pantaloneta para actividades deportivas escolares.', 'buena tela.', '/images/products/10.jpg', '2024-06-25 13:58:58', '2024-06-25 13:58:58'),
(11, 'Chaleco Maria Mercedes Carranza', 'Chaleco escolar color azul.', 'buena tela.', '/images/products/11.jpg', '2024-06-25 14:03:54', '2024-06-25 14:03:54'),
(12, 'Sudadera Maria Mercedes Carranza', 'Sudadera verde deportiva.', 'buena tela.', '/images/products/12.jpg', '2024-06-25 14:05:57', '2024-06-25 14:05:57'),
(13, 'Jardinera Maria Mercedes Carranza', 'Jardinera azul estilo princesa.', 'buena tela.', '/images/products/13.jpg', '2024-06-25 14:07:32', '2024-06-25 14:07:32'),
(14, 'Chaqueta Maria Mercedes Carranza', 'Chaqueta uniforme diario', 'buena tela.', '/images/products/14.jpg', '2024-06-25 14:08:42', '2024-06-25 14:08:42'),
(15, 'Chaqueta CARIED', 'chaqueta roja deportiva.', 'buena tela.', '/images/products/15.jpg', '2024-06-25 14:21:43', '2024-06-25 14:21:44'),
(16, 'Pantalón CARIED', 'Pantalón negro con rojo deportivo.', 'buena tela.', '/images/products/16.jpg', '2024-06-25 14:23:34', '2024-06-25 14:23:34');

-- Creation of the Product Media table
CREATE TABLE `product_media` (
  `media_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `media_url` VARCHAR(255) NOT NULL,
  `media_type` ENUM('image', 'video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Product media table
INSERT INTO `product_media` (`product_id`, `media_url`, `media_type`) VALUES
-- jardinera
(6, '/images/products/extra/6_0.20240624153959.mp4', 'video'),
(6, '/images/products/extra/6_1.20240624154000.jpg', 'image'),
-- Caried
(15, '/images/products/extra/15_3.20240625092530.jpg', 'image'),
(15, '/images/products/extra/15_1.20240625092530.jpg', 'image'),
(15, '/images/products/extra/15_2.20240625092530.jpg', 'image'),
(15, '/images/products/extra/15_0.20240625092530.jpg', 'image');

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

-- Camisa blanca
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

-- Pantalón gris
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

-- Corbata
(5, 5, 10000.00, 12),

-- Jardinera
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

-- Chaqueta sudadera
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

-- Pantalón sudadera
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

-- Camiseta polo
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

-- Pantaloneta
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
(10, 5, 25000.00, 11),

(11, 5, 20000, 1),
(12, 5, 100000, 1),
(13, 5, 100000, 1),
(14, 5, 50000, 1),
(15, 5, 50000, 1),
(16, 5, 30000, 1);

-- Creation of the Schools table
CREATE TABLE `schools` (
  `school_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `school_name` VARCHAR(100) NOT NULL,
  `school_address` VARCHAR(200) NOT NULL,
  `school_image_url` VARCHAR(100) NOT NULL DEFAULT '/images/schools/nf.jpg',
  `school_use_guide_url` VARCHAR(100) NOT NULL DEFAULT '/pdf/ejemplo.pdf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserting data into the Schools table
INSERT INTO `schools` (`school_id`, `school_name`, `school_address`, `school_image_url`, `school_use_guide_url`) VALUES
(1, 'IED El Ensueño', 'Tv. 70c #11 a 67a, Bogotá', '/images/schools/1.jpg', '/pdf/ejemplo.pdf'),
(2, 'Colegio Angela Restrepo Moreno', 'Cl. 69 Sur #71g-12, Bogotá', '/images/schools/2.jpg', '/pdf/ejemplo.pdf'),
(3, 'Colegio Emma Reyes', 'Cra. 80b #6-71, Bogotá', '/images/schools/3.jpg', '/pdf/ejemplo.pdf'),
(4, 'Colegio María Mercedes Carranza', 'El Perdomo, Tv. 70g #65 Sur-2, Bogotá', '/images/schools/4.jpg', '/pdf/ejemplo.pdf'),
(5, 'Colegio Distrital Agudelo Restrepo IED', 'Tv. 70d, Bogotá', '/images/schools/5.jpg', '/pdf/ejemplo.pdf');

-- Creación de la tabla intermedia product_school
CREATE TABLE `school_products` (
  `product_school_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `product_id` INT NOT NULL,
  `school_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos de ejemplo en la tabla school_products
INSERT INTO `school_products` (`product_id`, `school_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(4, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 5),
(16, 5);

-- Creation of the Orders table
CREATE TABLE `orders` (
  `order_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` INT NOT NULL,  
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creation of the Payment Details table
CREATE TABLE `payments_details` (
  `payment_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `order_id` INT NOT NULL,
  `payment_state` INT NOT NULL, -- polTransactionState
  `payment_method` INT NOT NULL, -- polPaymentMethodType
	`payment_amount` DECIMAL(10, 2) NOT NULL, -- TX_VALUE
  `payment_buyer_email` VARCHAR(70) NOT NULL, -- buyerEmail
  `payment_description` VARCHAR(255) NOT NULL -- IapResponseCode
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creation of the Sold Products table
CREATE TABLE `sold_products`(
	`order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `size_id` INT NOT NULL,
  `product_quantity` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
ADD CONSTRAINT `fk_sold_product_size_id`
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
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Son máximo 4 archivos por cada producto.';
  END IF;
END //

DELIMITER ;