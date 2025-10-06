<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa/Pegawai</title>
</head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 30px auto; padding: 20px; border: 1px solid #ccc;">

    <h2 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 5px;">
        PROFIL MAHASISWA
    </h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <td style="padding: 8px 0; font-weight: bold; width: 40%;">Nama</td>
            <td style="padding: 8px 0;">: {{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Umur</td>
            <td style="padding: 8px 0;">: {{ $data['my_age'] }} tahun</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Cita-cita</td>
            <td style="padding: 8px 0;">: {{ $data['future_goal'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Semester Saat Ini</td>
            <td style="padding: 8px 0;">: {{ $data['current_semester'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Target Wisuda</td>
            <td style="padding: 8px 0;">: {{ $data['tgl_harus_wisuda'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Hari Tersisa</td>
            <td style="padding: 8px 0;">
                <span style="font-weight: bold; color: {{ $data['time_to_study_left'] < 0 ? 'red' : 'green' }}">
                    : {{ $data['time_to_study_left'] }} hari
                </span>
            </td>
        </tr>
    </table>

    <div style="padding: 10px; margin: 20px 0; background-color: #ffcccc; border: 1px solid #cc0000; text-align: center;">
        <strong style="color: #cc0000;">{{ $data['semester_info'] }}</strong>
    </div>

    <h3 style="margin-top: 30px; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Daftar Hobi</h3>
    <ul style="padding-left: 20px;">
    @foreach ($data['hobbies'] as $hobi)
        <li>{{ $hobi }}</li>
    @endforeach
    </ul>

</body>
</html>
