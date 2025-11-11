<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-main': '#2d5a8c',
                        'primary-dark': '#1e3a5f',
                        'primary-light': '#4a7ba7',
                        'primary-accent': '#6b94b8',
                        'primary-pale': '#f0f5fa',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <title>EasyRent</title>
</head>

<body>
    @yield('content')
</body>

</html>
