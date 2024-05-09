SET FOREIGN_KEY_CHECKS=0;

TRUNCATE colors;
INSERT INTO colors(color, code) VALUES
('Red', "FF0000"),
('Green', "00FF00"),
('Blue', "0000FF");

TRUNCATE sizes;
INSERT INTO sizes(`size`) VALUES
('XS'),
('S'),
('M'),
('L'),
('XL');

TRUNCATE product_colors;
INSERT INTO product_colors(product_id, color_id) VALUES
(1, 1),
(1, 2);

TRUNCATE product_sizes;
INSERT INTO product_sizes(product_id, size_id) VALUES
(1, 1),
(1, 3),
(1, 5);




SET FOREIGN_KEY_CHECKS=1;
