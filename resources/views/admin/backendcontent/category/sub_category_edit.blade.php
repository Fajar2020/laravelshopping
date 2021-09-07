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
            <h3 class="box-title">Edit Sub Category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('subcategory.update') }}">
            @csrf
                <input type="hidden" name="id" value="{{$item->id}}" />
                
                <div class="form-group">
                    <h5>Sub Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subcategory_name_en" value="{{ $item->subcategory_name_en }}" class="form-control" required="">
                    </div>
                    @error('subcategory_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Sub Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subcategory_name_id" value="{{ $item->subcategory_name_id }}" class="form-control" required="">
                    </div>
                    @error('subcategory_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category</h5>
                    <select class="form-control select2" style="width: 100%;" name="category_id" required="">
                        @foreach($categories as $item2)
                            <option value="{{$item2->id}}" {{ $item->category_id == $item2->id ? 'selected': ''}}>{{$item2->category_name_en}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
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