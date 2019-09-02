# Shopping App

[![pipeline status](https://gitlab.com/jhm-ciberman/shopping-app/badges/master/pipeline.svg)](https://gitlab.com/jhm-ciberman/shopping-app/commits/master)

Project created for the Web Programming Assignment for FASTA University, Mar del Plata, Argentina by Javier "Ciberman" Mora. 

Developed ussing the Laravel Framework.



## Setup

Clone the repository and: 

```bash
# Install dependencies
composer install
npm install

# Configure environment variables
# Make sure to edit your .env file with your local DB passwords and your APP_URL
cp .env.example .env

## Generate a new APP_KEY (for encrypting cookies)
php artisan key:generate

# Build frontend in development mode
npm run dev
```

## Testing

```bash
phpunit
```