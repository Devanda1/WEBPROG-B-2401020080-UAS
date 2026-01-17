@extends('layouts.game')

@section('title', 'Home - Game Gallery')

@push('head')
<style>
/* ================= HOME CONTAINER ================= */
.home-container {
  padding-top: 80px;
  transform: translateY(-160px);
  position: relative;
  height: 100vh;
  width: 100%;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: white;
  z-index: 1;
  animation: fadeInHome 1.2s ease;
}
@keyframes fadeInHome {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ================= POSTER SLIDES ================= */
.poster-slideshow {
  position: fixed;
  inset: 0;
  overflow: hidden;
  z-index: -2;
}
.poster-slideshow img {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.45);
  opacity: 0;
  transform: scale(1.04);
  transition: opacity 2s ease-in-out, transform 10s ease, filter 1.6s ease-in-out;
}
.poster-slideshow img.active {
  opacity: 1;
  transform: scale(1);
}
.poster-slideshow img.fading {
  filter: blur(5px) brightness(0.5) saturate(0.9);
  opacity: 0;
}

/* ================= OVERLAY ================= */
.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.25));
  z-index: -1;
}

/* ================= TEXT ================= */
.home-title {
  font-family: 'Orbitron', sans-serif;
  font-size: 3rem;
  color: #00eaff;
  text-shadow: 0 0 25px rgba(0,234,255,0.8);
  letter-spacing: 2px;
  margin-bottom: 15px;
}
.home-subtitle {
  font-size: 1.2rem;
  color: #bfeaff;
  max-width: 600px;
  margin: 0 auto 40px;
  text-shadow: 0 0 10px rgba(0,234,255,0.3);
  line-height: 1.6;
}

