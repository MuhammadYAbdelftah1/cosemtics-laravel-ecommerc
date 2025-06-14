@php
    Theme::layout('full-width');
@endphp

<div class="container">
    <div style="margin: 40px 0;">
        <h4 style="color: #f00">You need to setup your homepage first!</h4>

        <p><strong>1. Go to Admin → Plugins then activate all plugins.</strong></p>
        <p><strong>2. Go to Admin → Pages and create a page:</strong></p>

        <div style="margin: 20px 0;">
            <div>- Content:</div>
            <div style="border: 1px solid rgba(0,0,0,.1); padding: 10px; margin-top: 10px;direction: ltr;">
                <div>[simple-slider key="slider-home-1" style="boxes" ads_1="IYHICPADQD5X"
                    ads_2="R4YAV9FECJUS"][/simple-slider]</div>
                <div>[product-brands title="Our Brands" brand_ids="1,2,3,4,5,6" limit="6"][/product-brands]</div>
                <div>[product-categories style="wooden" title="Top Categories" limit="6"][/product-categories]
                </div>
                <div>[products style="wooden" title="Popular Products" limit="10"][/products]</div>
                <div>[deal-product flash_sale_id="1"][/deal-product]</div>
                <div>[full-banner title="Transform Your Skin Today" subtitle="Premium Skincare Solutions"
                    background_image="banners/full-banner-bg.jpg" button_text="Shop Now" button_url="/products"
                    text_color="white"][/full-banner]</div>
                <div>[promo-banner title="Special Offer" subtitle="Limited Time"
                    description="Get 20% off on all skincare products." background_image="banners/promo-banner-bg.jpg"
                    button_text="Shop Sale" button_url="/products" style="left"][/promo-banner]</div>
                <div>[image-text title="Why Choose Bs-Derma?" subtitle="About Our Products"
                    description="Our scientifically formulated skincare products are designed to deliver visible results."
                    image="banners/about-skincare.jpg" button_text="Learn More" button_url="/about"
                    layout="image-left"][/image-text]</div>
                <div>[testimonials title="What Our Customers Say" subtitle="Testimonials"
                    background_color="light"][/testimonials]</div>
            </div>
            <br>
            <div>- Template: <strong>Full width</strong>.</div>
            <div>- Header style: <strong>Collapsed</strong>.</div>
        </div>

        <p><strong>3. Then go to Admin → Appearance → Theme options → Page to set your homepage.</strong></p>
    </div>

</div>
