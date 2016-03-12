@extends('pegawai.app')

@section('content')

<script type="text/javascript">
$(function(){
    $('#form_create').submit(function(e){
      e.preventDefault();
      $.ajax({
        data: $(this).serializeArray(),
        type: 'POST',
        url: '{{ url('pegawai') }}',
        success:function(data){
          if (data.sukses==true) {
            $('.buttonplace').addClass('none');
            $('.loaderplace').removeClass('none');
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
              $('.loaderplace').addClass('none');
              $('.buttonplace').removeClass('none');
            },1000);
            setTimeout(function(){
              $('#modal1').closeModal();
            },1200);
            setTimeout(function(){
              reloadEmployee();
            },1300);
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

<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Tambah pegawai</h4>
      <div class="row" style="margin-bottom:0">
          <form id="form_create" class="col s12">
            {!! csrf_field() !!}
            <div class="row" style="margin-bottom:0">
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
              <div class="loaderplace center none">
                <div class="preloader-wrapper active">
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
        </div>
    </div>
    <div class="buttonplace modal-footer">
      <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
      </form>
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
    </div>
  </div>
  <div id="hapuspegawai" class="modal">
    <div class="modal-content">
      <h4>Hapus pegawai <span class="title-pegawai"></span></h4>
      <p>Apakah anda yakin ingin menghapus <span class="title-pegawai"></span> dari daftar pegawai?</p>
      <div class="loaderplace center none">
        <div class="preloader-wrapper active">
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
    <div class="buttonplace modal-footer">
      <form id="form_delete">
        {!! csrf_field() !!}
        <input type="hidden" name="id" class="id-pegawai">
        <button type="submit" class="waves-effect waves-green btn-flat">Hapus</button>
      </form>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
    </div>
  </div>

<table class="centered striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama</th>
      <th>NIP</th>
      <th>Tindakan</th>
    </tr>
  </thead>

  <tbody>
    @foreach($pegawai as $pegawai)
    <tr id="pegawai_{{ $pegawai->id }}">
      <td>{{ $no++ }}</td>
      <td>{{ $pegawai->nama }}</td>
      <td>{{ $pegawai->nip }}</td>
      <td>
        <a href="#editpegawai" class="modal-trigger btn waves-effect waves-light">Edit</a>
        <a href="#hapuspegawai" onclick="deleteEmployee('{{ $pegawai->id }}')" class="modal-trigger btn waves-effect waves-light">Hapus</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
