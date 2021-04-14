<?php

class Builder
{

    /**
     * Сделать красивые пути
     * @param string $path
     * @return string|string[]
     */
    public static function makeRightSlashes(string $path)
    {
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Копирование файлов из папки в папку
     * @param string $from
     * @param string $to
     * @param string $message
     */
    public static function copyFilesFromDirToDir(string $from, string $to, string $message = 'start copying')
    {
        echo "\e[32m>>> \e[36m{$message}...\e[37m ";
        $configureDir = self::makeRightSlashes($from);
        $copyTo = self::makeRightSlashes($to);
        if($openConfigureDir = opendir($configureDir)) {
            while(false !== ($file = readdir($openConfigureDir))) {
                if($file == "." || $file == "..") continue;
                $fullFilePath = $configureDir . DIRECTORY_SEPARATOR . $file;
                $finalFilePath = $copyTo . DIRECTORY_SEPARATOR . $file;
                @copy($fullFilePath, $finalFilePath);
            }
        }
        echo "\e[32mOK!\e[37m\n";
    }

    public static function copyFile(string $from, string $to)
    {
        echo "\e[32m>>> \e[36mcopying file...\e[37m ";
        copy($from, $to);
        echo "\e[32mOK!\e[37m\n";
    }

    /**
     * Создание директории
     * @param string $path
     */
    public static function createDirectoryIfNotExists(string $path)
    {
        echo "\e[32m>>> \e[36mcreating directories...\e[37m ";
        $backupsDir = self::makeRightSlashes($path);
        if(!file_exists($backupsDir)) mkdir($backupsDir, 0777, true);
        echo "\e[32mOK!\e[37m\n";
    }

}