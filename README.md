# ChegeOS • Side-Project Dashboard

ChegeOS is a powerful, agentic project management dashboard designed to help developers and power users organize their side projects, track time, manage tasks via Kanban, and capture ideas seamlessly.

![ChegeOS Banner](https://img.shields.io/badge/Status-Beta-blue?style=for-the-badge)
![CodeIgniter](https://img.shields.io/badge/Framework-CodeIgniter%204-EF4444?style=for-the-badge&logo=codeigniter)
![Bootstrap](https://img.shields.io/badge/UI-Bootstrap%205-7952B3?style=for-the-badge&logo=bootstrap)

## 🚀 Key Features

- **📊 Comprehensive Dashboard**: Get a high-level overview of your project stats, weekly focus, and recent activity at a glance.
- **📋 Project Management**: Full lifecycle management of projects including planning, progress tracking, and archiving.
- **🧱 Kanban Board**: Organize tasks with a dynamic drag-and-drop interface powered by SortableJS.
- **⏱️ Time Tracking**: Built-in timer and manual entry system to monitor how much effort you're putting into each project.
- **📝 Smart Notes**: Markdown-supported notes system with starring capabilities and project-specific linking.
- **🗓️ Integrated Calendar**: Track deadlines, milestones, and custom events in a unified view.
- **🔐 Secure Authentication**: Robust user management powered by CodeIgniter Shield.
- **🌙 Modern Dark UI**: Sleek, premium aesthetic with a collapsible sidebar and responsive design.

## 🛠️ Tech Stack

- **Backend**: PHP 8.1+ (CodeIgniter 4)
- **Database**: MySQL / MariaDB
- **Frontend**: 
  - Bootstrap 5 (Vanilla CSS)
  - jQuery (Interactivity)
  - SortableJS (Kanban Drag-and-Drop)
  - FontAwesome 6 (Icons)
  - Inter font family (Typography)
- **Authentication**: CodeIgniter Shield

## 🔧 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- A local server environment like XAMPP, Laragon, or Apache/Nginx

### Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/chege-os.git
   cd chege-os
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   - Copy `env` to `.env`
   - Configure your database settings:
     ```env
     database.default.hostname = localhost
     database.default.database = chege_os
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```

4. **Run Migrations**
   ```bash
   php spark migrate
   ```

5. **Serve the application**
   ```bash
   php spark serve
   ```
   Access the dashboard at `http://localhost:8080`

## 📸 Screenshots

*(To be added)*
- Dashboard Overview
- Project Kanban Board
- Time Tracking Statistics

## 🗺️ Roadmap

- [ ] Interactive Analytics Reports
- [ ] Exportable CSV/PDF project summaries
- [ ] Multi-user collaboration tools
- [ ] API Integrations (GitHub, Trello)
- [ ] Mobile App wrapper (PWA)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---
*Built with ❤️ for the Side-Project Community.*
