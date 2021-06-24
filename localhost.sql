-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 11:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doan`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `userID` int(10) UNSIGNED NOT NULL,
  `IDproduct` int(10) UNSIGNED NOT NULL,
  `cmt` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `parent_id`, `userID`, `IDproduct`, `cmt`, `date`) VALUES
(65, 0, 9, 1, 'xịn quá shop', '2021-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop'),
(3, 'Smart watch'),
(4, 'Sạc dự phòng'),
(5, 'Tabblet'),
(6, 'Tai nghe'),
(7, 'Headphone');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `receiptid` int(11) NOT NULL,
  `productid` int(10) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`receiptid`, `productid`, `quantity`, `date`, `userid`, `address`) VALUES
(2, 1, '1,1', '2020-11-01', 3, 'da nang'),
(4, 1, '1,1', '2020-11-01', 3, 'dan nang'),
(5, 1, '2,1,1', '2020-11-01', 3, 'da nang'),
(6, 1, '2,1,1', '2020-11-01', 3, 'viet nam'),
(7, 1, '2,2,1', '2020-11-01', 3, 'trai dat'),
(8, 2, '1', '2020-11-01', 3, 'da  nang'),
(9, 2, '1', '2020-11-01', 3, 'da nang'),
(10, 2, '1,1', '2020-11-01', 3, 'da nang'),
(11, 1, '1,1', '2020-11-01', 2, 'da nang'),
(12, 0, '', '2021-05-09', 9, 'sdfsdf'),
(13, 0, '', '2021-05-09', 9, 'sdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CategoryID` int(10) UNSIGNED NOT NULL,
  `price` int(64) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `descript` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `img` text COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `CategoryID`, `price`, `quantity`, `descript`, `img`) VALUES
