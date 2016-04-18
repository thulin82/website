#!/usr/bin/env php
<?php
function makeClickable($text)
{
    return preg_replace_callback(
        '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
        function ($matches) {
            return "<a href='{$matches[0]}'>{$matches[0]}</a>";
        },
        $text
    );
}


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
$stmt = $db->prepare("SELECT C.*, U.acronym, Ca.key AS category FROM Content AS C LEFT OUTER JOIN User AS U ON C.idUser = U.id LEFT OUTER JOIN Category AS Ca ON Ca.id = C.idCategory ");
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>", print_r($res, true), "</pre>";

// Loop through all and create content for each
$base = __DIR__ . "/content";
//unlink($base);
//mkdir($base);

//$markdownx = [];
$redirect = [];
$removed = [];
$kunskapId = 100;
$blogId = 100;
$tipId = 100;
$uppgiftId = 100;
$osId = 100;

foreach ($res as $doc) {
    extract($doc);
    
    // Default settings
    $doYaml = true;
    $h1 = "==================================\n";
    $h4 = false;
    
    // Ignore deleted
    if ($deleted) {
        echo "Deleted id=$id.\n";
        continue;
    }

    // Ignore som ids.
    $ignore = [3, 9, 13, 14, 15, 16, 17, 19, 29, 56, 82, 83, 113, 140, 144, 244, 278, 279, 360, 491, 268, 58, 272, 546, 543, 122, 137, 136, 119, 566, 135, 478, 363];
    if (in_array($id, $ignore)) {
        echo "Ignore id=$id.\n";
        continue;
    }

    // Read original content
    $content = "";
    if (!empty($datafile)) {
        if (!is_file(__DIR__ . "/txt/$datafile")) {
            print_r($doc);
            die("Id $id missing file $datafile.");
        }
        $content = file_get_contents(__DIR__ . "/txt/$datafile");
    } elseif (!empty($data)) {
        $content = $data;
    }
    
    // Remove BASEURL from $content
    $content = preg_replace("#\[BASEURL\]#", "", $content);
    
    // Create the target filename
    $file = $key;

    // Start by checking per type
    $redirects = null;
    
    switch ($type) {
        case "page":
            if (empty($url)) {
                print_r($doc);
                die("ERROR: Type page missing url.");
            }
            $file = $url;
            break;
        
        case "block":
            $file = "block-old/$key";
            $doYaml = false;
            $h1 = false;
            $h4 = "####";
            break;
                
        case "opensource":
            $file = "opensource/${osId}_$key";
            $osId++;
            
            if ($url) {
                $redirects = " Redirects from $url";
                $redirect[$url] = "opensource/$key";
            }
            break;
                
        case "uppgift":
            $file = "uppgift/${uppgiftId}_$key";
            $uppgiftId++;
            
            if ($url) {
                $redirects = " Redirects from $url";
                $redirect[$url] = "uppgift/$key";
            }
            break;
                
        case "tip":
            $file = "coachen/${tipId}_$key";
            $tipId++;
            
            if ($url) {
                $redirects = " Redirects from $url";
                $redirect[$url] = "coachen/$key";
            }
            break;
                
        case "post":
            $file = "blogg/${blogId}_$key";
            $blogId++;
            
            if ($url) {
                $redirects = " Redirects from $url";
                $redirect[$url] = "blogg/$key";
            }
            break;
            
        case "kunskap":
            $file = "kunskap/${kunskapId}_$key";
            $kunskapId++;
            
            if ($url) {
                $redirects = " Redirects from $url";
                $redirect[$url] = "kunskap/$key";
            }
            break;
            
            
        default:
            print_r($doc);
            die("ERROR: Missing known type.");
    }

    // Check if older textfilter is used.
    if ($filter == "markdownx") {
        $content = makeClickable($content);
    }

    // Write target file, create dirs if needed
    $file = "$base/$file.md";
    $basedir = dirname($file);
    if (!file_exists($basedir)) {
        mkdir($basedir, 0755, true);
    }

    if (is_file($file)) {
        echo "File already exists: $id $file\n";
        continue;
        //die("File already exists: $file\n");
    }

    // Add title
    $content = "$h4$title\n$h1\n$content";

    // Remove older "written by"
    $content = str_replace("<span class='revision-history'>Av Mikael Roos (mos@dbwebb.se)</span>", "", $content);
    $content = str_replace("<span class='revision-history'>Av Rickard Gimersted (rickard@gimerstedt.se)</span>", "", $content);

    // IMG2
    $content = str_replace("[IMG2 ", "[FIGURE ", $content);

    // IMG
    $pattern = "/\[IMG src=(.+) alt=(.+)\]/";
    $replace = "[FIGURE src=$1 caption=\"$2\"]";
    $content = preg_replace($pattern, $replace, $content);


    // Grep and format revision history
    $match = null;
    $pattern = "/Revisionshistoria \{#revisionshistoria\}.*?>(.*?)<\/span>/s";
    $revision = [];
    if (preg_match($pattern, $content, $match)) {
        //echo "FOUND\n";
        $content = preg_replace($pattern, "", $content, 1);
        $lines = explode("\n", (trim($match[1])));
        foreach ($lines as $line) {
            $line = trim($line);
            $pos1 = strpos($line, " ");
            $pos2 = strpos($line, ":");
            $pos1 = $pos1 ? $pos1 : 99;
            $pos2 = $pos2 ? $pos2 : 99;
            $pos = min($pos1, $pos2);
            $key = substr($line, 0, $pos);
            $val = trim(substr($line, $pos + 1));
            $revision[$key] = $val; 
        }
        //var_dump($revision);
    }

    // YAML ending with ...?
    // Add YAML frontmatter
    if ($doYaml) {
        $fm = [];
        $fm["author"] = $acronym;

        if ($category) {
            $fm["category"] = $category;
        }
        
        if (!empty($revision)) {
            $fm["revision"] = $revision;
        } else {
            if ($published) {
                $fm["published"] = $published;
            }
            if ($updated) {
                $fm["updated"] = $updated;
            }
            $fm["created"] = $created;
        }
        
        $content = yaml_emit($fm, YAML_UTF8_ENCODING) . $content;
    }

    // Write file 
    file_put_contents($file, $content);
    echo "Saved $file $redirects\n";
    //$res = readline();
    $res = null; //readline();
    if ($res == "p") {
        print_r($doc);
    }
}

