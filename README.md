# Shopping App

[![coverage report](https://gitlab.com/jhm-ciberman/shopping-app/badges/master/coverage.svg)](https://gitlab.com/jhm-ciberman/shopping-app/commits/master)

Project created for the Web Programming Assignment for FASTA University, Mar del Plata, Argentina by Javier "Ciberman" Mora. 

Developed ussing the Laravel Framework.



## Setup

Clone the repository and: 

```bash
# Install dependencies
composer install
npm install

# Configure environment variables
# Make sure to edit your .env file with your local DB passwords
cp .env.example .env       

# Build frontend in development mode
npm run dev            
```

## Testing

```bash
phpunit
```