# Create a new project using composer

```
composer create-project laravel/laravel task-list
```

The option `laravel/laravel` installs a lot of boilerplate code used in the project.

# Start the server

```
php artisan serve
```

# A note about `artisan`
In Laravel, an artisan is the command-line interface (CLI) tool that comes bundled with the framework. It provides various helpful commands to assist with tasks like application setup, database migration, managing assets, generating code, and performing other routine development tasks. Artisan commands are designed to streamline the development process and improve the overall developer experience.

Some common use cases of Artisan commands in Laravel include:

1. **Database Migrations:** Laravel's migration system allows you to manage your database schema using PHP code. Artisan provides commands to create, run, and rollback database migrations, making it easy to manage changes to your database structure.

2. **Model and Migration Generation:** Artisan can generate boilerplate code for database tables (migrations) and Eloquent models, reducing manual effort and potential errors.

3. **Generating Controllers:** You can create new controllers with predefined methods and functions using Artisan, saving time when building the application's logic.

4. **Task Scheduling:** Laravel includes a task scheduler that allows you to run commands at specified intervals. Artisan provides commands to manage scheduled tasks and automate various processes.

5. **Creating Custom Artisan Commands:** Developers can create their own custom Artisan commands to perform specific tasks unique to their application. This is particularly useful for automating repetitive tasks or building custom functionalities.

6. **Clearing Caches:** Artisan commands are available to clear various types of caches, such as the application cache, view cache, route cache, and more.

7. **Optimizing Assets:** Laravel includes commands to optimize and compile assets like JavaScript and CSS files, making your application more efficient and responsive.

8. **Running Tests:** Artisan provides commands to run PHPUnit tests, making it easier to perform automated testing and ensure the quality of your code.

To use an Artisan command, you typically open your terminal or command prompt, navigate to your Laravel project directory, and execute the desired command using the `php artisan` syntax. For example, to create a new migration, you might run `php artisan make:migration CreateUsersTable`.

Artisan significantly enhances the development experience in Laravel by automating repetitive tasks and providing a consistent and efficient way to manage various aspects of your application. It's a powerful tool that helps developers work more efficiently and maintain a well-structured and robust Laravel application.

# All about routing, mostly `get` at this point

Routes in Laravel provide a way to define how the application responds to incoming HTTP requests. They play a crucial role in mapping URLs to specific actions or controllers in your application. Routes are an essential component of building web applications using the Laravel PHP framework. Here's a summary of key points about routes in Laravel:

1. **Definition:** Routes are defined in the `routes` directory of a Laravel application. They are typically located in the `web.php` file for web routes and the `api.php` file for API routes.

2. **HTTP Verbs:** Routes can be associated with different HTTP verbs, such as GET, POST, PUT, DELETE, etc. Each HTTP verb corresponds to a specific type of request.

3. **Route Parameters:** Routes can include parameters that capture dynamic segments of the URL. These parameters can be accessed in controllers or closures to process the request.

4. **Named Routes:** Routes can be assigned names, making it easier to generate URLs for specific routes using Laravel's route helper functions.

5. **Middleware:** Middleware can be applied to routes to add layers of functionality before or after the request is handled. Middleware can handle tasks like authentication, authorization, logging, etc.

6. **Route Groups:** Routes can be grouped together to apply shared attributes, such as middleware or namespace prefixes, to a set of routes.

7. **Route Caching:** To improve application performance, Laravel allows you to cache your routes. This precompiles the route definitions, leading to faster routing lookups.

8. **Closure Routes:** You can define routes using closures, which are inline functions that directly handle the request. Closures are useful for quick route definitions.

9. **Controller Routes:** Most often, routes are associated with controller methods. Controllers help organize application logic and keep routes clean and concise.

10. **Resourceful Routing:** Laravel provides resourceful routing, which automatically generates routes for CRUD operations on resources, such as models or database tables.

11. **Route Model Binding:** Laravel supports automatic model binding, which allows you to inject models directly into controller methods based on route parameters.

12. **Route Prefixes and Namespaces:** You can group routes under a common prefix or namespace to organize them and avoid naming conflicts.

13. **Fallback Routes:** Fallback routes handle requests that do not match any defined routes, allowing you to show custom error pages or handle redirections.

14. **Route URL Generation:** Laravel provides helper functions to generate URLs for named routes, making it easy to link to different parts of your application.

15. **API Routes:** Separate from web routes, API routes in Laravel are typically used to define endpoints for RESTful APIs, and they often use stateless authentication mechanisms like tokens.

Laravel's routing system provides a flexible and powerful way to define the behavior of your application in response to various HTTP requests. It encourages clean and organized code while allowing developers to create dynamic and interactive web applications.

## Routes following the Udemy course
The first route for the `root` route is, that can be accessed at e.g. `localhost:8000`:
```php
Route::get('/', function () {
    return 'Main page';
});
```

We can specify many different routes, e.g. `hello`, that can be accessed at `localhost:8000/hello`:
```php
Route::get('/hello', function () {
    return 'Hello';
});
```
A route can also be dynamic, with user specified parameters:

```php
Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});
```

We can redirect routes:
```php
Route::get('/hallo', function () {
    return redirect('/hello');
});
```

You can list all routes with the artisan CLI-command:
```
task-list git:(main) ✗ php artisan route:list

  GET|HEAD   / .......................................................................................................... 
  POST       _ignition/execute-solution ... ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD   _ignition/health-check ............... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST       _ignition/update-config ............ ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD   api/user ................................................................................................... 
  GET|HEAD   greet/{name} ............................................................................................... 
  GET|HEAD   hallo ...................................................................................................... 
  GET|HEAD   hello ...................................................................................................... 
  GET|HEAD   sanctum/csrf-cookie ...................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show

                                                                                                       Showing [9] routes
```

Some of the routes have names.

To give a name to a route, you can add a name method:
```php
Route::get('/hello', function () {
    return 'Hello';
})->name('route-hello');
```

The new route-list is:
```
GET|HEAD   / .......................................................................................................... 
  POST       _ignition/execute-solution ... ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD   _ignition/health-check ............... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST       _ignition/update-config ............ ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD   api/user ................................................................................................... 
  GET|HEAD   greet/{name} ............................................................................................... 
  GET|HEAD   hallo ...................................................................................................... 
  GET|HEAD   hello .......................................................................................... route-hello
  GET|HEAD   sanctum/csrf-cookie ...................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show

                                                                                                       Showing [9] routes
```
and its clear that we have named a route. Now we can (but not have to) modify:
```
Route::get('/hallo', function () {
    //return redirect('/hello');
    return redirect()->route('route-hello');
});
```

Now, if the route `/hello` changes, we can still access it with the route name `route-hello`. This makes life easier when the project becomes big, and have to be refactorized.

We can add a fallback-route, for wrong or missing routes:
```php
Route::fallback(function () {
    return 'Page not found';
});
```

# Blade templates

Laravel Blade is a powerful templating engine provided by the Laravel PHP framework. It allows developers to write clean and expressive templates for their web applications. Blade templates provide a way to separate the presentation layer from the application logic, enhancing code maintainability and readability.

Here's an introduction to some key features and concepts of Laravel Blade:

1. **Template Inheritance:**
   Blade supports template inheritance, allowing you to create a master layout (parent template) with placeholders for dynamic content. Child templates can extend the master layout and fill in the specific content for each page. This promotes code reusability and a consistent layout across your application.

2. **Extensive Control Structures:**
   Blade provides various control structures like loops (`@foreach`, `@for`, `@while`), conditionals (`@if`, `@else`, `@elseif`, `@unless`), and more. These control structures enable you to conditionally render content and iterate over data without cluttering your templates with PHP logic.

3. **Including Sub-Views:**
   You can include sub-views or partials using the `@include` directive. This helps in modularizing your templates and reusing components across multiple views.

4. **Components and Slots:**
   Blade components allow you to encapsulate reusable UI elements along with their logic. Slots within components enable you to inject dynamic content into specific sections of the component template.

5. **Rendering Variables:**
   Blade makes it easy to output variables within your templates using the `{{ $variable }}` syntax. This automatically escapes the content to prevent cross-site scripting (XSS) attacks.

6. **Escaping and Unescaping:**
   Blade provides different ways to escape and unescape content to ensure secure output. You can use `{{ }}` for escaped output and `{!! !!}` for unescaped output.

7. **Comments and Directives:**
   Blade allows you to add comments using the `{{-- Comment here --}}` syntax. Directives like `@section`, `@yield`, `@extends`, and `@inject` facilitate template organization and dynamic content insertion.

8. **Localization:**
   Blade templates support localization and translation using the `@lang` directive. This makes it easier to create multi-language applications.

9. **Custom Directives:**
   You can define custom Blade directives to encapsulate specific functionality within your templates, enhancing code readability and reusability.

