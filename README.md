## <h2>About Application</h2>

application with which we can create a CV (curriculum vitae), using a user-friendly interface that provides the ability</br>
to supply the application with input data by filling in the fields and clicking the execution button.


## Install Packages

https://packagist.org/packages/barryvdh/laravel-dompdf </br>
composer require "ext-gd:*" --ignore-platform-reqs </br>

## Files

config/app.php </br>
routes/web.php </br>
app/Http/Controllers/PDFController.php </br>
app/Services/FileService.php </br>
resources/views/pdf/.* </br>
resources/views/pdf/cv/.* </br>
public/pictures/cv/.* (jpeg,png,jpg,gif) </br>
public/styles/pdf.css </br>

## run application

go to terminal (cmd).</br>
next enter appropriate path where is source application, and then run command: <b>npm run dev</b></br>
next run other window terminal (cmd) this command (this command should start the server): <b>php artisan serve</b></br>
Now enjoy it.

## start application

open this url in a browser:</br>
http://127.0.0.1:8000/create-pdf
