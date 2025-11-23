-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2025 lúc 12:05 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) NOT NULL COMMENT 'ID log',
  `admin_id` bigint(20) DEFAULT NULL COMMENT 'ID admin thực hiện',
  `action` text DEFAULT NULL COMMENT 'Hành động đã thực hiện',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm thực hiện'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL COMMENT 'ID thuộc tính',
  `name` varchar(100) NOT NULL COMMENT 'Tên thuộc tính (ví dụ: Màu, Size)',
  `slug` varchar(100) NOT NULL COMMENT 'Mã định danh duy nhất (dạng viết liền)',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Màu', 'màu-sắc', '2025-10-09 23:42:15', '2025-10-09 23:42:15'),
(2, 'Size', 'kích-thước', '2025-10-09 23:56:28', '2025-10-09 23:56:28'),
(3, 'Material', 'chất-liệu', '2025-10-10 00:18:53', '2025-10-10 00:18:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL COMMENT 'ID giá trị thuộc tính',
  `attribute_id` int(11) NOT NULL COMMENT 'ID thuộc tính',
  `value` varchar(100) NOT NULL COMMENT 'Giá trị thuộc tính (ví dụ: Đỏ, 42mm)',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hồng', '2025-10-09 23:38:22', '2025-10-09 23:38:22'),
(2, 1, 'Xám', '2025-10-09 23:47:55', '2025-10-09 23:47:55'),
(3, 1, 'Đen', '2025-10-09 23:51:18', '2025-10-09 23:51:18'),
(4, 2, 'M', '2025-10-10 00:03:42', '2025-10-10 00:03:42'),
(5, 2, 'L', '2025-10-10 00:12:27', '2025-10-10 00:12:27'),
(6, 2, 'XL', '2025-10-10 00:21:09', '2025-10-10 00:21:09'),
(7, 2, 'XXL', '2025-10-09 23:44:33', '2025-10-09 23:44:33'),
(8, 3, 'Lụa', '2025-10-09 23:58:16', '2025-10-09 23:58:16'),
(9, 3, 'jeen', '2025-10-10 00:07:48', '2025-10-10 00:07:48'),
(10, 1, 'Trắng', '2025-10-09 23:36:51', '2025-10-09 23:36:51'),
(11, 1, 'Nâu', '2025-10-10 00:14:29', '2025-10-10 00:14:29'),
(12, 1, 'Xanh', '2025-10-09 23:49:37', '2025-10-09 23:49:37'),
(13, 1, 'Đỏ', '2025-10-10 00:19:54', '2025-10-10 00:19:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL COMMENT 'ID banner',
  `category_id` int(11) NOT NULL COMMENT 'id của danh mục',
  `image_url` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn ảnh',
  `link_url` varchar(255) DEFAULT NULL COMMENT 'Liên kết khi click',
  `position` varchar(50) DEFAULT NULL COMMENT 'Vị trí hiển thị (home, top, bottom...)',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Trạng thái hiển thị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `category_id`, `image_url`, `link_url`, `position`, `is_active`) VALUES
(1, 1, 'slide1.png', NULL, NULL, 1),
(3, 1, 'slide2.png', NULL, NULL, 1),
(4, 1, 'slide3.png', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL COMMENT 'ID bài viết',
  `title` varchar(255) DEFAULT NULL COMMENT 'Tiêu đề',
  `content` text DEFAULT NULL COMMENT 'Nội dung',
  `image_url` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện',
  `published_at` datetime DEFAULT NULL COMMENT 'Thời điểm xuất bản',
  `author_id` bigint(20) DEFAULT NULL COMMENT 'ID người viết'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) NOT NULL COMMENT 'ID giỏ hàng',
  `user_id` bigint(20) NOT NULL COMMENT 'ID người dùng',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`) VALUES
(14, 16, '2025-11-21 14:36:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) NOT NULL COMMENT 'ID chi tiết giỏ hàng',
  `cart_id` bigint(20) NOT NULL COMMENT 'ID giỏ hàng',
  `product_variant_id` bigint(20) NOT NULL COMMENT 'ID biến thể sản phẩm',
  `quantity` int(11) NOT NULL DEFAULT 1 COMMENT 'Số lượng mua'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_variant_id`, `quantity`) VALUES
(114, 14, 130, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'ID danh mục',
  `name` varchar(100) NOT NULL COMMENT 'Tên danh mục',
  `parent_id` int(11) DEFAULT NULL COMMENT 'ID danh mục cha (nếu có)',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Thứ tự hiển thị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `sort_order`) VALUES
