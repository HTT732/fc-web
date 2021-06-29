<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait ImageManipulation
{
    /**
     * upload Image
     *
     * @param file $originalFile
     * @param string $rootFolder
     * @param array $listSize
     * @param bool $imagePosition
     * @return mixed
     */
    public function processUploadImage($originalFile, $rootFolder, $listSize = array(), $imagePosition = false)
    {
        // check folder
        $this->createDirectoryFolderInPublic($rootFolder, $listSize);

        // upload image
        $result = $this->uploadImageToPublic($originalFile, $rootFolder, $listSize, $imagePosition);

        // check and remove
        if ($result['msgCode'] === 400) {
            foreach ($result['image'] as $key => $image) {
                $this->deleteImageUpload($image);
            }
        }
        return $result;
    }

    /**
     * upload Image
     *
     * @param object $originalFile
     * @param $rootFolder
     * @param $listSize
     * @param $imagePosition
     * @return array
     */
    public function uploadImageToPublic($originalFile, $rootFolder, $listSize, $imagePosition)
    {
        $image_size_array = getimagesize($originalFile);
        $image_aspect_ratio = ($image_size_array[0] / $image_size_array[1]);
        $imageName = \microtime(true) . "." . $originalFile->getClientOriginalName();

        // upload image
        $result = array();
        if (count($listSize) > 0) {
            $continueUpload = true;
            foreach ($listSize as $key => $size) {
                $sizeRatio = $size['width'] / $size['height'];
                if ($continueUpload) {
                    if (!$imagePosition) {
                        $img = Image::canvas($size['width'], $size['height']);
                        $image = Image::make($originalFile);
                        $this->widenOrHeightenImage($image, $image_aspect_ratio, $sizeRatio, $size['width'], $size['height'], $imagePosition);
                        $img->insert($image, 'center');
                    } else {
                        $img = Image::make($originalFile);
                        $this->widenOrHeightenImage($img, $image_aspect_ratio, $sizeRatio, $size['width'], $size['height'], $imagePosition);
                    }
                    $pathUpload = public_path()."/$rootFolder/$key/$imageName";
                    if ($img->save($pathUpload)) {
                        $result['msgCode'] = 200;
                        $result['image'][$key] = "/$rootFolder/$key/$imageName";
                    } else {
                        $result['msgCode'] = 400;
                        $continueUpload = false;
                    }
                }
            }
        } else {
            $img = Image::make($originalFile);
            $pathUpload = public_path() . "/$rootFolder" . "" . "$imageName";
            if ($img->save($pathUpload)) {
                $result['msgCode'] = 200;
                $result['image'] = "$imageName";
            } else {
                $result['msgCode'] = 400;
            }
        }

        return $result;
    }

    /**
     * Check ratio and wide with or height
     *
     * @param  object  $image
     * @param  float  $ratioOrigin
     * @param  float  $newRatio
     * @param  int  $newWidth
     * @param  int  $newHeight
     * @param  boolean  $imagePosition
     * @return mixed
     */
    public function widenOrHeightenImage($image, $ratioOrigin, $newRatio, $newWidth, $newHeight, $imagePosition)
    {
        if ($ratioOrigin > $newRatio) {
            $image->heighten((int) $newHeight);
        } else {
            if ($ratioOrigin < $newRatio) {
                $image->widen((int) $newWidth);
            } else {
                if ($imagePosition) {
                    $image->resize((int) $newWidth, (int) $newHeight);
                } else {
                    $image->resize((int) $newWidth, (int) $newHeight, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            }
        }
    }

    /**
     * delete image from folder
     *
     * @param object $originalFile
     * @param string $imageName
     */
    public function deleteImageUpload($imagePath)
    {
        $imagePath = public_path() . "/$imagePath";
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return true;
        }

        return false;
    }

    /**
     * delete image from folder
     *
     * @param array $dataImage
     * @param array $dataSize
     */
    public function deleteListSizeImageUpload($dataImage, $dataSize)
    {
        if (count($dataImage) > 0 && array_key_exists('image', $dataImage)) {
            foreach ($dataSize as $key => $value) {
                if (array_key_exists($key, $dataImage['image'])) {
                    $this->deleteImageUpload($dataImage['image'][$key]);
                }
            }
        }
    }

    /**
     * create directory folder image
     *
     * @return mixed
     */
    public function createDirectoryFolderInPublic($rootFolder, $listSize)
    {
        $uploadPath = public_path() . "/$rootFolder";
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, $mode = 0777, true, true);
        }

        if (count($listSize) > 0) {
            foreach ($listSize as $key => $value) {
                $uploadPath = public_path() . "/$rootFolder/$key";
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, $mode = 0777, true, true);
                }
            }
        }
    }
}
