<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>ContractorSystem</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link rel="icon" href="{{ URL::asset('/assets/img/icon.jpg') }}" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="{{ URL::asset('/assets/js/plugin/webfont/webfont.js') }}"></script>


<!-- CSS Files -->
<link rel="stylesheet" href="{{ URL::asset('/assets/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('/assets/css/plugins.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('/assets/css/kaiadmin.css') }}" />
<!-- jQuery สำหรับค้นหาแบบสด (Live Search & Filter) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="{{ URL::asset('/assets/css/demo.css') }}" />
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
