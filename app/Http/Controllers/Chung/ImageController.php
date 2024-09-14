<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
  //
  function uploads(Request $request, $locale = '')
  {
    $files = $request->file('hinhanh_files');
    if (!empty($files)) :
      foreach ($files as $file) :
        $extension = $file->getClientOriginalExtension();
        $realname = $file->getClientOriginalName();
        $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
        Storage::put('private/images/' . $filename, file_get_contents($file), 'private');
        $origin = Storage::disk('local')->path('/public/images/origin/' . $filename);
        Image::make($file->getRealPath())->save($origin);
        $thumb = Storage::disk('local')->path('/public/images/thumb_360x200/' . $filename);
        Image::make($file->getRealPath())->resize(360, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($thumb);
        $thumb_50 = Storage::disk('local')->path('/public/images/thumb_50/' . $filename);
        Image::make($file->getRealPath())->resize(null, 50, function ($constraint) {
          $constraint->aspectRatio();
        })->save($thumb_50);
        echo '<div class="col-sm-6 col-md-4 items draggable-element text-center position-relative">
                <input type="hidden" name="hinhanh_aliasname[]" value="' . $filename . '" readonly/>
                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="' . $realname . '" />
                <input type="hidden" name="hinhanh_type[]" class="form-control" value="' . $extension . '" />
                  <a href="' . env('APP_URL') . 'storage/images/origin/' . $filename . '" class="image-popup">
                    <div class="portfolio-masonry-box">
                      <div class="portfolio-masonry-img">
                        <img src="' . env('APP_URL') . 'storage/images/thumb_360x200/' . $filename . '" class="thumb-img img-fluid" alt="' . $filename . '">
                      </div>
                      <div class="portfolio-masonry-detail">
                        <p>' . $realname . '</p>
                      </div>
                    </div>
                  </a>
                  <a href="' . env('APP_URL') . 'image/delete/' . $filename . '" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:4px;right:4px;">
                    <i class="fa fa-trash"></i>
                  </a>
                  <input type="text" name="hinhanh_title[]" class="form-control" value="' . $realname . '" />
                </div>';
      endforeach;
    endif;
  }

  function delete(Request $request, $filename = '')
  {
    Storage::delete('private/images/' . $filename);
    Storage::delete('public/images/origin/' . $filename);
    Storage::delete('public/images/thumb_360x200/' . $filename);
    Storage::delete('public/images/thumb_50/' . $filename);
    // Storage::delete('public/images/thumb_800x800/'.$filename);
    // Storage::delete('public/images/thumb_785x476/'.$filename);
  }

  static function remove($filename)
  {
    Storage::delete('private/images/' . $filename);
    Storage::delete('public/images/origin/' . $filename);
    Storage::delete('public/images/thumb_360x200/' . $filename);
    Storage::delete('public/images/thumb_50/' . $filename);
    // Storage::delete('public/images/thumb_800x800/'.$filename);
    // Storage::delete('public/images/thumb_785x476/'.$filename);
  }

  static function save($file)
  {
    if (!empty($file)) :
      $extension = $file->getClientOriginalExtension();
      $realname = $file->getClientOriginalName();
      $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
      Storage::put('private/images/' . $filename, file_get_contents($file), 'private');
      $origin = Storage::disk('local')->path('/public/images/origin/' . $filename);
      Image::make($file->getRealPath())->save($origin);
      $thumb = Storage::disk('local')->path('/public/images/thumb_360x200/' . $filename);
      Image::make($file->getRealPath())->resize(360, null, function ($constraint) {
        $constraint->aspectRatio();
      })->save($thumb);
      $thumb_50 = Storage::disk('local')->path('/public/images/thumb_50/' . $filename);
      Image::make($file->getRealPath())->resize(null, 50, function ($constraint) {
        $constraint->aspectRatio();
      })->save($thumb_50);
      return [
        'aliasname' => $filename,
        'title' => $realname,
        'type' => $extension
      ];
    endif;
  }

  static function save_many($files)
  {
    $arr = array();
    if (!empty($files)) :
      foreach ($files as $file) :
        $extension = $file->getClientOriginalExtension();
        $realname = $file->getClientOriginalName();
        $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
        Storage::put('private/images/' . $filename, file_get_contents($file), 'private');
        $origin = Storage::disk('local')->path('/public/images/origin/' . $filename);
        Image::make($file->getRealPath())->save($origin);
        $thumb = Storage::disk('local')->path('/public/images/thumb_360x200/' . $filename);
        Image::make($file->getRealPath())->resize(360, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($thumb);
        $thumb_50 = Storage::disk('local')->path('/public/images/thumb_50/' . $filename);
        Image::make($file->getRealPath())->resize(null, 50, function ($constraint) {
          $constraint->aspectRatio();
        })->save($thumb_50);
        $arr[] =  [
          'aliasname' => $filename,
          'title' => $realname,
          'type' => $extension
        ];
      endforeach;
      return $arr;
    endif;
  }

  static function toSaveArray($data)
  {
    $arr_hinhanh = array();
    if (isset($data['hinhanh_aliasname'])) {
      foreach ($data['hinhanh_aliasname'] as $key => $dk) {
        $arr = array(
          'aliasname' => $dk,
          'title' => $data['hinhanh_title'][$key],
          'type' => $data['hinhanh_type'][$key]
        );
        $arr_hinhanh[] = $arr;
      }
    }
    return $arr_hinhanh;
  }
}
