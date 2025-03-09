<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body>

    <style>
        body {
            font-family: "verdana", "sans-serif";
        }

        .w-full {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-white {
            color: white;
        }

        .text-danger {
            color: #f1416c;
        }


        .d-block {
            display: block
        }

        .d-none {
            display: none;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .lowercase {
            text-transform: lowercase;
        }

        .fw-bold {
            font-weight: bold
        }

        span,
        p {
            font-size: 12px;
        }

        .bordered {
            border: 1px solid black;
        }

        .p-0 {
            padding: 0;
        }

        .m-0 {
            margin: 0;
        }

        .m-8 {
            margin: 8px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .font7 {
            font-size: 7px;
        }

        .font8 {
            font-size: 8px;
        }

        .font9 {
            font-size: 9px;
        }

        .font10 {
            font-size: 10px;
        }

        .font12 {
            font-size: 12px;
        }

        .font15 {
            font-size: 15px;
        }

        .bg-dark {
            background-color: #181C32;
        }

        .fst-italic {
            font-style: italic
        }

        @page {
            margin-top: 0.5cm;
            margin-right: 0cm;
            margin-left: 0cm;
        }

        /** Define the header rules **/
        header {
            /* position: fixed; */
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3.6cm;
            margin-top: 0.5cm;
        }

        main {
            margin-top: 0cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
        }

        .text-no-overflow {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
    @stack('styles')

    {{ $slot }}
</body>

</html>
