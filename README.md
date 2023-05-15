# Documentation
This repository contains a simple PHP web application that allows editing user details stored in a MySQL database.

## Files
### `index.php`
This file contains the HTML and PHP code for the user interface and handling form submissions. The script first includes the `connection.php` file to establish a connection to the database, and then retrieves all user records from the `users` table.

The retrieved user records are then displayed in a table, with each row containing input fields to edit the user's name, username, email, and password. The script uses the `mysqli_real_escape_string()` function to escape user input to prevent SQL injection attacks.

When the user submits the form, the script updates the corresponding database records with the new values using a `foreach` loop. A JavaScript function is included to toggle the password input fields between plain text and password type.

### `connection.php`
This file contains PHP code to establish a connection to the MySQL database. It defines the connection details in variables and creates a connection using the `mysqli_connect()` function. The script also checks for connection errors using the `mysqli_connect_errno()` function and exits the script if an error is found.

### `users.sql`
This file contains SQL code to create the adet database and the users table with columns for `id`, `name`, `username`, `email`, and `password`. The id column is set to auto-increment, and the id column is set as the primary key.

## Getting Started
To use this web application, follow these steps:

1. Install a web server such as Apache and a MySQL database server on your computer.
2. Clone this repository to your web server's document root directory.
3. Import the users.sql file into your MySQL database to create the adet database and users table.
4. Update the connection details in the ``connection.php` file to match your MySQL database server credentials.
5. Open the web application in a web browser by navigating to `http://localhost/index.php.`

## Dependencies
### This web application uses the following dependencies:

+ PHP version 7.0 or higher
+ MySQL database server

## License
This project is licensed under the MIT License.