10. **Caching:**
    Blade templates can be compiled and cached, resulting in faster rendering times for frequently accessed views.

Laravel Blade simplifies the process of creating dynamic and interactive web pages while maintaining separation between PHP logic and presentation. Its intuitive syntax and features help developers create elegant and maintainable templates for their Laravel applications.

# Creating a view in Laravel using Blade
In Laravel, adding a view involves creating a Blade template file that defines the HTML structure and presentation of a specific page or component in your web application. Views allow you to separate your application's presentation logic from the underlying code, promoting better organization and maintainability. Here's how you can add a view in Laravel:

1. **Create a Blade View:**
   Blade views are typically stored in the `resources/views` directory of your Laravel project. To create a new view, follow these steps:

   a. Open your terminal or command prompt.
   b. Navigate to your Laravel project directory using the `cd` command.
   c. Use the `touch` command to create a new Blade view file. For example, to create a view called `welcome.blade.php`, run:

      ```sh
      touch resources/views/welcome.blade.php
      ```

2. **Edit the View File:**
   Open the newly created Blade view file (`welcome.blade.php`) in a code editor of your choice. Inside this file, you can write your HTML code and include Blade directives to dynamically generate content.

   For example, a simple Blade view might look like this:

   ```html
   <!DOCTYPE html>
   <html>
   <head>
       <title>Welcome Page</title>
   </head>
   <body>
       <h1>Hello, {{ $name }}</h1>
   </body>
   </html>
   ```

   In this example, the `{{ $name }}` syntax is a Blade directive that outputs the value of the `$name` variable passed to the view.

3. **Pass Data to the View:**
   In your Laravel application, you can pass data to views from your controllers. To do this, open the controller method that corresponds to the view and use the `view()` function to pass data. For example:

   ```php
   public function welcome()
   {
       $name = 'John';
       return view('welcome', ['name' => $name]);
   }
   ```

   In this example, the `welcome()` method passes the `$name` variable to the `welcome.blade.php` view.

4. **Render the View:**
   To render the view and display it in the browser, you need to access the corresponding route that triggers the controller method. For example, if you have a route defined in the `web.php` routes file:

   ```php
   Route::get('/welcome', 'YourController@welcome');
   ```

   Accessing `/welcome` in your browser will trigger the `welcome()` method in the specified controller and render the `welcome.blade.php` view.

Views in Laravel allow you to create dynamic, reusable, and maintainable templates for your web application's user interface. By separating the presentation logic from the underlying code, you can build clean and organized applications that are easier to manage and extend.

## Blade Templates following the Udemy course
Add a view with a parameter `message` in `routes/web.php`:
```php
// Route to the root of the application
Route::get('/', function () {
    return view('index', ['message' => "Hello, from Blade Template"]);
});
```
We passed a second argument `'message'` to the view function.

The content of the view `index` is assumed to be contained in the Blade Template file: `resources/views/index.blade.php`:
```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @isset($message)
        <p>Message from Backend: {{ $message }}</p>
    @endisset
</body>

</html>
```
The variable `$message` must match the passed second argument in the view function in `web.php`. If we don't use the directive `@isset($message)`, then it has to be passed, or we get an error. When a template is defined for only a specific route, then its not necessary to do all those checks, but if we use a generic template with many variables, then one should.

# Template inheritance

Template inheritance is a fundamental concept in web development and is particularly prominent in modern web frameworks like Laravel. It allows you to create a consistent layout for your web pages by defining a master template that serves as a framework for your application's various pages.

In the context of Laravel, template inheritance is implemented using a feature called Blade templates. Blade is Laravel's templating engine, which provides a simple and elegant way to create dynamic, reusable, and structured views.

Here's how template inheritance works in Laravel using Blade templates:

1. **Creating a Master Template (Layout):** In your Laravel application, you typically start by creating a master template or layout that defines the overall structure of your web pages. This layout contains the common HTML structure, such as the `<html>`, `<head>`, and `<body>` elements. It may also include common elements like navigation menus, headers, footers, and any other sections that appear consistently across your application.

   For example, you could create a file called `layout.blade.php`:

   ```html
   <!DOCTYPE html>
   <html>
   <head>
       <title>@yield('title')</title>
   </head>
   <body>
       @yield('content')
   </body>
   </html>
   ```

