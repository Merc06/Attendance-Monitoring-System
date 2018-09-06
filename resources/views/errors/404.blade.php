<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('partials._head')

</head>
<body>

    <div class="container">
        <div class="wrapper">
            <h2>OOPS... PAGE NOT FOUND!</h2>
            <h1>ERROR 404</h1>
            <button onclick="history.go(-1);" class="btn btn-outline-light">GET BACK!</button>
        </div>
    </div>

</body>
</html>