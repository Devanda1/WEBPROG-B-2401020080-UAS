@extends('layouts.game')

@section('title', $karakter->nama . ' - Detail Karakter')

@push('head')
<style>
/* ================= PAGE ================= */
.detail-container {
  min-height: 100vh;
  padding: 100px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow: hidden;
  animation: fadeInDetail 1s ease;
}

@keyframes fadeInDetail {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ================= BACKGROUND ================= */
.detail-bg {
  position: fixed;
  inset: 0;
  background-image: url("{{ asset('images/' . $karakter->background) }}");
  background-size: cover;
  background-position: center;
  filter: brightness(0.45) blur(4px);
  z-index: -2;
}
.detail-bg::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at center, rgba(0,0,0,.45), #000);
}

/* ================= CARD ================= */
.detail-card {
  background: rgba(15, 20, 30, 0.75);
  backdrop-filter: blur(14px);
  border-radius: 22px;
  padding: 40px;
  max-width: 820px;
  width: 100%;
  text-align: center;
  position: relative;
  border: 2px solid rgba(0,234,255,.25);
  box-shadow: 0 0 30px rgba(0,234,255,.25);
}

/* ================= AURA ================= */
.detail-card::before {
  content: "";
  position: absolute;
  inset: -4px;
  border-radius: 24px;
  background: radial-gradient(circle, var(--aura-color), transparent 60%);
  filter: blur(40px);
  opacity: .4;
  animation: auraPulse 3.5s ease-in-out infinite alternate;
  z-index: -1;
}

@keyframes auraPulse {
  0% { transform: scale(1); opacity: .35; }
  100% { transform: scale(1.08); opacity: .65; }
}

/* ================= IMAGE ================= */
.detail-img {
  max-width: 340px;
  max-height: 70vh;
  width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 16px;
  margin-bottom: 28px;
  box-shadow: 0 0 25px rgba(0,234,255,.35);
  transition: transform .5s ease, filter .4s ease;
}
.detail-img:hover {
  transform: scale(1.05);
  filter: brightness(1.1);
}

/* ================= TEXT ================= */
.detail-name {
  font-family: 'Orbitron', sans-serif;
  font-size: 2.4rem;
  margin-bottom: 14px;
  text-shadow: 0 0 20px var(--aura-color);
}

.detail-info p {
  margin: 6px 0;
  font-size: 1.05rem;
  color: #bfeaff;
}
.detail-info strong {
  color: var(--aura-color);
}

.detail-desc {
  margin-top: 26px;
  font-size: 1.1rem;
  color: #defaff;
  line-height: 1.7;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
  text-align: justify;
}

/* ================= SPARKLE ================= */
.sparkle {
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--aura-color);
  opacity: .8;
  filter: blur(2px);
  pointer-events: none;
  animation: sparkleFloat 5s linear forwards;
}

@keyframes sparkleFloat {
  from { transform: translateY(0) scale(.6); opacity: 1; }
  to { transform: translateY(-140px) scale(.3); opacity: 0; }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
  .detail-card { padding: 30px 22px; }
  .detail-name { font-size: 2rem; }
}
</style>
@endpush

@section('content')

<!-- BACKGROUND -->
<div class="detail-bg"></div>

<!-- CONTENT -->
<div class="detail-container" style="--aura-color: {{ $karakter->warna ?? '#00eaff' }}">
  <div class="detail-card">

    <img
      src="{{ asset('images/' . $karakter->foto) }}"
      alt="{{ $karakter->nama }}"
      class="detail-img"
    >

    <h2 class="detail-name">{{ $karakter->nama }}</h2>

    <div class="detail-info">
      <p><strong>Game:</strong> {{ $karakter->game }}</p>
      <p><strong>Peran:</strong> {{ $karakter->jenis }}</p>
    </div>

    <p class="detail-desc">
      {{ $karakter->deskripsi }}
    </p>

  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.detail-container');

  function spawnSparkle() {
    const s = document.createElement('div');
    s.className = 'sparkle';
    const size = Math.random() * 5 + 3;
    s.style.width = size + 'px';
    s.style.height = size + 'px';
    s.style.left = Math.random() * 100 + '%';
    s.style.bottom = '-10px';
    s.style.animationDuration = (Math.random() * 3 + 3) + 's';
    container.appendChild(s);
    setTimeout(() => s.remove(), 5000);
  }

  setInterval(spawnSparkle, 650);
});
</script>
@endpush
@endsection
