@extends('layouts.app')

@section('title', 'API Integrations')
@section('header', 'API Integrations')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Configured APIs</h2>
        <p class="text-slate-500 mt-1">Manage all your external service credentials securely.</p>
    </div>
    <a href="{{ route('settings.apis.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Add New API
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4 font-bold">Name</th>
                    <th class="px-6 py-4 font-bold">Provider</th>
                    <th class="px-6 py-4 font-bold">Status</th>
                    <th class="px-6 py-4 font-bold">Created At</th>
                    <th class="px-6 py-4 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse($credentials as $api)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $api->name }}</td>
                    <td class="px-6 py-4 text-slate-600 capitalize font-medium">{{ $api->provider }}</td>
                    <td class="px-6 py-4">
                        @if($api->is_active)
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 text-emerald-600 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-200 text-slate-600 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $api->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('settings.apis.edit', $api->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors">Edit</a>
                            <form action="{{ route('settings.apis.destroy', $api->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl border border-slate-100 shadow-sm">
                            <i class="fas fa-plug"></i>
                        </div>
                        <p class="font-bold text-slate-900 text-lg">No APIs Configured</p>
                        <p class="text-sm mt-1 text-slate-500">Get started by adding your first API credentials.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($credentials->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $credentials->links() }}
    </div>
    @endif
</div>
@endsection
