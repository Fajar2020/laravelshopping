@extends('admin.admin_master');
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Brands List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="25%">Brand En</th>
                            <th width="25%">Brand Id</th>
                            <th width="20%">Image</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $item)
                        <tr>
                            <td width="25%">{{ $item->brand_name_en }}</td>
                            <td width="25%">{{ $item->brand_name_id }}</td>
                            <td width="20%">
                                <img src="{{ (!empty($item->brand_image)) ? url($item->brand_image) : url('upload/no_image.jpg')}}" alt="">
                            </td>
                            <!-- <td>{{$item->admin->name}}
                                @if($item->updated_at == NULL)
                                    <span class="text-danger"></span>
                                @else
                                    <span class="text-danger"> at 
                                    {{Carbon\Carbon::parse($item->updated_at)->diffForHumans()}}
                                    </span>
                                @endif        
                            </td> -->
                            <td width="30%">
                                <a href="{{ route('brand.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('brand.delete',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        
    </div>
    <!-- /.col -->

    <!-- Add section -->
    <div class="col-4">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add new brand</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <h5>Brand name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="brand_name_en" class="form-control" required="">
                    </div>
                    @error('brand_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Brand name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="brand_name_id" class="form-control" required="">
                    </div>
                    @error('brand_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Brand Image</h5>
                    <a class = "thumbnail"><img id="showImage" width="50%"></a>
                    <div class="controls">
                        <input type="file" name="brand_image" class="form-control" id="image" required=""> 
                    </div>
                    @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-info" value="Add">
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