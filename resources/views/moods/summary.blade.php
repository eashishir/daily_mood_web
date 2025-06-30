@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Weekly Mood Summary</h2>
    <canvas id="moodChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailySummary = @json($dailySummary);

    const labels = Object.keys(dailySummary);

    const moodTypes = ['Happy', 'Sad', 'Angry', 'Excited'];
    const datasets = moodTypes.map(mood => {
        return {
            label: mood,
            data: labels.map(day => dailySummary[day][mood]),
            backgroundColor: getMoodColor(mood),
        };
    });

    const ctx = document.getElementById('moodChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Mood Frequency This Week'
                }
            }
        }
    });

    function getMoodColor(mood) {
        return {
            'Happy': '#4caf50',
            'Sad': '#2196f3',
            'Angry': '#f44336',
            'Excited': '#ff9800'
        }[mood];
    }
</script>
@endsection
