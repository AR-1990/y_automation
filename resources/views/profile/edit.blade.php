@extends('layouts.app')

@section('title', 'My Profile')
@section('header', 'My Profile')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Security Settings</h2>
    <p class="text-slate-500 mt-1">Update your account password securely.</p>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-2xl">
    <form action="{{ route('profile.password.update') }}" method="POST" class="p-8 space-y-6">
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

        <div class="space-y-5">
            <div class="max-w-md">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Current Password <span class="text-red-500">*</span></label>
                <input type="password" name="current_password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
            </div>
            
            <div class="border-t border-slate-100 pt-6 mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">New Password <span class="text-red-500">*</span></label>
                        <input type="password" name="new_password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm New Password <span class="text-red-500">*</span></label>
                        <input type="password" name="new_password_confirmation" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-start border-t border-slate-100 mt-8">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection
