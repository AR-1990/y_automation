@extends('layouts.app')

@section('title', 'Pending Live Events')
@section('header', 'Live Events (Pending Approval)')

@section('content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Clips Awaiting Approval</h2>
        <p class="text-slate-500 mt-1">Review AI-generated clips before they are published to social media.</p>
    </div>
</div>

@if(session('success'))
<div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-sm mb-6 flex items-center gap-3 shadow-sm animate-fade-in-down">
    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($clips as $index => $clip)
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-down flex flex-col" style="animation-delay: {{ $index * 0.1 }}s;">
        <!-- Video Placeholder / Player -->
        <div class="relative bg-slate-900 aspect-[9/16] w-full flex items-center justify-center overflow-hidden group">
            <!-- Simulated Video -->
            <img src="https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity" alt="Cricket Match">
            
            <!-- Play Button Overlay -->
            <button class="absolute z-10 w-14 h-14 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-indigo-600 transition-all">
                <i class="fas fa-play ml-1 text-xl"></i>
            </button>
            
            <!-- Badges -->
            <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                <span class="px-2.5 py-1 bg-red-500/90 backdrop-blur text-white text-[10px] font-bold rounded-md uppercase tracking-wide">
                    {{ $clip->matchEvent->event_type }}
                </span>
            </div>
            
            <!-- Score Overlay Simulation -->
            <div class="absolute bottom-6 left-0 right-0 px-6 z-10 text-center">
                <div class="bg-slate-900/80 backdrop-blur-md rounded-xl p-3 border border-slate-700/50">
                    <p class="text-white font-bold text-sm truncate">{{ $clip->matchEvent->cricketMatch->title }}</p>
                    <p class="text-indigo-400 font-bold text-lg mt-1">{{ $clip->matchEvent->score_snapshot ?? 'N/A' }}</p>
                    <p class="text-slate-300 text-[11px] mt-0.5">{{ $clip->matchEvent->match_time ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Details & Actions -->
        <div class="p-5 flex flex-col flex-1">
            
            <form action="{{ route('clips.update', $clip->id) }}" method="POST" class="flex-1">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">AI Caption</label>
                    <textarea name="caption" rows="3" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 outline-none transition custom-scrollbar resize-none">{{ $clip->caption }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Hashtags</label>
                    <input type="text" name="hashtags" value="{{ $clip->hashtags }}" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 outline-none transition text-indigo-600 font-medium">
                </div>
                
                <button type="submit" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors w-full text-right mb-4">
                    <i class="fas fa-save mr-1"></i> Save Edits
                </button>
            </form>

            <div class="grid grid-cols-2 gap-3 mt-auto pt-4 border-t border-slate-100">
                <form action="{{ route('clips.reject', $clip->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 rounded-lg font-bold text-sm text-red-600 bg-red-50 hover:bg-red-100 transition-colors">
                        Reject
                    </button>
                </form>
                
                <form action="{{ route('clips.approve', $clip->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 rounded-lg font-bold text-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-sm">
                        Approve & Post
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fas fa-check-double"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900">All Caught Up!</h3>
        <p class="text-slate-500 mt-1 max-w-sm mx-auto">There are no pending clips waiting for approval at the moment. When new live events happen, they will appear here.</p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $clips->links('pagination::tailwind') }}
</div>
@endsection