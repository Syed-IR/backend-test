## Instructions

Laravel v10.34.2
PHP v8.2.12

new sources config file
`app\config\newsSources.php`

Run migrations
`php artisan migrate`

Populate categories
`php artisan db:seed`

> Note: Since we are using developer account for each source, it would be better to limit the category to 5 at `line 23` in `ArticleService::dailyUpdate()` before running the scheduler
> 
Run scheduler
`php artisan schedule:run`

`$schedule->command(UpdateNewsCommand::class)->daily()->withoutOverlapping();`

## Swagger Api Docs
`http://localhost/apidocs#/`
