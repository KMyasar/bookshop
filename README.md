
# Bookshop Management System

## Overview

A Demo application is built with PHP, allows management of the online bookshop. The users can search and purchase books on the site, edit their shopping cart and make an order. There is a screen which contains user accounts where customers are able to register and login. The backend of the system is implemented using PHP, MySQL, while the front end is built using HTML, CSS, Javascript, jQuery and bootstrap templates.

## Features

- **Book Browsing**: Users can view a list of available books, search, and filter books based on categories or titles.
- **Cart Management**: Users can add books to their cart, view cart details, and update quantities before checkout.
- **Checkout Page**: A secure checkout process where users can review their order and complete the purchase.
- **User Account Section**: Customers can register, log in, view order history, and manage their account information.
- **Responsive Design**: The interface is built with Bootstrap, ensuring a smooth experience across all devices.
- **Input Validation & Sanitization**: All user inputs are validated and sanitized to ensure security.

## Technologies Used

- **PHP**: Server-side scripting for handling backend processes such as user authentication, order management, and database interactions.
- **MySQL**: Database management system for storing book information, user data, and orders.
- **HTML/CSS**: Basic structure and design of the web pages.
- **JavaScript/jQuery**: For dynamic interactions, such as adding items to the cart without refreshing the page.
- **Bootstrap**: Responsive front-end framework to create a mobile-friendly and visually appealing UI.
- **Apache**: Web server for hosting the PHP application.

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/bookshop-management.git
   ```
2. Navigate to the project directory:

```bash
cd bookshop-management
```
3. Set up the MySQL database:

-   Import the provided  `database.sql`  file to create the necessary tables for books, users, and orders.

4.Configure the database connection:

-   Edit the  `config.json`  file to set up your database credentials.
##### Example
```json
{

"server_name":"MySQL Severname",

"user":"DataBase User",

"password":"password",

"db_name":"DataBase Name"

}
```
5. Set up Apache server with PHP support:

-   Place the project folder in the  `htdocs`  directory (for XAMPP/WAMP) or configure it in your server.

## Usage

After installation:

-   **Browse Books**: Go to the main page to browse books and add them to your cart.
-   **View Cart**: Click on the cart icon to review your selected books.
-   **Checkout**: Once ready, proceed to the checkout page to confirm your order and enter payment details.
-   **User Account**: Register an account to save your details, view past orders, and manage your profile.

## Security Measures

-   **Input Validation & Sanitization**: All user inputs (e.g., login, checkout) are validated and sanitized to prevent security risks such as SQL injection and XSS attacks.
-   **SQL Bind Parameters**: Secure database queries using SQL bind parameters to prevent SQL injection vulnerabilities.
-  **Session Management**: Secure User Authentication and User Authorisation
## Contributing

Feel free to fork this project and submit pull requests. Contributions and improvements are welcome!