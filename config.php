<?php
/*****************************************/
/*                                       */
/*	imm.in v1.1							 */
/*	Release date: 7 Dec 2013         	 */
/*	Copyright (C) nullfix.com        	 */
/*                                       */
/*****************************************/

// Main Website configuration:
$_CONFIG['admin_pw']		= 'xxx';                                        // Administration password for CPanel
$_CONFIG['site_name']		= 'pixel host';					// Site Name
$_CONFIG['site_url']		= 'http://localhost/pixel/';                    // Site URL
$_CONFIG['admin_mail']		= 'admin@nullfix.com';                          // Mail used in contact us page
$_CONFIG['database']		= 'mysqlitedb.db';				// Database file name!
$_CONFIG['allowed']         = array("audio/mpeg3", "audio/x-mpeg-3", "image/jpeg", "image/png", "audio/mpeg", "image/gif"); // allowed file types
$_CONFIG['upload_dir']      = 'i/';                                             // Upload folder

// Special functions do not touch below...

function MyDB() {
    global $_CONFIG;
    // Connect to SQLite3 database in file
    $custom_db = new PDO('sqlite:'.$_CONFIG['database'].'');
    // Set errormode to exceptions
    $custom_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $custom_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $custom_db;
}

function Mime($path, $magic = null)
{
    $path = realpath($path);
    if ($path !== false)
    {
        if (function_exists('finfo_open') === true)
        {
            $finfo = finfo_open(FILEINFO_MIME_TYPE, $magic);
            if (is_resource($finfo) === true)
            {
                $result = finfo_file($finfo, $path);
            }
            finfo_close($finfo);
        }
        else if (function_exists('exif_imagetype') === true)
        {
            $result = image_type_to_mime_type(exif_imagetype($path));
        }
        else if (function_exists('mime_content_type') === true)
        {
            $result = mime_content_type($path);
        }
        return preg_replace('~^(.+);.+$~', '$1', $result);
    }
    return false;
}

function how_long_ago($timestamp){
    $difference = time() - $timestamp;

    if($difference >= 60*60*24*365){        // if more than a year ago
        $int = intval($difference / (60*60*24*365));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' year' . $s . ' ago';
    } elseif($difference >= 60*60*24*7*5){  // if more than five weeks ago
        $int = intval($difference / (60*60*24*30));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' month' . $s . ' ago';
    } elseif($difference >= 60*60*24*7){        // if more than a week ago
        $int = intval($difference / (60*60*24*7));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' week' . $s . ' ago';
    } elseif($difference >= 60*60*24){      // if more than a day ago
        $int = intval($difference / (60*60*24));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' day' . $s . ' ago';
    } elseif($difference >= 60*60){         // if more than an hour ago
        $int = intval($difference / (60*60));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' hour' . $s . ' ago';
    } elseif($difference >= 60){            // if more than a minute ago
        $int = intval($difference / (60));
        $s = ($int > 1) ? 's' : '';
        $r = $int . ' minute' . $s . ' ago';
    } else {                                // if less than a minute ago
        $r = 'moments ago';
    }

    return $r;
}
?>