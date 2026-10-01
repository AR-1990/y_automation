@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'System Overview')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome, {{ auth()->user()->name }}</h2>
    <p class="text-slate-500 mt-1">Here's what is happening with your media pipeline today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-5 group animate-fade-in-down" style="animation-delay: 0.1s;">
        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="fas fa-bolt"></i>
        </div>
        <div>
            <p class="text-[13px] font-bold text-slate-500 uppercase tracking-wide">Events Processed</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ number_format($eventsProcessed) }}</h3>
        </div>
    </div>
    
    <!-- Stat 2 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-5 group animate-fade-in-down" style="animation-delay: 0.2s;">
        <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="fas fa-clock"></i>
        </div>
        <div>
            <p class="text-[13px] font-bold text-slate-500 uppercase tracking-wide">Pending Approval</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ number_format($pendingApproval) }}</h3>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-5 group animate-fade-in-down" style="animation-delay: 0.3s;">
        <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="fas fa-share-nodes"></i>
        </div>
        <div>
            <p class="text-[13px] font-bold text-slate-500 uppercase tracking-wide">Published to Social</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ number_format($published) }}</h3>
        </div>
    </div>
</div>

<!-- Recent Activity Table -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-down" style="animation-delay: 0.4s;">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-900">Recent AI Clips</h3>
        <a href="{{ route('clips.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Event</th>
                    <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Match</th>
                    <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Time</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($recentClips as $clip)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                    <td class="py-3 px-6 font-semibold text-slate-900">{{ $clip->matchEvent->event_type }}</td>
                    <td class="py-3 px-6 text-slate-600 truncate max-w-[200px]">{{ $clip->matchEvent->cricketMatch->title }}</td>
                    <td class="py-3 px-6 text-center">
                        @if($clip->status == 'pending')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-orange-50 text-orange-600 border border-orange-200">Pending</span>
                        @elseif($clip->status == 'approved' || $clip->status == 'published')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200">Published</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-red-50 text-red-600 border border-red-200">Rejected</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-right text-slate-500 text-xs">{{ $clip->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 text-center text-slate-500">No recent clips found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection