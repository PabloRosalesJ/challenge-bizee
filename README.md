# Run
docker-compose up --build -d

### Configure passport
docker-compose exec app php artisan passport:install
docker-compose exec app chown www-data: storage/oauth-*.key

# Database credentials
- DB_HOST=db
- DB_PORT=6379
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=root
- REDIS_HOST=redis

# App config (.env)
Edit the vars:

- QUEUE_CONNECTION=redis
- ADMIN_EMAIL=
- LIMIT_OF_COMPANIES_ASSIGNED_TO_AN_AGENT= -> (X%)


# Api Docs
The API documentation is located in the ./api folder