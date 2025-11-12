@extends('layouts.game')

@section('title', 'Daftar Karakter Game')

@push('head')
<style>
/* ===== LOADING SCREEN MODERN ===== */
#loadingScreen {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at center, #02121f, #000);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  color: #00eaff;
  font-family: 'Orbitron', sans-serif;
}
.loading-logo {
  font-size: 2rem;
  letter-spacing: 3px;
  text-shadow: 0 0 15px #00eaff;
  margin-bottom: 25px;
  animation: flicker 1.5s infinite alternate;
}
@keyframes flicker {
  0%, 100% { opacity: 1; text-shadow: 0 0 15px #00eaff; }
  50% { opacity: 0.7; text-shadow: 0 0 8px #0092a8; }
}
.loading-bar {
  width: 200px;
  height: 8px;
  background: rgba(0,234,255,0.15);
  border-radius: 10px;
  overflow: hidden;
  position: relative;
}
.loading-progress {
  position: absolute;
  top: 0; left: 0;
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, #00eaff, #007aff);
  border-radius: 10px;
  animation: loadBar 2s ease-in-out forwards;
}
@keyframes loadBar {
  0% { width: 0%; }
  100% { width: 100%; }
}
.loading-text {
  margin-top: 10px;
  font-size: 1rem;
  opacity: 0.8;
  letter-spacing: 1px;
}

/* ===== SEARCH + FILTER ===== */
.filter-row {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}
.search-input, .filter-select {
  padding: 10px 15px;
  border: 2px solid #00eaff;
  border-radius: 25px;
  background: rgba(255,255,255,0.08);
  color: #fff;
  outline: none;
  font-size: 1rem;
  transition: 0.3s;
}
.search-input:focus, .filter-select:focus {
  box-shadow: 0 0 10px rgba(0,234,255,0.5);
}
.filter-select { width: 180px; }

/* ===== GRID LAYOUT ===== */
.container { padding-top: 80px; }
.char-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 25px;
}

/* ===== CARD ===== */
.char-card-link { text-decoration: none; color: inherit; }

.char-card {
  position: relative;
  width: 280px;
  height: 380px;
  background: rgba(10, 15, 30, 0.7);
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 234, 255, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  backdrop-filter: blur(8px);
  z-index: 0;
}
.char-card:hover {
  transform: translateY(-6px) scale(1.03);
  box-shadow: 0 0 20px rgba(0,234,255,0.25);
}

/* BORDER GLOW */
.char-border {
  position: absolute;
  inset: 0;
  border-radius: 18px;
  border: 2px solid rgba(0,234,255,0.3);
  box-shadow: 0 0 8px rgba(0,234,255,0.3);
  pointer-events: none;
  z-index: -1;
  transition: all 0.4s ease;
}
.char-card:hover .char-border {
  border-color: rgba(0,234,255,0.6);
  box-shadow: 0 0 18px rgba(0,234,255,0.4);
}

/* GAMBAR */
.char-img {
  width: 100%;
  height: 240px;
  object-fit: contain;
  object-position: center;
  background: rgba(0,0,0,0.25);
  border-bottom: 1px solid rgba(0,234,255,0.2);
  transition: transform 0.4s ease;
}
.char-card:hover .char-img { transform: scale(1.05); }

/* TEKS */
.char-body {
  text-align: center;
  padding: 12px 15px;
  background: rgba(0,0,0,0.4);
  height: 140px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.char-body h5 {
  font-family: 'Orbitron', sans-serif;
  font-size: 1.2rem;
  color: #00eaff;
  text-shadow: 0 0 10px rgba(0,234,255,0.6);
  margin-bottom: 5px;
}
.char-body p { font-size: 0.9rem; color: #bfeaff; margin: 4px 0; }

@media (max-width: 768px) {
  .char-card { width: 90%; height: 350px; }
}
</style>
@endpush

@section('content')
<!-- LOADING SCREEN -->
<div id="loadingScreen">
  <div class="loading-logo">LARAVEL GALLERY</div>
  <div class="loading-bar"><div class="loading-progress"></div></div>
  <div class="loading-text">Loading... Please Wait</div>
</div>

<div class="container fade-in-page">
  <h2 class="text-center mb-4 fw-bold" style="font-family:'Orbitron',sans-serif;">Daftar Karakter Game</h2>

  <!-- SEARCH + FILTER -->
  <div class="filter-row">
    <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cari karakter...">
    <select id="filterGame" class="filter-select">
      <option value="">🎮 Semua Game</option>
      @foreach (collect($karakterList)->pluck('game')->unique() as $game)
        <option value="{{ strtolower($game) }}">{{ $game }}</option>
      @endforeach
    </select>
    <select id="filterPeran" class="filter-select">
      <option value="">🧩 Semua Peran</option>
      @foreach (collect($karakterList)->pluck('jenis')->unique() as $jenis)
        <option value="{{ strtolower($jenis) }}">{{ $jenis }}</option>
      @endforeach
    </select>
  </div>

  <!-- GRID KARAKTER -->
  <div class="char-grid" id="charGrid">
    @foreach ($karakterList as $karakter)
      <a href="{{ route('karakter.show', $karakter->id) }}" 
         class="char-card-link js-click"
         data-name="{{ strtolower($karakter->nama) }}"
         data-game="{{ strtolower($karakter->game) }}"
         data-role="{{ strtolower($karakter->jenis) }}">
        <div class="char-card">
          <div class="char-border"></div>
          <img src="{{ asset('images/' . $karakter->foto) }}" alt="{{ $karakter->nama }}" class="char-img">
          <div class="char-body">
            <h5>{{ $karakter->nama }}</h5>
            <p><strong>Game:</strong> {{ $karakter->game }}</p>
            <p><strong>Peran:</strong> {{ $karakter->jenis }}</p>
          </div>
        </div>
      </a>
    @endforeach
  </div>

  <div class="text-center mt-4">
  </div>
</div>

@push('scripts')
<script>
// ===== LOADING ANIMATION =====
window.addEventListener('load', () => {
  const loading = document.getElementById('loadingScreen');
  const progress = document.querySelector('.loading-progress');
  progress.addEventListener('animationend', () => {
    loading.style.opacity = '0';
    loading.style.transition = 'opacity 0.8s ease';
    setTimeout(() => loading.remove(), 800);
  });
});

// ===== SEARCH + FILTER =====
const searchInput = document.getElementById('searchInput');
const filterGame = document.getElementById('filterGame');
const filterPeran = document.getElementById('filterPeran');
const charGrid = document.getElementById('charGrid');

function filterCards() {
  const search = searchInput.value.toLowerCase();
  const game = filterGame.value;
  const role = filterPeran.value;

  const cards = charGrid.querySelectorAll('.char-card-link');
  cards.forEach(card => {
    const name = card.dataset.name;
    const gameData = card.dataset.game;
    const roleData = card.dataset.role;

    const matchName = name.includes(search);
    const matchGame = game ? gameData === game : true;
    const matchRole = role ? roleData === role : true;

    card.style.display = (matchName && matchGame && matchRole) ? '' : 'none';
  });
}

[searchInput, filterGame, filterPeran].forEach(el => {
  el.addEventListener('input', filterCards);
  el.addEventListener('change', filterCards);
});
</script>
@endpush
@endsection
