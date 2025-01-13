<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>QR Code Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        nav {
            background-color: #34495e; /* Light Blue */
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
            background-color: #2c3e50; /* Dark Blue */
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin: 50px auto;
            max-width: 960px;
        }

        .section {
            width: 100%; /* Full width by default */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px; /* Add space between sections */
        }

        .section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section form {
            display: flex;
            flex-direction: column;
        }

        .section form label {
            margin-bottom: 10px;
        }

        .section form input[type="text"],
        .section form input[type="file"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .section form button {
            padding: 10px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .section form button:hover {
            background-color: #34495e;
        }

        /* Media Query for Tablets and Smaller */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack sections vertically */
            }

            .section {
                width: 90%; /* Take up 90% of the viewport width */
                margin-left: auto; /* Center align the sections */
                margin-right: auto; /* Center align the sections */

            }
        }

        /* Success Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 5px;
            z-index: 9999;
            animation: slideInRight 2s, fadeOut 0.5s 2.5s forwards;
            /*display: none;*/
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>QR Code Generator</h1>
</header>

<nav>
    <a href="#">Home</a>
    <a href="{{url('view-qr')}}">View QR</a>
    <a href="{{url('logoutsession')}}">Logout</a>
    
    {{--  <a href="#">Services</a>
    <a href="#">Contact</a>  --}}
</nav>

<div class="container">
    <div class="section">
        <h2>Generate QR Code</h2>
        <form action="{{ url('/store') }}" method="POST">
            @csrf
        {{-- <form id="generateForm" onsubmit="submitForm(event)"> --}}
            <label for="firstName">FIRST NAME:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">LAST NAME:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="telWork">TEL WORK:</label>
            <input type="text" id="telWork" name="telWork">

            <label for="telHome">TEL HOME:</label>
            <input type="text" id="telHome" name="telHome">

            <label for="email">EMAIL:</label>
            <input type="text" id="email" name="email" required>

            <label for="organisation">ORGANISATION:</label>
            <input type="text" id="organisation" name="organisation">

            <label for="title">TITLE:</label>
            <input type="text" id="title" name="title">

            <label for="address">ADDRESS:</label>
            <input type="text" id="address" name="address">

            <label for="url">URL:</label>
            <input type="text" id="url" name="url">

            <button type="submit">Generate QR Code</button>
        </form>

        

    </div>

    <div class="section">
    {{--  <a href="{{ url('download/uploadexcel') }}" ><i class="fa-solid fa-download">Download file</i></a>  --}}
        <h2>Bulk Upload</h2>
        <form id="" action="{{ url('uploadexcel') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <label for="fileUpload">Select Files:</label>
            <input type="file" id="fileUpload" name="excel_file" multiple>
            <a href="{{ url($myPublicFolder) }}"><p>Download For sample</p></a>

            <button type="submit" >Upload</button>
        </form>

        

    </div>
</div>

<footer>
    <p>&copy; 2024 QR Code Generator. All rights reserved.</p>
</footer>

<!-- Success Toast -->
<div id="successToast" class="toast">Your request is successfully submitted.</div>

<script>
    function submitForm() {
        // Simulate form submission
        // Here, you can add actual form submission logic
        
        // Show success toast
        var toast = document.getElementById("successToast");
        toast.style.display = "block";

        // Clear the form after the toast disappears
        setTimeout(function() {
            document.getElementById("generateQRForm").reset();
            toast.style.display = "none";
        }, 5000); // 3000 milliseconds = 3 seconds
    }
</script>

</body>
</html>
