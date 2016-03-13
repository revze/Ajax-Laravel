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
     $(function(){
      // $(window).load(function(){
      //   $('body').css('overflow','hidden');
      //   setTimeout(function() {
      //     $('body').addClass('loaded');
      //     $('body').css('overflow','auto');
      //   },200);
      //   setTimeout(function() {
      //     $('#loader-wrapper').addClass('none');
      //   },800);
      // });

      $('.spa').click(function(){
        $url = $(this).attr('href');
        $.ajax({
          url: $url,
          type: 'GET',
          data: {},
          success:function(data)
          {
            window.history.pushState('','',$url);
            document.open();
            document.write(data);
            document.close();
          }
        });
      });

       $('.modal-trigger').leanModal();
    });
    </script>
  </head>
  <body>
    <!-- <div id="loader-wrapper">
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
    </div> -->
    @include('pegawai.menu')
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card-panel">
            tes 2 bro
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
