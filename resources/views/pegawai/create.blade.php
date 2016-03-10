@extends('pegawai.app')

@section('content')
<style type="text/css">
  .none{
    display: none;
  }
</style>
<script type="text/javascript">
  $(function(){
    $('#form_create').submit(function(e){
      e.preventDefault();
      $.ajax({
        data: $(this).serializeArray(),
        type: 'POST',
        url: '{{ url('pegawai') }}',
        success:function(data){

          if (data=='success') {
            $('#buttonplace').addClass('none');
            $('#loaderplace').removeClass('none');
            $('#form_create input').attr('readonly','true');
            $('#form_create textarea').attr('readonly','true');

            $('#form_create input[name=nama]').removeClass('invalid');
            $('#error_nama').removeClass('red-text');
            $('#error_nama').html('');
            $('#form_create input[name=nip]').removeClass('invalid');
            $('#error_nip').removeClass('red-text');
            $('#error_nip').html('');
            $('#form_create textarea[name=alamat]').removeClass('invalid');
            $('#error_alamat').removeClass('red-text');
            $('#error_alamat').html('');
            setTimeout(function(){
              $('#form_create input').removeAttr('readonly');
              $('#form_create textarea').removeAttr('readonly');
              $('#form_create input').val('');
              $('#form_create textarea').val('');
              $('#form_create label').removeClass('active');
              $('#form_create input').removeClass('valid');
              $('#form_create textarea').removeClass('valid');
              $('#loaderplace').addClass('none');
              $('#buttonplace').removeClass('none');
            },1000);
          }

          else {
            if (data.nama=='The nama field is required.') {
              $('#form_create input[name=nama]').addClass('invalid');
              $('#error_nama').addClass('red-text');
              $('#error_nama').html(data.nama);
            }

            else {
              $('#form_create input[name=nama]').removeClass('invalid');
              $('#error_nama').removeClass('red-text');
              $('#error_nama').html('');
            }

            if (data.nip=='The nip field is required.') {
              $('#form_create input[name=nip]').addClass('invalid');
              $('#error_nip').addClass('red-text');
              $('#error_nip').html(data.nip);
            }

            else if (data.nip=='The nip must be an integer.') {
              $('#form_create input[name=nip]').addClass('invalid');
              $('#error_nip').addClass('red-text');
              $('#error_nip').html(data.nip);
            }

            else {
              $('#form_create input[name=nip]').removeClass('invalid');
              $('#error_nip').removeClass('red-text');
              $('#error_nip').html('');
            }

            if (data.alamat=='The alamat field is required.') {
              $('#form_create textarea[name=alamat]').addClass('invalid');
              $('#error_alamat').addClass('red-text');
              $('#error_alamat').html(data.alamat);
            }

            else {
              $('#form_create textarea[name=alamat]').removeClass('invalid');
              $('#error_alamat').removeClass('red-text');
              $('#error_alamat').html('');
            }
          }
        },
        error:function(){
          alert('Server kehabisan waktu');
        }
      });
    });
  });
</script>

<div class="row">
    <form id="form_create" class="col s12">
      {!! csrf_field() !!}
      <div class="row">
        <div class="input-field col s6">
          <input id="icon_prefix" type="text" class="validate" name="nama">
          <label for="icon_prefix">Nama</label>
          <span id="error_nama"></span>
        </div>
        <div class="input-field col s6">
          <input id="icon_telephone" type="text" class="validate" name="nip">
          <label for="icon_telephone">NIP</label>
          <span id="error_nip"></span>
        </div>
        <div class="input-field col s12">
          <textarea id="icon_prefix2" class="materialize-textarea validate" name="alamat"></textarea>
          <label for="icon_prefix2">Alamat</label>
          <span id="error_alamat"></span>
        </div>
        <div id="buttonplace" class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light">Simpan</button>
        </div>
        <div id="loaderplace" class="none">
          <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-red">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-yellow">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-green">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

@endsection
