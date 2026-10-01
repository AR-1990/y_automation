@extends('layouts.app')

@section('title', 'Add User')
@section('header', 'Add System User')

@section('content')
<div class="mb-8">
    <a href="{{ route('settings.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 mb-2 inline-block transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Back to Users
    </a>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Create New User</h2>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-2xl">
    <form action="{{ route('settings.users.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

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
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="John Doe" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end gap-3 border-t border-slate-100 mt-4">
            <a href="{{ route('settings.users.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition-colors">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all">
                Create User
            </button>
        </div>
    </form>
</div>
@endsection
