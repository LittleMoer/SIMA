<!DOCTYPE html>
<html>
<head>
    <title>Rekap Gaji Crew</title>
</head>
<body>
    <h1>Pilih Armada</h1>
    <form action="{{ route('rekap.gaji.show') }}" method="POST">
        @csrf
        <label for="id_armada">Pilih Armada:</label>
        <select name="id_armada" id="id_armada" required>
            @foreach($armadas as $armada)
                <option value="{{ $armada->id_armada }}">{{ $armada->id_armada }} - {{ $armada->driver }} / {{ $armada->codriver }}</option>
            @endforeach
        </select>
        <button type="submit">Lihat Rekap Gaji</button>
    </form>
</body>
</html>
