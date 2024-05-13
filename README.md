# How to install

1. Clone the repository
2. Copy the `.env.example` file to `.env` and update the database credentials (in /application/config)
3. Make sure you have docker installed
4. Run the following command in the root directory of the project

```bash
docker-compose build && docker-compose up
```

5. Open phpmyadmin in your port 8080 and create db `jobseeker` and import the jobseeker.sql file
6. Open your browser and go to `http://localhost/jobseeker/`
7. Please login using the following credentials:
   - email: test@mail.com
   - Password: test123
