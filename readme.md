# Sample Hotel Application

- `cp .env.example .env`
- Create an MySQL database called `rooms` and add this into .env file (ensure DB creds are correct)
- `composer install`
- `php artisan migrate --seed`

# Running Tests
- `vendor/bin/phpunit`

# Resetting the migrations
- `php artisan migrate:refresh --seed`

# Notes on test project
- Contains migrations and seeds
- Containts unit tests that would run on a test DB and uses transactions
- Uses a repository pattern but without the interfaces. I could have added them but felt it unnecessary for this project. Regardless of whether the repos use interfaces or not, I view them as a business data layer for the application.
- Did not use a CSS pre-processor for this such as SASS. Let me know if it's necessary for this and I can add it in. I will always use one in real projects.
- Was planning to use Vue.js but it didn't work out due to the calendar's html being within the plugin and I didn't want to spend more time to edit the plugin files. However JS frameworks with two-way data-binging like Vue.js are excellent but I didn't really get a chance to use it here.
- I used Bootstrap to demonstrate my ability to create responsive sites. The layout is responsive but the site would need more code to get the calendar working on smaller devices.
- Helper classes in `app/Helpers`
- Repo in `app/Repos`
- Unit Tests in `tests/Unit/App/Repos`
- Seeds/Migrations in `database` folder

# Plugin bug
- I discovered at the end there's a bug in the plugin when going to previous/next months, so I hid the buttons as I've already put a lot of time on this. I hope what I have here is enough :)
