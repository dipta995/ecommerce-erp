<div class="wrap-show-advance-info-box style-1 box-in-site">
    <h3 class="title-box">Most Viewed Products</h3>
    <div class="wrap-products">
        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >




            @foreach ($mostpopular as $pop)


            <div class="product product-style-2 equal-elem ">
                <div class="product-thumnail">
                    <a href="{{ url('/product/details/'.$pop->product_code) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                        <figure><img src="{{ url('/images/'.$pop->image_one) }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                    </a>
                    <div class="group-flash">
                        <span class="flash-item new-label">new</span>
                    </div>
                    <div class="wrap-btn">
                        <a href="{{ url('/product/details/'.$pop->product_code) }}" class="function-link">quick view</a>
                    </div>
                </div>
                <div class="product-info">
                    <a href="{{ url('/product/details/'.$pop->product_code) }}" class="product-name"><span>{{ $pop->name }}</span></a>
                    <div class="wrap-price"><span class="product-price">@php
                        if ($pop->discount>0) {
                            $discount =($pop->discount* $pop->sell_price)/100;
                           echo $pop->sell_price- $discount.' Taka';
                           echo "</p></ins><del><p class='product-price'>".$pop->sell_price." Taka</p></del></div>";
                        }else{
                            echo $pop->sell_price.' Taka </div>';
                        }
                    @endphp
                </div>
            </div>

            @endforeach


        </div>
    </div><!--End wrap-products-->
</div>
