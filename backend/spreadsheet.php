<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/config.php';
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;


$ssid="";
$sql = "SELECT value FROM `settings` WHERE name='ssid'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result)) {
	$row = mysqli_fetch_assoc($result);
	$ssid=$row['value'];
}

$data = file_get_contents('php://input');
$data = json_decode($data);

try {
    // configure the Google Client
    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API');

    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    // credentials.json is the key file we downloaded while setting up our Google Sheets API
    $path = __DIR__ . '/credentials.json';
    $client->setAuthConfig($path);

    // configure the Sheets Service
    $service = new \Google_Service_Sheets($client);

    $spreadsheetId = $ssid;
    $spreadsheet = $service->spreadsheets->get($spreadsheetId);

    // $date = ceil((intval($data->time)/1000));
    // $likeDate = date("D j M o H:i:s a",$date);
    $likeDate = date("Y/m/d H:i:s");
    $email = $data->email;
    $title = $data->title;
    $pageUrl = $data->url;

    $newRow = [$likeDate,$title,$email,$pageUrl];

    $rows = [$newRow]; // you can append several rows at once
    $valueRange = new \Google_Service_Sheets_ValueRange();
    $valueRange->setValues($rows);
    $range = 'Sheet1'; // the service will detect the last row of this sheet
    $options = ['valueInputOption' => 'USER_ENTERED'];
    $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $options);

    echo "Data Updated Successfully";
}catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}




?>