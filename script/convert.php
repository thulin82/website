#!/usr/bin/env php
<?php
$dsn = "sqlite:" . __DIR__ . "/.ht.sqlite";

// Open the database file and catch the exception it it fails.
try {
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect to the database using DSN:<br>$dsn<br>";
    throw $e;
}

// Prepare and execute the SQL statement
$stmt = $db->prepare("SELECT * FROM Content limit 5");
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>", print_r($res, true), "</pre>";

// Loop through all and create content for each
$base = __DIR__ . "/content";
//unlink($base);
//mkdir($base);

foreach ($res as $doc) {
    print_r($doc);
    extract($doc);
    
    // Read original content
    $content = "";
    if (!empty($datafile)) {
        $content = file_get_contents(__DIR__ . "/txt/$datafile");
    } elseif (!empty($data)) {
        $content = $data;
    }
    
    // Create the target filename
    $file = $key;
    if ($url) {
        $file = $url;
    }

    // Write target file, create dirs if needed
    $file = "$base/$file.md";
    $basedir = dirname($file);
    if (!file_exists($basedir)) {
        mkdir($basedir, 0755, true);
    }

    if (is_file($file)) {
        die("File already exists: $file\n");
    }
    file_put_contents($file, $content);
    echo "Saved as $file\n\n";
}
