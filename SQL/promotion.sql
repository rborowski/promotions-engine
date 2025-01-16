INSERT INTO `promotion` (`id`, `name`, `type`, `adjustment`, `criteria`) VALUES
(1, 'Black Friday half price sale', 'date_range_multiplier', 0.5, '{\"to\": \"2024-12-12\", \"from\": \"2024-11-11\"}'),
(2, 'Voucher OU812', 'fixed-price-voucher', 100, '{\"code\": \"OU812\"}');