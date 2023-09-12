<?php
use Jenssegers\Agent\Agent;

/**
 * Created by PhpStorm.
 * User: THANHHUYEN
 * Date: 22/06/2016
 * Time: 9:42 AM
 */
class scanDir
{
    static private $directories, $files, $ext_filter, $recursive;

    static public function scan()
    {
        // Initialize defaults
        self::$recursive = false;
        self::$directories = array();
        self::$files = array();
        self::$ext_filter = false;

        // Check we have minimum parameters
        if (!$args = func_get_args()) {
            die("Must provide a path string or array of path strings");
        }
        if (gettype($args[0]) != "string" && gettype($args[0]) != "array") {
            die("Must provide a path string or array of path strings");
        }

        // Check if recursive scan | default action: no sub-directories
        if (isset($args[2]) && $args[2] == true) {
            self::$recursive = true;
        }

        // Was a filter on file extensions included? | default action: return all file types
        if (isset($args[1])) {
            if (gettype($args[1]) == "array") {
                self::$ext_filter = array_map('strtolower', $args[1]);
            } else
                if (gettype($args[1]) == "string") {
                    self::$ext_filter[] = strtolower($args[1]);
                }
        }

        // Grab path(s)
        self::verifyPaths($args[0]);
        return self::$files;
    }

    static private function verifyPaths($paths)
    {
        $path_errors = array();
        if (gettype($paths) == "string") {
            $paths = array($paths);
        }

        foreach ($paths as $path) {
            if (is_dir($path)) {
                self::$directories[] = $path;
                $dirContents = self::find_contents($path);
            } else {
                $path_errors[] = $path;
            }
        }

        if ($path_errors) {
            echo "The following directories do not exists<br />";
            die(var_dump($path_errors));
        }
    }

    // This is how we scan directories
    static private function find_contents($dir)
    {
        $result = array();
        $root = scandir($dir);
        foreach ($root as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_file($dir . DIRECTORY_SEPARATOR . $value)) {
                if (!self::$ext_filter || in_array(strtolower(pathinfo($dir . DIRECTORY_SEPARATOR . $value, PATHINFO_EXTENSION)), self::$ext_filter)) {
                    self::$files[] = $result[] = $dir . DIRECTORY_SEPARATOR . $value;
                }
                continue;
            }
            if (self::$recursive) {
                foreach (self::find_contents($dir . DIRECTORY_SEPARATOR . $value) as $value) {
                    self::$files[] = $result[] = $value;
                }
            }
        }
        // Return required for recursive search
        return $result;
    }

    public static function directoryToArray($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = [], $root = true, $arrExt = [], $rep_path = "", $showEmptyFolder = true)
    {
        $arrayItems = array();
        if ($listDirs && $root) $arrayItems[] = ["Name" => ".\\", "FolderName" => ".\\", "IsDir" => 1];
        $skipByExclude = false;
        $directory = str_replace("%5C", "\\", $directory);
        $rep_path = str_replace("%5C", "\\", $rep_path);
        $directory = str_replace("./", "", $directory);
        $directory = str_replace("/", "\\", $directory);
        try {
            $handle = opendir($directory);
            if ($handle) {
                while (false !== ($file = readdir($handle))) {
                    preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
                    if (count($exclude) > 0) {
                        $skipByExclude = in_array(["RemarkU" => $file], $exclude);
                    }
                    if (!$skip && !$skipByExclude) {
                        if (is_dir($directory . "\\" . $file)) {
                            if ($recursive) {
                                $arrayItems = array_merge($arrayItems, scanDir::directoryToArray($directory . "\\" . $file, $recursive, $listDirs, $listFiles, $exclude, false, $arrExt, $rep_path, $showEmptyFolder));
                            }
                            if ($listDirs) {
                                // if ($showEmptyFolder || scanDir::isHasFile($directory . "\\" . $file, $arrExt)){
                                $file = ["Name" => str_replace($rep_path, ".", $directory . "\\" . $file), "IsDir" => 1, "FolderName" => $directory . "/" . $file];
                                $arrayItems[] = $file;
                                // }
                            }
                        } else {
                            if ($listFiles) {
                                if (count($arrExt) == 0 || in_array(scanDir::get_file_extension($file), $arrExt)) {
                                    $name = str_replace($directory . "\\", "", $directory . "\\" . $file);
                                    $file = ["Name" => $name, "FolderName" => str_replace($rep_path, "", $directory), "IsDir" => 0];
                                    $arrayItems[] = $file;
                                }
                            }
                        }
                    }
                }
                closedir($handle);
            }
        } catch (Exception $ex) {
            \Debugbar::info($ex->getMessage());
        }
        return $arrayItems;
    }

    public static function isHasFile($directory, $arrExt = [])
    {
        $handle = opendir($directory);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
                if (!is_dir($directory . "\\" . $file)) {
                    if (count($arrExt) == 0 || in_array(scanDir::get_file_extension($file), $arrExt))
                        return true;
                }

            }
            closedir($handle);
        }
        return true;
    }

    public static function get_file_extension($file_name)
    {
        return substr(strrchr($file_name, '.'), 1);
    }

    public static function create_tree($path, $reppath, $extension = [])
    {
        $files = array();
        if (file_exists($path)) {
            if ($path[strlen($path) - 1] == '/')
                $folder = $path;
            else
                $folder = $path . '/';

            $dir = opendir($path);
            while (($file = readdir($dir)) != false)
                $files[] = $file;
            closedir($dir);
        }
        if (count($files) > 2) { /* First 2 entries are . and ..  -skip them */
            natcasesort($files);
            $list = '<ul class="filetree" style="display: none;">';
            // Group folders first
            foreach ($files as $file) {
                if (file_exists($folder . $file) && $file != '.' && $file != '..' && is_dir($folder . $file)) {
                    $fname = htmlentities(mb_convert_encoding($file, 'UTF-8', 'ASCII'), ENT_SUBSTITUTE, "UTF-8");
                    $pathfile = str_replace($reppath, "", $folder . $file);
                    $pathfile = htmlentities(mb_convert_encoding($pathfile, 'UTF-8', 'ASCII'), ENT_SUBSTITUTE, "UTF-8");
                    $list .= '<li class="folder collapsed"><a href="#" rel="' . $pathfile . '/">' . $fname . '</a></li>';
                }
            }
            // Group all files
            foreach ($files as $file) {
                $ext = preg_replace('/^.*\./', '', $file);
                if (in_array($ext, $extension)) {
                    if (file_exists($folder . $file) && $file != '.' && $file != '..' && !is_dir($folder . $file)) {
                        $fname = htmlentities(mb_convert_encoding($file, 'UTF-8', 'ASCII'), ENT_SUBSTITUTE, "UTF-8");
                        $list .= '<li class="file ext_' . $ext . '"><a href="#">' . $fname . '</a></li>';
                    }
                }

            }
            $list .= '</ul>';
            return $list;
        }
    }

    public static function get_mime_type($file)
    {
        // our list of mime types
        $mime_types = array(
            "pdf" => "Adobe Portable Document Format"
        , "exe" => "Application"
        , "zip" => "Zip Archive"
        , "rar" => "RAR Archive"
        , "7z" => "7-Zip"
        , "docx" => "Word Document"
        , "doc" => "Word Document"
        , "xls" => "Excel Document"
        , "xlsx" => "Excel Document"
        , "ppt" => "Presentation File"
        , "pptm" => "Presentation File"
        , "gif" => "Graphics Interchange Format"
        , "png" => "Portable Network Graphics (PNG)"
        , "jpeg" => "JPEG Image"
        , "jpg" => "JPEG Image"
        , "mp3" => "Audio"
        , "wav" => "Audio"
        , "mpeg" => "MPEG Video"
        , "mpg" => "MPEG Video"
        , "avi" => "Audio Video Interleave (AVI)"
        , "css" => "Cascading Style Sheets (CSS)"
        , "jsc" => "JavaScript"
        , "js" => "JavaScript"
        , "php" => "Text"
        , "txt" => "Text"
        , "htm" => "HyperText Markup Language"
        , "html" => "HyperText Markup Language"
        );
        $tmp = explode('.', $file);
        $file_extension = strtolower(end($tmp));
        if (!isset($mime_types[$file_extension]))
            return "File";
        return $mime_types[$file_extension];
    }
}