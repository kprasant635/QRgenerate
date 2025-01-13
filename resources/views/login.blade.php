<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #2c3e50;
            /* Dark Blue */
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #34495e;
            /* Light Blue */
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #2c3e50;
            /* Dark Blue */
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #2c3e50;
            /* Dark Blue */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        h1 {
            margin-top: 0;
        }

        p {
            line-height: 1.6;
        }

        /* Media Query for Tablets */
        @media (max-width: 768px) {
            nav {
                padding: 5px 0;
            }

            nav a {
                padding: 10px;
                margin: 5px;
            }

            main {
                padding: 10px;
            }
        }

        /* Hamburger Menu Styles */
        .menu-toggle {
            display: none;
        }

        .menu-toggle:checked+nav {
            max-height: 200px;
            /* Adjust as needed */
            overflow-y: auto;
        }

        .menu-toggle:checked+nav a {
            display: block;
        }

        /* Hide checkboxes */
        input[type="checkbox"] {
            display: none;
        }

        /* Style the hamburger menu */
        .hamburger {
            display: block;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 999;
            cursor: pointer;
        }

        .hamburger .bar {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin: 5px auto;
            transition: all 0.3s ease-in-out;
        }

        /* Animate the hamburger menu */
        .menu-toggle:checked+.hamburger .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle:checked+.hamburger .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle:checked+.hamburger .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* Login Page Styles */
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container label {
            display: block;
            margin-bottom: 10px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            /* Ensure padding and border are included in width */
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            /* Dark Blue */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #34495e;
            /* Light Blue */
        }
    </style>
</head>

<body>

    <header>
        <h1>QR Code Generator</h1>
    </header>

    {{--  <input type="checkbox" id="menu-toggle" class="menu-toggle">  --}}
    {{--  <label for="menu-toggle" class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </label>  --}}

    {{--  <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </nav>  --}}

    <main class="container">
        <div class="login-container">

            
            @if (\Session::has('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{!! \Session::get('success') !!}</strong>.

            </div>
                
            @endif
            <h2>Login</h2>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 QR Code Generator. All rights reserved.</p>
    </footer>

</body>

</html>

<script>
    // JavaScript to close the menu when a link is clicked
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('menu-toggle').checked = false;
        });
    });
</script>
