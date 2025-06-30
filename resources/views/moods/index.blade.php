@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Today's Mood</h2>

    {{-- ✅ Show Streak Badge --}}
    @if(isset($streak) && $streak >= 3)
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <div>
                🎉 You are on a <strong>{{ $streak }}-day streak!</strong> Keep it up!
            </div>
            <span class="badge bg-success">🔥 Streak Badge</span>
        </div>
    @endif

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Show Mood if Already Logged --}}
    @if($mood)
        <div class="alert alert-info">
            <strong>You already logged today's mood:</strong> {{ $mood->mood }}<br>
            <em>{{ $mood->note }}</em>
        </div>
    @else
        {{-- Mood Form --}}
        <form method="POST" action="{{ route('moods.store') }}">
            @csrf
            <div class="mb-3">
                <label for="mood" class="form-label">Select your mood</label>
                <select name="mood" id="mood" class="form-select" required>
                    <option value="">Select Mood</option>
              <option value="Happy">😊 Happy</option>
              <option value="Sad">😢 Sad</option>
              <option value="Angry">😠 Angry</option>
              <option value="Excited">😃 Excited</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Optional Note</label>
                <textarea name="note" id="note" class="form-control" rows="3" placeholder="Why do you feel this way?"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Mood</button>
        </form>
    @endif
    
    
</div>
@endsection
