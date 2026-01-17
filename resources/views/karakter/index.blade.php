@extends('layouts.game')

@section('title', 'Daftar Karakter Game')

@push('head')
<style>
/* ===== LOADING ===== */
#loadingScreen{
  position:fixed;inset:0;
  background:radial-gradient(circle,#02121f,#000);
  display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  z-index:9999;color:#00eaff;
  font-family:'Orbitron',sans-serif;
}
.loading-logo{font-size:2rem;letter-spacing:3px;text-shadow:0 0 15px #00eaff;}
.loading-bar{width:200px;height:8px;background:rgba(0,234,255,.2);border-radius:10px;overflow:hidden;margin-top:20px;}
.loading-progress{height:100%;width:0;background:linear-gradient(90deg,#00eaff,#007aff);animation:loadBar 2s forwards;}
@keyframes loadBar{to{width:100%}}

.container{padding-top:90px}

/* ===== FILTER ===== */
.filter-row{
  display:flex;gap:14px;
  justify-content:center;
  flex-wrap:wrap;
  margin-bottom:28px;
}
.search-input,.filter-select{
  padding:11px 18px;
  border-radius:30px;
  border:2px solid #00eaff;
  background:rgba(255,255,255,.08);
  color:#fff;
  outline:none;
  font-size:.9rem;
}

/* ===== GRID ===== */
.char-grid{
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  gap:28px;
}

/* ===== CARD ===== */
.char-card{
  width:280px;
  height:420px;
  background:rgba(12,18,30,.8);
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 0 18px rgba(0,234,255,.12);
  transition:.35s ease;
  position:relative;
}
.char-card:hover{
  transform:translateY(-8px) scale(1.04);
  box-shadow:0 0 28px rgba(0,234,255,.35);
}

.char-img{
  width:100%;
  height:240px;
  object-fit:contain;
  background:rgba(0,0,0,.35);
}

.char-body{
  padding:14px;
  text-align:center;
  background:linear-gradient(to top,rgba(0,0,0,.7),rgba(0,0,0,.4));
}
.char-body h5{
  color:#00eaff;
  font-family:'Orbitron',sans-serif;
  font-size:1.1rem;
}
.char-body p{
  font-size:.85rem;
  color:#d6f6ff;
  margin:4px 0;
}

/* ===== ADMIN ACTION ===== */
.card-actions{
  display:flex;
  justify-content:center;
  gap:12px;
  margin-top:12px;
}

.btn-action{
  padding:7px 18px;
  border-radius:30px;
  font-size:.75rem;
  font-weight:600;
  border:none;
  cursor:pointer;
  transition:.3s ease;
  display:flex;
  align-items:center;
  gap:6px;
}

.btn-edit{
  background:linear-gradient(90deg,#00eaff,#00b7ff);
  color:#001b25;
  box-shadow:0 0 12px rgba(0,234,255,.4);
}
.btn-edit:hover{
  transform:scale(1.08);
  box-shadow:0 0 20px rgba(0,234,255,.7);
}

.btn-delete{
  background:linear-gradient(90deg,#ff4d4d,#ff2d2d);
  color:#fff;
  box-shadow:0 0 10px rgba(255,77,77,.4);
}
.btn-delete:hover{
  transform:scale(1.08);
  box-shadow:0 0 18px rgba(255,77,77,.7);
}
</style>
@endpush

@section('content')

<!-- LOADING -->
<div id="loadingScreen">
  <div class="loading-logo">LARAVEL GAME GALLERY</div>
  <div class="loading-bar"><div class="loading-progress"></div></div>
</div>

<div class="container fade-in-page">

  <h2 class="text-center mb-4 fw-bold" style="font-family:'Orbitron',sans-serif">
    Daftar Karakter Game
  </h2>

  <!-- ADD -->
  @auth
<div style="text-align:center;margin-bottom:25px">
  <a href="{{ route('karakter.create') }}"
     style="
       display:inline-block;
       padding:10px 22px;
       border-radius:30px;
       background:#00eaff;
       color:#000;
       font-weight:600;
       box-shadow:0 0 15px rgba(0,234,255,.5)
     ">
    + Tambah Karakter
  </a>
</div>
@endauth


  <!-- SEARCH -->
  <form method="GET" action="{{ route('karakter.index') }}" class="filter-row">
    <input type="text" name="search" class="search-input"
           placeholder="🔍 Cari nama / game..."
           value="{{ request('search') }}">
    <button type="submit" class="search-input">Cari</button>
  </form>

  <!-- FILTER -->
  <div class="filter-row">
    <select id="filterGame" class="filter-select">
      <option value="">🎮 Semua Game</option>
      @foreach ($karakterList->pluck('game')->unique() as $game)
        <option value="{{ strtolower($game) }}">{{ $game }}</option>
      @endforeach
    </select>

    <select id="filterPeran" class="filter-select">
      <option value="">🧩 Semua Peran</option>
      @foreach ($karakterList->pluck('jenis')->unique() as $jenis)
        <option value="{{ strtolower($jenis) }}">{{ $jenis }}</option>
      @endforeach
    </select>
  </div>

  <!-- GRID -->
  <div class="char-grid" id="charGrid">
    @foreach ($karakterList as $karakter)
      <div class="char-card"
           data-game="{{ strtolower($karakter->game) }}"
           data-role="{{ strtolower($karakter->jenis) }}">

        <a href="{{ route('karakter.show',$karakter->id) }}">
          <img src="{{ asset('images/'.$karakter->foto) }}"
               alt="{{ $karakter->nama }}"
               class="char-img">
        </a>

        <div class="char-body">
          <h5>{{ $karakter->nama }}</h5>
          <p>{{ $karakter->game }}</p>
          <p>{{ $karakter->jenis }}</p>

          @auth
          <div class="card-actions">
            <a href="{{ route('karakter.edit',$karakter->id) }}"
               class="btn-action btn-edit">✏️ Edit</a>

            <form action="{{ route('karakter.destroy',$karakter->id) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus karakter ini?')">
              @csrf
              @method('DELETE')
              <button class="btn-action btn-delete">🗑 Hapus</button>
            </form>
          </div>
          @endauth
        </div>
      </div>
    @endforeach
  </div>
</div>

@push('scripts')
<script>
window.addEventListener('load',()=>{
  document.getElementById('loadingScreen').style.display='none'
})

const filterGame=document.getElementById('filterGame')
const filterPeran=document.getElementById('filterPeran')
const cards=document.querySelectorAll('.char-card')

function filterCards(){
  cards.forEach(c=>{
    const g=!filterGame.value||c.dataset.game===filterGame.value
    const p=!filterPeran.value||c.dataset.role===filterPeran.value
    c.style.display=(g&&p)?'':'none'
  })
}
filterGame.addEventListener('change',filterCards)
filterPeran.addEventListener('change',filterCards)
</script>
@endpush
@endsection