$move = [
    "dbwebb-cli.md" => "dbwebb-cli/dbwebb.md",
    "dbwebb-inspect.md" => "dbwebb-cli/dbwebb-inspect.md",
    "dbwebb-validate.md" => "dbwebb-cli/dbwebb-validate.md",
    "facebook.md" => "social/facebook.md",
    "flickr.md" => "social/flickr.md",
    "github.md" => "social/github.md",
    "googleplus.md" => "social/googleplus.md",
    "instagram.md" => "social/instagram.md",
    "linkedin.md" => "social/linkedin.md",
    "twitter.md" => "social/twitter.md",
    "youtube.md" => "social/youtube.md",
    "htmlphp.md" => "htmlphp/index.md",
    "htmlphp-v1.md" => "htmlphp-v1/index.md",
    "javascript.md" => "javascript/index.md",
    "javascript1.md" => "javascript1/index.md",
    "linux.md" => "linux/index.md",
    "om.md" => "om/index.md",
    "oophp.md" => "oophp/index.md",
    "oophp-v1.md" => "oophp-v1/index.md",
    "phpmvc.md" => "phpmvc/index.md",
    "phpmvc-v1.md" => "phpmvc-v1/index.md",
    "python.md" => "python/index.md",
    "webapp.md" => "webapp/index.md",
    "webgl.md" => "webgl/index.md",
    "webtopic.md" => "webtopic/index.md",
    "bth.md" => "bth/index.md",
    "irc.md" => "irc/index.md",
    "rss.md" => "rss/index.md",
    "webprog.md" => "webprog/index.md",
    "webutv.md" => "webutv/index.md",
];

foreach ($move as $orig => $new) {
    // Write target file, create dirs if needed
    $file = "$base/$new";
    $basedir = dirname($file);
    if (!file_exists($basedir)) {
        mkdir($basedir, 0755, true);
    }

    if (is_file($file)) {
        echo "Moving $orig but $new already exists (overwriting) ";
    }
    rename("$base/$orig", $file);
    echo "Renamed $orig to $new\n";
}



$redirect["cli"] = "dbwebb-cli";
$redirect["dbwebb-cli"] = "dbwebb-cli/dbwebb";
$redirect["dbwebb-inspect"] = "dbwebb-cli/dbwebb-inspect";
$redirect["dbwebb-validate"] = "dbwebb-cli/dbwebb-validate";
$redirect["facebook"] = "social/facebook";
$redirect["flickr"] = "social/flickr";
$redirect["github"] = "social/github";
$redirect["googleplus"] = "social/googleplus";
$redirect["instagram"] = "social/instagram";
$redirect["linkedin"] = "social/linkedin";
$redirect["twitter"] = "social/twitter";
$redirect["youtube"] = "social/youtube";

$removed[] = "manual";
$removed[] = "program";
$removed[] = "validator";

echo "Redirects\n";
print_r($redirect);

echo "Removed\n";
print_r($removed);

//echo "Markdownx\n";
//print_r($markdownx);
