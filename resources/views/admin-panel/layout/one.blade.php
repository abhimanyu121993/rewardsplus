<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RewardsPlus :: @yield('title')</title>
    @include('admin-panel.include.head')
    @yield('link-area')
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"> </div>
      <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
     @include('admin-panel.include.header')
      <!-- Page Header Ends-->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @if(Helper::getGuard()=='admin')
          @include('admin-panel.include.sidebar')
        @elseif(Helper::getGuard()=='employee')
          @include('admin-panel.include.employee-sidebar')
          @elseif(Helper::getGuard()=='company')
          @include('admin-panel.include.company-sidebar')
        @endif
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          @yield('bread-crumb')
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            @yield('content-area')
          </div>
          <!-- Container-fluid Ends-->
        </div>
        
         
       @include('admin-panel.include.footer')
       </div></div>
  
  @include('admin-panel.include.foot')
  @yield('script-area');
  @include('sweetalert::alert')
  <script>
    $(document).on('change','#country_id',function(){
    var id=$(this).val();
    $.ajax({
      url:"{{ route('general.get-state') }}",
      method:'post',
      data:{
        '_token':'{{ csrf_token() }}',
        'country_id':id
      },
      beforeSend:function(){
        $('#state_id').attr('disabled','true');
      },
      success:function(r){
        $('#state_id').html(r);
        $('#state_id').removeAttr('disabled');
      }
    });
    $(document).on('change','#state_id',function(){
    var id=$(this).val();
    $.ajax({
      url:"{{ route('general.get-city') }}",
      method:'post',
      data:{
        '_token':'{{ csrf_token() }}',
        'state_id':id
      },
      beforeSend:function(){
        $('#city_id').attr('disabled','true');
      },
      success:function(r){
        $('#city_id').html(r);
        $('#city_id').removeAttr('disabled');
      }
    });
  })
})
  </script>
  </body>
</html>