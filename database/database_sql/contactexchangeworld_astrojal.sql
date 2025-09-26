-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 11:58 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contactexchangeworld_astrojal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms_pages`
--

CREATE TABLE `tbl_cms_pages` (
  `id` int(11) NOT NULL,
  `v_name` text DEFAULT NULL,
  `v_slug` varchar(100) DEFAULT NULL,
  `t_page_content` text DEFAULT NULL,
  `e_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cms_pages`
--

INSERT INTO `tbl_cms_pages` (`id`, `v_name`, `v_slug`, `t_page_content`, `e_status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<p>About Us Content HTM1L11111</p>', 'Active', '2022-06-29 18:57:30', '2023-06-25 06:13:00'),
(2, 'Privacy Policy', NULL, '<p>Privacy Policy Content HTM1L1</p>', 'Active', '2022-06-29 18:57:30', '2022-06-29 09:27:08'),
(3, 'Terms Condition', NULL, '<p>Terms Condition Content HTM1L1</p>', 'Active', '2022-06-29 18:57:30', '2022-06-29 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cron_jobs`
--

CREATE TABLE `tbl_cron_jobs` (
  `id` int(11) NOT NULL,
  `v_name` varchar(200) NOT NULL,
  `e_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cron_jobs`
--

INSERT INTO `tbl_cron_jobs` (`id`, `v_name`, `e_status`, `updated_at`) VALUES
(1, 'EventUserEmailDataRead', 'Active', '2023-07-10 10:49:01'),
(2, 'EventUserEmailDataDelete', 'Active', '2023-07-10 10:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cron_job_logs`
--

CREATE TABLE `tbl_cron_job_logs` (
  `id` int(11) NOT NULL,
  `i_cron_job_id` int(11) DEFAULT NULL,
  `v_cron_name` varchar(200) DEFAULT NULL,
  `t_cron_description` text DEFAULT NULL,
  `t_output_description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cron_job_logs`
--

INSERT INTO `tbl_cron_job_logs` (`id`, `i_cron_job_id`, `v_cron_name`, `t_cron_description`, `t_output_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Successfully<b><br>', '2023-07-10 07:05:28', '2023-07-10 07:05:28'),
(2, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 07:06:23', '2023-07-10 07:06:23'),
(3, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Find Total UnSeen Email: 2<b><br>', '2023-07-10 07:10:31', '2023-07-10 07:10:31'),
(4, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 07:12:45', '2023-07-10 07:12:45'),
(5, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>User Event Participant Table Added Record Total : 1<b><br>', '2023-07-10 07:14:40', '2023-07-10 07:14:40'),
(6, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>User Event Participant Table Added Record Total : 1<b><br>', '2023-07-10 07:19:03', '2023-07-10 07:19:03'),
(7, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Cron Start<b><br>', '2023-07-10 09:32:50', '2023-07-10 09:32:50'),
(8, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>User Event Participant Table Added Record Total : 1<b><br>', '2023-07-10 09:33:40', '2023-07-10 09:33:40'),
(9, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 09:33:51', '2023-07-10 09:33:51'),
(10, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 09:34:22', '2023-07-10 09:34:22'),
(11, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 09:34:45', '2023-07-10 09:34:45'),
(12, 1, 'Cron for event user email data read', 'Cron run successfully for event user email data read at every 1 minute', '<b>IMAP Connection Not Found UnSeen Email<b><br>', '2023-07-10 09:34:58', '2023-07-10 09:34:58'),
(13, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 1<b><br>', '2023-07-10 19:07:14', '2023-07-10 19:07:14'),
(14, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 0<b><br>', '2023-07-10 19:07:16', '2023-07-10 19:07:16'),
(15, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 0<b><br>', '2023-07-10 19:07:17', '2023-07-10 19:07:17'),
(16, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 0<b><br>', '2023-07-10 19:07:17', '2023-07-10 19:07:17'),
(17, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 0<b><br>', '2023-07-10 19:07:18', '2023-07-10 19:07:18'),
(18, 2, 'Cron for event user email data delete', 'Cron run successfully for event user email data delete at every 1 minute', '<b>Total User Event Found : 0<b><br>', '2023-07-10 19:10:05', '2023-07-10 19:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_templates`
--

CREATE TABLE `tbl_email_templates` (
  `id` int(11) NOT NULL,
  `v_template_name` varchar(100) NOT NULL,
  `v_subject` varchar(100) NOT NULL,
  `v_from_email_id` varchar(100) NOT NULL,
  `v_template_body` mediumtext NOT NULL,
  `e_status` enum('Active','Inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_email_templates`
--

INSERT INTO `tbl_email_templates` (`id`, `v_template_name`, `v_subject`, `v_from_email_id`, `v_template_body`, `e_status`, `created_at`, `updated_at`) VALUES
(1, 'Forgot Password - SuperAdmin', 'Forgot Password', 'ecw@gmail.com', '<table style=\"width: 90%;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"[IMG_LOGO_PATH]\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n<td>\r\n<h3>[SITE_NAME] - Forgot Password</h3>\r\n[DATE]</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">[NAME_PREFIX] [NAME],</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">A password reset request has been submitted for your profile. Please click on the link below in order to reset your password. If you haven&rsquo;t requested this then please ignore this email.</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><strong>Link:</strong><a href=\"[LINK]\"> [LINK]</a></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">Note: Link will get expired within 24 hours.</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><a href=\"[MAIL_FOOTER_LINK]\"><strong>[MAIL_FOOTER_LINK_LABEL]</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td><br />Kind regards,<br />Team [SITE_NAME]<br />[APP_FRONT_END_LINK]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Active', '2023-06-25 11:39:46', '2023-06-25 11:39:46'),
(2, 'Thanks For Participant In Event', 'Thanks For Participant In Event', 'ecw@gmail.com', '<table style=\"width: 90%;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"[IMG_LOGO_PATH]\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n<td>\r\n<h3>[SITE_NAME] - Event Participat</h3>\r\n[DATE]</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">[NAME_PREFIX] [NAME],</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">Dear We do not know your name! <br><br> You have participated in a contact information exchange process. Some folks have trusted you and you have trusted them and based on your trust in us we are sharing the list in the vcf file. <br><br> Save the contacts and delete the email. We have already done it at our servers and your information has ceased to exist in contactexchange.world. <br><br> If you are impressed with our honesty and simplicity of our service, please use our service when you meet a new bunch of people, to play a game or when you are leading a seminar.<br><br>Thanks for using our services. You will only hear from us if you have organized this contact information exchange.</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><a href=\"[MAIL_FOOTER_LINK]\"><strong>[MAIL_FOOTER_LINK_LABEL]</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td><br />Kind regards,<br />Team [SITE_NAME]<br />[APP_FRONT_END_LINK]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Active', '2023-06-25 11:39:46', '2023-06-25 11:39:46'),
(3, 'Your Event Participant', 'Your Event Participant', 'ecw@gmail.com', '<table style=\"width: 90%;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"[IMG_LOGO_PATH]\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n<td>\r\n<h3>[SITE_NAME] - Your Event Participat</h3>\r\n[DATE]</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">[NAME_PREFIX] [NAME],</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">You successfully completed the event [EVENT_EMAIL]. You should take pride in connecting [TOTAL_PARTICIPANTS] human beings. Interesting possibilities there! They will remember you and your event. Just so you know, every-time any of these participants search for you or your event in their contact book, they will see all the humans that you helped connect! So again take pride.<br> Also attaching all the Vcards and CSV file containing participant details. <br> Note that we have removed all contact information from our database / server. Also removed the temporary email address. Any email sent there will bounce.<br>Happy Connecting!<br>ContactExchange.World</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><a href=\"[MAIL_FOOTER_LINK]\"><strong>[MAIL_FOOTER_LINK_LABEL]</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td><br />Kind regards,<br />Team [SITE_NAME]<br />[APP_FRONT_END_LINK]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\"><hr /></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Active', '2023-06-25 11:39:46', '2023-06-25 11:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `v_key` varchar(255) DEFAULT NULL,
  `t_value` text DEFAULT NULL,
  `v_label` varchar(255) DEFAULT NULL,
  `e_type` enum('General','Social Login','Event','Event User','Event Participant','Email','IMAP','None') NOT NULL DEFAULT 'General',
  `e_tab` enum('None','Email General','SMTP Driver') NOT NULL DEFAULT 'None',
  `e_is_required` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `j_validation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `e_form_element_type` enum('TextBox','Number','SelectBox','Radio','CheckBox','TextArea','TextAreaEditor','Date','None') NOT NULL DEFAULT 'None',
  `j_form_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `j_hide_setting_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `i_group_order` int(11) DEFAULT NULL,
  `i_tab_group_order` smallint(6) DEFAULT 0,
  `e_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `v_key`, `t_value`, `v_label`, `e_type`, `e_tab`, `e_is_required`, `j_validation`, `e_form_element_type`, `j_form_values`, `j_hide_setting_values`, `i_group_order`, `i_tab_group_order`, `e_status`, `created_at`, `updated_at`) VALUES
(1, 'event_initial_timer_in_seconds', '60', 'Event Initial Timer In Seconds', 'Event', 'None', 'Yes', NULL, 'Number', NULL, NULL, 1, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(2, 'event_max_number_of_participant', '50', 'Event Max Number Of Participant', 'Event', 'None', 'Yes', NULL, 'Number', NULL, NULL, 2, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(3, 'event_email_domain_name', 'justexhangecontacts.world', 'Event Email Domain Name', 'Event', 'None', 'Yes', NULL, 'TextBox', NULL, NULL, 3, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(4, 'event_mobile_number', '98989898989', 'Event Mobile Number', 'Event', 'None', 'Yes', NULL, 'TextBox', NULL, NULL, 4, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(5, 'event_addon_timer_in_seconds', '120', 'Event Addon Timer In Seconds', 'Event', 'None', 'Yes', NULL, 'Number', NULL, NULL, 5, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(6, 'social_media_login_google_mode', 'On', 'Social Media Login Google Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 1, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(7, 'social_media_login_facebook_mode', 'On', 'Social Media Login Facebook Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 2, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(8, 'social_media_login_twitter_mode', 'On', 'Social Media Login Twitter Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 3, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(9, 'social_media_login_instagram_mode', 'On', 'Social Media Login Instagram Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 4, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(10, 'social_media_login_linkedin_mode', 'On', 'Social Media Login Linkedin Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 5, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(11, 'social_media_login_apple_mode', 'Off', 'Social Media Login Apple Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 6, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(12, 'imap_username', 'harshit.kakadiya1996@gmail.com', 'Imap User Name', 'IMAP', 'None', 'Yes', NULL, 'TextBox', '', NULL, 3, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(13, 'imap_password', 'tuedkwrgjovxolpv', 'Imap User Password', 'IMAP', 'None', 'Yes', NULL, 'TextBox', '', NULL, 4, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(14, 'imap_hostname', 'imap.gmail.com', 'Imap Host Name', 'IMAP', 'None', 'Yes', NULL, 'TextBox', '', NULL, 1, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(15, 'imap_port_number', '993', 'Imap Port Number', 'IMAP', 'None', 'Yes', NULL, 'TextBox', '', NULL, 2, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52'),
(16, 'social_media_login_github_mode', 'On', 'Social Media Login Github Mode', 'Social Login', 'None', 'Yes', NULL, 'Radio', '[\"On\", \"Off\"]', NULL, 6, 0, 'Active', '2023-06-20 11:31:52', '2023-06-21 11:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_super_admin`
--

CREATE TABLE `tbl_super_admin` (
  `id` int(11) NOT NULL,
  `v_name` varchar(100) DEFAULT NULL,
  `v_email_id` varchar(100) DEFAULT NULL,
  `v_mobile_number` varchar(25) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `d_last_login_date` datetime DEFAULT NULL,
  `v_forgot_password_code` varchar(25) DEFAULT NULL,
  `v_profile_image` varchar(100) DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `e_status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_super_admin`
--

INSERT INTO `tbl_super_admin` (`id`, `v_name`, `v_email_id`, `v_mobile_number`, `password`, `d_last_login_date`, `v_forgot_password_code`, `v_profile_image`, `remember_token`, `e_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '123443434', '$2y$10$t6ibASzxyhQxiNoOZWGOme.tlG1FhUe8UOIEftCgRhI9LRRj/LWty', NULL, '5QOH5nIy1T', '20230625_JwRxfq02Ly.JPG', 'DfH9JPtrQrtamzsaoi9RdM4VCFMPeWGOlkhPR98i7nzbhtuy9fIQOKhQ0dTz', 'Active', '2021-06-06 15:49:39', '2023-06-25 06:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `v_first_name` varchar(100) DEFAULT NULL,
  `v_middle_name` varchar(100) DEFAULT NULL,
  `v_last_name` varchar(100) DEFAULT NULL,
  `t_social_id` text DEFAULT NULL,
  `t_linkedin_id` text DEFAULT NULL,
  `t_facebook_id` text DEFAULT NULL,
  `t_twitter_id` text DEFAULT NULL,
  `t_github_id` text DEFAULT NULL,
  `t_instagram_id` text DEFAULT NULL,
  `t_apple_id` text DEFAULT NULL,
  `v_email` varchar(100) DEFAULT NULL,
  `v_phone_no` varchar(25) DEFAULT NULL,
  `v_profile_pic` varchar(100) DEFAULT NULL,
  `t_password` varchar(100) NOT NULL,
  `e_status` enum('Active','Inactive','In Progress','Pending Verification') NOT NULL DEFAULT 'In Progress',
  `remember_token` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `v_first_name`, `v_middle_name`, `v_last_name`, `t_social_id`, `t_linkedin_id`, `t_facebook_id`, `t_twitter_id`, `t_github_id`, `t_instagram_id`, `t_apple_id`, `v_email`, `v_phone_no`, `v_profile_pic`, `t_password`, `e_status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sandeep1', 'P1', 'Gajera1', 'sdfssdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, 'sandeep1@gmail.com', '345535314345', '20230625_uCj10AqeLq.JPG', '', 'Active', NULL, '2023-06-25 11:08:20', '2023-06-25 06:07:06', NULL),
(2, 'Sandeep G', NULL, 'G', '109150474711449516214', NULL, NULL, NULL, NULL, NULL, NULL, 'sandeep@pivotdrive.ca', NULL, NULL, '$2y$10$Z02DA0oxY7gIjkVWeABSd.qjbZKVE6IFGP0zhmsJCt0.yEPfwEkIq', 'Active', NULL, '2023-07-04 09:58:24', '2023-07-12 10:51:47', '2023-07-12 10:51:47'),
(3, 'Sandeep Gajera', NULL, '', NULL, 'LlNmk9j9B_', NULL, NULL, NULL, NULL, NULL, 'sandeepgajera.sgp@gmail.com', NULL, NULL, '$2y$10$Om1DE6QDX5WIRHo27Dh64OWzc3REUv6Wj0LNtE0PDQk8KZy8QOlTa', 'Active', NULL, '2023-07-04 10:06:58', '2023-07-04 10:06:58', NULL),
(4, 'Sandeep Gajera', NULL, '', NULL, NULL, '6341283545962403', NULL, NULL, NULL, NULL, '', NULL, NULL, '$2y$10$KrB1NW27ZPzu7Pw.tPPqpO9C9.7F/5aNp5dYKtpRIODQW38tKldEW', 'Active', NULL, '2023-07-04 11:19:47', '2023-07-04 11:19:47', NULL),
(5, 'jhon.wick.675', NULL, '', NULL, NULL, NULL, NULL, NULL, '6803873569632449', NULL, 'jhon.wick.675', NULL, NULL, '$2y$10$YA9PcCa/DVLqKFno/cEYwuhoZX31l64XDZIAXMIPOrfUT1wnOCDVO', 'Active', NULL, '2023-07-04 12:38:25', '2023-07-04 12:38:25', NULL),
(6, 'Mat Hannry', 'Test', 'Hannry', '101680869038616606152', NULL, NULL, NULL, NULL, NULL, NULL, 'astrojaluser1@gmail.com', '344553453', NULL, '$2y$10$NoAJR9ZlWDYH.S8DIxPJau7s7nYcwD5fZqEn.NKD27et.xBNwZMf.', 'Active', NULL, '2023-07-05 05:46:31', '2023-07-12 10:50:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_events`
--

CREATE TABLE `tbl_user_events` (
  `id` int(11) NOT NULL,
  `i_user_id` int(11) NOT NULL,
  `v_event_unique_id` varchar(25) DEFAULT NULL,
  `v_email` varchar(100) DEFAULT NULL,
  `e_is_remove_data` enum('Yes','No') NOT NULL DEFAULT 'No',
  `i_event_contact_share_total_time_in_seconds` smallint(6) DEFAULT NULL,
  `i_total_participant` mediumint(9) DEFAULT 0,
  `e_status` enum('Create Event','Share Event','Share Email') NOT NULL DEFAULT 'Create Event',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_events`
--

INSERT INTO `tbl_user_events` (`id`, `i_user_id`, `v_event_unique_id`, `v_email`, `e_is_remove_data`, `i_event_contact_share_total_time_in_seconds`, `i_total_participant`, `e_status`, `created_at`, `updated_at`) VALUES
(4, 6, '345345345', 'harshit.kakadiya1996', 'Yes', NULL, 0, 'Create Event', '2023-07-10 12:39:09', '2023-07-10 19:07:14'),
(5, 1, '499735', 'test12345', 'Yes', NULL, 0, 'Create Event', '2023-07-11 15:57:50', '2023-07-11 16:18:32'),
(9, 1, '525902', 'dfgdgdg', 'Yes', NULL, 0, 'Share Email', '2023-07-11 16:29:09', '2023-07-11 16:34:40'),
(10, 1, '626028', 'dfgdfgdfg', 'Yes', NULL, 0, 'Share Email', '2023-07-11 16:37:53', '2023-07-11 16:38:54'),
(11, 1, '669869', 'dssdf', 'Yes', NULL, 0, 'Share Email', '2023-07-11 16:49:39', '2023-07-11 16:49:39'),
(12, 1, '477759', 'sdfsfsf', 'Yes', NULL, 0, 'Share Email', '2023-07-11 16:50:36', '2023-07-11 17:08:00'),
(13, 1, '957378', 'sdfsdf', 'Yes', 960, 0, 'Create Event', '2023-07-11 17:08:24', '2023-07-11 18:27:54'),
(14, 1, '611560', 'test12333', 'Yes', 60, 0, 'Share Email', '2023-07-12 10:05:22', '2023-07-12 10:06:29'),
(15, 1, '442167', 'test122323', 'Yes', 60, 0, 'Share Email', '2023-07-12 10:12:32', '2023-07-12 10:13:33'),
(16, 1, '784382', 'ssfsdf', 'No', 1740, 0, 'Share Email', '2023-07-12 12:18:54', '2023-07-12 13:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_event_participants`
--

CREATE TABLE `tbl_user_event_participants` (
  `id` int(11) NOT NULL,
  `i_user_id` int(11) NOT NULL,
  `i_user_event_id` int(11) NOT NULL,
  `v_name` varchar(100) DEFAULT NULL,
  `v_phone_number` varchar(25) DEFAULT NULL,
  `v_email` varchar(100) DEFAULT NULL,
  `t_email_subject` text DEFAULT NULL,
  `t_email_body` text DEFAULT NULL,
  `d_email_datetime` datetime DEFAULT NULL,
  `e_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_event_participants`
--

INSERT INTO `tbl_user_event_participants` (`id`, `i_user_id`, `i_user_event_id`, `v_name`, `v_phone_number`, `v_email`, `t_email_subject`, `t_email_body`, `d_email_datetime`, `e_status`, `created_at`, `updated_at`) VALUES
(4, 1, 12, 'dfgdfg', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL),
(5, 1, 12, 'dfgdfg sfsdf', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL),
(6, 1, 14, 'dfgdfg sfsdf dfgdfg', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL),
(7, 1, 15, 'dfgdfg sfsdf dfgdfg', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL),
(8, 1, 16, 'dfgdfg sfsdf dfgdfg', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL),
(9, 1, 16, 'dfgdfg sfsdf dfgdfg', '345345', 'fghfgh@gmail.com', NULL, NULL, NULL, 'Active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cms_pages`
--
ALTER TABLE `tbl_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cron_jobs`
--
ALTER TABLE `tbl_cron_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cron_job_logs`
--
ALTER TABLE `tbl_cron_job_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_events`
--
ALTER TABLE `tbl_user_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_event_participants`
--
ALTER TABLE `tbl_user_event_participants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cms_pages`
--
ALTER TABLE `tbl_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cron_jobs`
--
ALTER TABLE `tbl_cron_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cron_job_logs`
--
ALTER TABLE `tbl_cron_job_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_events`
--
ALTER TABLE `tbl_user_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_user_event_participants`
--
ALTER TABLE `tbl_user_event_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
