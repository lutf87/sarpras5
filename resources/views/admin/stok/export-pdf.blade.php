<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Total Barang<br>Masuk</th>
                <th scope="col">Total Barang<br>keluar</th>
                <th scope="col">Total Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->kategori->nama_kategori }}</td>
                    <td>{{ $data->stokin->sum('qty') }}</td>
                    <td>{{ $data->stokout->sum('qty') }}</td>
                    <td>{{ $data->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
