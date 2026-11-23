<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

abstract class AdminController extends Controller
{
    /**
     * Saves an uploaded file under /public/uploads/{folder} and returns the
     * path relative to /public (e.g. "uploads/packages/abc.jpg").
     */
    protected function storeUpload(UploadedFile $file, $folder)
    {
        $directory = public_path('uploads/' . $folder);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'file';
        $name = Str::limit($base, 40, '') . '-' . date('YmdHis') . '-' . Str::random(5) . '.' . strtolower($file->getClientOriginalExtension());
        $file->move($directory, $name);

        return 'uploads/' . $folder . '/' . $name;
    }

    /** Deletes a previously uploaded file. Original theme assets (img/...) are never deleted. */
    protected function deleteUpload($path)
    {
        if ($path && Str::startsWith($path, 'uploads/') && strpos($path, '..') === false) {
            $full = public_path($path);
            if (File::exists($full)) {
                File::delete($full);
            }
        }
    }
}
