<?php

namespace Models;

final class FilesFinder
{
    private static string $dir = "./hawking/";

    public function __construct()
    {
        //
    }

    public static function find($regex = "/^[a-zA-Z0-9]+\.(bros)$/") : array
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

    public static function createFiles(): void
    {
        $fileExtensions = ['txt', 'pdf', 'doc', 'bros'];
        $fileNames = ['test', 'abcd', 'a%!]', 'файл'];

        for ($i = 0; $i < 100; $i++) {
            file_put_contents(self::$dir.$fileNames[array_rand($fileNames)].rand(0, $i * 10).'.'.$fileExtensions[array_rand($fileExtensions)], 'test');
        }
    }
}