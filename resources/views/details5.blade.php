<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>test bootstrap</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="width:200px; height:200px;">

  <div class="carousel-inner">
       @for ($i = 1; $i <=$details[0]->countF; $i++)
                <div class="carousel-item active">
                    <img src="{{asset('images/'.$details[0]->image_path.'/'.$i.'.jpg')}}" class="d-block w-100"  alt="">
    </div>


      @endfor

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


   <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>                 
</body>
</html>