## Instructions

`Laravel v10.34.2`
`PHP v8.2.12`

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

The scheduler is set in a way that it'll data of current date, if you want to get data of another date then edit `line 42` in `HttpService::prepareUrl`

> Since this is a pilot project data duplication prevention is not addressed

## Swagger Api Docs
`http://localhost/apidocs#/`
