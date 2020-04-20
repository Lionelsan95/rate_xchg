# rate_xchg
Applications that integrate rate exchange from European Central Bank API, and manage cache with Redis

Requirement : 
- php >=v7.3.11
- mysql >=v5.0.*
- Install Redis on your computer 

To launch the application : 

1. Open your terminal and clone this repository locally
2. Verify that your redis-server is launched 
3. update composer
    - composer self-update
4. install dependencies
    - composer install
5. create database 
    - ./bin/console doctrine:database:create
6. create tables
    - ./bin/console make:migration
    - ./bin/console doctrine:migrations:migrate
7. launch the server
    - symfony server:start
8. open your navigator and launch
    - http://localhost:8000/transaction
