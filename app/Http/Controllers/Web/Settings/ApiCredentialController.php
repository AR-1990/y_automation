<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use App\Models\ApiCredential;
use Illuminate\Http\Request;

class ApiCredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $credentials = ApiCredential::query()
            ->orderBy($request->sort_by ?? 'id', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 10);

        return view('settings.apis.index', compact('credentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.apis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'base_url' => 'nullable|url|max:255',
            'additional_settings' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (isset($validated['additional_settings'])) {
            $validated['additional_settings'] = json_decode($validated['additional_settings'], true);
        }

        ApiCredential::create($validated);

        return redirect()->route('settings.apis.index')->with('success', 'API Configuration created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiCredential $api)
    {
        return view('settings.apis.edit', ['apiCredential' => $api]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiCredential $api)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'base_url' => 'nullable|url|max:255',
            'additional_settings' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (isset($validated['additional_settings'])) {
            $validated['additional_settings'] = json_decode($validated['additional_settings'], true);
        }

        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        $api->update($validated);

        return redirect()->route('settings.apis.index')->with('success', 'API Configuration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiCredential $api)
    {
        $api->delete();

        return redirect()->route('settings.apis.index')->with('success', 'API Configuration deleted successfully.');
    }
}
