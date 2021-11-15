<?php

class App
{
    protected $controller = "Home";
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if ($url == NULL) {
            $url = [$this->controller];
        }

        var_dump($url);

        echo "<br>";
        var_dump(file_exists('../app/controllers/' . $url[0] . '.php'));
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            var_dump($url[0]);
            unset($url[0]);
            echo 'ini di ekseskusi';
        }
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}


function fileExists($fileName, $caseSensitive = true)
{

    if (file_exists($fileName)) {
        return $fileName;
    }
    if ($caseSensitive) return false;

    // Handle case insensitive requests            
    $directoryName = dirname($fileName);
    $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
    $fileNameLowerCase = strtolower($fileName);
    foreach ($fileArray as $file) {
        if (strtolower($file) == $fileNameLowerCase) {
            return $file;
        }
    }
    return false;
}
