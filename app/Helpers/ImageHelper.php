<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageHelper
{
    public $file;
    public $path = '';
    public $lazyPath = '';
    public function __construct($file) {
        $this->file = $file;
    }
    function PutImage(string $dir) : void
    {
        // $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $manager = new ImageManager(new Driver());
        $img = $manager->read($this->file);
        if ($img->width() > 2000 && $img->width() > $img->height()){
            $height = $img->height() / ($img->width() / 2000);
            $img->resize(2000, $height);
        }
        elseif ($img->height() > 2000) {
            $width = $img->width() / ($img->height() / 2000);
            $img->resize($width, 2000);
        }
        $name = Carbon::now()->format('YmdHisu') .  '.' . 'webp';
        $path = $dir . '/' . $name;
        
        Storage::disk('public')->makeDirectory($dir);
        $manager->create($img->width(), $img->height())
            ->fill('#FFFFFF')
            ->place($img)
            ->toWebp(90)
            ->save(storage_path("app/public/$path"));
        // $path = Storage::disk('public')->putFileAs($dir, $imageData, $name);
        // save lazy image

        $lazyName = basename($name, ".webp") . "_lazy.webp";
        $lazyPath = $dir . "/" . $lazyName;
        
        $resolution = [
            "width" => $img->width(),
            "height" => $img->height()
        ];
        if ($img->width() > 300 && $img->width() > $img->height()){
            $height = $img->height() / ($img->width() / 300);
            $img->resize(300, $height);
            $resolution = ["width" => 300, "height" => $height];
        }
        elseif ($img->height() > 300) {
            $width = $img->width() / ($img->height() / 300);
            $img->resize($width, 300);
            $resolution = ["width" => $width, "height" => 300];
        }
        $manager->create($resolution['width'], $resolution['height'])->fill('#FFFFFF')
            ->place($img)
            ->blur(20)->toWebp(70)
            ->save(storage_path("app/public/$lazyPath"));
        
        // Storage::disk('public')->putFileAs($dir, $lazyImageData, $lazyName);
        // $img->blur(20)->save(storage_path('app/public/' . $lazyPath), 70, 'webp');
    
        $this->path = $path;
        $this->lazyPath = $lazyPath;
    }
    static function getLazyImagePath(string $origPath) : string
    {
        return dirname($origPath) . "/" . pathinfo($origPath, PATHINFO_FILENAME) . "_lazy." . pathinfo($origPath, PATHINFO_EXTENSION);
    }
    static function DeleteImage(string $path) : void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        if (Storage::disk('public')->exists(ImageHelper::getLazyImagePath($path))) {
            Storage::disk('public')->delete(ImageHelper::getLazyImagePath($path));
        }
    }
}