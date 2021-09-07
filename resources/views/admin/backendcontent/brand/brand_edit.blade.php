@extends('admin.admin_master');
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        
    <!-- Add section -->
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit brand</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('brand.update') }}" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$item->id}}" />
                <input type="hidden" name="old_image" value="{{$item->brand_image}}" />
                <div class="form-group">
                    <h5>Brand name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="brand_name_en" value="{{ $item->brand_name_en }}" class="form-control" required="">
                    </div>
                    @error('brand_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Brand name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="brand_name_id" value="{{ $item->brand_name_id }}" class="form-control" required="">
                    </div>
                    @error('brand_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Brand Image</h5>
                    <a class = "thumbnail"><img id="showImage" src="{{ (!empty($item->brand_image)) ? url($item->brand_image) : url('upload/no_image.jpg')}}" width="50%"></a>
                    <div class="controls">
                        <input type="file" name="brand_image" class="form-control" id="image"> 
                    </div>
                    @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-info" value="Update">
                </div>
				
			</form>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        
    </div>

    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection