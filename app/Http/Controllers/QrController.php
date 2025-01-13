<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
class QrController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function logoutsession()
    {
       
        Session::flush();
        return redirect()->route('index');
    }
    public function formview()
    {
        if (Session::has('key')) {
            $myPublicFolder = 'sample_qr.csv';
           
            return view('qr', compact('myPublicFolder'));
        }else{
            return redirect()->route('index');
        }
    }

    public function login(Request $request)
    {
        $username = ['admin@admin.com', 'admin@gmail.com', 'admin'];
        $password = '1234';
        if (in_array($request->username, $username) && $password == $request->password) {
            Session::put('key', 'login');
            return redirect()->route('form-view');

        } else {
            return redirect()->back()->with('success', 'Invalid Login');
        }

    }
    public function downloaduploadexcel(){
        try {
            $path = public_path('/upload/json/datafileupload.json'); // ie: /var/www/laravel/app/storage/json/filename.json

            $json = json_decode(file_get_contents($path), true);

            //if(count($data) > 0){
            $delimiter = ",";
            $filename = $year . ".csv";

            // Create a file pointer
            $f = fopen('php://memory', 'w');

            // Set column headers
            $fields = array('FNAME', 'LNAME', 'TEL_HOME', 'TEL_WORK', 'EMAIL', 'ORG', 'TITLE', 'ADDRESS', 'URL');
            fputcsv($f, $fields, $delimiter);
            foreach ($json as $row) {
               //dd($row['firstname']);
                $lineData = array($row['firstname'], $row['lastname'], $row['telwork'], $row['telhome'], $row['email'], $row['organization'], $row['title'], $row['address'], $row['url']);
                fputcsv($f, $lineData, $delimiter);

            }

            fseek($f, 0);

            // Set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            fpassthru($f);
            //}

            exit();
            Session::flash('success', "Special message goes here");
            return redirect()->route('form-view');

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        //return $request;
        $path = public_path('/upload/json/datafile.json'); // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);
       

        $year = 'Excel';
        $data = ['firstname' => $request->firstName, 'lastname' => $request->lastName, 'telwork' => $request->telWork, 'telhome' => $request->telHome, 'email' => $request->email, 'organization' => $request->organisation, 'title' => $request->title, 'address' => $request->address, 'url' => $request->url];

        $json[] = $data; // Adding new data to the end of the array, adjust as needed

        // Convert the array back to JSON format
        $jsonString = json_encode($json, JSON_PRETTY_PRINT);

        // $fileName = 'datafile.json';
        // $fileStorePath = public_path('/upload/json/'.$fileName);
        $fileStorePath = public_path('/upload/json/datafile.json');

        File::put($fileStorePath, $jsonString);

        //return response()->download($fileStorePath);

        try {

            //if(count($data) > 0){
            $delimiter = ",";
            $filename = $year . ".csv";

            // Create a file pointer
            $f = fopen('php://memory', 'w');

            // Set column headers
            $fields = array('FNAME', 'LNAME', 'TEL_HOME', 'TEL_WORK', 'EMAIL', 'ORG', 'TITLE', 'ADDRESS', 'URL');
            fputcsv($f, $fields, $delimiter);
            foreach ($json as $row) {
               //dd($row['firstname']);
                $lineData = array($row['firstname'], $row['lastname'], $row['telwork'], $row['telhome'], $row['email'], $row['organization'], $row['title'], $row['address'], $row['url']);
                fputcsv($f, $lineData, $delimiter);

            }

            fseek($f, 0);

            // Set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            fpassthru($f);
            //}

            exit();
            Session::flash('success', "Special message goes here");
            return redirect()->route('form-view');

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function uploadexcel(Request $request){
      
         if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->getRealPath();

            // Load Excel file
            $spreadsheet = IOFactory::load($filePath);
            // Get the first sheet
            $sheet = $spreadsheet->getActiveSheet();
            // Get the highest row and column
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Loop through rows and columns to get data
            $data = [];
            for ($row = 1; $row <= $highestRow; $row++) {
                $rowData = [];
                for ($col = 'A'; $col <= $highestColumn; $col++) {
                    $cell = $sheet->getCell($col . $row);
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }
           
            foreach ($data as $key=>$row) {
                if($key > 0){
                 $data = ['firstname' => $row[0], 'lastname' => $row[1], 'telwork' => $row[2], 'telhome' => $row[3], 'email' => $row[4], 'organization' => $row[5], 'title' => $row[6], 'address' => $row[7], 'url' => $row[8]];
                 $json[] = $data; // Adding new data to the end of the array, adjust as needed
                 // Convert the array back to JSON format
                }
 
             }

             $jsonString = json_encode($json, JSON_PRETTY_PRINT);
         
             $fileStorePath = public_path('/upload/json/datafileupload.json');

             File::put($fileStorePath, $jsonString);
             Session::flash('success', "Special message goes here");
            return redirect()->route('form-view');

            // Process or store $data as needed
            return response()->json(['data' => $data]);
        }
    }

    public function view_qr(){
        if (Session::has('key')) {
        $path = public_path('/upload/json/qr_code');
        $files = File::files($path);
        $data = [];
        if ($handle = opendir(public_path('/upload/json/qr_code'))) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    //echo $entry."<br>"; // NAME OF THE FILE
                    $data[] = $entry;
                }
            }
            closedir($handle);
        }

//dd($data[0],'/upload/json/qr_code/'.$data[0]);
        
        return view('view-qr',compact('data'));
    }else{
        return redirect()->route('index');
    }
    }

   
}
