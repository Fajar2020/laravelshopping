@extends('admin.admin_master');
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">

    <!-- Edit section -->
    <div class="col-8">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit sub sub category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ route('subsubcategory.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}" />
                
                <div class="form-group">
                    <h5>Category <span class="text-danger">*</span></h5>
                    <select class="form-control select2" style="width: 100%;" name="category_id" required="">
                        <option value="">Search...</option>
                        @foreach($categories as $item2)
                            <option value="{{$item2->id}}" {{ $item->category_id == $item2->id ? 'selected': ''}}>{{$item2->category_name_en}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <h5>Sub Category <span class="text-danger">*</span></h5>
                    <select class="form-control select2" style="width: 100%;" name="subcategory_id" required="">
                        <option value="">Search...</option>
                        @foreach($subcategories as $item2)
                            <option value="{{$item2->id}}" {{ $item->subcategory_id == $item2->id ? 'selected': ''}}>{{$item2->subcategory_name_en}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <h5>Sub Sub Category name in English <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subsubcategory_name_en" value="{{$item->subsubcategory_name_en}}" class="form-control" required="">
                    </div>
                    @error('subsubcategory_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Sub Sub Category name in Indonesia <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subsubcategory_name_id" value="{{$item->subsubcategory_name_id}}" class="form-control" required="" data-live-search="true">
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