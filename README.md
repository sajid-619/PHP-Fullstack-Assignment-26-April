## Bookstore App

The Bookstore App is a web application designed to manage bookstore operations such as managing books, customers, and orders. It provides API endpoints for CRUD operations on books, customers, and orders, as well as a frontend interface for users to interact with the bookstore.

# Features
 - View list of books, customers, and orders
 - Add, edit, and delete books, customers, and orders
 - Responsive user interface
 - Infinite scroll for book list
 - Error handling for API requests

# Technologies Used
- Laravel (Backend API)
- React (Frontend)
- Vite (Frontend build tool)
- PostgreSQL (Database)

# Installation

1. Clone the repository 

    ```bash
    git clone https://github.com/sajid-619/PHP-Fullstack-Assignment-26-April.git
    ```
2. Install dependencies for the server 

    ```bash
    composer install
    ```
3. If you're using Ubuntu, create a PostgreSQL database using the following command

    ```bash
       sudo -i -u username -p password
       psql
    ```
4. Create a database named bookstore using the following query:

    ```bash
        CREATE DATABASE bookstore
    ```
    Inside the database shell, use the following query:

    ```bash
       CREATE TABLE books (
        id SERIAL PRIMARY KEY,
        title VARCHAR(255),
        writer VARCHAR(255),
        cover_image_url VARCHAR(255),
        price DECIMAL(10, 2),
        tags TEXT[]
    );

    CREATE TABLE customers (
        id SERIAL PRIMARY KEY,
        name VARCHAR(255),
        points INTEGER DEFAULT 100
    );

    CREATE TABLE orders (
        id SERIAL PRIMARY KEY,
        customer_id INTEGER REFERENCES customers(id),
        book_id INTEGER REFERENCES books(id),
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    ```

4. Create a .env file by copying .env.example and configuring your environment variables for PostgreSql

    ```bash
       DB_CONNECTION=pgsql
       DB_HOST=127.0.0.1
       DB_PORT=5432
       DB_DATABASE=<your-postgres-database>
       DB_USERNAME=<your-postgres-username>
       DB_PASSWORD=<your-postgres-password> 
    ```

5. Generate application key 

    ```bash
    php artisan key:generate
    ```
6. Migrate database 

    ```bash
    php artisan migrate
    ```
7. Install dependencies for the client 

    ```bash
    cd client && npm install
    ```
8. Start the server 

    ```bash
    php artisan serve
    ```
9. Start the client 

    ```bash
    npm run dev
    ```
## Usage

- Access the frontend interface by visiting http://localhost:3000 in your web browser.
- Use the provided API endpoints for backend operations.

## API Documentation
The API documentation can be found at http://localhost:8000/api/documentation after starting the server.


## License
This project is licensed under the MIT License.
