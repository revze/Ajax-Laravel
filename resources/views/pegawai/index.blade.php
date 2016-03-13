@extends('pegawai.app')

@section('content')

<script type="text/javascript">
function reloadEmployee() {
  $.ajax({
    url: '{{ url('pegawai') }}',
    type: 'GET',
    data: {},
    success:function(data)
    {
      window.history.pushState('','','{{ url('pegawai') }}');
      document.open();
      document.write(data);
      document.close();
    }
  });
}

function showEmployee(id) {
  $.ajax({
    url: '{{ url('pegawai') }}'+'/'+id,
    type: 'GET',
    data: {},
    success:function(data){
      $('.title-pegawai').html(data.pegawai.nama);
      $('#form_edit input[name=id]').val(id);
      $('#nama').val(data.pegawai.nama);
      $('#label_nama').addClass('active');
      $('#nip').val(data.pegawai.nip);
      $('#label_nip').addClass('active');
      $('#alamat').html(data.pegawai.alamat);
      $('#label_alamat').addClass('active');
    }
  });
}

function deleteEmployee(id) {
  $.ajax({
    url: '{{ url('pegawai') }}'+'/'+id,
    type: 'GET',
    data: {},
    success:function(data){
      $('.title-pegawai').html(data.pegawai.nama);
      $('.id-pegawai').val(id);
    }
  });
}

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
            },200);
            setTimeout(function(){
              $('#modal1').closeModal();
            },400);
            setTimeout(function(){
              $modalcontent = 'Data pegawai berhasil ditambah.';
              $('#modalsukses .modal-content').html($modalcontent);
              $('#modalsukses').openModal();
            },500);
            setTimeout(function(){
              $('#modalsukses').closeModal();
            },1000);
            setTimeout(function(){
              reloadEmployee();
            },1400);
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

    $('#form_delete').submit(function(e){
      e.preventDefault();
      $.ajax({
        data: $(this).serializeArray(),
        type: 'POST',
        url: '{{ url('pegawai/destroy') }}',
        success:function(data){
          if (data.sukses==true) {
            $('.buttonplace').addClass('none');
            $('.loaderplace').removeClass('none');
            setTimeout(function(){
              $('#hapuspegawai').closeModal();
            },200);
            setTimeout(function(){
              $modalcontent = 'Data pegawai berhasil dihapus.';
              $('#modalsukses .modal-content').html($modalcontent);
              $('#modalsukses').openModal();
            },300);
            setTimeout(function(){
              $('#modalsukses').closeModal();
            },600);
            setTimeout(function(){
              reloadEmployee();
            },1000);
          }
        }
     });
  });

  $('#form_edit').submit(function(e){
    e.preventDefault();
    $.ajax({
      data: $(this).serializeArray(),
      type: 'POST',
      url: '{{ url('pegawai/update') }}',
      success:function(data){
        if (data.sukses==true) {
          $('.buttonplace').addClass('none');
          $('.loaderplace').removeClass('none');
          $('#form_edit input').attr('readonly','true');
          $('#form_edit textarea').attr('readonly','true');

          $('#form_edit input[name=nama]').removeClass('invalid');
          $('#error_nama2').removeClass('red-text');
          $('#error_nama2').html('');
          $('#form_edit input[name=nip]').removeClass('invalid');
          $('#error_nip2').removeClass('red-text');
          $('#error_nip2').html('');
          $('#form_edit textarea[name=alamat]').removeClass('invalid');
          $('#error_alamat2').removeClass('red-text');
          $('#error_alamat2').html('');
          setTimeout(function(){
            $('#form_edit input').removeAttr('readonly');
            $('#form_edit textarea').removeAttr('readonly');
            $('#form_edit input').val('');
            $('#form_edit textarea').val('');
            $('#form_edit label').removeClass('active');
            $('#form_edit input').removeClass('valid');
            $('#form_edit textarea').removeClass('valid');
            $('.loaderplace').addClass('none');
            $('.buttonplace').removeClass('none');
          },200);
          setTimeout(function(){
            $('#editpegawai').closeModal();
          },400);
          setTimeout(function(){
            $modalcontent = 'Data pegawai berhasil diubah.';
            $('#modalsukses .modal-content').html($modalcontent);
            $('#modalsukses').openModal();
          },500);
          setTimeout(function(){
            $('#modalsukses').closeModal();
          },1000);
          setTimeout(function(){
            reloadEmployee();
          },1400);
        }

        else {
          if (data.nama=='The nama field is required.') {
            $('#form_edit input[name=nama]').addClass('invalid');
            $('#error_nama2').addClass('red-text');
            $('#error_nama2').html(data.nama);
          }

          else {
            $('#form_edit input[name=nama]').removeClass('invalid');
            $('#error_nama2').removeClass('red-text');
            $('#error_nama2').html('');
          }

          if (data.nip=='The nip field is required.') {
            $('#form_edit input[name=nip]').addClass('invalid');
            $('#error_nip2').addClass('red-text');
            $('#error_nip2').html(data.nip);
          }

          else if (data.nip=='The nip must be an integer.') {
            $('#form_edit input[name=nip]').addClass('invalid');
            $('#error_nip2').addClass('red-text');
            $('#error_nip2').html(data.nip);
          }

          else {
            $('#form_edit input[name=nip]').removeClass('invalid');
            $('#error_nip2').removeClass('red-text');
            $('#error_nip2').html('');
          }

          if (data.alamat=='The alamat field is required.') {
            $('#form_edit textarea[name=alamat]').addClass('invalid');
            $('#error_alamat2').addClass('red-text');
            $('#error_alamat2').html(data.alamat);
          }

          else {
            $('#form_edit textarea[name=alamat]').removeClass('invalid');
            $('#error_alamat2').removeClass('red-text');
            $('#error_alamat2').html('');
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

<div id="modalsukses" class="modal yellow">
    <div class="modal-content center">

    </div>
  </div>

<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Tambah pegawai</h4>
      <div class="row" style="margin-bottom:0">
           <form id="form_create" class="col s12">
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
                @include('pegawai.loader')
              </div>
            </div>
        </div>
    </div>
    <div class="buttonplace modal-footer">
      <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
      </form>
      <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
    </div>
  </div>
  <div id="editpegawai" class="modal">
      <div class="modal-content">
        <h4>Edit <span class="title-pegawai"></span></h4>
        <div class="row" style="margin-bottom:0">
            <form id="form_edit" class="col s12">
              <input type="hidden" name="id">
              <div class="row" style="margin-bottom:0">
                <div class="input-field col s6">
                  <input id="nama" type="text" class="validate" name="nama">
                  <label for="nama" id="label_nama">Nama</label>
                  <span id="error_nama2"></span>
                </div>
                <div class="input-field col s6">
                  <input id="nip" type="text" class="validate" name="nip">
                  <label for="nip" id="label_nip">NIP</label>
                  <span id="error_nip2"></span>
                </div>
                <div class="input-field col s12">
                  <textarea id="alamat" class="materialize-textarea validate" name="alamat"></textarea>
                  <label for="alamat" id="label_alamat">Alamat</label>
                  <span id="error_alamat2"></span>
                </div>
                <div class="loaderplace center none">
                  @include('pegawai.loader')
                </div>
              </div>
          </div>
      </div>
      <div class="buttonplace modal-footer">
        <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
        </form>
        <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
      </div>
    </div>
  <div id="hapuspegawai" class="modal">
    <div class="modal-content">
      <h4>Hapus pegawai <span class="title-pegawai"></span></h4>
      <p>Apakah anda yakin ingin menghapus <span class="title-pegawai"></span> dari daftar pegawai?</p>
      <div class="loaderplace center none">
        @include('pegawai.loader')
      </div>
    </div>
    <div class="buttonplace modal-footer">
       <form id="form_delete">
        <input type="hidden" name="id" class="id-pegawai">
        <button type="submit" class="waves-effect waves-green btn-flat">Hapus</button>
      </form>
      <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
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
    @foreach($pegawai as $value)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $value->nama }}</td>
      <td>{{ $value->nip }}</td>
      <td>
        <a href="#editpegawai" onclick="showEmployee('{{ $value->id }}')" class="modal-trigger btn waves-effect waves-light">Edit</a>
        <a href="#hapuspegawai" onclick="deleteEmployee('{{ $value->id }}')" class="modal-trigger btn waves-effect waves-light">Hapus</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{!! $pegawai->links() !!}

@endsection
