<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
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
    <a href="{{url('form-view')}}">Home</a>
    <a href="{{url('view-qr')}}">View QR</a>
    <a href="{{url('logoutsession')}}">Logout</a>
    {{--  <a href="#">Services</a>
    <a href="#">Contact</a>  --}}
</nav>

<div class="container">
    <div class="section">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>File Name</th>
				<th>QR</th>
				<th>Download</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$value)
            <tr>
                <td>{{$value}}</td>
                <td> <img src="{{'/upload/json/qr_code/'.$value}}" alt="Qr Image" width="100" height="96"></td>
                <td><a href="{{'/upload/json/qr_code/'.$value}}" download="{{$value}}"><button type="button" class="btn btn-info">Download</button></a></td>
            </tr>
		@endforeach	
           
        </tbody>
    </table>

        

    </div>

   </div>

<footer>
    <p>&copy; 2024 QR Code Generator. All rights reserved.</p>
</footer>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js'></script>
<script>
        $(document).ready(function() {
            //Only needed for the filename of export files.
            //Normally set in the title tag of your page.
			var register_type = $('#register_type').val();
            document.title = register_type;
            // DataTable initialisation
            $('#example').DataTable({
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "autoWidth": true,
                "buttons": [
                    'colvis',
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
    </script>



</body>
</html>
