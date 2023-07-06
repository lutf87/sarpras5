@extends('layouts.master')

@section('tab-title', 'Stok Keluar | Admin')
@section('page-title', 'Stok Keluar')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Kurangi Stok</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stokOut.create') }}" class="btn btn-success">Kurangi Stok</a>
                                <a href="{{ route('stokOut.export') }}" class="btn btn-warning">Ekspor Excel</a>
                                <a href="{{ route('stokOut.exportPdf') }}" class="btn btn-warning">Ekspor Pdf</a>
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
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah Produk Keluar</th>
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Pemohon</th>
                                <th scope="col">Keterangan</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokOuts as $stokOut)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $stokOut->produk->nama_produk }}</td>
                                    <td>{{ $stokOut->qty }}</td>
                                    <td>{{ $stokOut->created_at->isoFormat('dddd, DD MMMM Y') }}</td>
                                    <td>{{ $stokOut->pemohon }}</td>
                                    <td>{{ $stokOut->keterangan }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="{{ route('stokOut.edit', $stokOut->id) }}"
                                                    class="btn btn-sm btn-secondary">Edit</a>
                                            </div>
                                            <div class="col-auto">
                                                <form action="{{ route('stokOut.destroy', $stokOut->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete">Hapus</button>
                                                    <div class="row">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Stok Keluar belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {!! $stokOuts->links() !!}
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
