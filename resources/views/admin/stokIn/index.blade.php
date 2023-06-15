@extends('layouts.master')

@section('tab-title', 'Stok Masuk | Admin')
@section('page-title', 'Stok Masuk')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Tambah Stok</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stokIn.create') }}" class="btn btn-success">Tambah Stok</a>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="keyword" id="keyword" class="form-control"
                                    placeholder="ketik keyword disini">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px">No</th>
                                {{-- <th scope="col">Gambar</th> --}}
                                {{-- <th scope="col">Kode Produk</th> --}}
                                <th scope="col">Nama Produk</th>
                                {{-- <th scope="col">Kategori</th> --}}
                                <th scope="col">Penempatan</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Tanggal Beli</th>
                                <th scope="col">Jumlah - Satuan</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokIns as $stokIn)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    {{-- <td class="text-center">
                                        <img src="{{ Storage::url('/') . $produk->foto_produk }}"
                                            class="card-img img-thumbnails" style="max-height: 150px; max-width: 150px; overflow-x: hidden; overflow-y: hidden">
                                    </td> --}}
                                    {{-- <td>{{ $produk->kode_produk }}</td> --}}
                                    <td>{{ $stokIn->produk->nama_produk }}</td>
                                    {{-- <td>{{ $produk->kategori->nama_kategori }}</td> --}}
                                    <td>{{ $stokIn->tempat->nama_tempat }}</td>
                                    <td>{{ $stokIn->harga_beli }}</td>
                                    <td>{{ $stokIn->tgl_beli }}</td>
                                    <td>{{ $stokIn->jml_produk }} - {{ $stokIn->satuan->nama_satuan }}</td>
                                    <td>
                                        <form action="#" method="POST">
                                            <a href="{{ route('stokIn.edit', $stokIn->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                            {{-- <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Stok Masuk belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {!! $stokIns->links() !!}
        </div>
    </div>
    <script>
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
