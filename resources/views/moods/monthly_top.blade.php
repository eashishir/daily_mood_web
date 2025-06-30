@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mood of the Month</h2>

    @if($topMood)
        <div class="alert alert-info">
            🏅 Most frequent mood in last 30 days: <strong>{{ $topMood->mood }}</strong> ({{ $topMood->count }} times)
        </div>
    @else
        <p>No mood data found in the last 30 days.</p>
    @endif

    <a href="{{ route('moods.index') }}" class="btn btn-secondary">Back to Mood History</a>
</div>
@endsection
