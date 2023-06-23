// Receives the POST data, and saves it to log.txt

<?php
// file where data will be stored
$file = 'DIRECTORY_TO_LOGFILE.txt';

// your secret passkey
$secretPasskey = "REPLACE WITH DEVICE PASSKEY";

// getting the POST data
$data = $_POST;

// check if the passkey is correct
if (!isset($data['PASSKEY']) || $data['PASSKEY'] !== $secretPasskey) {
    http_response_code(403);
    echo "Invalid PASSKEY.";
    exit;
}

// adding timestamp to the data
$data['received_at'] = date('Y-m-d H:i:s');

// formatting the data as a string to write in the file
$data_string = json_encode($data) . PHP_EOL;

// writing data into file
file_put_contents($file, $data_string, FILE_APPEND | LOCK_EX);
?>
