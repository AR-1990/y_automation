@extends('layouts.app')

@section('title', 'Highlight Library')
@section('header', 'Highlight Library')

@section('content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Published Highlights</h2>
        <p class="text-slate-500 mt-1">Browse all clips that have been successfully published to your social channels.</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-down">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest w-20">Preview</th>
                    <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest">Match & Event</th>
                    <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest hidden md:table-cell">Caption</th>
                    <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest text-center w-32">Status</th>
                    <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest text-right w-32">Date</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($clips as $clip)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors group">
                    <td class="py-3 px-6">
                        <div class="w-12 h-16 bg-slate-900 rounded-md overflow-hidden relative shadow-sm">
                            <img src="https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?q=80&w=100&auto=format&fit=crop" class="w-full h-full object-cover opacity-60" alt="Thumb">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-play text-white text-[10px] opacity-70"></i>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-6 font-medium text-slate-900">
                        {{ $clip->matchEvent->cricketMatch->title }}
                        <div class="text-xs text-slate-500 font-normal mt-0.5">
                            <span class="font-bold text-indigo-600">{{ $clip->matchEvent->event_type }}</span> • {{ $clip->matchEvent->match_time ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-slate-600 hidden md:table-cell max-w-xs truncate">
                        {{ $clip->caption }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Published
                        </span>
                    </td>
                    <td class="py-3 px-6 text-right text-slate-500">
                        {{ $clip->updated_at->format('M d, Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-500">
                        No published highlights found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8">
    {{ $clips->links('pagination::tailwind') }}
</div>
@endsection