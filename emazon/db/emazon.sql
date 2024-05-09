SET FOREIGN_KEY_CHECKS=0;

--
-- addresses table
--
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	title VARCHAR(64) NOT NULL,
	full_name VARCHAR(64) NOT NULL,
	phone VARCHAR(12) NOT NULL,
	address_line_1 VARCHAR(128) NOT NULL,
	town_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- users table
--
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(32) NOT NULL,
	last_name VARCHAR(32) NOT NULL,
	gender TINYINT(1) NOT NULL,
	phone VARCHAR(12) UNIQUE NOT NULL,
	email VARCHAR(64) UNIQUE,
	password VARCHAR(255) NOT NULL,
	is_active TINYINT DEFAULT 0,
	is_blocked TINYINT DEFAULT 0,
	photo VARCHAR(255),
	address_id INT UNSIGNED,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	verified_at TIMESTAMP NULL DEFAULT NULL,

	INDEX(first_name, last_name),
	INDEX(phone),
	INDEX(email),

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- admins table
--
-- Role = 1 --> super admin
-- Role = 2 --> Admin (KYC verifier)
-- Role = 3 --> Admin (Course manager)
-- Role = 4 --> Business
-- Role = 5 --> Institute
-- Role = 6 --> Trainer
-- Role = 7 -->
--
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(32) NOT NULL,
	last_name VARCHAR(32) NOT NULL,
	gender TINYINT(1) NOT NULL,
	phone VARCHAR(12) UNIQUE NOT NULL,
	email VARCHAR(64) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	is_active TINYINT DEFAULT 0,
	is_blocked TINYINT DEFAULT 0,
	photo VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	verified_at TIMESTAMP NULL DEFAULT NULL,

	role TINYINT(1) NOT NULL,

	INDEX(first_name, last_name),
	INDEX(phone),
	INDEX(email),

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

-- 
-- password_resets table
--
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    token VARCHAR(256) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX(token),
    INDEX(user_id),

    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- coupons table
--
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	coupon VARCHAR(16),
	value INT UNSIGNED NOT NULL,
	is_active TINYINT(1) DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- applied_coupons table
