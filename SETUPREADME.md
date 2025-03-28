# Account Management System

This is a Laravel-based API for managing accounts and transactions. The application allows users to create accounts, view account details, log transactions, and manage their accounts through a RESTful API.

## Features

- list view account.
- Create a new account.
- Update account information.
- Record transactions (Credit/Debit).

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL
- Laravel 10

### Setup Instructions

1. **Clone the Repository:**
    ```bash
    git clone https://github.com/pradunya-s/account-management.git
    ```

2. **Navigate to the project directory:**
    ```bash
    cd account-management
    ```

3. **Install Dependencies:**
    Run the following command to install all the dependencies via Composer:
    ```bash
    composer install
    ```

4. **Set Up the Environment File:**
    Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

5. **Generate Application Key:**
    Laravel requires an application key, which can be generated using the Artisan command:
    ```bash
    php artisan key:generate
    ```

6. **Set Up the Database:**
    - Create a database in MySQL (or your chosen database).
    - Update the `.env` file with the correct database credentials:
      ```env
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_database_password
      ```

7. **Run Migrations:**
    Run the database migrations to create the necessary tables:
    ```bash
    php artisan migrate
    ```

8. **Seed the Database (optional):**
    If you want to seed your database with some default values, you can run:
    ```bash
    php artisan db:seed
    ```

9. **Start the Development Server:**
    You can now start the Laravel development server:
    ```bash
    php artisan serve
    ```

    Your application will be available at `http://localhost:8000`.

## API Documentation

### 1. **Login**
**Endpoint**: `POST /api/login`

**Request Body**:
```json
{
  "email": "user@example.com",
  "password": "password"
}
RESPONSE - {
  "token": "your_generated_api_token"
}

### 2. **Create Account**
**Endpoint**: `POST /api/accounts`

{
  "account_name": "Test Account",
  "account_type": "Personal",
  "currency": "USD",
  "balance": 1000,
  "account_number": "123456789012"
}

RESPONSE - {
  "id": 1,
  "account_name": "Test Account",
  "account_type": "Personal",
  "currency": "USD",
  "balance": 1000,
  "account_number": "123456789012",
  "user_id": 1
}
### 3. **Get Account Details**
**Endpoint**: `/api/accounts/{account_number}`

RESPONSE - {
  "id": 1,
  "account_name": "Test Account",
  "account_type": "Personal",
  "currency": "USD",
  "balance": 1000,
  "account_number": "123456789012",
  "user_id": 1
}
### 4. **Update Account**
**Endpoint**: `/api/accounts/{account_number}`
BODY JSON - {
  "account_name": "Updated Account",
  "account_type": "Business",
  "currency": "USD",
  "balance": 1500
}

RESPONSE - {
  "id": 1,
  "account_name": "Updated Account",
  "account_type": "Business",
  "currency": "USD",
  "balance": 1500,
  "account_number": "123456789012",
  "user_id": 1
}

### Log Transaction ###
**Endpoint**: `POST /api/transactions`
BODY JSON - {
  "account_number": "123456789012",
  "amount": 500,
  "transaction_type": "credit"
}

RESPONSE - {
  "id": 1,
  "account_number": "123456789012",
  "amount": 500,
  "transaction_type": "credit",
  "created_at": "2025-03-28T12:34:56"
}

### GET TRANSACION ###
**Endpoint**: `GET /api/transactions?account_number=123456789012`

RESPONSE - [
  {
    "id": 1,
    "account_number": "123456789012",
    "amount": 500,
    "transaction_type": "credit",
    "created_at": "2025-03-28T12:34:56"
  },
  {
    "id": 2,
    "account_number": "123456789012",
    "amount": 200,
    "transaction_type": "debit",
    "created_at": "2025-03-29T12:34:56"
  }
]
