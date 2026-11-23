<?php

namespace App\Http\Controllers\Admin;

use App\Support\SiteContent;
use Illuminate\Http\Request;

class ContentController extends AdminController
{
    public function index(Request $request)
    {
        $groups = config('site_content');
        $active = $request->input('group', 'general');
        if (!isset($groups[$active])) {
            $active = 'general';
        }

        return view('admin.content.index', [
            'groups' => $groups,
            'active' => $active,
            'group'  => $groups[$active],
            'values' => SiteContent::values(),
        ]);
    }

    public function update(Request $request, $groupKey)
    {
        $groups = config('site_content');
        abort_unless(isset($groups[$groupKey]), 404);
        $fields = $groups[$groupKey]['fields'];

        $rules = [];
        $names = [];
        foreach ($fields as $key => $field) {
            $input = $this->inputName($key);
            $names[$input] = $field['label'];
            switch ($field['type']) {
                case 'toggle':
                    $rules[$input] = 'nullable|in:0,1';
                    break;
                case 'image':
                    $rules['file_' . $input] = 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:5120';
                    $names['file_' . $input] = $field['label'];
                    break;
                case 'video':
                    $rules['file_' . $input] = 'nullable|file|mimes:mp4,webm,jpg,jpeg,png,webp|max:51200';
                    $names['file_' . $input] = $field['label'];
                    break;
                case 'email':
                    $rules[$input] = 'nullable|email|max:191';
                    break;
                case 'url':
                    $rules[$input] = 'nullable|url|max:2000';
                    break;
                case 'text':
                    $rules[$input] = 'nullable|string|max:1000';
                    break;
                default:
                    $rules[$input] = 'nullable|string|max:20000';
            }
        }

        $request->validate($rules, [], $names);

        $reset = (array) $request->input('reset', []);
        $changed = 0;

        foreach ($fields as $key => $field) {
            $input = $this->inputName($key);
            $current = SiteContent::values();

            if (!empty($reset[$input])) {
                if (isset($current[$key]) && in_array($field['type'], ['image', 'video'], true)) {
                    $this->deleteUpload($current[$key]);
                }
                SiteContent::forget($key);
                $changed++;
                continue;
            }

            if (in_array($field['type'], ['image', 'video'], true)) {
                if ($request->hasFile('file_' . $input)) {
                    if (isset($current[$key])) {
                        $this->deleteUpload($current[$key]);
                    }
                    SiteContent::set($key, $this->storeUpload($request->file('file_' . $input), 'content'));
                    $changed++;
                }
                continue;
            }

            if ($field['type'] === 'toggle') {
                $value = $request->input($input) === '1' ? '1' : '0';
            } else {
                $value = (string) $request->input($input, '');
            }

            if ((string) SiteContent::get($key) !== $value) {
                SiteContent::set($key, $value);
                $changed++;
            }
        }

        return redirect()->route('admin.content.index', ['group' => $groupKey])
            ->with('success', $changed ? $groups[$groupKey]['title'] . ' saved. The website has been updated.' : 'No changes to save.');
    }

    /** Dots are not allowed in request keys, so "hero.1.title" becomes "hero__1__title". */
    protected function inputName($key)
    {
        return str_replace('.', '__', $key);
    }
}
