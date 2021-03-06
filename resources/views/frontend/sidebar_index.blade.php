<div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
        
        <!--  TOP NAVIGATION  -->
        @include('frontend.sidebar.vertical_menu')
        <!--  TOP NAVIGATION : END  --> 
        
        <!--  HOT DEALS  -->
        @include('frontend.sidebar.hot_deal') 
        
        <!--  SPECIAL OFFER  -->
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Offer</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

              <div class="item">
                  <div class="products special-product">
                    @foreach($special_offer as $product)
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"> <img src="{{ asset($product->product_thambnail) }}" alt=""> </a> </div>
                              <!-- /.image --> 
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'hindi') {{ $product->product_name_hin }} @else {{ $product->product_name_en }} @endif</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                              <!-- /.product-price --> 

                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                    </div>
                    @endforeach
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <!--  SPECIAL OFFER : END  --> 
        
        
        <!--  PRODUCT TAGS  -->
        @include('frontend.sidebar.product_tags') 
        <!--  PRODUCT TAGS : END  --> 
        
        <!--  SPECIAL DEALS  -->
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Deals</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
              <div class="item">
                <div class="products special-product">

                @foreach($special_deals as $product)
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> 
                              <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"> 
                                <img src="{{ asset($product->product_thambnail) }}"  alt=""> 
                              </a> 
                            </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'indonesia') {{ $product->product_name_ind }} @else {{ $product->product_name_en }} @endif</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> Rp.{{ $product->selling_price }} </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
        <!--  SPECIAL DEALS : END  --> 
        
        <!--  NEWSLETTER  -->
        @include('frontend.sidebar.newsletter') 
        <!-- Testimonials -->
        @include('frontend.sidebar.testimoni') 
        
        
        <div class="home-banner"> <img src="{{asset('frontend/assets/images/banners/LHS-banner.jpg')}}" alt="Image"> </div>
    </div>