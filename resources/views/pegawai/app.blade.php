<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi Pegawai</title>
    <link rel="stylesheet" href="{{ url('assets/css/materialize.min.css') }}" media="screen" title="Core CSS" charset="utf-8">
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/materialize.min.js') }}"></script>
    <style type="text/css">
      .none{
        display: none;
      }

      .loaded #loader-wrapper{
        opacity: 0;
        visibility: hidden;
        transition: all .3s ease-out;
      }

      #loader-wrapper{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
      }

      #loader-wrapper .loader-section{
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background: #eee;
        z-index: 9999;
      }

    </style>
    <script type="text/javascript">
    function reloadEmployee() {
      $.ajax({
        url: '{{ url('pegawai') }}',
        type: 'GET',
        data: {},
        success:function(data)
        {
          window.history.pushState('Aplikasi Pegawai','Aplikasi Pegawai','{{ url('pegawai') }}');
          document.open();
          document.write(data);
          document.close();
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

      $(window).load(function(){
        $('body').css('overflow','hidden');
        setTimeout(function() {
          $('body').addClass('loaded');
          $('body').css('overflow','auto');
        },200);
        setTimeout(function() {
          $('#loader-wrapper').addClass('none');
        },800);
      });

      $('#form_delete').submit(function(e){
        e.preventDefault();
        $.ajax({
          data: $('#form_delete').serializeArray(),
          type: 'POST',
          url: '{{ url('pegawai/destroy') }}',
          success:function(data){
            if (data.sukses==true) {
              $('.buttonplace').addClass('none');
              $('.loaderplace').removeClass('none');
              setTimeout(function(){
                $('#hapuspegawai').closeModal();
              },500);
              setTimeout(function(){
                reloadEmployee();
              },700);
            }
          }
        });
      });

      $('.modal-trigger').leanModal();
    });
    </script>
  </head>
  <body>
    <div id="loader-wrapper">
        <div class="loader-section center">
          <div class="preloader-wrapper big active" style="margin-top:250px">
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
    <nav>
      <div class="nav-wrapper container">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a class="modal-trigger" href="#modal1">Tambah</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card-panel">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    </script>
  </body>
</html>
