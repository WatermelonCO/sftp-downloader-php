# SFTP File Downloader

This PHP script allows you to download files from an SFTP server based on filenames listed in a CSV file.

## Prerequisites

- PHP version: PHP 7.0 or later
- Composer (for installing dependencies)

## Installation

1. Clone or download this repository to your local machine.

2. Install the required dependencies using Composer. Open a terminal or command prompt, navigate to the project directory, and run the following command:

composer install


## Usage

To use the script, follow these steps:

1. Prepare the CSV file containing the list of filenames you want to download. The CSV file should have a single column with the filenames. For example:

filename
file1.txt
file2.png
file3.pdf


2. Ensure you have the necessary details for the SFTP server and connection:

   - SFTP Host (e.g., cdn.watermelonco.es)
   - SFTP Port (e.g., 2222)
   - SFTP Username (e.g., myradio)
   - Certificate file for SFTP login (provide the full path to the certificate file)
   - Remote folder path on the SFTP server (e.g., /catalog)

3. Open a terminal or command prompt, navigate to the project directory, and run the PHP script with the following command:

php script.php <path_to_csv_file> <local_folder> <sftp_host> <sftp_port> <sftp_username> <certificate_file> <remote_folder_path>


Replace the following placeholders in the command with your specific values:

- `<path_to_csv_file>`: The path to the CSV file containing the list of filenames.
- `<local_folder>`: The local folder path where you want to download the files.
- `<sftp_host>`: The hostname of the SFTP server (e.g., cdn.watermelonco.es).
- `<sftp_port>`: The port number for the SFTP connection (e.g., 2222).
- `<sftp_username>`: The SFTP username (e.g., myradio).
- `<certificate_file>`: The full path to the certificate file for SFTP login.
- `<remote_folder_path>`: The remote folder path on the SFTP server where the files are located (e.g., /catalog).

4. The script will connect to the SFTP server, download the specified files to the local folder, and display the status of each download (success or failure).

## Example

Suppose you have the following CSV file named `files.csv`:

filename
file1.txt
file2.png
file3.pdf

To download these files from the SFTP server to the local folder `/path/to/local/folder`, run the following command:

php script.php files.csv /path/to/local/folder cdn.watermelonco.es 2222 myradio /path/to/certificate/file.pem /catalog

The script will connect to the SFTP server, download the files to the specified local folder, and display the status of each download.

Note: Make sure you have appropriate read and write permissions for the local folder where the files will be downloaded.


