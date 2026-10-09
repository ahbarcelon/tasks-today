# Tasks for Today Management System

A small CodeIgniter 4 + MySQL app for IT0049 Web System Technologies. It shows today's tasks, the full task list, a demo user profile, and an About page.

## Features
- Welcome page (`/`) with **only** today's tasks, summary counts, and an empty state
- All Tasks page (`/tasks`) ordered by date, with colored status badges
- Profile page (`/profile`) showing the single demo user
- About page (`/about`) with the developer and course
- Responsive custom CSS (table on desktop, cards on mobile), no CSS framework
- Data read through `TaskModel` and `UserModel`; sample data from a migration and seeder

## Technology
CodeIgniter 4.7, PHP 8.1+ (with `intl`, `mbstring`, `mysqli`), MySQL via XAMPP, HTML5, custom CSS.

## Setup on Windows with XAMPP
The project can live in any folder (not `htdocs`). `php spark serve` serves the `public` folder directly, so Apache is not needed.

1. Open the XAMPP Control Panel and **start MySQL** (Apache is optional).
2. Create the database in phpMyAdmin (`http://localhost/phpmyadmin`) named `tasks_today_db`, or run:
   `mysql -u root -e "CREATE DATABASE tasks_today_db"`
3. In the project folder, copy the config: `copy .env.example .env`
   (if you only have the framework's `env` file: `copy env .env`)
4. Check `.env`:
   ```dotenv
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = tasks_today_db
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```
   Change the username, password, or port if your XAMPP differs.
5. Create the tables and sample data:
   ```bash
   php spark migrate
   php spark db:seed TasksTodaySeeder
   ```
   The seeder uses dynamic dates (2 days ago to 3 days ahead), so run it again any day to refresh "today" tasks. It resets both tables.
6. Start the app: `php spark serve`
7. Open `http://localhost:8080/`

Make sure the `intl` extension is on: in `C:\xampp\php\php.ini` remove the `;` before `extension=intl`, then restart the terminal.

## Routes
| Route | Controller | Purpose |
|---|---|---|
| `/` | `Pages::welcome` | Today's tasks only |
| `/tasks` | `Tasks::index` | All tasks ordered by date |
| `/profile` | `Profile::index` | The demo user |
| `/about` | `Pages::about` | Developer and course info |

## Project structure
```text
app/Controllers   Pages.php, Tasks.php, Profile.php
app/Models        TaskModel.php, UserModel.php
app/Views         layouts/main.php, pages/, tasks/, profile/, partials/
app/Database      Migrations/ (tables), Seeds/TasksTodaySeeder.php
app/Config        Routes.php (routes), App.php (timezone: Asia/Manila)
public/assets/css style.css
```

## Replace the developer name
Open `app/Controllers/Pages.php` and change the `DEVELOPER_NAME` constant from `[REPLACE WITH MY FULL NAME]` to your full name. It appears on the About page.

## Timezone
"Today" uses the timezone in `app/Config/App.php` (`appTimezone`, set to `Asia/Manila`). Change it if you are elsewhere.

## Troubleshooting
- **MySQL not running / "Unable to connect"**: start MySQL in XAMPP and re-check `.env`.
- **Port 3306 already used**: stop the other MySQL service, or change the port in XAMPP's `my.ini` and set `database.default.port` in `.env`.
- **Access denied**: fix `database.default.username` and `password` in `.env`.
- **`public/` appears in the URL or routes do not load**: run `php spark serve` from the project root (the folder containing `spark`), not from `public/` or another folder.
- **CSS not loading**: confirm `app.baseURL = 'http://localhost:8080/'` (with trailing slash) and that `public/assets/css/style.css` exists.
- **Welcome page empty**: the seeded dates are relative to the seed day. Run `php spark db:seed TasksTodaySeeder` again.

## GitHub submission checklist
- [ ] Developer name replaced
- [ ] `.env` is **not** committed (it is in `.gitignore`); `.env.example` is
- [ ] `php spark migrate` and the seeder run cleanly on a fresh database
- [ ] All four routes tested
- [ ] README is up to date

## Hosting checklist
- [ ] Create a production MySQL database and user on the host
- [ ] Create `.env` on the server with the production host, database, username, and password
- [ ] Set `CI_ENVIRONMENT = production` and `app.baseURL` to the live URL
- [ ] Point the web root to the `public/` folder
- [ ] Run `php spark migrate` and the seeder on the server
