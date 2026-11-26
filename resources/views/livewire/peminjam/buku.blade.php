@php
    $generateCover = function ($title, $author, $accent = '#7aa97a') {
        $judul = trim((string) $title ?: 'Judul Buku');
        $penulis = trim((string) $author ?: 'Perpustakaan');

        $judul = \Illuminate\Support\Str::limit($judul, 18, '...');
        $penulis = \Illuminate\Support\Str::limit($penulis, 22, '...');

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="240" height="300" viewBox="0 0 240 300">
            <defs>
                <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#f4f4f4"/>
                    <stop offset="100%" stop-color="#ffffff"/>
                </linearGradient>
            </defs>
            <rect width="240" height="300" rx="18" fill="url(#bg)"/>
            <rect x="18" y="18" width="204" height="264" rx="12" fill="#ffffff" stroke="#dfe3df" stroke-width="2"/>
            <rect x="30" y="30" width="36" height="36" rx="10" fill="'.$accent.'" opacity="0.18"/>
            <path d="M38 49h20M38 56h12M38 63h20" stroke="'.$accent.'" stroke-width="3" stroke-linecap="round"/>
            <text x="120" y="124" text-anchor="middle" font-family="Arial, sans-serif" font-size="20" font-weight="700" fill="#222222">'.htmlspecialchars($judul, ENT_QUOTES, 'UTF-8').'</text>
            <text x="120" y="156" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" fill="#5f5f5f">by '.htmlspecialchars($penulis, ENT_QUOTES, 'UTF-8').'</text>
            <rect x="52" y="182" width="136" height="48" rx="12" fill="'.$accent.'" opacity="0.12"/>
            <text x="120" y="214" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" font-weight="600" fill="#3a3a3a">Cover Buku</text>
        </svg>';

        return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($svg);
    };
@endphp

<div class="container">
    @include('admin-lte/flash')

    <div class="row">
        <div class="col-md-8 mb-3">
            <h1>{{$title}}</h1>
        </div>
        @if (!$detail_buku)
            <div class="col-md-4">
              <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                  <input wire:model="search" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Cari Buku">
                  <div class="input-group-prepend">
                    <button class="input-group-text">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
            </div>
        @endif
    </div>

    @if ($detail_buku)
        
        <div class="row">
            <div class="col-md-4">
                @php
                    $detailCover = $buku->sampul ? '/storage/'.$buku->sampul : $generateCover($buku->judul, $buku->penulis);
                @endphp
                <img src="{{ $detailCover }}"
                     alt="{{$buku->judul}}"
                     width="300"
                     height="400"
                     style="object-fit: cover; background: #f5f5f5; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.08);"
                     onerror="this.src='{{ $generateCover($buku->judul, $buku->penulis) }}'">
            </div>
            <div class="col-md-8">
                 <table class="table">
                  <tbody>
                    <tr>
                      <th>Judul</th>
                      <td>:</td>
                      <td>{{$buku->judul}}</td>
                    </tr>
                    <tr>
                      <th>Penulis</th>
                      <td>:</td>
                      <td>{{$buku->penulis}}</td>
                    </tr>
                    <tr>
                      <th>Kategori</th>
                      <td>:</td>
                      <td>{{$buku->kategori->nama}}</td>
                    </tr>
                    <tr>
                      <th>Penerbit</th>
                      <td>:</td>
                      <td>{{$buku->penerbit->nama}}</td>
                    </tr>
                    <tr>
                      <th>Rak</th>
                      <td>:</td>
                      <td>{{$buku->rak->rak}}</td>
                    </tr>
                    <tr>
                      <th>Baris</th>
                      <td>:</td>
                      <td>{{$buku->rak->baris}}</td>
                    </tr>
                    <tr>
                      <th>Stok</th>
                      <td>:</td>
                      <td>{{$buku->stok}}</td>
                    </tr>
                  </tbody>
                </table>

                <button wire:click="keranjang({{$buku->id}})" class="btn btn-success">Keranjang</button>
            </div>
        </div>

    @else
    
        @if ($buku->isNotEmpty())
    
            <div class="row">
                @foreach ($buku as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div wire:click="detailBuku({{$item->id}})" class="card mb-4 shadow" style="cursor: pointer; border-radius: 12px; overflow: hidden;">
                            @php
                                $cover = $item->sampul ? '/storage/'.$item->sampul : $generateCover($item->judul, $item->penulis);
                            @endphp
                            <img src="{{ $cover }}"
                                 class="card-img-top"
                                 alt="{{$item->judul}}"
                                 width="200"
                                 height="300"
                                 style="object-fit: cover; background: #f5f5f5; border-bottom: 1px solid #e8e8e8;"
                                 onerror="this.src='{{ $generateCover($item->judul, $item->penulis) }}'">
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{$item->judul}}</strong></h5>
                                <p class="card-text">{{$item->penulis}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                {{$buku->links()}}
            </div>

        @else

            <div class="alert alert-danger">
                Data tidak ada
            </div>
        @endif

    @endif
    
</div>