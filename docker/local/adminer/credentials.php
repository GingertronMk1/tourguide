<?php

class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct(string $path)
    {
        if(!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    public function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

class Autologin {
    function loginForm() {
        $this->populateEnv();
        $echoing = implode('</br>', [
            "<input type=\"text\" value=\"pgsql\" name=\"auth[driver]\" />",
            "<input type=\"text\" value=\"{$_ENV['DB_HOST']}\" name=\"auth[server]\" />",
            "<input type=\"text\" value=\"{$_ENV['POSTGRES_USER']}\" name=\"auth[username]\" />",
            "<input type=\"text\" value=\"{$_ENV['POSTGRES_PASSWORD']}\" name=\"auth[password]\" />",
            "<input type=\"text\" value=\"{$_ENV['POSTGRES_DB']}\" name=\"auth[db]\" />",
            "<label for=\"auth[permanent]>",
            "Permanent?",
            "<input type=\"checkbox\" name=\"auth[permanent]\" value=\"{$_COOKIE['adminer_permanent']}\" />",
            "</label>",
            "</br>",
            "<input style=\"font-size:144px\" type=\"Submit\" value=\"Login\" />",
        ]);
        echo $echoing;
        return false;
    }

  private function populateEnv() {
    $dotenv = new DotEnv(__DIR__.'/../.env');
    $dotenv->load();
  }
}

return new Autologin();
