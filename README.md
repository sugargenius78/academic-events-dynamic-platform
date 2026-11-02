# Academic Events Dynamic Platform

## Overview
A dynamic, responsive full-stack web application developed to manage institutional event scheduling, student registrations, and administrative tasks. Developed for the Web Design and Databases module (SEN4001) under the Cardiff Metropolitan University curriculum. Grade Achieved: 65% (Upper Second-Class Honours - 2:1).

## System Capabilities
- **Authentication & Security:** Dynamic registration, user authentication, and secure password recovery mechanisms (`forgot_password.php`, `reset_password.php`, `verify_code.php`).
- **Administrative Portal:** Role-based dashboards for site managers to publish, update, and manage institutional events (`admin_index.php`, `add_event.php`).
- **Dynamic Event Discovery:** Categorized listing interfaces for students to explore campus events across Academic, Cultural, Career, Sports, and Science domains (`allevents.php`, `fetch_events.php`).
- **Relational Data Storage:** Structured relational database connectivity (`db.php`) enforcing secure query handling and referential integrity.

## Technology Stack
- **Frontend:** HTML5, CSS3 (`style.css`), JavaScript
- **Backend:** PHP
- **Database:** MySQL / MariaDB
- **Architecture:** Client-Server Architecture, Dynamic Event Querying

## Repository Structure
- `index.html` / `academic.html` - Primary public landing and event category portals
- `admin_index.php` / `add_event.php` - Administrative management dashboards
- `db.php` - Database connection script
- `signin.php` / `signup.php` - Authentication pipelines
- `pictures/` - Static assets and graphical interface resources