(1, 'Nam', NULL, 1),
(2, 'Nữ', NULL, 2),
(3, 'Bé Trai', NULL, 3),
(4, 'Bé Gái', NULL, 4),
(5, 'School', NULL, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL COMMENT 'ID mã giảm giá',
  `code` varchar(50) NOT NULL COMMENT 'Mã code',
  `discount_type` enum('percent','fixed') NOT NULL COMMENT 'Kiểu giảm: phần trăm hoặc số tiền cố định',
  `discount_value` decimal(10,2) NOT NULL COMMENT 'Giá trị giảm',
  `min_order_value` decimal(10,2) DEFAULT NULL COMMENT 'Giá trị đơn hàng tối thiểu',
  `usage_limit` int(11) DEFAULT NULL COMMENT 'Số lần sử dụng tối đa',
  `used_count` int(11) DEFAULT 0 COMMENT 'Số lần đã sử dụng',
  `start_date` date DEFAULT NULL COMMENT 'Ngày bắt đầu hiệu lực',
  `end_date` date DEFAULT NULL COMMENT 'Ngày hết hạn',
  `status` enum('pending','active','expired') DEFAULT NULL COMMENT 'Trạng thái coupons'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL COMMENT 'ID thông báo',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'ID người nhận thông báo',
  `message` text DEFAULT NULL COMMENT 'Nội dung thông báo',
  `type` varchar(50) DEFAULT NULL COMMENT 'Loại thông báo (đơn hàng, hệ thống...)',
  `is_read` tinyint(1) DEFAULT 0 COMMENT 'Đã đọc hay chưa',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm gửi thông báo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL COMMENT 'ID đơn hàng',
  `coupon_id` int(11) DEFAULT NULL COMMENT 'id coupons',
  `user_id` bigint(20) NOT NULL COMMENT 'ID người dùng đặt hàng',
  `email_order` varchar(255) NOT NULL COMMENT 'Email người nhận',
  `phone_order` int(11) NOT NULL COMMENT 'số điện thoại người nhận',
  `name_order` varchar(255) NOT NULL COMMENT 'Tên người nhận',
  `total_price` decimal(10,2) NOT NULL COMMENT 'Tổng giá trị đơn hàng',
  `shipping_address` text DEFAULT NULL COMMENT 'Địa chỉ giao hàng',
  `payment_method` enum('COD','Bank Transfer') NOT NULL COMMENT 'Phương thức thanh toán',
  `status` enum('processing','shipping','delivered','cancelled') DEFAULT 'processing' COMMENT 'Trạng thái đơn hàng',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `coupon_id`, `user_id`, `email_order`, `phone_order`, `name_order`, `total_price`, `shipping_address`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(72, NULL, 16, 'ducvu159753@gmail.com', 234567891, 'duc', 299000.00, '117/15/1 Trần Cung', 'COD', 'processing', '2025-11-21 14:37:00', '2025-11-21 14:37:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL COMMENT 'ID chi tiết đơn hàng',
  `order_id` bigint(20) NOT NULL COMMENT 'ID đơn hàng',
  `product_variant_id` bigint(20) NOT NULL COMMENT 'ID biến thể sản phẩm',
  `quantity` int(11) NOT NULL COMMENT 'Số lượng',
  `price` decimal(10,2) NOT NULL COMMENT 'Giá tại thời điểm mua'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_variant_id`, `quantity`, `price`) VALUES
(93, 72, 119, 1, 299000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL COMMENT 'ID thanh toán',
  `order_id` bigint(20) NOT NULL COMMENT 'ID đơn hàng liên quan',
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending' COMMENT 'Trạng thái thanh toán',
  `payment_gateway` varchar(50) DEFAULT NULL COMMENT 'Cổng thanh toán sử dụng',
  `transaction_id` varchar(100) DEFAULT NULL COMMENT 'Mã giao dịch',
  `paid_at` datetime DEFAULT NULL COMMENT 'Thời gian thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_status`, `payment_gateway`, `transaction_id`, `paid_at`) VALUES
(34, 72, 'pending', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL COMMENT 'ID sản phẩm',
  `category_id` int(11) NOT NULL COMMENT 'ID danh mục',
  `name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `description` text DEFAULT NULL COMMENT 'Mô tả sản phẩm',
  `thumbnail` varchar(255) NOT NULL COMMENT 'ảnh chính sản phẩm',
  `price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active' COMMENT 'Trạng thái hiển thị',
  `is_new` tinyint(1) DEFAULT 0 COMMENT 'Đánh dấu sản phẩm mới',
  `is_hot` tinyint(1) DEFAULT 0 COMMENT 'Sản phẩm nổi bật',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `thumbnail`, `price`, `sale_price`, `status`, `is_new`, `is_hot`, `created_at`, `updated_at`) VALUES
(39, 1, 'Áo polo nam basic', 'Áo polo nam basic có cổ bẻ, nẹp cài cúc thiết kế vát chéo có in sọc, kiểu dáng đơn giản phù hợp với nhiều hoàn cảnh sử dụng.', '1763719576_1754561783_68947cf79d225.webp', 449000, 314300, 'active', 1, 1, '2025-10-09 23:37:42', '2025-11-21 17:06:16'),
(45, 1, 'Áo phông người lớn Độc Lập - Tự do - Hạnh phúc', 'Áo phông phong cách typo truyền tải thông điệp tinh thần dân tộc và tình yêu quê hương đất nước. Ba từ khóa “Độc Lập – Tự Do – Hạnh Phúc” được thể hiện bằng typography mạnh mẽ, gọn gàng, hiện đại, tạo điểm nhấn đầy ấn tượng. Là một sản phẩm kết nối các thế hệ trong gia đình Việt Nam hiện đại, cùng chung tinh thần tự hào về quê hương, đất nước.', '1763719609_1755339889_68a05c71b9986.webp', 359000, 299000, 'active', 1, 1, '2025-10-09 23:37:42', '2025-11-21 17:06:49'),
(46, 1, 'Áo phông người lớn Ngôi sao Việt Nam', 'Áo phông unisex người lớn Canifa S Kết nối tự hào dáng boxy.\r\nNhững chiếc áo mang sắc đỏ, vàng cùng dòng chữ “Việt Nam” nhằm lan tỏa tình yêu quê hương đất nước, niềm tự hào dân tộc. Các thiết kế hướng tới sự năng động, sáng tạo và thời trang để mọi người dễ dàng kết hợp cùng các sản phẩm khác trong đa dạng hoàn cảnh sử dụng.', '1755340178_68a05d92684cf.webp', 339000, 299000, 'active', 1, 1, '2025-10-09 23:37:42', '2025-11-21 17:06:56'),
(47, 1, 'Quần âu nam Slimfit có chun', 'Quần âu nam cạp lót họa tiết, form dáng mặc vừa với cơ thể. Cạp quần có thiết kế chi tiết chun tăng giảm đặc biệt phù hợp cho nhiều dáng cơ thể bụng nhỏ, bụng vừa, bụng to tạo tính thẩm mỹ, thiết kế cao. Chất liệu đứng form, có độ bền cao, dễ phối đồ.', '1755340528_68a05ef08f523.webp', 849000, 699000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(48, 2, 'Áo phông nữ cổ tròn dáng suông', 'Áo T-shirt nữ giá tốt cổ tròn', '1755340992_68a060c0ade01.webp', 149000, 79000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(49, 2, 'Áo len ghi lê nữ cổ tim dệt kiểu', 'Áo len ghi lê, dáng áo rộng vừa, chất liệu dệt len mềm mại, ấm áp. Hoàn cảnh sử dụng linh hoạt.', '1755341340_68a0621c27ced.webp', 500000, 399000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(50, 2, 'Áo polo nữ hoạ tiết kẻ', 'Áo polo nữ dáng ngắn với các họa tiết dệt kẻ đa dạng từ màu rực rỡ cho đến trung tính, dễ dàng lựa chọn cho khách hàng.\r\n', '1755341541_68a062e5528b0.webp', 649000, 399000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(51, 2, 'Áo phông nữ dáng slimfit', 'Áo phông nữ dáng ôm vai chờm bắt trend, với chất liệu vải dệt rib tạo sự thoải mái tối đa cho nhg sản phẩm dáng ôm.', '1755341948_68a0647cb14f5.webp', 299000, 209000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(52, 3, 'Áo phông unisex trẻ em Việt Nam Độc lập', 'Áo phông phong cách typo truyền tải thông điệp tinh thần dân tộc và tình yêu quê hương đất nước. Ba từ khóa “Độc Lập – Tự Do – Hạnh Phúc” được thể hiện bằng typography mạnh mẽ, gọn gàng, hiện đại, tạo điểm nhấn đầy ấn tượng. Là một sản phẩm kết nối các thế hệ trong gia đình Việt Nam hiện đại, cùng chung tinh thần tự hào về quê hương, đất nước.', '1755342275_68a065c3d115c.webp', 349000, 219000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(53, 3, 'Áo phông unisex trẻ em Cờ đỏ sao vàng', 'Áo phông mang biểu tượng ngôi sao vàng năm cánh của quốc kỳ Việt Nam, tượng trưng cho tinh thần đoàn kết và sức mạnh dân tộc. Chiếc áo quen thuộc nhưng được hoàn thiện chỉnh chu về phom dáng, đề cao chất lượng sản phẩm, là một biểu tượng kết nối các thế hệ trong gia đình Việt Nam hiện đại, cùng chung tinh thần dân tộc, cùng tự hào khoác lên mình màu cờ tổ quốc.', '1755342483_68a066930fb00.webp', 200000, 169000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(54, 4, 'Áo phông unisex trẻ em Cờ đỏ sao vàng', 'Áo phông mang biểu tượng ngôi sao vàng năm cánh của quốc kỳ Việt Nam, tượng trưng cho tinh thần đoàn kết và sức mạnh dân tộc. Chiếc áo quen thuộc nhưng được hoàn thiện chỉnh chu về phom dáng, đề cao chất lượng sản phẩm, là một biểu tượng kết nối các thế hệ trong gia đình Việt Nam hiện đại, cùng chung tinh thần dân tộc, cùng tự hào khoác lên mình màu cờ tổ quốc.', '1755342570_68a066ea2cfff.webp', 200000, 169000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(55, 5, 'Áo sơ mi bé trai đính patch trang trí', 'Áo sơ mi phom basic, chất liệu cotton phom dáng cơ bản, đính patch ngực phù hợp cho các bé sử dụng trong nhiều hoàn cảnh.', '1755342756_68a067a4e87e8.webp', 333000, 299000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(56, 4, 'Quần soóc bé gái cạp chun dáng thể thao', 'Quần soóc bé gái phong cách thể thao, chất liệu cotton pha mềm mại đứng form, kiểu dáng khỏe khoắn năng động phù hợp với nhiều hoàn cảnh sử dụng,', '1755697668_68a5d2049c3e2.webp', 320000, 149000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(57, 1, 'Áo sát nách bé gái cotton USA tay cánh tiên', 'Áo thun sát nách bé gái in tự do nữ tính tạo cảm giác điệu đà cho các con, chất liệu cotton thoáng mát, tay cánh tiên điệu đà.', '1755702698_68a5e5aac5066.webp', 169000, 79000, 'active', 1, 0, '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(58, 2, 'Bộ nỉ nữ WBD001W4 dáng suông rộng', 'abcd', '1763719552_anhdaidien.jpg', 501000, 400000, 'active', 1, 1, '2025-11-21 15:23:28', '2025-11-21 17:05:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) NOT NULL COMMENT 'ID biến thể',
  `product_id` bigint(20) NOT NULL COMMENT 'ID sản phẩm gốc',
  `is_hot` enum('0','1') NOT NULL,
  `sku` varchar(100) DEFAULT NULL COMMENT 'Mã SKU',
  `price` decimal(10,2) NOT NULL COMMENT 'Giá bán',
  `sale_price` decimal(10,2) DEFAULT NULL COMMENT 'Giá khuyến mãi',
  `stock_quantity` int(11) DEFAULT 0 COMMENT 'Số lượng tồn kho',
  `status` enum('active','hidden','out_of_stock') DEFAULT 'active' COMMENT 'Trạng thái biến thể',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `is_hot`, `sku`, `price`, `sale_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(49, 39, '0', 'MPHM', 499000.00, 314300.00, 10, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(50, 39, '0', 'MPHL', 499000.00, 314300.00, 17, 'hidden', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(51, 39, '0', 'MPHXL', 499000.00, 314300.00, 8, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(52, 39, '0', 'MPHXXL', 499000.00, 314300.00, 13, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(53, 39, '0', 'MPXM', 499000.00, 314300.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(54, 39, '0', 'MPXL', 499000.00, 314300.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(55, 39, '0', 'MPXXL', 499000.00, 314300.00, 15, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(56, 39, '0', 'MPXXXL', 499000.00, 314300.00, 23, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(62, 45, '0', 'PHONGXM', 359000.00, 299000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(63, 45, '0', 'PHONGXL', 359000.00, 299000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(64, 45, '0', 'PHONGXXL', 359000.00, 299000.00, 11, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(65, 45, '0', 'PHONGXXXL', 359000.00, 299000.00, 31, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(66, 45, '0', 'PHONGDM', 359000.00, 299000.00, 13, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(67, 45, '0', 'PHONGDL', 359000.00, 299000.00, 6, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(68, 45, '0', 'PHONGDXL', 359000.00, 299000.00, 42, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(69, 45, '0', 'PHONGDXXL', 359000.00, 299000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(70, 46, '0', 'SAOVIETM', 339000.00, 299000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(71, 46, '0', 'SAOVIETL', 339000.00, 299000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(72, 46, '0', 'SAOVIETXL', 339000.00, 299000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(73, 46, '0', 'SAOVIETXXL', 339000.00, 299000.00, 14, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(74, 47, '0', 'MQAXM', 849000.00, 699000.00, 9, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(75, 47, '0', 'MQAXL', 849000.00, 699000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(76, 47, '0', 'MQAXXL', 849000.00, 699000.00, 212, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(77, 47, '0', 'MQAXXXL', 849000.00, 699000.00, 41, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(78, 47, '0', 'MQADM', 849000.00, 699000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(79, 47, '0', 'MQADL', 849000.00, 699000.00, 53, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(80, 47, '0', 'MQADXL', 849000.00, 699000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(81, 47, '0', 'MQADXXL', 849000.00, 699000.00, 54, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(82, 48, '0', 'WPHONGDM', 149000.00, 79000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(83, 48, '0', 'WPHONGDL', 149000.00, 79000.00, 31, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(84, 48, '0', 'WPHONGDXL', 149000.00, 79000.00, 142, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(85, 48, '0', 'WPHONGTM', 149000.00, 79000.00, 54, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(86, 48, '0', 'WPHONGTL', 149000.00, 79000.00, 6, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(87, 48, '0', 'WPHONGTXL', 149000.00, 79000.00, 124, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(88, 48, '0', 'WPHONGBM', 149000.00, 79000.00, 65, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(89, 48, '0', 'WPHONGBL', 149000.00, 79000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(90, 48, '0', 'WPHONGBXL', 149000.00, 79000.00, 54, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(91, 49, '0', 'WGLNM', 500000.00, 399000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(92, 49, '0', 'WGLNL', 500000.00, 399000.00, 32, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(93, 49, '0', 'WGLNXL', 500000.00, 399000.00, 10, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(94, 50, '0', 'WPHM', 649000.00, 399000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(95, 50, '0', 'WPHL', 649000.00, 399000.00, 31, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(96, 50, '0', 'WPXM', 649000.00, 399000.00, 44, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(97, 50, '0', 'WPXL', 649000.00, 399000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(98, 51, '0', 'WPSNM', 299000.00, 209000.00, 21, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(99, 51, '0', 'WPSNL', 299000.00, 209000.00, 23, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(100, 51, '0', 'WPSNXL', 299000.00, 209000.00, -16, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(101, 51, '0', 'WPSDM', 299000.00, 209000.00, 4, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(102, 51, '0', 'WPSDL', 299000.00, 209000.00, 76, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(103, 51, '0', 'WPSDXL', 299000.00, 209000.00, 8, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(104, 52, '0', 'BPHVNXM', 349000.00, 219000.00, 65, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(105, 52, '0', 'BPHVNXL', 349000.00, 219000.00, 34, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(106, 52, '0', 'BPHVNXXL', 349000.00, 219000.00, 7, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(107, 52, '0', 'BPHVNDM', 349000.00, 219000.00, 86, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(108, 52, '0', 'BPHVNDL', 349000.00, 219000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(109, 52, '0', 'BPHVNDXXL', 349000.00, 219000.00, 7, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(110, 52, '0', 'BPHVNRM', 349000.00, 219000.00, 46, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(111, 52, '0', 'BPHVNRL', 349000.00, 219000.00, 8, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(112, 52, '0', 'BPHVNRXL', 349000.00, 219000.00, 33, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(113, 53, '0', 'KPHSVDM', 200000.00, 169000.00, 14, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(114, 53, '0', 'KPHSVDL', 200000.00, 169000.00, 43, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(115, 53, '0', 'KPHSVDXL', 200000.00, 169000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(116, 54, '0', 'GPHSVDM', 200000.00, 169000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(117, 54, '0', 'GPHSVDL', 200000.00, 169000.00, 11, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(118, 54, '0', 'GPHSVDXL', 200000.00, 169000.00, 44, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(119, 55, '0', 'SSMBM', 333000.00, 299000.00, 42, 'active', '2025-10-09 23:37:42', '2025-11-21 14:37:00'),
(120, 55, '0', 'SSMBL', 333000.00, 299000.00, 66, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(121, 56, '0', 'QS1', 279000.00, 145000.00, 12, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(122, 56, '0', 'QS2', 279000.00, 145000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(123, 56, '0', 'QS3', 279000.00, 145000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(124, 56, '0', 'QS5', 279000.00, 145000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(125, 56, '0', 'QS4', 279000.00, 145000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(126, 56, '0', 'QS6', 279000.00, 145000.00, 22, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(127, 57, '0', 'SS1', 150000.00, 70000.00, 111, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(128, 57, '0', 'FF2', 150000.00, 70000.00, 111, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(129, 57, '0', 'FF5', 150000.00, 70000.00, 111, 'active', '2025-10-09 23:37:42', '2025-10-09 23:37:42'),
(130, 58, '0', 'X1', 501000.00, 400000.00, 100, 'active', '2025-11-21 15:23:28', '2025-11-21 15:24:14'),
(131, 58, '0', 'X2', 501000.00, 400000.00, 21, 'active', '2025-11-21 15:23:28', '2025-11-21 15:39:13'),
(132, 58, '0', 'X3', 501000.00, 400000.00, 34, 'active', '2025-11-21 15:23:28', '2025-11-21 15:39:41'),
(133, 58, '0', 'T1', 501000.00, 400000.00, 11, 'active', '2025-11-21 15:23:28', '2025-11-21 16:54:32'),
(134, 58, '0', 'T2', 501000.00, 400000.00, 1, 'active', '2025-11-21 15:23:28', '2025-11-21 16:09:05'),
(135, 58, '0', 'T3', 501000.00, 400000.00, 5, 'active', '2025-11-21 15:23:28', '2025-11-21 16:16:57'),
(136, 58, '0', 'ĐEM944', 501000.00, 400000.00, 51, 'active', '2025-11-21 16:21:13', '2025-11-21 16:56:12'),
(137, 58, '0', 'ĐEL115', 501000.00, 400000.00, 0, 'out_of_stock', '2025-11-21 16:21:13', '2025-11-21 16:38:03'),
(138, 58, '0', 'PRO58-C13-S5', 501000.00, 400000.00, 0, 'active', '2025-11-21 16:23:43', '2025-11-21 16:23:43'),
(139, 58, '0', 'PRO58-C13-S4', 501000.00, 400000.00, 1, 'active', '2025-11-21 16:23:43', '2025-11-21 16:52:33'),
(140, 58, '0', 'PRO58-C13-S6', 501000.00, 400000.00, 0, 'active', '2025-11-21 16:23:43', '2025-11-21 16:23:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variant_images`
--

CREATE TABLE `product_variant_images` (
  `id` bigint(20) NOT NULL COMMENT 'ID ảnh',
  `product_id` bigint(20) NOT NULL,
  `color_id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL COMMENT 'URL ảnh',
  `is_primary` tinyint(1) DEFAULT 0 COMMENT 'Là ảnh chính hay không',
  `path` varchar(250) NOT NULL COMMENT 'đường dẫn ảnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variant_images`
--

INSERT INTO `product_variant_images` (`id`, `product_id`, `color_id`, `image_url`, `is_primary`, `path`) VALUES
(73, 39, 1, '1754561783_68947cf79d225.webp', 1, './Public/Img/uploads/'),
(74, 39, 1, '1754561783_68947cf79d435.webp', 2, './Public/Img/uploads/'),
(75, 39, 1, '1754561783_68947cf79d60b.webp', 2, './Public/Img/uploads/'),
(76, 39, 1, '1754561783_68947cf79d77c.webp', 2, './Public/Img/uploads/'),
(77, 39, 1, '1754561783_68947cf79d901.webp', 2, './Public/Img/uploads/'),
(78, 39, 1, '1754561783_68947cf79dad5.webp', 2, './Public/Img/uploads/'),
(79, 39, 2, '1754561783_68947cf79dc3a.webp', 1, './Public/Img/uploads/'),
(80, 39, 2, '1754561783_68947cf79dd7d.webp', 2, './Public/Img/uploads/'),
(81, 39, 2, '1754561783_68947cf79deca.webp', 2, './Public/Img/uploads/'),
(82, 39, 2, '1754561783_68947cf79e0b5.webp', 2, './Public/Img/uploads/'),
(83, 39, 2, '1754561783_68947cf79e2f0.webp', 2, './Public/Img/uploads/'),
(84, 39, 2, '1754561783_68947cf79e4cf.webp', 2, './Public/Img/uploads/'),
(89, 45, 2, '1755339889_68a05c71b92ed.webp', 1, './Public/Img/uploads/'),
(90, 45, 2, '1755339889_68a05c71b94ba.webp', 2, './Public/Img/uploads/'),
(91, 45, 2, '1755339889_68a05c71b9659.webp', 2, './Public/Img/uploads/'),
(92, 45, 2, '1755339889_68a05c71b9781.webp', 2, './Public/Img/uploads/'),
(93, 45, 2, '1755339889_68a05c71b9895.webp', 2, './Public/Img/uploads/'),
(94, 45, 3, '1755339889_68a05c71b9986.webp', 1, './Public/Img/uploads/'),
(95, 45, 3, '1755339889_68a05c71b9aa8.webp', 2, './Public/Img/uploads/'),
(96, 45, 3, '1755339889_68a05c71b9bb5.webp', 2, './Public/Img/uploads/'),
(97, 45, 3, '1755339889_68a05c71b9ceb.webp', 2, './Public/Img/uploads/'),
(98, 45, 3, '1755339889_68a05c71b9e8a.webp', 2, './Public/Img/uploads/'),
(99, 45, 3, '1755339889_68a05c71ba0cc.webp', 2, './Public/Img/uploads/'),
(100, 46, 13, '1755340178_68a05d926d539.webp', 1, './Public/Img/uploads/'),
(101, 46, 13, '1755340178_68a05d926d84b.webp', 2, './Public/Img/uploads/'),
(102, 46, 13, '1755340178_68a05d926da2c.webp', 2, './Public/Img/uploads/'),
(103, 46, 13, '1755340178_68a05d926dc39.webp', 2, './Public/Img/uploads/'),
(104, 46, 13, '1755340178_68a05d926dd7e.webp', 2, './Public/Img/uploads/'),
(105, 46, 13, '1755340178_68a05d926e106.webp', 2, './Public/Img/uploads/'),
(106, 46, 13, '1755340178_68a05d926e260.webp', 2, './Public/Img/uploads/'),
(107, 47, 2, '1755340528_68a05ef094fff.webp', 1, './Public/Img/uploads/'),
(108, 47, 2, '1755340528_68a05ef095268.webp', 2, './Public/Img/uploads/'),
(109, 47, 2, '1755340528_68a05ef0953fa.webp', 2, './Public/Img/uploads/'),
(110, 47, 2, '1755340528_68a05ef09552f.webp', 2, './Public/Img/uploads/'),
(111, 47, 2, '1755340528_68a05ef095664.webp', 2, './Public/Img/uploads/'),
(112, 47, 2, '1755340528_68a05ef095775.webp', 2, './Public/Img/uploads/'),
(113, 47, 2, '1755340528_68a05ef095891.webp', 2, './Public/Img/uploads/'),
(114, 47, 2, '1755340528_68a05ef0959ca.webp', 2, './Public/Img/uploads/'),
(115, 47, 3, '1755340528_68a05ef095ae3.webp', 1, './Public/Img/uploads/'),
(116, 47, 3, '1755340528_68a05ef095c08.webp', 2, './Public/Img/uploads/'),
(117, 47, 3, '1755340528_68a05ef095da6.webp', 2, './Public/Img/uploads/'),
(118, 47, 3, '1755340528_68a05ef095f05.webp', 2, './Public/Img/uploads/'),
(119, 47, 3, '1755340528_68a05ef096285.webp', 2, './Public/Img/uploads/'),
(120, 47, 3, '1755340528_68a05ef096412.webp', 2, './Public/Img/uploads/'),
(121, 47, 3, '1755340528_68a05ef09655b.webp', 2, './Public/Img/uploads/'),
(122, 48, 3, '1755340992_68a060c0b4f49.webp', 1, './Public/Img/uploads/'),
(123, 48, 3, '1755340992_68a060c0b50bd.webp', 2, './Public/Img/uploads/'),
(124, 48, 3, '1755340992_68a060c0b51b6.webp', 2, './Public/Img/uploads/'),
(125, 48, 3, '1755340992_68a060c0b529f.webp', 2, './Public/Img/uploads/'),
(126, 48, 3, '1755340992_68a060c0b538e.webp', 2, './Public/Img/uploads/'),
(127, 48, 3, '1755340992_68a060c0b5555.webp', 2, './Public/Img/uploads/'),
(128, 48, 3, '1755340992_68a060c0b56df.webp', 2, './Public/Img/uploads/'),
(129, 48, 10, '1755340992_68a060c0b584e.webp', 1, './Public/Img/uploads/'),
(130, 48, 10, '1755340992_68a060c0b59b1.webp', 2, './Public/Img/uploads/'),
(131, 48, 10, '1755340992_68a060c0b5aa0.webp', 2, './Public/Img/uploads/'),
(132, 48, 10, '1755340992_68a060c0b5b8f.webp', 2, './Public/Img/uploads/'),
(133, 48, 10, '1755340992_68a060c0b5c78.webp', 2, './Public/Img/uploads/'),
(134, 48, 10, '1755340992_68a060c0b5d6a.webp', 2, './Public/Img/uploads/'),
(135, 48, 10, '1755340992_68a060c0b5e5d.webp', 2, './Public/Img/uploads/'),
(136, 48, 12, '1755340992_68a060c0b5f58.webp', 1, './Public/Img/uploads/'),
(137, 48, 12, '1755340992_68a060c0b6085.webp', 2, './Public/Img/uploads/'),
(138, 48, 12, '1755340992_68a060c0b61f8.webp', 2, './Public/Img/uploads/'),
(139, 48, 12, '1755340992_68a060c0b63a4.webp', 2, './Public/Img/uploads/'),
(140, 48, 12, '1755340992_68a060c0b64d5.webp', 2, './Public/Img/uploads/'),
(141, 49, 11, '1755341340_68a0621c2a235.webp', 1, './Public/Img/uploads/'),
(142, 49, 11, '1755341340_68a0621c2a64e.webp', 2, './Public/Img/uploads/'),
(143, 49, 11, '1755341340_68a0621c2a89c.webp', 2, './Public/Img/uploads/'),
(144, 49, 11, '1755341340_68a0621c2a9e5.webp', 2, './Public/Img/uploads/'),
(145, 49, 11, '1755341340_68a0621c2ab04.webp', 2, './Public/Img/uploads/'),
(146, 49, 11, '1755341340_68a0621c2ac66.webp', 2, './Public/Img/uploads/'),
(147, 49, 11, '1755341340_68a0621c2adc2.webp', 2, './Public/Img/uploads/'),
(148, 50, 1, '1755341541_68a062e5567c4.webp', 1, './Public/Img/uploads/'),
(149, 50, 1, '1755341541_68a062e556fcc.webp', 2, './Public/Img/uploads/'),
(150, 50, 1, '1755341541_68a062e557191.webp', 2, './Public/Img/uploads/'),
(151, 50, 1, '1755341541_68a062e55738b.webp', 2, './Public/Img/uploads/'),
(152, 50, 1, '1755341541_68a062e55771f.webp', 2, './Public/Img/uploads/'),
(153, 50, 1, '1755341541_68a062e557851.webp', 2, './Public/Img/uploads/'),
(154, 50, 1, '1755341541_68a062e557abd.webp', 2, './Public/Img/uploads/'),
(155, 50, 2, '1755341541_68a062e557d9a.webp', 1, './Public/Img/uploads/'),
(156, 50, 2, '1755341541_68a062e557ee7.webp', 2, './Public/Img/uploads/'),
(157, 50, 2, '1755341541_68a062e558079.webp', 2, './Public/Img/uploads/'),
(158, 50, 2, '1755341541_68a062e5582a0.webp', 2, './Public/Img/uploads/'),
(159, 50, 2, '1755341541_68a062e5583d0.webp', 2, './Public/Img/uploads/'),
(160, 50, 2, '1755341541_68a062e55858f.webp', 2, './Public/Img/uploads/'),
(161, 50, 2, '1755341541_68a062e55869a.webp', 2, './Public/Img/uploads/'),
(162, 51, 3, '1755341948_68a0647cb5292.webp', 1, './Public/Img/uploads/'),
(163, 51, 3, '1755341948_68a0647cb5444.webp', 2, './Public/Img/uploads/'),
(164, 51, 3, '1755341948_68a0647cb558f.webp', 2, './Public/Img/uploads/'),
(165, 51, 3, '1755341948_68a0647cb5788.webp', 2, './Public/Img/uploads/'),
(166, 51, 3, '1755341948_68a0647cb58b7.webp', 2, './Public/Img/uploads/'),
(167, 51, 3, '1755341948_68a0647cb5a09.webp', 2, './Public/Img/uploads/'),
(168, 51, 11, '1755341948_68a0647cb5b20.webp', 1, './Public/Img/uploads/'),
(169, 51, 11, '1755341948_68a0647cb5ce2.webp', 2, './Public/Img/uploads/'),
(170, 51, 11, '1755341948_68a0647cb5dec.webp', 2, './Public/Img/uploads/'),
(171, 51, 11, '1755341948_68a0647cb5f72.webp', 2, './Public/Img/uploads/'),
(172, 51, 11, '1755341948_68a0647cb60dd.webp', 2, './Public/Img/uploads/'),
(173, 51, 11, '1755341948_68a0647cb6268.webp', 2, './Public/Img/uploads/'),
(174, 51, 11, '1755341948_68a0647cb66f9.webp', 2, './Public/Img/uploads/'),
(175, 52, 2, '1755342275_68a065c3d542a.webp', 1, './Public/Img/uploads/'),
(176, 52, 2, '1755342275_68a065c3d5649.webp', 2, './Public/Img/uploads/'),
(177, 52, 2, '1755342275_68a065c3d574a.webp', 2, './Public/Img/uploads/'),
(178, 52, 2, '1755342275_68a065c3d5987.webp', 2, './Public/Img/uploads/'),
(179, 52, 2, '1755342275_68a065c3d5a65.webp', 2, './Public/Img/uploads/'),
(180, 52, 3, '1755342275_68a065c3d5b41.webp', 1, './Public/Img/uploads/'),
(181, 52, 3, '1755342275_68a065c3d5c13.webp', 2, './Public/Img/uploads/'),
(182, 52, 3, '1755342275_68a065c3d5cde.webp', 2, './Public/Img/uploads/'),
(183, 52, 3, '1755342275_68a065c3d5db7.webp', 2, './Public/Img/uploads/'),
(184, 52, 3, '1755342275_68a065c3d5e8e.webp', 2, './Public/Img/uploads/'),
(185, 52, 3, '1755342275_68a065c3d5f5c.webp', 2, './Public/Img/uploads/'),
(186, 52, 13, '1755342275_68a065c3d6034.webp', 1, './Public/Img/uploads/'),
(187, 52, 13, '1755342275_68a065c3d6128.webp', 2, './Public/Img/uploads/'),
(188, 52, 13, '1755342275_68a065c3d6235.webp', 2, './Public/Img/uploads/'),
(189, 52, 13, '1755342275_68a065c3d630e.webp', 2, './Public/Img/uploads/'),
(190, 52, 13, '1755342275_68a065c3d6414.webp', 2, './Public/Img/uploads/'),
(191, 52, 13, '1755342275_68a065c3d651a.webp', 2, './Public/Img/uploads/'),
(192, 53, 13, '1755342483_68a06693138bf.webp', 1, './Public/Img/uploads/'),
(193, 53, 13, '1755342483_68a0669313aeb.webp', 2, './Public/Img/uploads/'),
(194, 53, 13, '1755342483_68a0669313cb1.webp', 2, './Public/Img/uploads/'),
(195, 53, 13, '1755342483_68a0669313ef0.webp', 2, './Public/Img/uploads/'),
(196, 53, 13, '1755342483_68a0669314121.webp', 2, './Public/Img/uploads/'),
(197, 53, 13, '1755342483_68a0669314397.webp', 2, './Public/Img/uploads/'),
(198, 53, 13, '1755342483_68a066931459b.webp', 2, './Public/Img/uploads/'),
(199, 54, 13, '1755342570_68a066ea2e53b.webp', 1, './Public/Img/uploads/'),
(200, 54, 13, '1755342570_68a066ea2e782.webp', 2, './Public/Img/uploads/'),
(201, 54, 13, '1755342570_68a066ea2e986.webp', 2, './Public/Img/uploads/'),
(202, 54, 13, '1755342570_68a066ea2eae3.webp', 2, './Public/Img/uploads/'),
(203, 54, 13, '1755342570_68a066ea2ece7.webp', 2, './Public/Img/uploads/'),
(204, 54, 13, '1755342570_68a066ea2ee40.webp', 2, './Public/Img/uploads/'),
(205, 54, 13, '1755342570_68a066ea2f13f.webp', 2, './Public/Img/uploads/'),
(206, 55, 12, '1755342756_68a067a4ea996.webp', 1, './Public/Img/uploads/'),
(207, 55, 12, '1755342756_68a067a4eae83.webp', 2, './Public/Img/uploads/'),
(208, 55, 12, '1755342756_68a067a4eb363.webp', 2, './Public/Img/uploads/'),
(209, 55, 12, '1755342756_68a067a4eb692.webp', 2, './Public/Img/uploads/'),
(210, 55, 12, '1755342756_68a067a4eb859.webp', 2, './Public/Img/uploads/'),
(211, 55, 12, '1755342756_68a067a4ebaa4.webp', 2, './Public/Img/uploads/'),
(212, 56, 1, '1755697669_68a5d205029d5.webp', 1, './Public/Img/uploads/'),
(213, 56, 1, '1755697669_68a5d205058e0.webp', 2, './Public/Img/uploads/'),
(214, 56, 1, '1755697669_68a5d20507d29.webp', 2, './Public/Img/uploads/'),
(215, 56, 1, '1755697669_68a5d2050ab6b.webp', 2, './Public/Img/uploads/'),
(216, 56, 1, '1755697669_68a5d20510dc7.webp', 2, './Public/Img/uploads/'),
(217, 56, 3, '1755697669_68a5d20512c2f.webp', 1, './Public/Img/uploads/'),
(218, 56, 3, '1755697669_68a5d20514a7e.webp', 2, './Public/Img/uploads/'),
(219, 56, 3, '1755697669_68a5d20516642.webp', 2, './Public/Img/uploads/'),
(220, 56, 3, '1755697669_68a5d2051857c.webp', 2, './Public/Img/uploads/'),
(221, 56, 3, '1755697669_68a5d2051a00b.webp', 2, './Public/Img/uploads/'),
(222, 57, 1, '1755702699_68a5e5ab10568.webp', 1, './Public/Img/uploads/'),
(223, 57, 1, '1755702699_68a5e5ab13b38.webp', 2, './Public/Img/uploads/'),
(224, 57, 1, '1755702699_68a5e5ab16bee.webp', 2, './Public/Img/uploads/'),
(225, 57, 1, '1755702699_68a5e5ab1a024.webp', 2, './Public/Img/uploads/'),
(226, 57, 1, '1755702699_68a5e5ab1ccf6.webp', 2, './Public/Img/uploads/'),
(227, 57, 10, '1755702699_68a5e5ab22262.webp', 1, './Public/Img/uploads/'),
(228, 57, 10, '1755702699_68a5e5ab27f85.webp', 2, './Public/Img/uploads/'),
(229, 57, 10, '1755702699_68a5e5ab2aeb2.webp', 2, './Public/Img/uploads/'),
(230, 57, 10, '1755702699_68a5e5ab34e2c.webp', 2, './Public/Img/uploads/'),
(232, 58, 10, '1763713408_692021808abde.jpg', 1, './Public/Img/uploads/'),
(233, 58, 2, '1763713408_692021808e7f1.jpg', 2, './Public/Img/uploads/'),
(234, 58, 10, '1763713408_69202180920de.jpg', 2, './Public/Img/uploads/'),
(235, 58, 2, '1763716594_69202df27d68e.jpg', 1, './Public/Img/uploads/'),
(237, 58, 3, '1763716751_69202e8f707f7.jpg', 1, './Public/Img/uploads/'),
(238, 58, 3, '1763716751_69202e8f71152.jpg', 2, './Public/Img/uploads/'),
(239, 58, 3, '1763716751_69202e8f718e3.jpg', 2, './Public/Img/uploads/'),
(240, 58, 3, '1763716751_69202e8f7698c.jpg', 2, './Public/Img/uploads/'),
(242, 58, 3, '1763716751_69202e8f7e75e.jpg', 2, './Public/Img/uploads/'),
(243, 58, 13, '1763717023_69202f9f44455.jpg', 1, './Public/Img/uploads/'),
(244, 58, 13, '1763717023_69202f9f4906e.jpg', 2, './Public/Img/uploads/');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) NOT NULL COMMENT 'ID hoàn tiền',
  `payment_id` bigint(20) NOT NULL COMMENT 'ID thanh toán liên quan',
  `reason` text DEFAULT NULL COMMENT 'Lý do hoàn tiền',
  `status` enum('requested','approved','rejected') DEFAULT 'requested' COMMENT 'Trạng thái hoàn tiền',
  `refunded_at` datetime DEFAULT NULL COMMENT 'Thời gian hoàn tiền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL COMMENT 'ID đánh giá',
  `product_id` bigint(20) NOT NULL COMMENT 'ID sản phẩm',
  `user_id` bigint(20) NOT NULL COMMENT 'ID người đánh giá',
  `rating` int(11) NOT NULL COMMENT 'Điểm đánh giá từ 1 đến 5',
  `comment` text DEFAULT NULL COMMENT 'Nội dung đánh giá',
  `status` enum('visible','hidden') DEFAULT 'visible' COMMENT 'Trạng thái hiển thị',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm đánh giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Tên vai trò'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(2, 'admins'),
(3, 'customers'),
(1, 'super admins');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL COMMENT 'ID người dùng',
  `role_id` int(11) NOT NULL COMMENT 'ID vai trò của người dùng',
  `name` varchar(100) DEFAULT NULL COMMENT 'Tên người dùng',
  `email` varchar(100) NOT NULL COMMENT 'Email đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu đã mã hóa',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn ảnh đại diện',
  `phone` varchar(20) DEFAULT NULL COMMENT 'Số điện thoại',
  `address` text DEFAULT NULL COMMENT 'Địa chỉ liên hệ',
  `status` enum('active','inactive','banned') DEFAULT 'active' COMMENT 'Trạng thái tài khoản',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Thời điểm tạo tài khoản',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời điểm cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `avatar`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(15, 2, 'Vũ Minh Phương', 'vumphuong2109@gmail.com', '$2y$10$dAIwDzi4i7u8whqR7XBUoeSFUeEGPMxI3DNwU.K07KmEU68fEyGOy', '', '0234567891', '117/15/1 Trần Cung', 'active', '2025-11-21 14:33:52', '2025-11-21 14:34:51'),
(16, 3, 'duc', 'ducvu159753@gmail.com', '$2y$10$whrvVjczh0I2CXrgifRNz.MHX0Q87on5np8s7pVSGdz8gLA2VbAaq', '', '0234567891', '117/15/1 Trần Cung', 'active', '2025-11-21 14:34:25', '2025-11-21 14:34:25'),
(17, 3, 'duc', 'd@gmail.com', '$2y$10$28I1Hw/pOhpQfpCQsPX10.gffSDKx97thSpMrR/EEr3pkAiKkFFgS', '', '0123456799', '117/15/1 Trần Cung', 'active', '2025-11-21 18:15:43', '2025-11-21 18:19:57'),
(18, 3, 'duc', 'ducvu159@gmail.com', '$2y$10$Tekcg3rmsQs7zcxH91Pe9e3nD9HDeIEuOTuUVkUcgd8y.exXcWHs2', '', '0234567891', '117/15/1 Trần Cung', 'active', '2025-11-21 20:22:25', '2025-11-21 20:22:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `variant_attribute_values`
--

CREATE TABLE `variant_attribute_values` (
  `id` int(11) NOT NULL COMMENT 'ID liên kết',
  `product_variant_id` bigint(20) NOT NULL COMMENT 'ID biến thể',
  `attribute_id` int(11) NOT NULL COMMENT 'ID thuộc tính',
  `attribute_value_id` int(11) NOT NULL COMMENT 'ID giá trị thuộc tính'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `variant_attribute_values`
--

INSERT INTO `variant_attribute_values` (`id`, `product_variant_id`, `attribute_id`, `attribute_value_id`) VALUES
(126, 49, 1, 1),
(127, 49, 2, 4),
(128, 49, 3, 8),
(129, 50, 1, 1),
(130, 50, 2, 5),
(131, 50, 3, 8),
(132, 51, 1, 1),
(133, 51, 2, 6),
(134, 51, 3, 8),
(135, 52, 1, 1),
(136, 52, 2, 7),
(137, 52, 3, 8),
(138, 53, 1, 2),
(139, 53, 2, 4),
(140, 53, 3, 8),
(141, 54, 1, 2),
(142, 54, 2, 5),
(143, 54, 3, 8),
(144, 55, 1, 2),
(145, 55, 2, 6),
(146, 55, 3, 8),
(147, 56, 1, 2),
(148, 56, 2, 7),
(149, 56, 3, 8),
(165, 62, 1, 2),
(166, 62, 2, 4),
(167, 62, 3, 8),
(168, 63, 1, 2),
(169, 63, 2, 5),
(170, 63, 3, 8),
(171, 64, 1, 2),
(172, 64, 2, 6),
(173, 64, 3, 8),
(174, 65, 1, 2),
(175, 65, 2, 7),
(176, 65, 3, 8),
(177, 66, 1, 3),
(178, 66, 2, 4),
(179, 66, 3, 8),
(180, 67, 1, 3),
(181, 67, 2, 5),
(182, 67, 3, 8),
(183, 68, 1, 3),
(184, 68, 2, 6),
(185, 68, 3, 8),
(186, 69, 1, 3),
(187, 69, 2, 7),
(188, 69, 3, 8),
(189, 70, 1, 13),
(190, 70, 2, 4),
(191, 70, 3, 8),
(192, 71, 1, 13),
(193, 71, 2, 5),
(194, 71, 3, 8),
(195, 72, 1, 13),
(196, 72, 2, 6),
(197, 72, 3, 8),
(198, 73, 1, 13),
(199, 73, 2, 7),
(200, 73, 3, 8),
(201, 74, 1, 2),
(202, 74, 2, 4),
(203, 74, 3, 8),
(204, 75, 1, 2),
(205, 75, 2, 5),
(206, 75, 3, 8),
(207, 76, 1, 2),
(208, 76, 2, 6),
(209, 76, 3, 8),
(210, 77, 1, 2),
(211, 77, 2, 7),
(212, 77, 3, 8),
(213, 78, 1, 3),
(214, 78, 2, 4),
(215, 78, 3, 8),
(216, 79, 1, 3),
(217, 79, 2, 5),
(218, 79, 3, 8),
(219, 80, 1, 3),
(220, 80, 2, 6),
(221, 80, 3, 8),
(222, 81, 1, 3),
(223, 81, 2, 7),
(224, 81, 3, 8),
(225, 82, 1, 3),
(226, 82, 2, 4),
(227, 82, 3, 8),
(228, 83, 1, 3),
(229, 83, 2, 5),
(230, 83, 3, 8),
(231, 84, 1, 3),
(232, 84, 2, 6),
(233, 84, 3, 8),
(234, 85, 1, 10),
(235, 85, 2, 4),
(236, 85, 3, 8),
(237, 86, 1, 10),
(238, 86, 2, 5),
(239, 86, 3, 8),
(240, 87, 1, 10),
(241, 87, 2, 6),
(242, 87, 3, 8),
(243, 88, 1, 12),
(244, 88, 2, 4),
(245, 88, 3, 8),
(246, 89, 1, 12),
(247, 89, 2, 5),
(248, 89, 3, 8),
(249, 90, 1, 12),
(250, 90, 2, 6),
(251, 90, 3, 8),
(252, 91, 1, 11),
(253, 91, 2, 4),
(254, 91, 3, 8),
(255, 92, 1, 11),
(256, 92, 2, 5),
(257, 92, 3, 8),
(258, 93, 1, 11),
(259, 93, 2, 6),
(260, 93, 3, 8),
(261, 94, 1, 1),
(262, 94, 2, 4),
(263, 94, 3, 8),
(264, 95, 1, 1),
(265, 95, 2, 5),
(266, 95, 3, 8),
(267, 96, 1, 2),
(268, 96, 2, 4),
(269, 96, 3, 8),
(270, 97, 1, 2),
(271, 97, 2, 5),
(272, 97, 3, 8),
(273, 98, 1, 3),
(274, 98, 2, 4),
(275, 98, 3, 8),
(276, 99, 1, 3),
(277, 99, 2, 5),
(278, 99, 3, 8),
(279, 100, 1, 3),
(280, 100, 2, 6),
(281, 100, 3, 8),
(282, 101, 1, 11),
(283, 101, 2, 4),
(284, 101, 3, 8),
(285, 102, 1, 11),
(286, 102, 2, 5),
(287, 102, 3, 8),
(288, 103, 1, 11),
(289, 103, 2, 6),
(290, 103, 3, 8),
(291, 104, 1, 2),
(292, 104, 2, 4),
(293, 104, 3, 8),
(294, 105, 1, 2),
(295, 105, 2, 5),
(296, 105, 3, 8),
(297, 106, 1, 2),
(298, 106, 2, 6),
(299, 106, 3, 8),
(300, 107, 1, 3),
(301, 107, 2, 4),
(302, 107, 3, 8),
(303, 108, 1, 3),
(304, 108, 2, 5),
(305, 108, 3, 8),
(306, 109, 1, 3),
(307, 109, 2, 6),
(308, 109, 3, 8),
(309, 110, 1, 13),
(310, 110, 2, 4),
(311, 110, 3, 8),
(312, 111, 1, 13),
(313, 111, 2, 5),
(314, 111, 3, 8),
(315, 112, 1, 13),
(316, 112, 2, 6),
(317, 112, 3, 8),
(318, 113, 1, 13),
(319, 113, 2, 4),
(320, 113, 3, 8),
(321, 114, 1, 13),
(322, 114, 2, 5),
(323, 114, 3, 8),
(324, 115, 1, 13),
(325, 115, 2, 6),
(326, 115, 3, 8),
(327, 116, 1, 13),
(328, 116, 2, 4),
(329, 116, 3, 8),
(330, 117, 1, 13),
(331, 117, 2, 5),
(332, 117, 3, 8),
(333, 118, 1, 13),
(334, 118, 2, 6),
(335, 118, 3, 8),
(336, 119, 1, 12),
(337, 119, 2, 4),
(338, 119, 3, 9),
(339, 120, 1, 12),
(340, 120, 2, 5),
(341, 120, 3, 9),
(342, 121, 1, 1),
(343, 121, 2, 4),
(344, 121, 3, 8),
(345, 122, 1, 1),
(346, 122, 2, 5),
(347, 122, 3, 8),
(348, 123, 1, 1),
(349, 123, 2, 6),
(350, 123, 3, 8),
(351, 124, 1, 3),
(352, 124, 2, 4),
(353, 124, 3, 8),
(354, 125, 1, 3),
(355, 125, 2, 5),
(356, 125, 3, 8),
(357, 126, 1, 3),
(358, 126, 2, 6),
(359, 126, 3, 8),
(360, 127, 1, 1),
(361, 127, 2, 5),
(362, 127, 3, 8),
(363, 128, 1, 10),
(364, 128, 2, 4),
(365, 128, 3, 8),
(366, 129, 1, 10),
(367, 129, 2, 5),
(368, 129, 3, 8),
(369, 130, 1, 2),
(370, 130, 2, 4),
(371, 130, 3, 8),
(372, 131, 1, 2),
(373, 131, 2, 5),
(374, 131, 3, 8),
(375, 132, 1, 2),
(376, 132, 2, 6),
(377, 132, 3, 8),
(378, 133, 1, 10),
(379, 133, 2, 4),
(380, 133, 3, 8),
(381, 134, 1, 10),
(382, 134, 2, 5),
(383, 134, 3, 8),
(384, 135, 1, 10),
(385, 135, 2, 6),
(386, 135, 3, 8),
(387, 136, 1, 3),
(388, 136, 2, 4),
(389, 136, 3, 8),
(390, 137, 1, 3),
(391, 137, 2, 5),
(392, 137, 3, 8),
(393, 138, 1, 13),
(394, 138, 2, 5),
(395, 138, 3, 8),
(396, 139, 1, 13),
(397, 139, 2, 4),
(398, 139, 3, 8),
(399, 140, 1, 13),
(400, 140, 2, 6),
(401, 140, 3, 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`,`product_variant_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_variant_images`
--
ALTER TABLE `product_variant_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pvi_pi_fk` (`product_id`),
  ADD KEY `pvi_ci_fk` (`color_id`);

--
-- Chỉ mục cho bảng `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `variant_attribute_values`
--
ALTER TABLE `variant_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variant_id` (`product_variant_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `attribute_value_id` (`attribute_value_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID log';

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID thuộc tính', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID giá trị thuộc tính', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID banner', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID bài viết';

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID giỏ hàng', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID chi tiết giỏ hàng', AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID danh mục', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID mã giảm giá', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID thông báo', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID đơn hàng', AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID chi tiết đơn hàng', AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID thanh toán', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID sản phẩm', AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID biến thể', AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT cho bảng `product_variant_images`
--
ALTER TABLE `product_variant_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID ảnh', AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT cho bảng `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID hoàn tiền';

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID đánh giá', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID người dùng', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `variant_attribute_values`
--
ALTER TABLE `variant_attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID liên kết', AUTO_INCREMENT=408;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variant_images`
--
ALTER TABLE `product_variant_images`
  ADD CONSTRAINT `pvi_ci_fk` FOREIGN KEY (`color_id`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `pvi_pi_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `variant_attribute_values`
--
ALTER TABLE `variant_attribute_values`
  ADD CONSTRAINT `variant_attribute_values_ibfk_1` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variant_attribute_values_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variant_attribute_values_ibfk_3` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
