@extends('admin.admin_master');
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Categories List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="25%">Name En</th>
                            <th width="25%">Name Id</th>
                            <th width="20%">Icon</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $item)
                        <tr>
                            <td width="25%">{{ $item->category_name_en }}</td>
                            <td width="25%">{{ $item->category_name_id }}</td>
                            <td width="20%">
                                <i class="{{ $item->category_icon }}" ></i>
                            </td>
                            <td width="30%">
                                <a href="{{ route('category.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('category.delete',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data">
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
            <h3 class="box-title">Add new category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('category.store') }}">
            @csrf
                <div class="form-group">
                    <h5>Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="category_name_en" class="form-control" required="">
                    </div>
                    @error('category_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="category_name_id" class="form-control" required="">
                    </div>
                    @error('category_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category icon</h5>
                    <div class="controls">
                        <input type="text" name="category_icon" class="form-control" required="">
                    </div>
                    @error('category_icon')
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

@endsection