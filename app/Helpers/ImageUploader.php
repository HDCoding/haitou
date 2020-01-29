<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
     * @param $path
     * @param $folderId
     * @param $filename
     * @param $image
     */
    public function uploadImage($path, $filename, $image)
    {
        $this->pathExist($path);

        $local = $path . '/';

        $imageMake = Image::make($image);

        $imageMake->save($local . $filename);
    }

    /**
     * Delete only one image
     * Receive directory and filename as parameter
     */
    public function removeImage($path, $filename)
    {
        if (File::exists($path . '/' . $filename)) {
            //File::deleteDirectory($path . $folderId . '/' . $filename);
            unlink($path . '/' . $filename);
        }
    }

    /**
     * Check if the directory exists, otherwise create it with ID name
     * @param $path
     */
    public function pathExist($path)
    {
        $path = $path . '/';

        if (!file_exists($path) && !is_dir($path)) {
            mkdir($path, 0644, true);
        }
    }
}
