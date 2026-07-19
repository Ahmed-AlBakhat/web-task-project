# User Status Manager

A simple web application built with HTML, CSS, JavaScript, PHP, and MySQL.

## Project Requirements

- One-line form containing name, age, and a submit button.
- Store submitted data in a MySQL database.
- Display all database records in a table.
- Add a toggle button for every record.
- Change the status value between `0` and `1`.
- Update the status immediately without reloading the page.

## Technologies

- HTML
- CSS
- JavaScript
- PHP
- MySQL
- XAMPP

## Project Files

```text
web_task_project/
├── index.php
├── db.php
├── toggle.php
├── style.css
├── script.js
├── database.sql
└── README.md
```

## Installation Steps

### 1. Install XAMPP

Download and install XAMPP, then open the XAMPP Control Panel.

Start:

- Apache
- MySQL

### 2. Copy the Project

Copy the folder `web_task_project` into:

```text
C:\xampp\htdocs\
```

The final path should be:

```text
C:\xampp\htdocs\web_task_project
```

### 3. Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Then:

1. Choose **Import**.
2. Select the file `database.sql`.
3. Click **Import** or **Go**.

This creates:

- Database: `web_task`
- Table: `users`

### 4. Check Database Connection

The default settings inside `db.php` are:

```php
$host = "localhost";
$dbname = "web_task";
$username = "root";
$password = "";
```

These values work with the default XAMPP configuration.

### 5. Run the Project

Open this address in the browser:

```text
http://localhost/web_task_project/
```

## How the Project Works

### Adding a Record

The form sends the name and age to `index.php` using the POST method.

PHP validates the entered values and inserts them into the `users` table using a prepared SQL statement.

### Displaying Records

`index.php` retrieves all records from MySQL and prints them inside an HTML table.

### Toggling Status

When the user clicks the **Toggle** button:

1. JavaScript sends the record ID to `toggle.php` using `fetch()`.
2. PHP updates the value:
   - `0` becomes `1`
   - `1` becomes `0`
3. The server returns the new value as JSON.
4. JavaScript updates the status on the page immediately without refreshing it.

## Database Structure

| Column | Type | Description |
|---|---|---|
| id | INT | Primary key and auto-increment |
| name | VARCHAR(100) | User name |
| age | TINYINT | User age |
| status | TINYINT(1) | Status value, either 0 or 1 |
| created_at | TIMESTAMP | Record creation time |

## GitHub Upload Steps

1. Create a new GitHub repository.
2. Name it `user-status-manager`.
3. Open the project folder in Visual Studio Code.
4. Open the terminal and run:

```bash
git init
git add .
git commit -m "Create user status manager project"
git branch -M main
git remote add origin YOUR_REPOSITORY_URL
git push -u origin main
```

Replace `YOUR_REPOSITORY_URL` with your GitHub repository URL.

## Author

Ahmed AlBakhat