/* ================= BUTTON ================= */
.preview-btn {
  background: linear-gradient(90deg, #00eaff, #007aff);
  color: white;
  border: none;
  border-radius: 30px;
  padding: 12px 28px;
  font-weight: 600;
  font-size: 0.95rem;
  text-decoration: none;
  transition: 0.3s ease;
  box-shadow: 0 0 15px rgba(0,234,255,0.4);
}
.preview-btn:hover {
  transform: scale(1.07);
  box-shadow: 0 0 25px rgba(0,234,255,0.8);
}

/* ================= CAPTION ================= */
.poster-caption {
  position: absolute;
  bottom: 60px;
  left: 50%;
  transform: translateX(-50%);
  color: #bfeaff;
  font-size: 1rem;
  text-shadow: 0 0 10px rgba(0,234,255,0.6);
}

/* ================= FOOTER ================= */
.home-footer {
  position: absolute;
  bottom: 20px;
  text-align: center;
  color: #77bcd5;
  font-size: 0.9rem;
  opacity: 0.8;
}

/* ================= VIDEO MODAL ================= */
.video-modal {
  position: fixed;
  inset: 0;
  background: rgba(0,0,20,0.9);
  backdrop-filter: blur(8px);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 99999;
}
.video-modal.active { display: flex; }
.video-modal iframe {
  width: 80%;
  height: 60%;
  border: none;
  border-radius: 14px;
}
.video-close {
  position: absolute;
  top: 20px;
  right: 30px;
  font-size: 2rem;
  color: #fff;
  cursor: pointer;
}

/* ================= GLOBAL LOADING ================= */
#globalLoading {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at center, #020b14, #000);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999999;
}
.loader-title {
  font-family: 'Orbitron', sans-serif;
  color: #00eaff;
  font-size: 1.5rem;
  margin-bottom: 20px;
  letter-spacing: 3px;
}
.loader-bar {
  width: 260px;
  height: 6px;
  background: rgba(0,234,255,0.2);
  border-radius: 10px;
  overflow: hidden;
}
.loader-bar span {
  display: block;
  height: 100%;
  width: 40%;
  background: linear-gradient(90deg, #00eaff, #007aff);
  animation: loadingMove 1.2s infinite ease-in-out;
}
@keyframes loadingMove {
  from { transform: translateX(-100%); }
  to { transform: translateX(300%); }
}
</style>
@endpush

@section('content')

<!-- ===== GLOBAL LOADING ===== -->
<div id="globalLoading">
  <div>
    <div class="loader-title">LARAVEL GAME GALLERY</div>
    <div class="loader-bar"><span></span></div>
  </div>
</div>

<!-- ===== POSTER SLIDESHOW ===== -->
<div class="poster-slideshow" id="posterSlideshow">
  <img src="{{ asset('images/posters/lara.jpg') }}">
  <img src="{{ asset('images/posters/mario.jpg') }}">
  <img src="{{ asset('images/posters/link.jpg') }}">
  <img src="{{ asset('images/posters/phainon.jpg') }}">
  <img src="{{ asset('images/posters/six.jpg') }}">
  <img src="{{ asset('images/posters/isaac.jpg') }}">
  <img src="{{ asset('images/posters/wukong.jpg') }}">
  <img src="{{ asset('images/posters/olga-unbeast.jpg') }}">
  <img src="{{ asset('images/posters/ghost.jpg') }}">
  <img src="{{ asset('images/posters/anna-takt.jpg') }}">
  <img src="{{ asset('images/posters/ranni.jpg') }}">
  <img src="{{ asset('images/posters/pikachu.jpg') }}">
  <img src="{{ asset('images/posters/ds1.jpg') }}">
  <img src="{{ asset('images/posters/genshin.jpg') }}">
  <img src="{{ asset('images/posters/bloodborne.jpg') }}">
  <div class="overlay"></div>
</div>

<!-- ===== HERO ===== -->
<div class="home-container">
  <h1 class="home-title">Game Gallery</h1>
  <p class="home-subtitle">
    Galeri karakter lintas dunia game — dari petualangan, sihir, hingga legenda.<br>
    Rasakan aura dan kisah mereka dalam satu dunia sinematik.
  </p>
  <button id="previewBtn" class="preview-btn">Preview Game</button>
</div>

<div class="poster-caption" id="posterCaption">Lara Croft — Tomb Raider</div>
<div class="home-footer">
  Tekan <strong>Karakter</strong> di atas untuk mulai menjelajah.
</div>

<!-- ===== VIDEO MODAL ===== -->
<div class="video-modal" id="videoModal">
  <span class="video-close" id="closeModal">&times;</span>
  <iframe id="videoFrame" allowfullscreen></iframe>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('#posterSlideshow img');
  const caption = document.getElementById('posterCaption');
  const previewBtn = document.getElementById('previewBtn');
  const videoModal = document.getElementById('videoModal');
  const videoFrame = document.getElementById('videoFrame');
  const closeModal = document.getElementById('closeModal');

  const data = [
    { text: "Lara Croft — Tomb Raider", link: "XYtyeqVQnRI" },
    { text: "Mario — Super Mario Bros", link: "5kcdRBHM7kM" },
    { text: "Link — Zelda BOTW", link: "zw47_q9wbBE" },
    { text: "Phainon — Honkai Star Rail", link: "GaT1GftoqV0" },
    { text: "Six — Little Nightmares", link: "aOadxZBsPiA" },
    { text: "Isaac Clarke — Dead Space", link: "ctQl9wa3ydE" },
    { text: "Wukong — Black Myth", link: "_mAnlVXtDD8" },
    { text: "Olga Marie — FGO", link: "Q04woulXqu0" },
    { text: "Ghost — COD", link: "7el5VW1wij0" },
    { text: "Anna — Takt Op", link: "H9sCal379PQ" },
    { text: "Ranni — Elden Ring", link: "E3Huy2cdih0" },
    { text: "Pikachu — Pokémon", link: "smc3aPdyaaA" },
    { text: "Solaire — Dark Souls", link: "KfjG9ZLGBHE" },
    { text: "Furina — Genshin Impact", link: "kglEsR7bqAY" },
    { text: "The Hunter — Bloodborne", link: "G203e1HhixY" }
  ];

  let index = 0;
  slides[index].classList.add('active');

  setInterval(() => {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
    caption.textContent = data[index].text;
  }, 7000);

  previewBtn.onclick = () => {
    videoFrame.src = `https://www.youtube.com/embed/${data[index].link}?autoplay=1`;
    videoModal.classList.add('active');
  };

  closeModal.onclick = () => {
    videoModal.classList.remove('active');
    videoFrame.src = '';
  };

  // loading
  window.addEventListener('load', () => {
    const loader = document.getElementById('globalLoading');
    loader.style.opacity = '0';
    setTimeout(() => loader.remove(), 800);
  });
});
</script>
@endpush
@endsection
