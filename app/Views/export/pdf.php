<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        h1{
            margin-bottom: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Daftar Siswa</h1>
    <table>
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($siswa as $key): ?>
            <tr>
                <td><?= $key["nisn"] ?></td>
                <td><?= $key["name"] ?></td>
                <td><?= $key["address"] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>