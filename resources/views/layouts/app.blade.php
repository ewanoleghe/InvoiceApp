<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
  <script src="{{ asset('js/invoice.js') }}"></script>
  <script src="{{ asset('js/items.js') }}"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Invoice app</title>
</head>

<body class="" data-page="index">
  <div class="spinner">
    <div class="spinner-container">
    <img src="{{ asset('assets/spinner_zwwzra.gif') }}" alt="">
    </div>
  </div>
  <div class="site-wrapper">

    <header id="header">
      <div class="header-logo-container">
      <a href="{{ route('index') }}" class="btn btn-1" style="text-decoration: none;"><img src="{{ asset('assets/logo.svg') }}" alt="" class="header-logo"></a>
      </div>
      <div class="header-sun-icon-container">
        <img src="{{ asset('assets/icon-moon.svg') }}" alt="" class="header-sun-icon">
      </div>
      <div class="header-avatar-container">
        <img src="{{ asset('assets/image-avatar.jpg') }}" class="header-avatar" alt="">
      </div>
    </header>

         <!-- Begin Page Content -->
         <div class="container-fluid">
  
  <!-- Page Heading -->
  

  @yield('contents')

  <!-- Content Row -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

        <script src="{{ asset('js/app.js') }}"></script>
        <script>
    var baseUrl = "{{ asset('') }}";
</script>


</body>

</html>