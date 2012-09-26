<?php

namespace Witty\Model;

use Gaufrette\FileSystem as BaseFileSystem;
use Symfony\Component\HttpFoundation\File\File as File;

class Filesystem extends BaseFileSystem
{

    /**
     * Moves a file to a location of the fileSystem
     *
     * @param  File $file, string folder
     *
     * @return boolean
     */
    public function moveFile(File $file, $folder = "", $filename = "")
    {
        return $this->adapter->moveFile($file, $folder, $filename);
    }
}