(1, 'nokia 1280 vjp pro', 1, 900, 33, '<table>\r\n	<caption>Nokia 1280</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><a href=\"https://vi.wikipedia.org/wiki/T%E1%BA%ADp_tin:Nokia_1280_out_the_box.jpg\"><img alt=\"\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Nokia_1280_out_the_box.jpg/200px-Nokia_1280_out_the_box.jpg\" style=\"height:133px; width:200px\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\"><a href=\"https://vi.wikipedia.org/wiki/Danh_s%C3%A1ch_nh%C3%A0_s%E1%BA%A3n_xu%E1%BA%A5t_%C4%91i%E1%BB%87n_tho%E1%BA%A1i_di_%C4%91%E1%BB%99ng_theo_qu%E1%BB%91c_gia\">Nh&agrave; sản xuất</a></th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/Nokia\">Nokia</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Ph&aacute;t h&agrave;nh lần đầu</th>\r\n			<td>2010</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">C&oacute; mặt tại quốc gia</th>\r\n			<td>Ấn Độ, Nam Phi, Nga, Việt Nam v&agrave; hơn 106 quốc gia kh&aacute;c</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Dạng m&aacute;y</th>\r\n			<td>Thanh</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">K&iacute;ch thước</th>\r\n			<td>4.22 x 1.78 x 0.60 inch (107.2 x 45.1 x 15.3 mm)</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Khối lượng</th>\r\n			<td>82 gam</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\"><a href=\"https://vi.wikipedia.org/wiki/H%E1%BB%87_%C4%91i%E1%BB%81u_h%C3%A0nh\">Hệ điều h&agrave;nh</a></th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/Series_30\">Series 30</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\"><a href=\"https://vi.wikipedia.org/wiki/Pin_(%C4%91i%E1%BB%87n_h%E1%BB%8Dc)\">Pin</a></th>\r\n			<td>Pin&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Li-Ion\">Li-Ion</a>&nbsp;850<br />\r\n			mAh (BL-5CB)</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">M&agrave;n h&igrave;nh</th>\r\n			<td>Đơn sắc 96 x 68 pixels, 1.36 inch</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Chuẩn&nbsp;kết&nbsp;nối</th>\r\n			<td>Cổng kết nối 3.5 mm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', './image/nokia-1280.jpg'),
(2, 'Dell vostro 3590', 2, 15000, 23, '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>CPU:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-ve-vi-xu-ly-intel-core-the-he-10-1212148\" target=\"_blank\">Intel Core i5 Comet Lake</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cpu-intel-core-i5-10210u-tren-laptop-la-gi-1239745\" target=\"_blank\">10210U</a>, 1.60 GHz</p>\r\n	</li>\r\n	<li>RAM:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ram-lap-top-la-gi-dung-luong-bao-nhieu-la-du-1172167\" target=\"_blank\">4 GB</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ram-ddr4-la-gi-882173#ddr4\" target=\"_blank\">DDR4 (2 khe)</a>, 2666 MHz</p>\r\n	</li>\r\n	<li>Ổ cứng:\r\n	<p>HDD: 1 TB SATA3,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-ve-cac-chuan-toc-do-cua-o-cung-ssd-tren-1115453\" target=\"_blank\">Hỗ trợ khe cắm SSD M.2 PCIe</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh:\r\n	<p>15.6 inch,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-fhd-la-gi-956294\" target=\"_blank\">Full HD (1920 x 1080)</a></p>\r\n	</li>\r\n	<li>Card m&agrave;n h&igrave;nh:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/card-do-hoa-tich-hop-la-gi-950047\" target=\"_blank\">Card đồ họa t&iacute;ch hợp</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/card-man-hinh-intel-uhd-graphics-tren-laptop-la-gi-1199634\" target=\"_blank\">Intel UHD Graphics</a></p>\r\n	</li>\r\n	<li>Cổng kết nối:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-tieu-chuan-cong-usb-tren-laptop-va-cach-phan-biet-1180516#usb-31\" target=\"_blank\">2 x USB 3.1</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/hoi-dap-hdmi-la-gi-930605\" target=\"_blank\">HDMI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cho-minh-hoi-thong-so-laptop-co-nhung-cai-nay-10-743872\" target=\"_blank\">LAN (RJ45)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-tieu-chuan-cong-usb-tren-laptop-va-cach-phan-b-1180516#usb-20\" target=\"_blank\">USB 2.0</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/vga-la-gi-920575\" target=\"_blank\">VGA (D-Sub)</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-ve-windows-10-va-cac-phien-ban-cua-no-hie-1184370\" target=\"_blank\">Windows 10 Home SL</a></p>\r\n	</li>\r\n	<li>Thiết kế:\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chat-lieu-thuong-dung-tren-laptop-va-uu-nhuoc-diem-1192823\" target=\"_blank\">Vỏ nhựa</a>, PIN liền</p>\r\n	</li>\r\n	<li>K&iacute;ch thước:\r\n	<p>D&agrave;y 19.8 mm, 1.99 kg</p>\r\n	</li>\r\n	<li>Thời điểm ra mắt:\r\n	<p>2019</p>\r\n	</li>\r\n</ul>\r\n', './image/dell-vostro-3590-i5g10.jpg'),
(3, 'Panasonic kt ts500', 1, 285, 45, '<p>M&ocirc; tả sản phẩm</p>\r\n\r\n<h2>Điện thoại để b&agrave;n Panasonic KX-TS 500 -&nbsp;B&agrave;n ph&iacute;m to, thuận tiện cho&nbsp;mọi thao t&aacute;c v&agrave; sử dụng</h2>\r\n\r\n<p><em>Điện thoại b&agrave;n Panasonic KX- TS500</em>&nbsp;được thiết kế đơn giản, thanh tho&aacute;t nhưng rất sang trọng. Với nhiều m&agrave;u sắc kh&aacute;c nhau, thiết bị cho bạn c&oacute; thể lựa chọn m&agrave;u sắc ph&ugrave; hợp với căn ph&ograve;ng của m&igrave;nh.&nbsp;<strong>Panasonic KX- TS500</strong>&nbsp;th&iacute;ch hợp d&ugrave;ng trong gia đ&igrave;nh, c&ocirc;ng ty, văn ph&ograve;ng&hellip; H&atilde;y chọn ngay chiếc điện thoại để b&agrave;n n&agrave;y để t&ocirc; điểm th&ecirc;m sắc m&agrave;u cho ng&ocirc;i nh&agrave; của bạn.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Điện thoại để b&agrave;n Panasonic KX-TS 500 c&oacute; nhiều m&agrave;u sắc cho bạn lựa chọn</h3>\r\n\r\n<p>Kh&ocirc;ng cầu kỳ, trau chuốt &ndash;&nbsp;<em>điện thoại để b&agrave;n Panasonic KS-TS 500</em>&nbsp;đơn giản đến mức kh&ocirc;ng thể đơn giản hơn với cac chức năng chủ yếu :&nbsp;</p>\r\n\r\n<p><strong>C&oacute; 3 cấp điều chỉnh tăng, giảm chu&ocirc;ng v&agrave; &acirc;m lượng</strong>:&nbsp;<em>Panasonic KX- TS500</em>&nbsp;c&oacute; 3 cấp điều chỉnh chu&ocirc;ng v&agrave; &acirc;m lượng gi&uacute;p bạn thoải m&aacute;i lựa chọn mức độ &acirc;m thanh ph&ugrave; hợp cho vị tr&iacute; đặt điện thoại để c&oacute; thể nghe tiếng chu&ocirc;ng một c&aacute;ch r&otilde; r&agrave;ng nhất.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Panasonic KX- TS500 c&oacute; 3 nấc để chỉnh chu&ocirc;ng</h3>\r\n\r\n<p><strong>Gọi lại số gần nhất</strong>:&nbsp;Với chức năng gọi lại số gần nhất, chiếc điện thoại để b&agrave;n&nbsp;<em>Panasonic KX- TS500</em>&nbsp;gi&uacute;p người d&ugrave;ng c&oacute; thể gọi lại số vừa gọi một c&aacute;ch nhanh nhất, chỉ qua một ph&iacute;m bấm, kh&ocirc;ng cần phải nhấn lại cả một d&atilde;y số d&agrave;i, tr&aacute;nh việc gọi lộn số v&agrave; mất thời gian.</p>\r\n\r\n<p>Đặc biệt, thiết bị c&oacute; nhiều m&agrave;u sắc kh&aacute;c nhau: trắng, đen, xanh, đỏ v&agrave; x&aacute;m. Lựa chọn m&agrave;u sắc ph&ugrave; hợp cho chiếc điện thoại để b&agrave;n n&agrave;y sẽ l&agrave;m cho căn ph&ograve;ng của bạn trở n&ecirc;n nổi bật v&agrave; ấn tượng hơn.</p>\r\n', './image/panasonic-kx-ts500.jpg'),
(4, 'Samsung Gear S', 3, 7000, 32, '<table>\r\n	<caption>Samsung Gear S</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><a href=\"https://vi.wikipedia.org/wiki/T%E1%BA%ADp_tin:Samsung_Gear_S_app_for_BMW_i3.jpg\"><img alt=\"Samsung Gear S app for BMW i3.jpg\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Samsung_Gear_S_app_for_BMW_i3.jpg/300px-Samsung_Gear_S_app_for_BMW_i3.jpg\" style=\"height:291px; width:300px\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Nh&agrave; ph&aacute;t triển</th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/Samsung_Electronics\">Samsung Electronics</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">D&ograve;ng sản phẩm</th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/Samsung_Gear\">Gear</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Loại</th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/%C4%90%E1%BB%93ng_h%E1%BB%93_th%C3%B4ng_minh\">Đồng hồ th&ocirc;ng minh</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Ng&agrave;y ra mắt</th>\r\n			<td>7 th&aacute;ng 11 năm 2014</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\"><a href=\"https://vi.wikipedia.org/wiki/H%E1%BB%87_%C4%91i%E1%BB%81u_h%C3%A0nh\">Hệ điều h&agrave;nh</a></th>\r\n			<td><a href=\"https://vi.wikipedia.org/wiki/Tizen\">Tizen</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\"><a href=\"https://vi.wikipedia.org/wiki/CPU\">CPU</a></th>\r\n			<td>L&otilde;i k&eacute;p&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Snapdragon#Snapdragon_400\">Snapdragon 400</a><a href=\"https://vi.wikipedia.org/wiki/Samsung_Gear_S#cite_note-1\">[1]</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Bộ nhớ</th>\r\n			<td>512 MB</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Lưu trữ</th>\r\n			<td>4&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Gigabyte\">GB</a></td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Hiển thị</th>\r\n			<td>2&nbsp;in (51&nbsp;mm)&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Super_AMOLED\">Super AMOLED</a>&nbsp;cong với Ma trận RGB<br />\r\n			360&times;480&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Pixel\">pixel</a>&nbsp;(tỉ lệ 4:3)</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Đầu v&agrave;o</th>\r\n			<td>\r\n			<p>Danh s&aacute;ch<a href=\"https://vi.wikipedia.org/wiki/Samsung_Gear_S#\">[hiện]</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Kết nối</th>\r\n			<td>2G/3G<br />\r\n			Bluetooth 4.1<br />\r\n			Wi-Fi a/b/g/n<br />\r\n			GPS/GLONASS<br />\r\n			USB 2.0</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Năng lượng</th>\r\n			<td>300 mAh</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">K&iacute;ch thước</th>\r\n			<td>39.8 x 58.3 x 12.5mm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', './image/samsung-watch-gear-s.jpg'),
(5, 'Sạc dự phòng xiaomi', 4, 530, 56, '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.thegioididong.com/hoi-dap/hieu-suat-sac-cua-pin-sac-du-phong-co-y-nghia-gi-1198538\" target=\"_blank\">Hiệu suất sạc:</a>\r\n\r\n	<p><em>55%</em></p>\r\n	</li>\r\n	<li>Dung lượng pin:\r\n	<p><em>10.000 mAh</em></p>\r\n	</li>\r\n	<li>Thời gian sạc đầy pin:\r\n	<p><em>10 - 11 giờ (d&ugrave;ng Adapter 1A)</em><em>3 - 4 giờ (d&ugrave;ng 9V/2A or 12V/1.5A)</em><em>5 - 6 giờ (d&ugrave;ng Adapter 2A)</em></p>\r\n	</li>\r\n	<li>Nguồn v&agrave;o:\r\n	<p><em>Micro USB/ Type C: 5V - 2.6A, 9V - 2.1A, 12V - 1.5A (18W MAX)</em></p>\r\n	</li>\r\n	<li>Nguồn ra:\r\n	<p><em>USB: 5V - 2.6A, 9V - 2.1A, 12V - 1.5A</em><em>USB: 5V - 2.6A</em></p>\r\n	</li>\r\n	<li>L&otilde;i pin:\r\n	<p><em><a href=\"https://www.thegioididong.com/hoi-dap/so-sanh-pin-li-ion-va-pin-li-po-651833#lipo\" target=\"_blank\">Polymer</a></em></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ/Tiện &iacute;ch:\r\n	<p><em>Đ&egrave;n LED b&aacute;o hiệu</em><em><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-ve-sac-pin-nhanh-quick-charge-30-917509\" target=\"_blank\">Quick Charge 3.0</a></em></p>\r\n	</li>\r\n	<li>K&iacute;ch thước:\r\n	<p><em>D&agrave;i 14.8cm - Rộng 7.4cm - D&agrave;y 1.5cm</em></p>\r\n	</li>\r\n	<li>Trọng lượng:\r\n	<p><em>343g</em></p>\r\n	</li>\r\n	<li>Thương hiệu của:\r\n	<p><em>Trung Quốc</em></p>\r\n	</li>\r\n	<li>Sản xuất tại:\r\n	<p><em>Trung Quốc</em></p>\r\n	</li>\r\n</ul>\r\n', './image/sacduphongxiaomi.png'),
(7, 'Samsung Galaxy s20+', 1, 21000, 20, '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>M&agrave;n h&igrave;nh6.7&quot;, QHD+, Dynamic AMOLED 2X, 1440 x 3200 Pixel</li>\r\n	<li>Camera sau64.0 MP + 12.0 MP + 12.0 MP + 3D ToF</li>\r\n	<li>Camera Selfie10.0 MP</li>\r\n	<li>RAM&nbsp;8 GB</li>\r\n	<li>Bộ nhớ trong128 GB</li>\r\n	<li>CPUExynos 990</li>\r\n	<li>GPUMali-G77</li>\r\n	<li>Dung lượng pin4500 mAh</li>\r\n	<li>Thẻ sim2, 2 Nano SIM hoặc 1 eSIM, 1 Nano SIM</li>\r\n	<li>Hệ điều h&agrave;nhAndroid 10.0</li>\r\n	<li>Xuất xứViệt Nam</li>\r\n	<li>Năm sản xuất2020</li>\r\n</ul>\r\n', './image/galaxy-s20-plus.jpg'),
(8, 'Iphone 12', 1, 26000, 69, '', './image/ip12.jpg'),
(9, 'Samsung Galaxy note 10+', 1, 9000, 12, '', './image/note10p.jpg'),
(10, 'Tai nghe beats pro', 7, 6000, 12, '', './image/beastpro.jpg'),
(11, 'Ipad Air 4', 5, 21000, 25, '', './image/ipadair4.png'),
(12, 'Samsung Galaxy tab s6', 5, 9000, 36, '', './image/galaxy-tab-s6.png'),
(13, 'Plantronics Backbeat Fit 3200', 6, 2000, 32, '', './image/plantronic-bf-3200.jpg'),
(14, 'LG HBS 1120', 6, 3000, 31, '', './image/lg-hbs-1120.jpg'),
(15, 'Lenovo Tab e10', 5, 3000, 31, '', './image/lenovo-tab-e10.png'),
(16, 'Oppo A92', 1, 9000, 36, '', './image/oppo-a92.png'),
(17, 'HP Pavilion 15', 2, 13000, 25, '', './image/hp-pavilion-15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `permission` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `username`, `email`, `password`, `permission`) VALUES
(9, 'nhat', 'ndn0302@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDproduct` (`IDproduct`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`receiptid`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `receiptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`IDproduct`) REFERENCES `sanpham` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `taikhoan` (`id`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
