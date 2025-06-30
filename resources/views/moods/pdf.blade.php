<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mood Log</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Mood Log for {{ auth()->user()->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Mood</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($moods as $mood)
                <tr>
                    <td>{{ $mood->date }}</td>
                    <td>{{ $mood->mood }}</td>
                    <td>{{ $mood->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
