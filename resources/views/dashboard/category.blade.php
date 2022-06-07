 <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h2> Category </h2>

        <?php if(empty($editCategoryDatas)){  ?>
        <form class="md-float-material form-material" method="POST" enctype="multipart/form-data" id="categorySubmit" action="javascript:void(0)">
        @csrf
            <div class="form-row">
                 <input type="hidden" name="editID" id="editID" value="" >
                <div class="col">
                    <lable> Name </lable>
                    <select class="form-controls browser-default custom-select" name="category" id="category">
                        <option selected>Select category</option>
                          <option value="mobiles">Mobiles</option>
                        <option value="telivision">Telivision</option>
                        <option value="watch">Watch</option>
                    </select>
                </div>
                 <span id="nameErr" class="errorColor"> </span><br>
                
                <lable> Logo </lable>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image" class="form-control">
                    </div>
                </div>
                 <span id="logoErr" class="errorColor"> </span><br>
             </div>
              <button type="submit" name="submit"  id="submited">Add Product</button>   
        </form>
            <?php } ?>
        <!-- For Update -->

        <?php if(!empty($editCategoryDatas)){ foreach($editCategoryDatas as $editCategoryData)   {} ?>
         

         <form class="md-float-material form-material" method="POST" enctype="multipart/form-data" id="categorySubmit" action="javascript:void(0)">
         @csrf
            <div class="form-row">
                <input type="hidden" name="editID" id="editID" value="{{$editCategoryData->id}}" >
                <div class="col">
                    <lable> Name </lable>
                    <select class=" form-control browser-default custom-select" name="category" id="category">
                        <option>{{ $editCategoryData->name }}</option>
                        <option value="mobile">Mobiles</option>
                        <option value="telivision">Telivision</option>
                        <option value="watch">Watch</option>
                    </select>
                </div>
                 <span id="nameErr" class="errorColor"> </span><br>
                
                <lable> Logo </lable>
                <div class="col-md-12">
                    <div class="form-group">
                        <img src={{asset('/upload/category/'.$editCategoryData->logo)}} alt="Not Found" width="50px">
                        <input type="file" name="image" placeholder="Choose image" id="image" class="form-control">
                    </div>
                </div>
                 <span id="logoErr" class="errorColor"> </span><br>
             </div>
              <button type="submit" name="submit"  id="submited">Add Product</button>   
        </form>
        <?php } ?>
        <script src="" async defer></script>
    </body>
</html>


<script> 
     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('#image').change(function(){
        let reader = new FileReader();
            reader.onload = (e) => { 
            $('#preview-image-before-upload').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]);    
        });
        $('#categorySubmit').submit( function(event){ 
                var ids = $('#editID').val();   
                var name =   $('#category :selected').text();
                var formData = new FormData(this);  
                // For Validation
                if (name == "" ) {    
                    $('#nameErr').text('Name Is Reuired');
                    return false;
                    
                }
                if (ids != "") {  
                        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    url: "{{ route('updateCategory') }}", //Define Post URL
                    type:"post",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    "_token": "{{ csrf_token() }}",
                    success: function(response){  
                        window.location.href = '/'
                            
                    }
                });   
                }else{   
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        url: "{{ route('AddCategory') }}", //Define Post URL
                        type:"post",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        "_token": "{{ csrf_token() }}",
                        success: function(response){
                            window.location.href = '/'
                            
                        }
                    });   
                }
            });
            
      
        </script>