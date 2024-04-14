<?php

namespace Models;

final class FilesFinder
{
    /**
     * Directory path to scan.
     *
     * @var string
     */
    private static string $dir = "./hawking/";

    public function __construct()
    {
        //
    }

    /**
     * Find files in the directory that match the given regex pattern.
     *
     * @param  string  $regex The regex pattern to match file names against
     * @return array The list of file names that match the regex pattern
     */
    public static function find(string $regex = "/^[a-zA-Z0-9]+\.(bros)$/") : array
    {
        $files = [];
        $filesList = glob(self::$dir . '*');

        foreach ($filesList as $file) {
            if (is_file($file) && preg_match($regex, basename($file))) {
                $files[] = basename($file);
            }
        }
        sort($files);
        return $files;
    }

    /**
     * Generate 100 files with random names and extensions in a loop.
     *
     * @return void
     */
    public static function createFiles(): void
    {
        $fileExtensions = ['txt', 'pdf', 'doc', 'bros'];
        $fileNames = ['test', 'abcd', 'a%!]', 'файл'];

        for ($i = 0; $i < 100; $i++) {
            file_put_contents(self::$dir.$fileNames[array_rand($fileNames)].rand(0, $i * 10).'.'.$fileExtensions[array_rand($fileExtensions)], 'test');
        }
    }
}