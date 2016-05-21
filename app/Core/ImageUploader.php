<?php
namespace App\Core;

use App;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{

    public $imageService;

    public function upload(UploadedFile $file, Model $model)
    {
        $this->setImageService($model);
        // upload the file to the server
        $upload = $this->imageService->store($file);

        return $upload;
    }

    /**
     * @return mixed
     */
    public function getImageService()
    {
        return $this->imageService;
    }

    /**
     * @param $model
     */
    public function setImageService(Model $model)
    {
        $imageService = App::make('App\\Src\\' . $this->getClassShortName($model) . '\\ImageService');

        $this->imageService = $imageService;
    }

    public function destroy($model, $photo)
    {
        // set the class
        $this->setImageService($model);

        // destroy the file
        $this->imageService->destroy($photo->name);

        //destroy the db file
    }

    public function getClassShortName(Model $model)
    {
        $model = new \ReflectionClass($model);
        $classShortName = $model->getShortName();

        return $classShortName;
    }
}