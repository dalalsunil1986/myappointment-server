<?php
namespace App\Core;

use Exception;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class BaseImageService
{

    private $uploadDir;

    private $thumbnailImagePath;

    private $largeImagePath;

    private $mediumImagePath;

    protected $largeImageWidth = '750';

    protected $mediumImageWidth = '500';

    protected $thumbnailImageWidth = '250';

    protected $hashedName;

    public function __construct()
    {
        $this->uploadDir          = public_path().env('IMAGES_UPLOAD_DIR');
        $this->largeImagePath     = $this->getUploadDir() . env('LARGE_IMAGE_DIR');
        $this->mediumImagePath    = $this->getUploadDir() . env('MEDIUM_IMAGE_DIR');
        $this->thumbnailImagePath = $this->getUploadDir() . env('THUMBNAIL_IMAGE_DIR');
    }

    abstract function store(UploadedFile $image);

    protected function process(UploadedFile $image, array $imageDimensions = [])
    {
        $this->setHashedName($image);

        foreach ($imageDimensions as $imageDimension) {
            switch ($imageDimension) {
                case 'large':
                    Image::make($image->getRealPath())->resize($this->largeImageWidth,
                        null,function($constraint) {
                            $constraint->aspectRatio();
                        })->save($this->largeImagePath . $this->hashedName);
                    break;
                case 'medium':
                    Image::make($image->getRealPath())->resize($this->mediumImageWidth,
                        null,function($constraint) {
                            $constraint->aspectRatio();
                        })->save($this->mediumImagePath . $this->hashedName);
                    break;
                case 'thumbnail':
                    Image::make($image->getRealPath())->resize($this->thumbnailImageWidth,
                        null,function($constraint) {
                            $constraint->aspectRatio();
                        })->save($this->thumbnailImagePath . $this->hashedName);
                    break;
                default :
                    break;
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    /**
     * @return mixed
     */
    public function getLargeImagePath()
    {
        return $this->largeImagePath;
    }

    /**
     * @return mixed
     */
    public function getMediumImagePath()
    {
        return $this->mediumImagePath;
    }

    /**
     * @return mixed
     */
    public function getThumbnailImagePath()
    {
        return $this->thumbnailImagePath;
    }

    public function destroy($name)
    {
        if (file_exists($this->getThumbnailImagePath() . $name)) {
            unlink($this->getThumbnailImagePath() . $name);
        }
        if (file_exists($this->getMediumImagePath() . $name)) {
            unlink($this->getMediumImagePath() . $name);
        }
        if (file_exists($this->getLargeImagePath() . $name)) {
            unlink($this->getLargeImagePath() . $name);
        }
    }

    public function getHashedName()
    {
        return $this->hashedName;
    }

    public function setHashedName($file)
    {
        $this->hashedName = md5(uniqid(rand() * (time()))) . '.' . $file->getClientOriginalExtension();
        return $this;
    }

}