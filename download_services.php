<?php

class FileDownloader {
    private $file;

    public function __construct($file) {
        $this->file = $file; // Store the path of the file to be downloaded
    }

    public function download() {
        // Fetch file content using GitHub API
        $fileContent = $this->fetchFileContent();

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

    private function fetchFileContent() {
        // Extract the raw URL from GitHub URL
        $rawUrl = $this->getRawUrl();

        // Fetch file content using cURL or any other suitable method
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $rawUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $fileContent = curl_exec($ch);
        curl_close($ch);

        return $fileContent;
    }

    private function getRawUrl() {
        // Convert GitHub URL to raw content URL
        // Example: https://github.com/rouabayoudh/pdf/blob/main/services.pdf
        // Converted to: https://raw.githubusercontent.com/rouabayoudh/pdf/main/services.pdf
        $parts = explode('/', $this->file);
        $username = $parts[3];
        $repo = $parts[4];
        $branch = $parts[6];
        $filePath = implode('/', array_slice($parts, 7));
        return "https://raw.githubusercontent.com/$username/$repo/$branch/$filePath";
    }
}

// Usage
$file = 'https://github.com/rouabayoudh/pdf/blob/main/services.pdf'; 
$fileDownloader = new FileDownloader($file);
$fileDownloader->download();


?>
