<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>PPS | @yield('title')</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.css"/>

@yield('style')

<!-- Styles -->
<style>
    html,
    body {
        color: white;
        font-family: 'Raleway', sans-serif;
        min-height: 100%;
    }

    body {
        background-size: cover;
        background-color: #627eb9;
        background-repeat: no-repeat;
    }


    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #fff;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .form-control {
        background-color: rgba(0, 0, 0, 0);
        color:white;
        border-left: 0;
        border-right: 0;
        border-top: 0;
    }
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {   
    border-color: rgba(0, 0, 0, 0.8);
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-bottom: white;
    box-shadow: 0 4px 2px -2px white;
    outline: 0 none;
    background-color: rgba(0,0,0,0);
    color: white;
    }

    .navbar {
        background-color: rgba(0, 0, 0, 0);
    }
    a, #btnReg, #btnForgot {
        color: white;
    }

    *::-webkit-input-placeholder {
        color: black!important;
    }
    *:-moz-placeholder {
        /* FF 4-18 */
        color: black!important;
    }
    *::-moz-placeholder {
        /* FF 19+ */
        color: black!important;
    }
    *:-ms-input-placeholder {
        /* IE 10+ */
        color: black!important;
    }

    img {
        image-rendering: crisp-edges;
        transition: transform .2s;
    }

    img:hover {
    transform: scale(1.1);
    }

    h1 {
        font-size: 60px;
    }

    .card {
        background-size: cover;
        background-color: #8798bd;
        background-repeat: no-repeat;
        -webkit-box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
        -moz-box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
        box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
    }

    .modal-content {
        background-size: cover;
        background-color: #8798bd;
        background-repeat: no-repeat;
    }

    #loginlogo {
        margin-top: -80px;
        width: 120px;
        -webkit-box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
        -moz-box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
        box-shadow: 1px 11px 22px -2px rgba(0,0,0,0.54);
        border-radius:100px;
    }

    #submitbtn {
        border-radius: 50px;
    }

    #navitem {
        color:white;
    }

    hr {
        background-color: #dcdcdc;
        margin-top: 40px;
    }

</style>