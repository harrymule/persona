## PERSONA APP (Laravel VueJS Inertia TailwindCSS Application)

This is a simple Laravel VueJS Inertia TailwindCSS application that allows users to log in, register, and update their details. The application also allows users to generate API tokens for use with the API.

## Features
- **User authentication (login and registration)**
- **User profile management (update name, email, and password)**
- **API token generation and management**


## Technologies Used
- **Laravel 10**
- **InertiaJS**
- **VueJS 3** 
- **TailwindCSS**


## Installation
  1.Clone the repository
  2.Install dependencies by running composer install and npm install
  3.Set up your environment variables in the .env file from the .env.example file.
  4.Configure your database by setting up a new database, creating the necessary tables, and ensuring that the database credentials are set correctly in the .env file.
  5.Run migrations and seed the database by running php artisan migrate --seed
  6.Compile assets for production by running npm run production or for development npm run dev
  7.Serve the application by running php artisan serve or if your using laragon you can use [app folder name].test eg persona.test


## Usage
Visit the application homepage to log in or register
Once logged in, you will see "Profile" info and two buttons update details and change password
you can update your details or change password on the home page
Contributing
Feel free to contribute to this project by submitting a pull request. Please ensure that your code follows the PSR coding standards, and include tests where applicable.

## Api Usage
- **See API.MD file**

## License
This application is open-sourced software licensed under the MIT license.

## Contact
If you have any questions or feedback, please feel free to contact me at [harrisonmule@gmail.com] or [info@harrymule.com]
