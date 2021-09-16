@php
    $tags_en_db = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_ind_db = App\Models\Product::groupBy('product_tags_ind')->select('product_tags_ind')->get();

    $tags_en=[];
    $tags_ind=[];
    
    foreach ($tags_en_db as $tag) {
        foreach (explode(',',$tag->product_tags_en) as $row) {
            array_push($tags_en, $row);
        }   
    }

    foreach ($tags_ind_db as $tag) {
        foreach (explode(',',$tag->product_tags_ind) as $row) {
            array_push($tags_ind, $row);
        }   
    }

@endphp 

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list"> 
        @if(session()->get('language') == 'indonesia') 
            @foreach($tags_ind as $tag)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag) }}">
                {{ $tag  }}</a> 
            @endforeach
        @else 
            @foreach($tags_en as $tag)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag) }}">
                {{ $tag  }}</a> 
            @endforeach
        @endif
        </div>
    </div>
</div>