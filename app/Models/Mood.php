<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Mood extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'mood',
        'note',
        'date',
    ];

    public static function hasStreak($userId)
    {
        $dates = self::where('user_id', $userId)
            ->orderByDesc('date')
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->unique()
            ->values();

        $streak = 1;
        for ($i = 1; $i < count($dates); $i++) {
            $diff = Carbon::parse($dates[$i - 1])->diffInDays(Carbon::parse($dates[$i]));
            if ($diff === 1) {
                $streak++;
                if ($streak >= 3) return true;
            } else {
                $streak = 1;
            }
        }

        return false;
    }
}
