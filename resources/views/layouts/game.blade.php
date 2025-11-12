<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Laravel Game Gallery')</title>
  
  <!-- Font dan ikon -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Tambahan CSS dari halaman -->
  @stack('head')

  <style>
    /* ====== BOOT INTRO ====== */
#bootIntro {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at center, #001220, #000);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  z-index: 99999;
  opacity: 1;
  transition: opacity 1s ease;
}

.boot-logo h1 {
  font-family: 'Orbitron', sans-serif;
  font-size: 2.8rem;
  color: #00eaff;
  text-shadow: 0 0 25px rgba(0,234,255,0.8);
  animation: glowPulse 2s ease-in-out infinite alternate;
}

.boot-sub {
  font-size: 1rem;
  color: #9fefff;
  opacity: 0.8;
  letter-spacing: 1px;
  margin-top: 10px;
  text-transform: uppercase;
  font-weight: 500;
}

@keyframes glowPulse {
  0% { text-shadow: 0 0 10px #00eaff; opacity: 0.9; }
  100% { text-shadow: 0 0 30px #00ffff; opacity: 1; }
}

    /* ======= GLOBAL BASE ======= */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: radial-gradient(circle at top, #020f1b, #000);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      min-height: 100vh;
      opacity: 1;
      transition: background 0.4s ease;
    }

    /* ======= GLOBAL TRANSITION EFFECT ======= */
    body.fade-out {
      opacity: 0;
      filter: blur(5px);
      transition: opacity 0.6s ease, filter 0.6s ease;
    }

    /* ======= NAVBAR ======= */
    nav {
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
      position: fixed;
      top: 0;
      left: 0;
      z-index: 100;
      border-bottom: 1px solid rgba(0,234,255,0.15);
    }

    nav h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: 1.5rem;
      color: #00eaff;
      text-shadow: 0 0 10px rgba(0,234,255,0.6);
    }

    nav ul {
      display: flex;
      list-style: none;
      gap: 25px;
    }

    nav ul li a {
      color: #bfeaff;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #00eaff;
      text-shadow: 0 0 8px rgba(0,234,255,0.8);
    }

    /* ======= CONTROL BUTTONS ======= */
    .controls {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .ctrl-btn {
      background: rgba(0, 234, 255, 0.15);
      border: 1px solid rgba(0, 234, 255, 0.3);
      color: #00eaff;
      border-radius: 50px;
      padding: 6px 14px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .ctrl-btn:hover {
      background: rgba(0, 234, 255, 0.3);
      box-shadow: 0 0 10px rgba(0, 234, 255, 0.5);
    }

    /* ======= MAIN CONTENT ======= */
    main {
      margin-top: 90px;
      animation: fadeIn 0.7s ease;
      min-height: calc(100vh - 100px);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    footer {
      text-align: center;
      padding: 25px 0;
      color: #77a5b8;
      font-size: 0.9rem;
    }

    /* ======= THEME LIGHT ======= */
    body.light {
      background: linear-gradient(to bottom, #f0f7ff, #e2ebf5);
      color: #111;
    }

    body.light nav {
      background: rgba(255,255,255,0.6);
      border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    body.light nav h1 {
      color: #0044aa;
      text-shadow: none;
    }

    body.light .ctrl-btn {
      background: rgba(0, 0, 0, 0.05);
      color: #0044aa;
      border-color: rgba(0,0,0,0.2);
    }

    body.light footer {
      color: #444;
    }
  </style>
</head>
<!-- BOOT INTRO -->
<div id="bootIntro">
  <div class="boot-logo">
    <h1>Laravel Game Gallery</h1>
    <p class="boot-sub">Powered by Laravel</p>
  </div>
</div>

<body>
  <!-- NAVBAR -->
  <nav>
    <h1>Game Gallery</h1>
    <ul>
      <li><a href="{{ url('/') }}" class="js-click">Home</a></li>
      <li><a href="{{ route('karakter') }}" class="js-click">Karakter</a></li>
    </ul>
    <div class="controls">
      <button id="musicBtn" class="ctrl-btn">🎵 Musik</button>
      <button id="themeBtn" class="ctrl-btn">🌗 Tema</button>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main>
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer>
    © 2025 Laravel Game Gallery | Dibuat dengan 💙 oleh Made Andhika
  </footer>

  <!-- GLOBAL SCRIPT -->
  <script>
// ====== BOOT INTRO EFFECT ======
document.addEventListener('DOMContentLoaded', () => {
  const boot = document.getElementById('bootIntro');
  // Hanya tampil saat pertama kali kunjungan (per sesi)
  if (!sessionStorage.getItem('bootPlayed')) {
    setTimeout(() => {
      boot.style.opacity = '0';
      setTimeout(() => boot.remove(), 1000);
      sessionStorage.setItem('bootPlayed', 'true');
    }, 2500); // durasi tampil 2.5 detik
  } else {
    boot.remove(); // lewati intro jika sudah pernah tampil
  }
});

// ====== RO EFFECT ======
document.addEventListener('DOMContentLoaded', () => {
  const boot = document.getElementById('bootIntro');
  // Hanya tampil saat pertama kali kunjungan (per sesi)
  if (!sessionStorage.getItem('bootPlayed')) {
    setTimeout(() => {
      boot.style.opacity = '0';
      setTimeout(() => boot.remove(), 1000);
      sessionStorage.setItem('bootPlayed', 'true');
    }, 2500); // durasi tampil 2.5 detik
  } else {
    boot.remove(); // lewati intro jika sudah pernah tampil
  }
});

    // ======= SUARA KLIK GLOBAL =======
    const clickSound = new Audio("{{ asset('sounds/click.mp3') }}");
    const bgMusic = new Audio("{{ asset('sounds/theme.mp3') }}");
    bgMusic.loop = true;
    bgMusic.volume = 0.4;

    // ======= TRANSISI GLOBAL =======
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('a.js-click').forEach(link => {
        link.addEventListener('click', function(e) {
          if (this.target === '_blank' || this.href.includes('#')) return;
          e.preventDefault();
          clickSound.currentTime = 0;
          clickSound.play();
          document.body.classList.add('fade-out');
          setTimeout(() => window.location = this.href, 550);
        });
      });
    });

    // ======= MUSIK THEME =======
    const musicBtn = document.getElementById('musicBtn');
    let musicOn = false;
    musicBtn.addEventListener('click', () => {
      if (musicOn) {
        bgMusic.pause();
        musicBtn.textContent = '🎵 Musik';
      } else {
        bgMusic.play();
        musicBtn.textContent = '🔇 Stop';
      }
      musicOn = !musicOn;
    });

    // ======= TEMA =======
    const themeBtn = document.getElementById('themeBtn');
    themeBtn.addEventListener('click', () => {
      document.body.classList.toggle('light');
    });
  </script>

  @stack('scripts')
</body>
</html>
