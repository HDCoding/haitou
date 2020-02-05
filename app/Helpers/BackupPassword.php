<?php

namespace App\Helpers;

use PhpZip\Exception\ZipException;
use PhpZip\ZipFile;

class BackupPassword
{
    /**
     * Path to .zip-file.
     *
     * @var string
     */
    public $path;

    /**
     * Read the .zip, apply password and encryption, then rewrite the file.
     *
     * @param string $path the path to the .zip-file
     */
    public function __construct(string $path)
    {
        consoleOutput()->info('Aplicando senha e criptografia ao zip...');

        // Create a new zip, add the zip from spatie/backup, encrypt and resave/overwrite
        $zipFile = new ZipFile();

        try {
            $zipFile
                ->addFile($path, 'backup.zip', ZipFile::METHOD_DEFLATED)
                ->setPassword(config('backup.security.password'), config('backup.security.encryption'))
                ->saveAsFile($path)
                ->close();
        } catch (ZipException $exception) {
            // handle exception
        } finally {
            $zipFile->close();
        }

        consoleOutput()->info('Senha e criptografia aplicadas com êxito ao zip.');

        $this->path = $path;
    }
}