--
DROP TABLE IF EXISTS `applied_coupons`;
CREATE TABLE `applied_coupons` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	coupon_id INT UNSIGNED NOT NULL,
	order_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,

	INDEX(user_id),
	INDEX(order_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(order_id) REFERENCES orders(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- categories table
-- parent_id = self ref for multi level (nested) category
-- e.g. Development -> Web Development -> PHP, Javascript, Nodejs, CSS etc.
--
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(64) NOT NULL,
	image_path VARCHAR(128),
	parent_id INT UNSIGNED DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	deleted_at TIMESTAMP DEFAULT NULL,

	PRIMARY KEY(id),
	FOREIGN KEY(parent_id) REFERENCES categories(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- products table
-- Here product is just a package containing courses
-- One product can have multiple courses
-- products can not be unpublished because once user buys the product then he must be able to access it all time
-- subtitle = very is short description of the product that will be shown
--            in product (course) card
-- owner_id = Institute, Business or can be super admin
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	code CHAR(8) NOT NULL UNIQUE,
	title VARCHAR(128) NOT NULL,
	subtitle VARCHAR(256),
	description VARCHAR(512),
	price_mp INT NOT NULL,
	price_sp INT NOT NULL,
	discount INT DEFAULT 0,
	slug VARCHAR(256) NOT NULL UNIQUE,
	image VARCHAR(64),
	category_id INT UNSIGNED NOT NULL,
	is_returnable TINYINT(1) DEFAULT 0,
	is_published TINYINT(1) DEFAULT 0,

	INDEX(code, title),
	INDEX(category_id),
	INDEX(slug),
	INDEX(is_published),

	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	published_at DATETIME DEFAULT NULL,

	PRIMARY KEY(id),
	FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- colors table
-- stores all colors the brand produces products in
--
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	color VARCHAR(64),
	code CHAR(6) NOT NULL,

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- sizes table
-- stores all sizes of the brand products
--
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`size` VARCHAR(10),

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_colors table
--
DROP TABLE IF EXISTS `product_colors`;
CREATE TABLE `product_colors` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id BIGINT UNSIGNED NOT NULL,
	color_id INT UNSIGNED NOT NULL,

	INDEX(product_id),
	INDEX(product_id, color_id),

	PRIMARY KEY (id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(color_id) REFERENCES colors(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_sizes table
--
DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE `product_sizes` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id BIGINT UNSIGNED NOT NULL,
	size_id INT UNSIGNED NOT NULL,

	INDEX(product_id),
	INDEX(product_id, size_id),

	PRIMARY KEY (id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(size_id) REFERENCES sizes(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;
--
-- materials table
--
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`material` VARCHAR(16),

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_images table
-- image = filename of the image
-- is_default = 1 means product image is default product image
--
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	image VARCHAR(64) NOT NULL,
	is_default TINYINT(1) DEFAULT 1,

	INDEX(product_id),

	PRIMARY KEY (id),
	FOREIGN KEY (product_id) REFERENCES products(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- carts table
--
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT UNSIGNED NOT NULL,
	coupon_id INT UNSIGNED,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(coupon_id) REFERENCES coupons(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- cart_items table
--
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	qty INT NOT NULL,
	cart_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(cart_id),

	PRIMARY KEY(id),
	FOREIGN KEY(cart_id) REFERENCES carts(id),
	FOREIGN KEY(product_id) REFERENCES products(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- orders table
-- status = 0 = created, 1 = success, 2 = failed, 3 = processed
-- owner_id = Institute, Business or can be super admin
-- user_id = User who purchased the product
-- order_group_id: this design is very useful when building system
-- for multi vendors, where order must be divided into multiple orders
-- under a single order_group, since one order can contain items that belong to
-- different owners (course creator).
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	order_group_id VARCHAR(64) NOT NULL,
	amount INT UNSIGNED NOT NULL,
	gross_total INT UNSIGNED NOT NULL DEFAULT 0,
	sub_total INT UNSIGNED NOT NULL,
	discount INT UNSIGNED NOT NULL,
	tax INT UNSIGNED NOT NULL DEFAULT 0,
	shipment INT UNSIGNED NOT NULL DEFAULT 0,
	user_id INT UNSIGNED NOT NULL,
	applied_coupon_id INT UNSIGNED DEFAULT NULL,
	status INT DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(order_group_id),
	INDEX(created_at),
	INDEX(status),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (applied_coupon_id) REFERENCES coupons(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- order_items table
-- status: 1 = created, 2 = cancellation requested, 4 = cancelled, 8 = shipped
--         16 = delivered, 32 = return requested, 64 = returned
--         128 = refund requested, 256 = refunded, 512 = finished processing
-- flags: contains all the state an order_item went through
--
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	order_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	qty INT NOT NULL,
	price_mp INT UNSIGNED NOT NULL DEFAULT 0,
	price_sp INT UNSIGNED NOT NULL DEFAULT 0,
	discount INT UNSIGNED NOT NULL DEFAULT 0,
	status SMALLINT UNSIGNED DEFAULT 0,
	flags SMALLINT UNSIGNED DEFAULT 0,
	shipped_at DATETIME DEFAULT NULL,
	delivered_at DATETIME DEFAULT NULL,
	cancellation_requested_at DATETIME DEFAULT NULL,
	cancelled_at DATETIME DEFAULT NULL,
	return_requested_at DATETIME DEFAULT NULL,
	returned_at DATETIME DEFAULT NULL,
	refund_requested_at DATETIME DEFAULT NULL,
	refunded_at DATETIME DEFAULT NULL,

	INDEX(order_id),
	INDEX(product_id),
	INDEX(user_id),
	INDEX(status),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (product_id) REFERENCES products(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- payments table
-- status = 1 = success, 2 = failed
-- mode: 0 = unknown, 1 = Online, 2 = Cash
-- pg_payment_id: is the unique transaction id generated at the payment gateway
--   this id is independant of pg_payments table, pg_payments table stores all
--   the other details along with the unique transaction id.
--
-- This table will not have multiple records for the payment of each owner's order for a single
-- order (an order can have items of different owners). This is because we are collecting payment
-- for the order from user which is the total sum of the cart. Therefore we can not divide the payments
-- between owners. So we can not keep the owner_id in this table, previously it was here but after refining
-- it will not.
--
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount INT UNSIGNED NOT NULL,
	order_group_id VARCHAR(64) NOT NULL,
	pg_payment_id VARCHAR(64) NOT NULL,
	status INT DEFAULT 0,
	mode TINYINT(1) DEFAULT 0,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(order_group_id),
	INDEX(pg_payment_id),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- pg_payments table
-- status: 0 = pending / unknown, 1 = success, 2 = failure
-- mode: 1 = Credit Card, 2 = Debit Card, 3 = Net Banking, 4 = UPI, 5 = Cash
--
DROP TABLE IF EXISTS `pg_payments`;
CREATE TABLE `pg_payments` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount INT UNSIGNED NOT NULL,
	order_group_id VARCHAR(64) NOT NULL,
	pg_payment_id VARCHAR(128) DEFAULT NULL,
	pg_order_id VARCHAR(128) DEFAULT NULL,
	mode TINYINT(1) DEFAULT NULL,
	status TINYINT(1) DEFAULT 0,

	INDEX(order_group_id),
	INDEX(pg_payment_id),

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- refunds table
-- amount in Indian paise
-- pg stands for Payment Gateway
-- order_id: here order_id belongs to single ordered item for which user
-- requested refund. This is not order_group_id
--
DROP TABLE IF EXISTS `refunds`;
CREATE TABLE `refunds` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT UNSIGNED NOT NULL,
	order_id INT UNSIGNED NOT NULL,
	order_item_id INT UNSIGNED NOT NULL,
	payment_id INT UNSIGNED NOT NULL,
	amount INT NULL NULL,
	pg_refund_id VARCHAR(256) NOT NULL,
	pg_status VARCHAR(32) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(order_id),
	INDEX(order_item_id),
	INDEX(user_id),
	INDEX(created_at),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (order_item_id) REFERENCES order_items(id),
	FOREIGN KEY (payment_id) REFERENCES payments(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- invoices table
--
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	order_id INT UNSIGNED NOT NULL,
	shipping_id INT UNSIGNED NOT NULL,
	address_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (shipping_id) REFERENCES shippings(id),
	FOREIGN KEY (address_id) REFERENCES addresses(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- admins table data
--
INSERT INTO admins(first_name, last_name, gender, phone, email, password, photo, role) VALUES
('Admin', 'User', 1, '9331920000', 'admin@futuredemy.com', '$2y$10$m10VlTg6o2yYt3SRW92AZOJBIoPNmAWP2/x7nuzt17rgqVhWWzMbW', 'avatar-male.jpg', 1);

--
-- users table data
--
INSERT INTO users(first_name, last_name, gender, phone, email, username, password, photo, role) VALUES
('User', 'One', 1, '9331920001','one@futuredemy.com',  'DA22030001', '$2y$10$m10VlTg6o2yYt3SRW92AZOJBIoPNmAWP2/x7nuzt17rgqVhWWzMbW', 'avatar-male.jpg', 2),
('User', 'Two', 1, '9331920002', 'two@futuredemy.com', 'DA22030002', '$2y$10$m10VlTg6o2yYt3SRW92AZOJBIoPNmAWP2/x7nuzt17rgqVhWWzMbW', 'avatar-male.jpg', 2);



SET FOREIGN_KEY_CHECKS=1;
