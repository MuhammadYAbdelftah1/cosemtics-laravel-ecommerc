<link rel="stylesheet" href="{{ asset('vendor/core/plugins/sale-popup/css/sale-popup.css') }}?v=1.2.1">

<div class="sale-popup-section">
    <div class="sale-popup-container-wrap sales_animated hidden oh des_1 slpr_mb_ slpr_has_btns"
        data-stt='{
            "classDown":{
                "swing":"bounceOutDown",
                "shake":"bounceOutDown",
                "wobble":"bounceOutDown",
                "jello":"bounceOutDown",
                "slideInUp":"slideOutDown",
                "slideInLeft":"slideOutLeft",
                "fadeIn":"fadeOut",
                "fadeInLeft":"fadeOutLeft",
                "bounceInUp":"bounceOutDown",
                "bounceInLeft":"bounceOutLeft",
                "rotateInDownLeft":"rotateOutDownLeft",
                "rotateInUpLeft":"rotateOutDownLeft",
                "flipInX":"flipOutX",
                "zoomIn":"zoomOut",
                "rollIn":"rollOut"
            },
            "limit": {{ $salePopupHelper->getSetting('limit_products', 20) }},
            "pp_type": "2",
            "url": {!! json_encode($urls) !!},
            "id": {!! json_encode($products->pluck('id')->all()) !!},
            "image": {!! json_encode($images) !!},
            "starTime": 5,
            "starTime_unit": 1000,
            "stayTime": 10,
            "stayTimeUnit": 1000,
            "classUp": "slideInUp"
        }'>
        <div class="sale-popup-container">
            <div class="sale-popup-thumb">
                <a class="js-sale-popup-a" href="/">
                    <img class="js-sale-popup-img" src="/" srcset="/" alt="sales popup" loading="lazy">
                </a>
            </div>
            <div class="sale-popup-info">
                <span class="sale-popup-location">
                    <span class="js-sale-popup-location"></span>
                    {{ $salePopupHelper->getSetting('purchased_text', 'purchased') }}
                </span>
                <a class="js-sale-popup-a sale-popup-title js-sale-popup-tt" href="/"></a>
                <div class="sale-popup-ago">
                    @if ($salePopupHelper->getSetting('show_time_ago_suggest', 1))
                        <span class="sale-popup-time js-sale-popup-ago"></span>
                    @endif
                    @if ($salePopupHelper->getSetting('show_verified', 1))
                        <span class="sale-popup-verify">
                            <x-core::icon name="ti ti-circle-check" :wrapper="false" />
                            {{ $salePopupHelper->getSetting('verified_text', 'Verified') }}
                        </span>
                    @endif
                </div>
            </div>
            @if ($salePopupHelper->getSetting('show_close_button', 1))
                <a class="sale-popup-close pa" href="#" rel="nofollow" title="close">
                    <x-core::icon name="ti ti-x" :wrapper="false" />
                </a>
            @endif
            @if ($salePopupHelper->getSetting('show_quick_view_button', 1))
                <a class="js-sale-popup-a js-sale-popup-quick-view-button sale-popup-quick-view pa op__0" data-url=""
                    data-base-url="{{ url('') }}" href="#" rel="nofollow"
                    title="{{ $salePopupTitle = $salePopupHelper->getSetting('quick_view_text', __('Quick view')) }}">
                    <span title="{{ $salePopupTitle }}">
                        <x-core::icon name="ti ti-eye" :wrapper="false" />
                    </span>
                </a>
            @endif
        </div>
    </div>
    <script type="application/json" id="title-sale-popup">
        {!! json_encode($products->pluck('name')->all()) !!}
    </script>
    <script type="application/json" id="location-sale-popup">
        {!! json_encode(array_map('trim', explode('|', $salePopupHelper->getSetting('list_users_purchased', 'Ahmed Hassan (Cairo) | Fatima Ali (Alexandria) | Mohamed Mahmoud (Giza) | Nour Youssef (Sharm El Sheikh) | Omar Khaled (Luxor) | Mona Abdel Rahman (Aswan) | Amr Mostafa (Hurghada) | Yasmin Ibrahim (Mansoura) | Karim Farouk (Tanta) | Dina Samir (Zagazig) | Mahmoud Nasser (Ismailia) | Aya Mohamed (Port Said) | Hassan Gamal (Suez) | Mariam Adel (Damanhur) | Tarek Salah (Beni Suef) | Heba Fouad (Minya) | Sherif Magdy (Assiut) | Noha Essam (Sohag) | Waleed Ashraf (Qena) | Rana Hosny (Marsa Alam)')))) !!}
    </script>
    <script type="application/json" id="time-sale-popup">
        {!! json_encode(array_map('trim', explode('|', $salePopupHelper->getSetting('list_sale_time', '4 hours ago | 2 hours ago | 45 minutes ago | 1 day ago | 8 hours ago | 10 hours ago | 25 minutes ago | 2 day ago | 5 hours ago | 40 minutes ago')))) !!}
    </script>
</div>
