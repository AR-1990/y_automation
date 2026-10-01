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
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">1,248</h3>
        </div>
    </div>
    
    <!-- Stat 2 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-5 group animate-fade-in-down" style="animation-delay: 0.2s;">
        <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="fas fa-clock"></i>
        </div>
        <div>
            <p class="text-[13px] font-bold text-slate-500 uppercase tracking-wide">Pending Approval</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">14</h3>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-5 group animate-fade-in-down" style="animation-delay: 0.3s;">
        <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="fas fa-share-nodes"></i>
        </div>
        <div>
            <p class="text-[13px] font-bold text-slate-500 uppercase tracking-wide">Published to Social</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">432</h3>
        </div>
    </div>
</div>

<!-- Recent Activity Table -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-down" style="animation-delay: 0.4s;">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-900">Recent AI Clips</h3>
        <button class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-lg transition-colors">View All</button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white text-slate-400 text-xs uppercase tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4 font-bold">Event</th>
                    <th class="px-6 py-4 font-bold">Player</th>
                    <th class="px-6 py-4 font-bold">Match Time</th>
                    <th class="px-6 py-4 font-bold">Status</th>
                    <th class="px-6 py-4 font-bold text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center">
                            <i class="fas fa-fire text-xs"></i>
                        </div>
                        SIX
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">Ali Khan</td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">Over 8.4</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 bg-orange-50 border border-orange-100 text-orange-600 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Pending Review
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">Review</button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                            <i class="fas fa-crosshairs text-xs"></i>
                        </div>
                        WICKET
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">John Smith</td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">Over 7.2</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 text-emerald-600 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-slate-400 hover:text-slate-600 transition-colors"><i class="fas fa-external-link-alt"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection