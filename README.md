# My Projects Showcase

This is a PHP application that displays all of my projects. It provides a comprehensive overview of my work, allowing visitors to browse through my projects and easily get in touch with me via Gmail.

## Features

- List of all my projects with descriptions and links
- Fully responsive design for optimal viewing across all devices
- Contact form to send me an email directly

## Live Demo

You can view the live project here: [My Projects Showcase](https://project.sumitrathor.rf.gd/)

## Installation

To run this project locally, follow these steps:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/sumitrathor1/project.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd project
    ```

3. **Start a local server:**

    You can use the built-in PHP server for development purposes:

    ```bash
    php -S localhost:8000
    ```

4. **Open your browser and visit:**

    ```bash
    http://localhost:8000
    ```

## Database Setup

Before running the application, you need to set up the database. You can import the following SQL dump to create the necessary tables:

```sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 07:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `allproject`

-- --------------------------------------------------------

-- Table structure for table `projectdata`

CREATE TABLE `projectdata` (
  `sno` int(11) NOT NULL,
  `imageLink` varchar(255) NOT NULL,
  `projectLink` varchar(255) NOT NULL,
  `projectTittle` varchar(255) NOT NULL,
  `longDescription` mediumtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `shortDescription` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `userdata`

CREATE TABLE `userdata` (
  `sno` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Indexes for dumped tables

-- Indexes for table `projectdata`
ALTER TABLE `projectdata`
  ADD PRIMARY KEY (`sno`);

-- Indexes for table `userdata`
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`sno`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `projectdata`
ALTER TABLE `projectdata`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `userdata`
ALTER TABLE `userdata`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
