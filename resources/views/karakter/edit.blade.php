@extends('layouts.game')
@section('title','Edit Karakter')

@push('head')
<style>
.form-wrapper{
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
}
.form-card{
  width:100%;
  max-width:720px;
  background:rgba(10,15,30,.85);
  border-radius:20px;
  padding:35px;
  box-shadow:0 0 25px rgba(0,234,255,.25);
}
.form-card h2{
  font-family:'Orbitron',sans-serif;
  color:#00eaff;
  margin-bottom:25px;
  text-align:center;
}
.form-group{margin-bottom:15px}
.form-group label{color:#bfeaff;font-size:.9rem}
.form-group input,
.form-group textarea{
  width:100%;
  padding:10px 14px;
  border-radius:12px;
  background:#050b14;
  border:1px solid #00eaff;
  color:#fff;
}
.form-actions{
  display:flex;
  gap:12px;
  justify-content:flex-end;
  margin-top:25px;
}
.btn-save{
  background:#00eaff;color:#000;
  padding:10px 22px;
  border-radius:25px;
  font-weight:600;
}
.btn-cancel{
  background:transparent;
  border:1px solid #777;
  color:#ccc;
  padding:10px 18px;
  border-radius:25px;
}
</style>
@endpush

@section('content')
<div class="form-wrapper">
  <div class="form-card">
    <h2>Edit Karakter</h2>

    <form method="POST" action="{{ route('karakter.update',$karakter->id) }}">
      @csrf
      @method('PUT')

      @foreach (['kode','nama','game','jenis','warna','foto','background'] as $f)
      <div class="form-group">
        <label>{{ ucfirst($f) }}</label>
        <input name="{{ $f }}" value="{{ $karakter->$f }}" required>
      </div>
      @endforeach

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required>{{ $karakter->deskripsi }}</textarea>
      </div>

      <div class="form-actions">
        <a href="{{ route('karakter.index') }}" class="btn-cancel">Batal</a>
        <button class="btn-save">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
