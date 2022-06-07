<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>All Record Display</h2>
    <div class="AddLink">
        <a href="{{ url('view') }}" class="ForColorProduct"> <button type="Submit"> View Product </button></a>
        <a href="{{ url('ShowCategoryForm') }}"> <button type="Submit"> Add Category </button></a>
    </div>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Category</th>
            <th>logo</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
        <tr>
            <td>{{ $data->name }}</td>
            <td> <img src={{asset('/upload/category/'.$data->logo)}} alt="Not Found" width="50px"> </td>
            <td>
                 <a href="{{ route('editCategory',$data->id) }}" class="ForColorProduct"> <button type="Submit"> Edit </button></a>
                 <a href="{{ url('delete',$data->id) }}" class="ForColorProduct"> <button type="Submit"> Soft Delete </button></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>