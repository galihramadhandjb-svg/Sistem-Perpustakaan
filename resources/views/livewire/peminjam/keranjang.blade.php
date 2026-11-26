<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Keranjang</h1>
        </div>
    </div>

    @include('admin-lte/flash')

    @if ($keranjang->status === 0)
        <div class="row">
            <div class="col-md-12 mb-4">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input wire:model="tanggal_pinjam" type="date" class="form-control" id="tanggal_pinjam">
                @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-2">
            @if ($keranjang->status === 0)
                <button wire:click="pinjam({{$keranjang->id}})" class="btn btn-sm btn-success">Ajukan Peminjaman</button>
            @elseif ($keranjang->status === 1)
                <span class="badge badge-warning">Menunggu diproses petugas</span>
            @elseif ($keranjang->status === 2)
                <span class="badge badge-info">Sedang dipinjam</span>
            @endif
            @if ($keranjang->status !== 0)
                <strong>Tanggal Pinjam: {{$keranjang->tanggal_pinjam}}</strong>
            @endif
            <strong class="float-right">Kode Pinjam : {{$keranjang->kode_pinjam}}</strong>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Rak</th>
                    <th>Baris</th>
                    @if ($keranjang->status === 0)
                        <th></th>
                    @endif   
                </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang->detail_peminjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->buku->judul}}</td>
                            <td>{{$item->buku->penulis}}</td>
                            <td>{{$item->buku->rak->rak}}</td>
                            <td>{{$item->buku->rak->baris}}</td>
                            @if ($keranjang->status === 0)
                                <td>
                                    <button wire:click="hapus({{$keranjang->id}}, {{$item->id}})" class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($keranjang->status === 0)
                 <button wire:click="hapusMasal" class="btn btn-sm btn-danger">Hapus Masal</button>
            @endif        
        </div>
    </div>
</div>