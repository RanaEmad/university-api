# University API
A simple Laravel microservice that enables students to register, login, view courses and enroll in courses.

# System Requirements
In order to get this application up and running you need to have the following installed on your environment:
- Git
- Composer
- Vagrant 2.1.1 or higher
- Homestead
- SSH public and private key


# Installation  
- Clone this repository in your desired folder
- Update the Homestead.yaml file located in the root folder with your SSH key path and map your current folder's path correctly
- Update the .env.example file located in the root folder with your database credentials if different, then rename the file to .env
- Run ```composer install``` command to get the project dependencies
- Run ```vagrant up``` command to start the environment
- Run ```vagrant ssh``` command to connect to the folder on the guest machine
- Cd into the code folder
- Run ```php artisan migrate --seed``` command to set the database
- Run ```php artisan passport:install ``` command to add clients to the databse
- Run ```php artisan serve``` command to start the application
- Use the stated link in the command line as the base URL to call the endpoints mentioned in the Endpoints section
- In case you want to run the available feature tests you can open another command line and run ```phpunit``` command

# Endpoints
A Postman public documentation for the endpoints collection can be found here:
https://documenter.getpostman.com/view/8472194/SVfGzCRX

- All endpoints respond with a JSON object including a "result" key indicating whether the call was a success or failed
- The following endpoints are public and do not need authorization:
  - POST /api/students
  - POST /api/login
- The following endpoints need an authorization header with a bearer token attached in the request to be implemented:
  - GET /api/courses
  - POST /api/registrations

 

## Author

* **Rana Emad**  - (https://github.com/RanaEmad)

## License

This project is licensed under the MIT License
