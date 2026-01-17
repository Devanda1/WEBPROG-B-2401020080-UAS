@extends('layouts.game')

@section('title', 'Tambah Karakter')

@push('head')
<style>
/* CSS ASLI TIDAK DIUBAH */
.create-wrapper{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:100px 20px}
.create-card{width:100%;max-width:700px;background:rgba(10,15,30,.75);backdrop-filter:blur(14px);border-radius:22px;padding:35px 40px;box-shadow:0 0 35px rgba(0,234,255,.25);border:2px solid rgba(0,234,255,.3)}
.create-title{text-align:center;font-family:'Orbitron',sans-serif;color:#00eaff;margin-bottom:30px}
.form-group{margin-bottom:16px}
.form-group label{color:#9fefff;font-size:.9rem}
.form-control{width:100%;padding:12px 15px;border-radius:14px;background:rgba(0,0,0,.35);border:1.8px solid #00eaff;color:#fff}
.form-actions{display:flex;justify-content:space-between;margin-top:30px}
.btn-cancel{padding:10px 24px;border-radius:25px;border:1.5px solid #aaa;color:#ccc;background:transparent;text-decoration:none}
.btn-save{padding:10px 28px;border-radius:25px;border:none;background:linear-gradient(90deg,#00eaff,#007aff);color:#000;font-weight:700}
.preview{margin-top:10px;max-width:100%;border-radius:12px;display:none}
</style>
@endpush

@section('content')
<div class="create-wrapper">
  <div class="create-card">

    <h2 class="create-title">Tambah Karakter</h2>

    <form action="{{ route('karakter.store') }}"
          method="POST"
          enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Game</label>
        <input type="text" name="game" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Jenis / Peran</label>
        <input type="text" name="jenis" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Warna Aura</label>
        <input type="color" name="warna" class="form-control" value="#00eaff">
      </div>

      <div class="form-group">
        <label>Foto Karakter</label>
        <input type="file" name="foto" class="form-control" accept="image/*"
               onchange="previewImg(this,'fotoPreview')" required>
        <img id="fotoPreview" class="preview">
      </div>

      <div class="form-group">
        <label>Background</label>
        <input type="file" name="background" class="form-control" accept="image/*"
               onchange="previewImg(this,'bgPreview')" required>
        <img id="bgPreview" class="preview">
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="form-control" required></textarea>
      </div>

      <div class="form-actions">
        <a href="{{ route('karakter.index') }}" class="btn-cancel">Batal</a>
        <button class="btn-save">Simpan</button>
      </div>
    </form>

  </div>
</div>

<script>
function previewImg(input,id){
  const img=document.getElementById(id)
  img.src=URL.createObjectURL(input.files[0])
  img.style.display='block'
}
</script>
@endsection
