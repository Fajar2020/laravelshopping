@extends('admin.admin_master');
@section('admin')


<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Categories List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20%">Category</th>
                            <th width="20%">Sub category en</th>
                            <th width="20%">Sub category id</th>
                            <th width="40%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $item)
                        <tr>
                            <td width="20%">{{ $item->category->category_name_en }}</td>
                            <td width="20%">{{ $item->subcategory_name_en }}</td>
                            <td width="20%">{{ $item->subcategory_name_id }}</td>
                            <td width="40%">
                                <a href="{{ route('subcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('subcategory.delete',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data">
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
            <h3 class="box-title">Add new sub category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('subcategory.store') }}">
            @csrf
                <div class="form-group">
                    <h5>Sub Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subcategory_name_en" class="form-control" required="">
                    </div>
                    @error('subcategory_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Sub Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subcategory_name_id" class="form-control" required="">
                    </div>
                    @error('subcategory_name_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Category</h5>
                    <select class="form-control select2" style="width: 100%;" name="category_id" required="">
                        <option value="">Search...</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->category_name_en}}</option>
                        @endforeach
                    </select>
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