<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends AdminController
{
    public function index(Request $request)
    {
        $query = GalleryImage::query();
        $filter = $request->input('show');
        if ($filter === 'home') {
            $query->where('show_on_home', true);
        } elseif ($filter === 'gallery') {
            $query->where('show_in_gallery', true);
        } elseif ($filter === 'hidden') {
            $query->where('is_active', false);
        }
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $images = $query->ordered()->get();
        $categories = GalleryImage::query()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category');
        $homeCount = GalleryImage::active()->where('show_on_home', true)->count();

        return view('admin.gallery.index', compact('images', 'categories', 'homeCount'));
    }

    public function store(Request $request)
    {
        $rules = [
            'images'   => 'required|array|max:20',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'title'    => 'nullable|string|max:191',
            'caption'  => 'nullable|string|max:191',
            'category' => 'nullable|string|max:100',
        ];
        $data = $request->validate($rules, [], ['images.*' => 'image']);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        $order = (int) GalleryImage::max('sort_order');
        foreach ($request->file('images') as $file) {
            $order += 10;
            GalleryImage::create([
                'title'           => $data['title'],
                'caption'         => $data['caption'],
                'category'        => $data['category'],
                'alt'             => $data['title'] ?: 'Mirissa snorkeling',
                'image'           => $this->storeUpload($file, 'gallery'),
                'show_on_home'    => $request->boolean('show_on_home'),
                'show_in_gallery' => $request->boolean('show_in_gallery'),
                'is_active'       => true,
                'sort_order'      => $order,
            ]);
        }

        return back()->with('success', count($request->file('images')) . ' image(s) uploaded.');
    }

    public function update(Request $request, GalleryImage $image)
    {
        $rules = [
            'title'      => 'nullable|string|max:191',
            'caption'    => 'nullable|string|max:191',
            'category'   => 'nullable|string|max:100',
            'alt'        => 'nullable|string|max:191',
            'sort_order' => 'nullable|integer|min:0|max:100000',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        if ($request->hasFile('image_file')) {
            $this->deleteUpload($image->image);
            $image->image = $this->storeUpload($request->file('image_file'), 'gallery');
        }

        $image->fill([
            'title'           => $data['title'],
            'caption'         => $data['caption'],
            'category'        => $data['category'],
            'alt'             => $data['alt'],
            'sort_order'      => (int) $data['sort_order'],
            'show_on_home'    => $request->boolean('show_on_home'),
            'show_in_gallery' => $request->boolean('show_in_gallery'),
            'is_active'       => $request->boolean('is_active'),
        ])->save();

        return back()->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $image)
    {
        $this->deleteUpload($image->image);
        $image->delete();

        return back()->with('success', 'Image deleted.');
    }
}
