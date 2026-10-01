@extends('layouts.app')

@section('title', 'Edit API Integration')
@section('header', 'Edit API Integration')

@section('content')
<div class="mb-8">
    <a href="{{ route('settings.apis.index') }}" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 mb-2 inline-block transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Back to APIs
    </a>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit: {{ $apiCredential->name }}</h2>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('settings.apis.update', $apiCredential->id) }}" method="POST" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl text-sm mb-6 flex items-center gap-3 shadow-sm">
            <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li class="font-medium">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Configuration Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $apiCredential->name) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Provider <span class="text-red-500">*</span></label>
                <select name="provider" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition bg-white text-slate-700">
                    <option value="youtube" {{ old('provider', $apiCredential->provider) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="cricclubs" {{ old('provider', $apiCredential->provider) == 'cricclubs' ? 'selected' : '' }}>CricClubs</option>
                    <option value="facebook" {{ old('provider', $apiCredential->provider) == 'facebook' ? 'selected' : '' }}>Facebook Graph</option>
                    <option value="instagram" {{ old('provider', $apiCredential->provider) == 'instagram' ? 'selected' : '' }}>Instagram Graph</option>
                    <option value="custom" {{ old('provider', $apiCredential->provider) == 'custom' ? 'selected' : '' }}>Custom Webhook</option>
                </select>
            </div>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Credentials</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">API Key / Client ID</label>
                    <input type="text" name="api_key" value="{{ old('api_key', $apiCredential->api_key) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition font-mono text-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">API Secret / Password (Leave blank to keep current)</label>
                    <input type="password" name="api_secret" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition font-mono text-sm">
                </div>
            </div>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Advanced</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Base URL</label>
                    <input type="url" name="base_url" value="{{ old('base_url', $apiCredential->base_url) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Additional JSON Config</label>
                    <textarea name="additional_settings" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition font-mono text-sm">{{ old('additional_settings', $apiCredential->additional_settings ? json_encode($apiCredential->additional_settings, JSON_PRETTY_PRINT) : '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-4 rounded-xl">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $apiCredential->is_active) ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                    <label for="is_active" class="font-semibold text-slate-700 cursor-pointer">Enable this API configuration</label>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end gap-3 border-t border-slate-100 mt-4">
            <a href="{{ route('settings.apis.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition-colors">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all">
                Update Configuration
            </button>
        </div>
    </form>
</div>
@endsection
