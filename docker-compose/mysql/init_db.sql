DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `price` INT DEFAULT 0,
                          `data` LONGTEXT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE (`sku`)
);

INSERT INTO products (sku, name, price, data) VALUES ('Abc', 'Book', 239, '{"weight":50}'), ('Efg', 'DVD', 765, '{"size":88}');