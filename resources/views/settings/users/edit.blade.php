@extends('layouts.app')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="mb-8">
    <a href="{{ route('settings.users.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900 mb-2 inline-block">
        <i class="fas fa-arrow-left mr-1"></i> Back to Users
    </a>
    <h2 class="text-2xl font-bold text-gray-900">Edit: {{ $user->name }}</h2>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-2xl">
    <form action="{{ route('settings.users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        @if($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <div class="border-t border-gray-100 pt-6 mt-6">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Change Password (Leave blank to keep current)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
            <a href="{{ route('settings.users.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-600 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-xl font-bold hover:bg-gray-800 shadow-sm transition">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