2. **Extending the Master Template:** To create specific pages within your application, you extend the master template by creating child templates that inherit from the master layout. These child templates represent individual pages and can override or extend specific sections of the master template as needed.

   For instance, you might create a file called `home.blade.php`:

   ```html
   @extends('layout')

   @section('title', 'Home')

   @section('content')
       <h1>Welcome to our website!</h1>
       <p>This is the home page content.</p>
   @endsection
   ```

3. **Defining Content Sections:** In the master layout, you use the `@yield` directive to define sections where the content from the child templates will be inserted. In the child templates, you use the `@section` directive to define the content for each section.

   In the example above, `@yield('title')` and `@yield('content')` are placeholders for the title and content sections, respectively. The `@section('title')` and `@section('content')` directives in the child template correspond to these placeholders.

4. **Rendering the Final Page:** When you render a specific page using Laravel's routing system, the content from the child template is inserted into the corresponding sections of the master template. This allows you to maintain a consistent layout while customizing the content for each page.

   For instance, when you access the route that corresponds to the `home.blade.php` template, Laravel combines the content from `home.blade.php` with the master layout defined in `layout.blade.php`, resulting in a complete HTML page.

Template inheritance simplifies the process of creating and maintaining a consistent user interface across your web application. It promotes code reusability, makes it easier to manage changes to common elements, and enhances the overall development workflow.

# Running a SQL database with brew
I already have mysql installed with brew on Mac, and its server can be started by:
```
brew services start mysql
```
Then I can start a mysql client:
```
mysql -uroot -p
```

I can use this database in laravel, by changing the `.env` file in the project root-directory. It is mainly the root password that has to be changed, and the name of the database.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task-list
DB_USERNAME=root
DB_PASSWORD="<password>"
```

In order to create (or migrate) the database, we can use:
```
php artisan migrate
```
and you will be prompted to create a new database.

Next we want to create a new table that corresponds to the model Task in laravel. This can be done with:
```
php artisan make:model Task -m
```

We get a new migration file, which is edited to add the different columns in the table:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Add entries here after created this file with
            // php artisan make:model Task -m
            $table->string('title');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->boolean('completed')->default(false);
            // End of entries

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
```

## Factories and seeders
In order to fill the databases with something, we can use Factory methods.
The boilerplate code already contains a user, and its factory:
```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
```

The name of the class should match the table we are interested in.

The seeder function can be modified to add arbitrary elements in tables:
```php
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
```

After running
```
php artisan db:seed
```
the content in task-list:users, are
```
+----+------------------------+-----------------------------+---------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
| id | name                   | email                       | email_verified_at   | password                                                     | remember_token | created_at          | updated_at          |
+----+------------------------+-----------------------------+---------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
|  1 | Etha Schinner          | gerhold.rae@example.net     | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | njwn7L6gQI     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  2 | Jordy Hyatt            | fatima84@example.net        | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | 0FXpjkA2S7     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  3 | Janiya Lakin           | anais.mcclure@example.net   | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | wEz9GcxptE     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  4 | Ruth Cruickshank       | boyle.marlene@example.com   | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | HcR93gOxDc     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  5 | Mrs. Alayna Legros     | johnson.stanton@example.net | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | KGe4AkMOtV     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  6 | Mrs. Dominique Kautzer | carolina27@example.net      | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | ySYWgF7lhE     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  7 | Sonya Steuber          | myles11@example.org         | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | juvRy2DXtW     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  8 | Ms. Aaliyah Wisozk V   | nbartoletti@example.org     | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | B3LukOUxR3     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
|  9 | Sonia Upton            | effertz.chaim@example.org   | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | GbPIm35pax     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
| 10 | Miss Zetta Johns PhD   | auer.adalberto@example.org  | 2023-08-16 19:11:19 | $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi | K1habo2T6E     | 2023-08-16 19:11:19 | 2023-08-16 19:11:19 |
+----+------------------------+-----------------------------+---------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
```

## TaskFactory creation
In order to create a Factory for the Task model, we can use the artisan CLI-command:
```
php artisan make:factor TaskFactory --model=Task
```

This create an empty `TaskFactory`, that we will have to fill:
```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Here are the fake definitions for the Task model
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'long_description' => fake()->paragraph(7, true),
            'completed' => fake()->boolean
        ];
    }
}
```

To add fake data, you can write:
```
php artisan db:seed
```
as before.

If you want clean data, from scratch, you can use:
```
php artisan migrate:refresh --seed
```

# Artisan make request, with validation
```
php artisan make:request TaskRequest
```
