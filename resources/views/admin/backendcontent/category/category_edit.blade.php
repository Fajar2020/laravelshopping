@extends('admin.admin_master');
@section('admin')

<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        
    <!-- Add section -->
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('category.update') }}">
            @csrf
                <div class="form-group">
                    <h5>Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="category_name_en" value="{{ $item->category_name_en }}" class="form-control" required="">
                    </div>
                    @error('category_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="category_name_id" value="{{ $item->category_name_id }}" class="form-control" required="">
                    </div>
                    @error('category_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category icon</h5>
                    <div class="controls">
                        <input type="text" name="category_icon" value="{{ $item->category_icon }}" class="form-control" required=""> 
                    </div>
                    <i class="{{ $item->category_icon }} fa-5x"></i>
                    @error('category_icon')
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

@endsection