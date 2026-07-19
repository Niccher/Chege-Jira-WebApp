# 🚀 Chege Jira

> A professional, highly-scalable CodeIgniter 4 web application built for modern workflows.

A personal productivity and work-tracking platform designed to serve as a centralized operating system for managing ongoing projects, logging daily work done, recording milestones, and maintaining a structured timeline of deliverables.

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](#)
[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.x-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)](#)
[![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](#)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](#)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

---

## 📖 1. About the Project

**Chege Jira** is a robust and flexible web application designed to solve complex developer workflows with ease. Built on the lightning-fast CodeIgniter 4 framework, this project acts as a complete, out-of-the-box solution for tracking development time, organizing tasks, and visualizing project progress. 

Our target users are developers, power users, and teams looking for an open-source solution that emphasizes performance, security, and developer experience (DX). 

**What makes this project unique?**
Every component of this application is fully containerized. From the zero-configuration automated database migrations on boot, to the host-mapped persistent storage volumes—this project guarantees a frictionless setup experience whether you are running it on a local machine or deploying it to a cloud server.

---

## ✨ 2. Features

### 🖥️ Dashboard & Project Management
- **📊 Live Dashboard**: Real-time overview with quick stats (total/active/pending/archived projects), weekly focus cards, and a recent activity timeline with color-coded event types.
- **📋 Full Project Lifecycle**: Create, edit, view, and manage projects with status tracking, priority levels, tech stack tagging, and progress bars.
- **🗂️ Kanban Board**: Project-specific kanban views with drag-and-drop task cards, theme-aware styling, and clear status columns.
- **📈 Analytics**: Visual project analytics with completion trends and status distribution.

### 🎨 Personalization & UX
- **🌗 Theme Toggle**: Switch between Dark and Light themes with a single click or press `T`. Preference is persisted to your account.
- **🎨 Accent Color Picker**: Choose your accent color (default: Red). Saved per-user and applied instantly across the UI.
- **📍 Persistent Sidebar**: Collapse/expand the sidebar with a click or press `S`. Your preference is stored in the browser across sessions.
- **📱 Responsive Layout**: Fully responsive design that adapts from desktop to mobile.

### 🔐 Authentication & Security
- **🛡️ Shield Auth**: Built on CodeIgniter Shield with register, login, forgot/reset password, and email activation flows.
- **🔒 CSRF Protection**: All forms are protected against cross-site request forgery.
- **🗄️ Settings Persistence**: User preferences (timezone, date format, theme, accent color) are stored in the database and survive container restarts.

### 🕐 Time Tracking & Notes
- **⏱️ Time Logger**: Log work hours against projects with start/stop or manual entry. View daily, weekly, and monthly summaries.
- **📝 Per-Project Notes**: Attach notes to projects with timestamps. Organize thoughts, meeting minutes, and technical references.
- **📅 Calendar View**: Visual calendar for time logs and events, integrated with FullCalendar.

### 📦 Data Management
- **📥 Import / Export**: Export projects, time logs, and notes to CSV or JSON. Import data back via the settings panel.
- **🖼️ Profile Avatars**: Upload a profile image — securely stored and served from the application.

### 🐳 DevOps & Infrastructure
- **⚡ Instant Setup**: 100% Dockerized architecture. Go from zero to running in under 60 seconds with `docker compose up`.
- **🔄 Automated Migrations**: Database tables and schemas are built automatically when the container boots.
- **💾 Smart Persistence**: Database records and uploaded media safely persist on your local filesystem, completely isolated from container lifecycle events.
- **📊 Integrated Database Management**: Comes bundled with a dedicated `phpMyAdmin` container for real-time database visualization.

---

## 🛠️ 3. Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | [CodeIgniter 4](https://codeigniter.com/) |
| **Language** | PHP 8.3 |
| **Database** | MySQL 8.4 |
| **Database Manager** | phpMyAdmin |
| **Containerization** | Docker & Docker Compose |
| **Dependency Manager** | Composer |

---

## 📋 4. Prerequisites

Before you begin, ensure you have the following installed on your machine:
- [Docker](https://docs.docker.com/get-docker/) & [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)

*(If you choose to run without Docker, you will need PHP 8.3+, Composer, and a local MySQL server).*

---

## 🚀 5. Installation & Setup (Detailed)

### Option 1: Using Docker (Preferred & Easiest)

This repository includes a pre-configured `docker-compose.yml` file. It completely eliminates the need to manually install PHP, web servers, or databases on your local machine.

#### 1. Clone the repository
```bash
git clone https://github.com/yourusername/chege-jira-webapp.git
cd "Chege Jira WebApp"
```

#### 2. Configure Environment Variables
Copy the provided environment template:
```bash
cp .env.example .env
```
*(Note: The defaults in `.env.example` are specifically pre-configured to work perfectly with the Docker environment out of the box).*

#### 3. Build and Run
Spin up the application, MySQL database, and phpMyAdmin in detached mode:
```bash
docker compose up --build -d
```

#### 4. Access the Application
Once the containers finish booting, database migrations run automatically. You can access your services at:
- **Application**: [http://localhost:9001](http://localhost:9001)
- **phpMyAdmin**: [http://localhost:9000](http://localhost:9000)

**Useful Docker Commands:**
- Stop the application: `docker compose down`
- View live application logs: `docker compose logs -f chege-jira`
- Restart the application: `docker compose restart chege-jira`

### Option 2: Local Development (Without Docker)

If you prefer a traditional local setup (e.g., XAMPP, Laragon, or Laravel Valet):

1. **Clone the repo** and run `composer install` in the root directory.
2. **Copy `.env.example`** to `.env`.
3. **Configure the Database**: Update the `database.default.*` variables inside your `.env` to match your local MySQL credentials.
4. **Run Migrations**: Build the necessary database tables by executing:
   ```bash
   php spark migrate --all
   ```
5. **Serve the Application**:
   ```bash
   php spark serve
   ```

---

## 🗄️ 6. Database Configuration

If you are using the Docker setup, the database configuration is completely automated.

**Development Credentials:**
- **Host:** `mysql`
- **Database Name:** `db_chege_jira`
- **Username:** `root`
- **Password:** `root_password`

You can visually manage this database by navigating to [http://localhost:9000](http://localhost:9000) and logging into phpMyAdmin with the credentials above.

---

## 📖 7. Usage

1. **Sign Up / Login**: Navigate to the homepage to create your first administrative account.
2. **Dashboard**: Access the main dashboard to view analytics and metrics.
3. **File Management**: Any artifacts or files you upload within the application will be securely persisted inside the `/writable/uploads` directory on your local machine.

---

## 📁 8. Project Structure

```text
.
├── app/            # Core application logic (Controllers, Models, Views)
├── public/         # Document root (accessible to the web)
├── writable/       # Cache, logs, sessions, and persisted uploads
├── system/         # CodeIgniter 4 framework files
├── docker-compose.yml # Standalone Docker orchestration
├── entrypoint.sh   # Automated migration startup script
└── Dockerfile      # PHP-Apache container build instructions
```

---

## 🤝 9. Contributing

We welcome contributions from the community! To contribute:

1. **Fork** the repository.
2. **Create a new branch**: `git checkout -b feature/your-feature-name`
3. **Commit your changes**: `git commit -m 'Add some feature'`
4. **Push to the branch**: `git push origin feature/your-feature-name`
5. **Open a Pull Request**.

Please ensure you run tests and verify your changes inside the Docker environment before submitting.

---

## 📄 10. License

Distributed under the MIT License. See `LICENSE` for more information.

---

## 📸 11. Screenshots & Demo

*(Screenshots coming soon)*

---

## 💬 12. Support & Acknowledgments

- Built with ❤️ using [CodeIgniter 4](https://codeigniter.com/).
- UI components powered by modern web standards.
