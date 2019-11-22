<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageUploader
 * Image Upload
 * Directory Creation/Deletion
 * @package App\Helpers
 */
class ImageUploader
{

    /**
     * Uploading image
     * It receives as a parameter the directory, ID, file name in MD5 and the image file
     * Check with the pathExist function
     * Saves the image in the place passed by parameter
     */
    public function uploadImage($path, $folderId, $filename, $image)
    {
        $this->pathExist($path, $folderId);

        $local = $path . $folderId . '/';

        $imageMake = Image::make($image);

        $imageMake->save($local . $filename);
    }

    /**
     * Delete only one image
     * Receive directory and filename as parameter
     */
    public function removeImage($path, $folderId, $filename)
    {
        if (File::exists($path . $folderId . '/' . $filename)) {
            //File::deleteDirectory($path . $folderId . '/' . $filename);
            unlink($path . $folderId . '/' . $filename);
        }
    }

    /**
     * Delete directory and all contents within
     */
    public function removeDirectory($path, $folderId)
    {
        if (File::exists($path . $folderId)) {
            File::deleteDirectory($path . $folderId);
            //unlink($path . $folderId);
        }
    }

    /**
     * Check if the directory exists, otherwise create it with ID name
     */
    public function pathExist($path, $folderId)
    {
        $path = $path . $folderId . '/';

        if (!file_exists($path) && !is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
}
