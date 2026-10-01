@extends('layouts.app')

@section('title', 'Users Management')
@section('header', 'Users Management')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">System Users</h2>
        <p class="text-slate-500 mt-1">Manage admins and staff access to the engine.</p>
    </div>
    <a href="{{ route('settings.users.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Add New User
    </a>
</div>

@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-3 shadow-sm">
    <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
    <ul class="list-disc pl-5">
        @foreach($errors->all() as $error)
            <li class="font-medium">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4 font-bold">Name</th>
                    <th class="px-6 py-4 font-bold">Email</th>
                    <th class="px-6 py-4 font-bold">Created At</th>
                    <th class="px-6 py-4 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        {{ $user->name }}
                        @if(auth()->id() === $user->id)
                            <span class="ml-2 bg-indigo-50 border border-indigo-100 text-indigo-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">You</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-medium">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('settings.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors">Edit</a>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('settings.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold transition-colors">Delete</button>
                            </form>
                            @else
                                <span class="text-slate-300 font-medium cursor-not-allowed" title="You cannot delete yourself">Delete</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
