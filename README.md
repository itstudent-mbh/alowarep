## Aloware Test project

This is test progect for Aloware Company 

Create a comment system single-page web application using a framework of choice (preferably Laravel 5.5+) and VueJS / React with the following requirements:

Assume that there is only one Blog Post that can be commented on.
Only the user’s name and comment text are required to post a comment.
A comment can be replied to with another comment.
Nested comments are up to 3 layers only
The page should not refresh when posting a comment.
Comments must be ordered by the latest.
Make the user interface as beautiful, responsive, and easy to use as you can.
Use MySQL database for storing your data.
No need to edit, delete, etc of comments.
What we are looking for:

Optimal code that is clean and maintainable.
Business logic organization and software design patterns.
Optimized SQL performance.
Documentation.
Unit tests.
Important notes:

Start an empty repository in GitHub, commit the base Laravel to the master branch and then start work. (so when we read your code, we can separate it from framework base code).

Don’t make the project complicated; there is no need for user login, live broadcasting, and notifications.

You don’t need to create a User and Post model.

## install and run Project

1. run composer install
2. config .env and mysql connection
3. run php artian serve 
4. run php artisan migrate
5. run npm install
6. run npm run watch
7. open http://127.0.0.1:8000/post/1 in your browser 

