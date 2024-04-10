<?php

class FileDownloader {
    private $file;

    public function __construct($file) {
        $this->file = $file; // Store the path of the file to be downloaded
    }

    public function download() {
        // Use GitHub API to fetch the file content
       

        // Check if file content is fetched successfully
        if ($fileContent !== false) {
            // Send headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($this->file) . '"');
            header('Content-Length: ' . strlen($fileContent));
            // Output the file content
            echo $fileContent;
            exit;
        } else {
            echo 'File not found.';
        }
    }

   
}

// Usage
$file = 'https://github.com/rouabayoudh/pdf/blob/main/services.pdf'; 
$fileDownloader = new FileDownloader($file);
$fileDownloader->download();

?>
