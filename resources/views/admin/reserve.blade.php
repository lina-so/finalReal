
@extends('layouts.app')


@section('content')


<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align:center;
}

#customers tr{background-color: #f2f2f2; color:#8f8383;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>

<h1>@lang('lang.All Realestates were Reserved') </h1>

<table id="customers">
<tr>

    <th>is_reserve</th>
    <th>created_at</th>
    <th>updated_at</th>
    <th>user_id</th>
    <th>real_id</th>
  </tr>
    @foreach ($reserve as $reserved)
  <tr>
    <td> {{$reserved->is_reserve}}</td>
    <td> {{$reserved->created_at}}</td>
    <td>{{$reserved->updated_at}}</td>
    <td>{{$reserved->user_id}}</td>
    <td>{{$reserved->real_id}}</td>
  </tr>
  @endforeach
</table>

</body>
</html>



@endsection
