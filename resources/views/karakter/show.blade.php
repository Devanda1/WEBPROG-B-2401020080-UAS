@extends('layouts.game')

@section('title', $karakter->nama . ' - Detail Karakter')

@push('head')
<style>
/* ====== DETAIL PAGE ====== */
.detail-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 80px 20px;
  min-height: 100vh;
  animation: fadeInDetail 1s ease;
  position: relative;
  overflow: hidden;
}

@keyframes fadeInDetail {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ====== BACKGROUND ====== */
.detail-bg {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at center, rgba(0,0,0,0.6), #000);
  background-image: url("{{ asset('images/' . $karakter->background) }}");
  background-size: cover;
  background-position: center;
  filter: brightness(0.4) blur(4px);
  z-index: -2;
}

/* ====== CARD ====== */
.detail-card {
  background: rgba(15, 20, 30, 0.7);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 40px;
  max-width: 800px;
  width: 100%;
  box-shadow: 0 0 25px rgba(0, 234, 255, 0.2);
  border: 2px solid rgba(0,234,255,0.25);
  position: relative;
  z-index: 2;
  overflow: hidden;
}

/* ====== AURA ====== */
.detail-card::before {
  content: "";
  position: absolute;
  inset: -3px;
  border-radius: 22px;
  background: radial-gradient(circle at 50% 50%, var(--aura-color), transparent 60%);
  filter: blur(35px);
  opacity: 0.25;
  animation: auraPulse 3.5s ease-in-out infinite alternate;
  z-index: -1;
}

@keyframes auraPulse {
  0% { transform: scale(1); opacity: 0.3; }
  100% { transform: scale(1.05); opacity: 0.6; }
}

/* ====== IMAGE ====== */
.detail-img {
  width: 100%;
  max-width: 360px;
  height: auto;
  object-fit: contain;
  border-radius: 15px;
  margin-bottom: 25px;
  transition: transform 0.6s ease, filter 0.4s ease;
  box-shadow: 0 0 25px rgba(0,234,255,0.25);
}
.detail-img:hover {
  transform: scale(1.04);
  filter: brightness(1.1);
}

/* ====== TEXT ====== */
.detail-name {
  font-family: 'Orbitron', sans-serif;
  font-size: 2.4rem;
  text-shadow: 0 0 18px var(--aura-color);
  margin-bottom: 15px;
}

.detail-info p {
  margin: 8px 0;
  font-size: 1.05rem;
  color: #bfeaff;
}
.detail-info strong {
  color: var(--aura-color);
}

.detail-desc {
  margin-top: 25px;
  font-size: 1.1rem;
  color: #defaff;
  line-height: 1.6;
  max-width: 700px;
  text-align: justify;
}

/* ====== PARTICLE EFFECT ====== */
.sparkle {
  position: absolute;
  border-radius: 50%;
  opacity: 0.8;
  pointer-events: none;
  background: var(--aura-color);
  filter: blur(2px);
  animation: sparkleFloat 5s linear infinite;
}

@keyframes sparkleFloat {
  0% { transform: translateY(0) scale(0.6); opacity: 1; }
  50% { opacity: 0.7; }
  100% { transform: translateY(-120px) scale(0.3); opacity: 0; }
}
</style>
@endpush

@section('content')
<!-- BACKGROUND -->
<div class="detail-bg"></div>

<!-- DETAIL CONTENT -->
<div class="detail-container" style="--aura-color: {{ $karakter->warna ?? '#00eaff' }}">
  <div class="detail-card" id="detailCard">
    <img src="{{ asset('images/' . $karakter->foto) }}" alt="{{ $karakter->nama }}" class="detail-img">
    <h2 class="detail-name">{{ $karakter->nama }}</h2>

    <div class="detail-info">
      <p><strong>Game:</strong> {{ $karakter->game }}</p>
      <p><strong>Peran:</strong> {{ $karakter->jenis }}</p>
    </div>

    <p class="detail-desc">{{ $karakter->deskripsi }}</p>
  </div>
</div>

@push('scripts')
<script>
// ===== SPARKLE EFFECT =====
document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.detail-container');
  function createSparkle() {
    const sparkle = document.createElement('div');
    sparkle.classList.add('sparkle');
    const size = Math.random() * 5 + 3;
    sparkle.style.width = `${size}px`;
    sparkle.style.height = `${size}px`;
    sparkle.style.left = `${Math.random() * 100}%`;
    sparkle.style.bottom = `-10px`;
    sparkle.style.animationDuration = `${Math.random() * 3 + 3}s`;
    container.appendChild(sparkle);
    setTimeout(() => sparkle.remove(), 5000);
  }
  setInterval(createSparkle, 500);
});
</script>
@endpush
@endsection