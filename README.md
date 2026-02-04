## How to run the project locally
## composer install
## copy .env example to a new file and name it .env with your local db configuration
## php artisan db:seed (to seed a test data for database)
## php artisan serve (to run your local server)
## for postman test use School Management
----------------------------------------------------
## Project Structure
## Project is made by action + repository + strategy design patterns
## every model has folder inside actions with all it's crud operations
## routes are separated for each api version , admin , student routes are separated and separating each models routes into separate files and admin route files is included in admin.php and student in student.php and both invoked in api.php 
## separation by student/admin by role field inside users table 
------------------------------------------
## for postman testing use School Management System API.postman_collection inside public folder 
## Best Regards ! Ahmed Emad <3