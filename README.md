# Chat App Assignment

This project was developed as part of an assignment of my application as a backend engineer at Bunq. The assignment is to build  a simple chat application backend in PHP.

## Demo
The project has been deployed on Heroku and is live [here](https://chat-app-assignment.herokuapp.com/). To look at an existing user that has sent and received messages, use: `john.doe` as the username with the password `secret123`.

## Approach
The app is based on Laravel 7.2. The reason for this is because of the framework already includes vast array of defined classes and functions and allows for writing in elegant syntax. It also facilitates user authentication which makes for a faster development of a project. The final product is a messaging system that allows each user to exchange messages with any other user in the system.

### Components
* **ORM Models**: the app has two models `User` and `Message`, each of which is identified with a unique ID. Each `Message` is related to two different `User` objects, acting as the author and recipient of the message.
* **Controllers**: each model has its own controller, `UserController` and `MessageController`, that interacts with the repository classes. They contain the logic of the system.
* **Repositories**: the repository classes `UserRepository` and `MessageRepository` interacts directly with the database. The functions that make a query to the database are defined here.
* **Resources**: the resource classes are defined for both models as well their relationship to other models. These classes were built such that the JSON response would comply with the standard [JSON:API](https://jsonapi.org/) specification. However, these classes are not actually implemented in the controllers yet, to allow for a simpler data handling on the front-end.
* **Database**: the main tables in the database are `users` and `messages`. The database is configured with SQLite for local development and with [MySQL](https://elements.heroku.com/addons/cleardb) on the Heroku deployment. Seeder classes have been defined, which can be used during a local run to test the system.

### API Routes
There are four defined routes for storing and viewing of the data. These four are defined specifically to provide the data necessary in the front-end view. All the `GET` routes provide a response in JSON.

* `api/messages/` : `POST` route to create and save a new `Message` in the database. The request must contain three keys. 
    - `author` that contains the ID of the user sending the message
    - `recipient` that contains the ID of the user receiving the message
    - `content` that contains the content of the message.
* `api/messages/{user1}/{user2}`: `GET` route to retrieve all messages exchanged between two users. The route takes two parameters, the ID of the two users.
* `api/messages/{user}`: `GET` route to fetch the last messages exchanged by a given user and any other user in the database. The purpose of this route is to display an inbox view, typical in a messaging app. The route takes one parameter, the ID of the user.
* `api/users/{user}/contact`: `GET` route to fetch all users in the system excluding the given user. The route takes one parameter, the ID of the user.


### Front-end
Although it wasn't a requirement, the project is a full stack application that includes a front-end development. It utilizes the Vue.js framework. A request is made by a Vue component to retrieve the messages every 5000 ms.


## Running the project locally
### Prerequisites
* Composer
* PHP 7.4
* SQLite

### Setup

Run the following commands.

```
./setup.sh
php artisan serve
```

The setup file includes commands to install the required packages, set the environment variables, create the database tables and seed them with a sample data. Note: since this repository contains precompiled UI components, it's not necessary recompile everything using `npm` unless changes are made.

Go to `localhost:8000` to open the application.