# Documentation

This is just a Simple Comment System for demonstration purposes

## How to run this project

### Requirements

1. PHP 8+
2. Composer
3. MySQL
4. NodeJS 16+
5. npm 9+

### Procedure

1. Clone this repository to your local machine.
2. Go to the directory and run ``` composer install ```.
3. Then ``` npm install ```.
4. To make sure the javascript resources are compiled, run ``` npm run build ```.
5. Or you can run ``` npm run dev``` to use the development version.
6. Now, copy the ```.env.example``` file, and adjust it to your computer configuration. It's especially important to
   adjust the database configurations.
7. Don't forget to set APP_KEY with some random string or wait for laravel to generate one for you during the first access.
8. Create a database in MySQL and name it ```comment_system```.
9. Run ``` php artisan migrate:fresh --seed``` to create the database tables and apply seed data.
10. Serve the application by using ``` php artisan serve ```.
11. The application will be available through your browser at ```http://localhost:8000```
12. The home page shows the list of posts, in our case only one post is displayed and it is hardcoded.
13. Click on the post title to see the comments.
14. You should see some comments already, because the database is seeded with some data.
15. You can add a comment by clicking on the ```Post Comment``` button.
16. You can reply to a comment by clicking on the ```Reply``` button on the comment.
