<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PackageController extends AdminController
{
    public function index(Request $request)
    {
        $query = Package::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($request->input('availability') === 'available') {
            $query->where('is_active', true);
        } elseif ($request->input('availability') === 'unavailable') {
            $query->where('is_active', false);
        }
        $packages = $query->ordered()->get();

        $bookingCounts = Booking::query()
            ->selectRaw('service_name, COUNT(*) as total')
            ->groupBy('service_name')
            ->pluck('total', 'service_name')
            ->all();

        return view('admin.packages.index', compact('packages', 'bookingCounts'));
    }

    public function create()
    {
        $package = new Package(['is_active' => true, 'show_on_home' => true, 'sort_order' => (int) Package::max('sort_order') + 10]);
        return view('admin.packages.form', compact('package'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeUpload($request->file('image_file'), 'packages');
        }
        $package = Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package "' . $package->name . '" created.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.form', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $oldName = $package->name;
        $data = $this->validated($request, $package);

        if ($request->hasFile('image_file')) {
            $this->deleteUpload($package->image);
            $data['image'] = $this->storeUpload($request->file('image_file'), 'packages');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteUpload($package->image);
            $data['image'] = null;
        }

        $package->update($data);

        // Keep existing bookings linked when a package is renamed.
        if ($oldName !== $package->name) {
            Booking::where('service_name', $oldName)->update(['service_name' => $package->name, 'package_id' => $package->id]);
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package "' . $package->name . '" updated.');
    }

    public function toggle(Package $package)
    {
        $package->update(['is_active' => !$package->is_active]);

        return back()->with('success', $package->name . ' is now ' . ($package->is_active ? 'available' : 'unavailable') . ' for booking.');
    }

    public function destroy(Package $package)
    {
        $this->deleteUpload($package->image);
        $name = $package->name;
        Booking::where('package_id', $package->id)->update(['package_id' => null]);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package "' . $name . '" deleted. Existing bookings keep the service name.');
    }

    protected function validated(Request $request, Package $package = null)
    {
        $rules = [
            'name'              => ['required', 'string', 'max:150', Rule::unique('packages', 'name')->ignore($package ? $package->id : null)],
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string|max:20000',
            'price'             => 'nullable|numeric|min:0|max:999999',
            'price_label'       => 'nullable|string|max:50',
            'duration'          => 'nullable|string|max:100',
            'pickup_time'       => 'nullable|string|max:100',
            'features'          => 'nullable|string|max:5000',
            'detail_url'        => 'nullable|string|max:191',
            'daily_capacity'    => 'nullable|integer|min:1|max:10000',
            'blocked_dates'     => 'nullable|string|max:5000',
            'sort_order'        => 'nullable|integer|min:0|max:100000',
            'image_file'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        $features = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $data['features']))));

        $blocked = [];
        foreach (preg_split('/[\s,]+/', (string) $data['blocked_dates']) as $date) {
            if ($date === '') {
                continue;
            }
            try {
                $blocked[] = Carbon::parse($date)->toDateString();
            } catch (\Throwable $e) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'blocked_dates' => '"' . $date . '" is not a valid date. Use the format YYYY-MM-DD.',
                ]);
            }
        }
        $blocked = array_values(array_unique($blocked));
        sort($blocked);

        $slug = Str::slug($data['name']);
        $base = $slug;
        $i = 2;
        while (Package::where('slug', $slug)->when($package, function ($q) use ($package) {
            $q->where('id', '!=', $package->id);
        })->exists()) {
            $slug = $base . '-' . $i++;
        }

        return [
            'name'              => $data['name'],
            'slug'              => $slug,
            'short_description' => $data['short_description'],
            'description'       => $data['description'],
            'price'             => $data['price'],
            'price_label'       => $data['price_label'],
            'duration'          => $data['duration'],
            'pickup_time'       => $data['pickup_time'],
            'features'          => $features,
            'detail_url'        => $data['detail_url'],
            'daily_capacity'    => $data['daily_capacity'],
            'blocked_dates'     => $blocked,
            'sort_order'        => (int) $data['sort_order'],
            'is_active'         => $request->boolean('is_active'),
            'show_on_home'      => $request->boolean('show_on_home'),
        ];
    }
}
