@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mood History</h2>
    <a href="{{ route('moods.export.pdf') }}" class="btn btn-outline-dark mb-3">🧾 Export as PDF</a>


    {{-- Filter Form --}}
    <form method="GET" action="{{ route('moods.history') }}" class="row mb-4">
        <div class="col-md-4">
            <label>From:</label>
            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
        </div>
        <div class="col-md-4">
            <label>To:</label>
            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- Mood Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Mood</th>
                <th>Note</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($moods as $mood)
                <tr class="{{ $mood->trashed() ? 'table-danger' : '' }}">
                    <td>{{ $mood->date }}</td>
                    <td>{{ $mood->mood }}</td>
                    <td>{{ $mood->note }}</td>
                    <td>
                        @if($mood->trashed())
                            <span class="text-danger">Deleted</span>
                        @else
                            <span class="text-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($mood->trashed())
                            <form method="POST" action="{{ route('moods.restore', $mood->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('moods.destroy', $mood->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this mood?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No mood entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
