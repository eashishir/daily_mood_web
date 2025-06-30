<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;




class MoodController extends Controller
{
    public function index()
{
    $userId = Auth::id();
    $today = Carbon::today()->toDateString();

    // আজকের mood
    $mood = Mood::where('user_id', $userId)->whereDate('date', $today)->first();

    // 🎖️ Streak Badge Check
    $streak = 0;
    $checkDate = Carbon::today();

    while (true) {
        $hasMood = Mood::where('user_id', $userId)
            ->whereDate('date', $checkDate->toDateString())
            ->exists();

        if ($hasMood) {
            $streak++;
            $checkDate->subDay();
        } else {
            break;
        }
    }

    return view('moods.index', compact('mood', 'streak'));
}

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|in:Happy,Sad,Angry,Excited',
            'note' => 'nullable|string|max:500',
        ]);

        $today = Carbon::today()->toDateString();
        $existing = Mood::where('user_id', Auth::id())->whereDate('date', $today)->first();

        if ($existing) {
            return back()->with('error', 'You have already logged your mood for today.');
        }

        Mood::create([
            'user_id' => Auth::id(),
            'mood' => $request->mood,
            'note' => $request->note,
            'date' => $today,
        ]);

        return back()->with('success', 'Mood saved successfully!');
    }

    public function history(Request $request)
    {
        $query = Mood::where('user_id', Auth::id())->withTrashed();

        if ($request->from && $request->to) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $moods = $query->orderBy('date', 'desc')->get();
        return view('moods.history', compact('moods'));
    }

    public function restore($id)
    {
        $mood = Mood::withTrashed()->findOrFail($id);
        if ($mood->trashed()) {
            $mood->restore();
        }
        return back()->with('success', 'Mood restored!');
    }

    public function destroy($id)
    {
        $mood = Mood::findOrFail($id);
        $mood->delete();
        return back()->with('success', 'Mood deleted!');
    }

    public function summary()
{
    $userId = Auth::id();
    $weekStart = Carbon::now()->startOfWeek();
    $weekEnd = Carbon::now()->endOfWeek();

    $moods = Mood::where('user_id', $userId)
        ->whereBetween('date', [$weekStart, $weekEnd])
        ->get();

    $dailySummary = [];

    // সাত দিনের জন্য mood count ইনিশিয়ালাইজ
    for ($date = $weekStart->copy(); $date <= $weekEnd; $date->addDay()) {
        $dailySummary[$date->format('l')] = [
            'Happy' => 0,
            'Sad' => 0,
            'Angry' => 0,
            'Excited' => 0,
        ];
    }

    foreach ($moods as $mood) {
        $day = Carbon::parse($mood->date)->format('l');
        if (isset($dailySummary[$day])) {
            $dailySummary[$day][$mood->mood]++;
        }
    }

    return view('moods.summary', compact('dailySummary'));
}
    public function exportPdf()
{
    $moods = Mood::where('user_id', Auth::id())
        ->orderBy('date', 'desc')
        ->get();

    $pdf = Pdf::loadView('moods.pdf', compact('moods'));
    return $pdf->download('mood-log.pdf');
}
public function moodOfTheMonth()
{
    $startDate = Carbon::now()->subDays(30)->toDateString();
    $userId = Auth::id();

    $topMood = Mood::where('user_id', $userId)
        ->whereDate('date', '>=', $startDate)
        ->selectRaw('mood, COUNT(*) as count')
        ->groupBy('mood')
        ->orderByDesc('count')
        ->first();

    return view('moods.monthly_top', compact('topMood'));
}


}
