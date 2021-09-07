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
            <h3 class="box-title">Sub Categories List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="18%">Category</th>
                            <th width="18%">Sub Category</th>
                            <th width="20%">Sub sub category en</th>
                            <th width="20%">Sub sub category id</th>
                            <th width="26%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subsubcategories as $item)
                        <tr>
                            <td width="18%">{{ $item->category->category_name_en }}</td>
                            <td width="18%">{{ $item->subcategory->subcategory_name_en }}</td>
                            <td width="20%">{{ $item->subsubcategory_name_en }}</td>
                            <td width="20%">{{ $item->subsubcategory_name_id }}</td>
                            <td width="26%">
                                <a href="{{ route('subsubcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('subsubcategory.delete',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data">
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
            <h3 class="box-title">Add new sub sub category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('subsubcategory.store') }}">
            @csrf
            <div class="form-group">
                    <h5>Category <span class="text-danger">*</span></h5>
                    <select class="form-control select2" style="width: 100%;" name="category_id" required="">
                        <option value="">Search...</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->category_name_en}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <h5>Sub Category <span class="text-danger">*</span></h5>
                    <select class="form-control select2" style="width: 100%;" name="subcategory_id" required="">
                        <option value="">Search...</option>
                    </select>
                </div>

                <div class="form-group">
                    <h5>Sub Sub Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subsubcategory_name_en" class="form-control" required="">
                    </div>
                    @error('subsubcategory_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Sub Sub Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subsubcategory_name_id" class="form-control" required="" data-live-search="true">
                    </div>
                    @error('subsubcategory_name_id')
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
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

@endsection