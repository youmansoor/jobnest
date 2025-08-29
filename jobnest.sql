-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 04:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `cover_letter` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `resume_path`, `cover_letter`, `job_title`) VALUES
(1, 'resumes/ali_raza_cv.pdf', 'I am excited to apply for the software engineer po...', 'Software Engineer'),
(2, 'resumes/sara_khan_resume.pdf', 'With a strong background in UI/UX design, I am con...', 'UI/UX Designer'),
(3, 'resumes/ahmed_hassan_cv.pdf', 'I have 3 years of experience as a Java Developer a...', 'Java Developer'),
(4, 'resumes/fatima_noor_resume.pdf', 'My background in data analysis and visualization m...', 'Data Analyst'),
(5, 'resumes/bilal_ahmed_cv.pdf', 'Please find attached my resume for your considerat...', 'Software Engineer'),
(6, 'resumes/ayesha_malik_resume.pdf', 'I am passionate about frontend technologies and ha...', 'Frontend Developer'),
(7, 'resumes/zain_siddiqui_cv.pdf', 'I am applying for the network engineer role and ha...', 'Network Engineer'),
(8, 'resumes/mariam_yousaf_resume.pdf', 'My background in cybersecurity aligns with your cu...', 'Cybersecurity Analyst'),
(9, 'resumes/usman_tariq_cv.pdf', 'Experienced in Laravel and ready to work on scalab...', 'Laravel Developer'),
(10, 'resumes/hina_javed_resume.pdf', 'Enthusiastic about joining your QA team. I bring m...', 'QA Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `empolyee`
--

CREATE TABLE `empolyee` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empolyee`
--

INSERT INTO `empolyee` (`id`, `Name`, `Email`, `Password`, `user_role`) VALUES
(1, 'HR - Systems Limited', 'hr@systemsltd.com', 'system123', 'IT'),
(2, 'Recruiter - 10Pearls', 'recruit@10pearls.com', 'pearls456', 'IT'),
(3, 'Talent Acquisition - NetSol', 'jobs@netsol.com', 'netsol@789', 'IT'),
(4, 'HR Manager - Techlogix', 'hr@techlogix.com', 'techlogix321', 'IT'),
(5, 'Recruitment - Folio3', 'careers@folio3.com', 'folio#dev', 'IT'),
(6, 'Hiring Manager - ArbiSoft', 'hiring@arbisoft.com', 'arbiHR!', 'IT'),
(7, 'HR - CureMD', 'hr@curemd.com', 'curemd@123', 'IT'),
(8, 'Talent Team - Tixel', 'talent@tixel.com', 'tixelpwd', 'IT'),
(9, 'Jobs - Ufone', 'jobs@ufone.com', 'ufonejobs', 'IT'),
(10, 'HR - VisionX', 'hr@visionx.com', 'visionx_pass', 'IT'),
(11, 'HR - Mindstorm Studios', 'hr@mindstorm.com', 'games123', 'IT'),
(12, 'HR - Rozee.pk', 'hr@rozee.pk', 'rozeeepass', 'IT'),
(13, 'Hiring - Zong 4G', 'hr@zong.com.pk', 'zong4ghr', 'IT'),
(14, 'HR - PTCL', 'hr@ptcl.com.pk', 'ptcljobs', 'IT'),
(15, 'Recruiter - DPL', 'recruit@dpl.com', 'dplteam', 'IT'),
(16, 'HR - Techverx', 'hr@techverx.com', 'verx2025', 'IT'),
(17, 'Careers - Si Global', 'careers@siglobal.com', 'siglobal321', 'IT'),
(18, 'HR - TRG Pakistan', 'hr@trg.com.pk', 'trgtrg1', 'IT'),
(19, 'HR - CodeNinja', 'hr@codeninja.com', 'ninjajobs', 'IT'),
(20, 'Recruitment - Contour Software', 'recruitment@contour.com', 'contourHR', 'IT'),
(21, 'Mansoor', 'man@gmail.com', '555', 'Markiting'),
(22, 'Azhaan', 'azhaan@gmail.com', '888', 'SE Developer'),
(23, 'umer', 'you@gmail.com', '576', 'Designer'),
(24, 'you', 'waiz@gmail.com', '666', 'Designer');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(1, 'Mansoor', 'admin@shopstore.com', 'gdfgfgdf'),
(2, 'hgh', 'yg@g', 'ghgfhfg'),
(3, 'm', 'you@gmail.com', 'jjkhh'),
(4, 'hgh', 'you@gmail.com', 'hjhjh');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `employer_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_email`, `title`, `company`, `location`, `sector`, `description`) VALUES
(1, 'hr@systemsltd.com', 'Software Engineer', 'Systems Limited', 'Lahore', 'IT', 'Develop scalable enterprise applications in .NET and Angular.'),
(2, 'recruit@10pearls.com', 'Full Stack Developer', '10Pearls', 'Karachi', 'IT', 'Work on modern web stacks including MERN for global clients.'),
(3, 'jobs@netsol.com', 'Java Developer', 'NetSol Technologies', 'Lahore', 'IT', 'Develop financial software using Java Spring Framework.'),
(4, 'hr@techlogix.com', 'Business Analyst', 'Techlogix', 'Islamabad', 'IT', 'Liaise between business units and software developers.'),
(5, 'careers@folio3.com', 'QA Engineer', 'Folio3', 'Karachi', 'IT', 'Test and validate applications for mobile and web.'),
(6, 'hiring@arbisoft.com', 'DevOps Engineer', 'Arbisoft', 'Lahore', 'IT', 'Manage CI/CD pipelines and cloud infrastructure.'),
(7, 'hr@curemd.com', 'UI/UX Designer', 'CureMD', 'Lahore', 'IT', 'Design clean and modern interfaces for healthcare apps.'),
(8, 'talent@tkxel.com', 'Data Analyst', 'Tkxel', 'Lahore', 'IT', 'Analyze customer data and create dashboards in Power BI.'),
(9, 'jobs@ufone.com', 'Network Engineer', 'Ufone', 'Islamabad', 'IT', 'Maintain and troubleshoot telecom network infrastructure.'),
(10, 'hr@visionx.com', 'AI Engineer', 'VisionX', 'Islamabad', 'IT', 'Develop machine learning models for real-time vision systems.'),
(11, 'hr@mindstorm.com', 'Game Developer', 'Mindstorm Studios', 'Lahore', 'IT', 'Build mobile and PC games using Unity and C#.'),
(12, 'hr@rozee.pk', 'Product Manager', 'Rozee.pk', 'Lahore', 'IT', 'Define product strategy and lead agile teams.'),
(13, 'hr@zong.com.pk', 'Cybersecurity Analyst', 'Zong 4G', 'Islamabad', 'IT', 'Monitor networks and respond to cyber threats.'),
(14, 'hr@ptcl.com.pk', 'System Administrator', 'PTCL', 'Lahore', 'IT', 'Ensure uptime and performance of internal systems.'),
(15, 'recruit@dpl.com', 'Mobile App Developer', 'DPL', 'Islamabad', 'IT', 'Develop cross-platform apps in Flutter and React Native.'),
(16, 'hr@techverx.com', 'Front-End Developer', 'Techverx', 'Lahore', 'IT', 'Build pixel-perfect web interfaces using Vue.js.'),
(17, 'careers@siglobal.com', 'Cloud Engineer', 'Si Global', 'Karachi', 'IT', 'Design and deploy cloud infrastructure on AWS.'),
(18, 'hr@trg.com.pk', 'Technical Support Specialist', 'TRG Pakistan', 'Karachi', 'IT', 'Provide support to clients for IT-related issues.'),
(19, 'hr@codeninja.com', 'Laravel Developer', 'CodeNinja', 'Lahore', 'IT', 'Build secure and scalable apps with Laravel.'),
(20, 'recruitment@contour.com', 'ERP Consultant', 'Contour Software', 'Lahore', 'IT', 'Implement ERP systems for large international clients.'),
(21, 'man@gmail.com', 'Front End Developer', 'unknown', 'karachi', 'Engineering', 'Skilled person required'),
(22, 'man@gmail.com', 'Front End Developer', 'unknown', 'karachi', 'Engineering', 'Skilled person required'),
(23, 'hr@systemsltd.com', 'UI/UX designer', 'Systems Limited', 'Lahore', 'IT', 'We are looking for a talented and detail-oriented UI/UX Designer to create intuitive, user-centered designs for our digital products. You will work closely with product managers, developers, and stakeholders to understand user needs, translate them into d');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(101, 'SE Developer'),
(102, 'Designer'),
(103, 'Markiting');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Ali Raza', 'ali.raza@example.com', 'password123'),
(2, 'Sara Khan', 'sara.khan@example.com', 'sarak123'),
(3, 'Ahmed Hassan', 'ahmed.hassan@example.com', 'ahmedpass'),
(4, 'Fatima Noor', 'fatima.noor@example.com', 'fatinoor321'),
(5, 'Bilal Ahmed', 'bilal.ahmed@example.com', 'bilalpass'),
(6, 'Ayesha Malik', 'ayesha.malik@example.com', 'ayesha!2025'),
(7, 'Zain Siddiqui', 'zain.siddiqui@example.com', 'zainsid123'),
(8, 'Mariam Yousaf', 'mariam.yousaf@example.com', 'mariamy@pass'),
(9, 'Usman Tariq', 'usman.tariq@example.com', 'usman!@#'),
(10, 'Hina Javed', 'hina.javed@example.com', 'hinaj321'),
(11, 'Kashif Ali', 'kashif.ali@example.com', 'kashifsecure'),
(12, 'Rabia Shah', 'rabia.shah@example.com', 'rabiashah789'),
(13, 'Saad Mehmood', 'saad.mehmood@example.com', 'saadmehmood!'),
(14, 'Nida Qureshi', 'nida.qureshi@example.com', 'nida1234'),
(15, 'Omar Farooq', 'omar.farooq@example.com', 'omarpass2024'),
(16, 'Tania Anwar', 'tania.anwar@example.com', 'taniaa321'),
(17, 'Imran Akhtar', 'imran.akhtar@example.com', 'imran@khtar'),
(18, 'Mehwish Iqbal', 'mehwish.iqbal@example.com', 'mehwishP@ss'),
(19, 'Hamza Shahid', 'hamza.shahid@example.com', 'hamza786'),
(20, 'Zara Sheikh', 'zara.sheikh@example.com', 'zara@job'),
(21, 'you', 'you@gmail.com', '576');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empolyee`
--
ALTER TABLE `empolyee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `empolyee`
--
ALTER TABLE `empolyee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
