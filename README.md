# Health Information System

A RESTful API and frontend for managing health programs and clients.

## Features
- Create health programs (e.g., TB, Malaria, HIV).
- Register and manage clients.
- Enroll clients in programs.
- Search clients with fuzzy matching.
- View client profiles with enrolled programs.
- Secure API with token-based authentication.
- Audit logging for actions.

## Setup
1. Clone the repo: git clone https://github.com/Mishen-Anami/health-system.git
2. Install dependencies: composer install
3. Configure .env with database and Sanctum settings.
4. Run migrations: php artisan migrate
5. Seed database: php artisan db:seed
6. Start server: php artisan serve
7. Access frontend at https://lifthawklogistics.africa/healthSystem/public/index.html

## API Documentation
- Available at (http://localhost:8000/api/documentation) (Swagger).

## Testing
- Run tests: php artisan test

## Security
- Input validation via Laravel Form Requests.
- Token-based authentication with Sanctum.
- Audit logging for critical actions.

## Demo
Watch the prototype demo: [https://www.youtube.com/shorts/xjUHweFZ0gk?feature=share]