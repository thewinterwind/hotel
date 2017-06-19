<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('titles.' . $viewName) }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/vendor/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <link href="/css/monthly.css" rel="stylesheet" type="text/css">
        <link href="/css/global.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        @yield('content')
        <div id="scripts">
            <script src="/js/jquery.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
                    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
            </script>
            <script src="/vendor/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>
            <script src="https://unpkg.com/vue@2.3.4"></script>
            <script src="/js/monthly.js"></script>
            <script src="/js/global.js"></script>
        </div>
    </body>
</html>