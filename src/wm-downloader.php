<?php
require 'vendor/autoload.php'; // Include composer autoloader

use phpseclib\Net\SFTP;

function downloadFilesFromSFTP($csvFile, $localFolder, $sftpHost, $sftpPort, $sftpUsername, $certificateFile, $remoteFolderPath)
{
    // Parse CSV file and extract filenames
    $fileNames = [];
    if (($handle = fopen($csvFile, "r")) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
            $fileNames[] = $data[0];
        }
        fclose($handle);
    }

    // Connect to SFTP server using certificate
    $sftp = new SFTP($sftpHost, $sftpPort);
    if (!$sftp->login($sftpUsername, $certificateFile)) {
        echo 'SFTP Login Failed.' . PHP_EOL;
        return;
    }

    // Create the local folder if it doesn't exist
    if (!is_dir($localFolder)) {
        mkdir($localFolder, 0777, true);
    }

    // Download files from SFTP to the local folder
    foreach ($fileNames as $filename) {
        $remoteFilePath = rtrim($remoteFolderPath, '/') . '/' . ltrim($filename, '/');
        $localFilePath = $localFolder . '/' . basename($filename);

        if ($sftp->get($remoteFilePath, $localFilePath)) {
            echo "Downloaded: $filename" . PHP_EOL;
        } else {
            echo "Failed to download: $filename" . PHP_EOL;
        }
    }
}

// Get command-line arguments
if (count($argv) !== 8) {
    echo "Usage: php wm-downloader.php <path_to_csv_file> <local_folder> <sftp_host> <sftp_port> <sftp_username> <certificate_file> <remote_folder_path>" . PHP_EOL;
    exit(1);
}

$csvFile = $argv[1];
$localFolder = $argv[2];
$sftpHost = $argv[3];
$sftpPort = $argv[4];
$sftpUsername = $argv[5];
$certificateFile = $argv[6];
$remoteFolderPath = $argv[7];

downloadFilesFromSFTP($csvFile, $localFolder, $sftpHost, $sftpPort, $sftpUsername, $certificateFile, $remoteFolderPath);