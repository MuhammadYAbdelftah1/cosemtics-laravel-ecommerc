/******/ (() => { // webpackBootstrap
/*!*******************************************************!*\
  !*** ./platform/themes/ninico/assets/js/ecommerce.js ***!
  \*******************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var Ecommerce = /*#__PURE__*/function () {
  function Ecommerce() {
    _classCallCheck(this, Ecommerce);
    _defineProperty(this, "$body", $(document.body));
    _defineProperty(this, "$productsFilter", this.$body.find('.bb-product-form-filter'));
  }
  return _createClass(Ecommerce, [{
    key: "init",
    value: function init() {
      var _this2 = this;
      this.$body.on('click', '.add-to-cart:not(.cart-form button[type=submit])', function (event) {
        _this2.addToCart(event);
      }).on('click', '.remove-cart-item', function (event) {
        _this2.removeFromCart(event);
      }).on('click', '.btn-apply-coupon-code', function (event) {
        _this2.applyCouponCode(event);
      }).on('click', '.btn-remove-coupon-code', function (event) {
        _this2.removeCouponCode(event);
      }).on('click', '.product-quantity span', function (event) {
        _this2.changeCartQuantity(event);
      }).on('keyup', '.product-quantity input', function (event) {
        _this2.onChangeQuantityInput(event);
      }).on('click', '.add-to-compare', function (event) {
        _this2.addToCompare(event);
      }).on('click', '.js-sale-popup-quick-view-button', function (event) {
        _this2.quickView(event);
      }).on('click', '.tpproduct .quickview', function (event) {
        _this2.quickView(event);
      }).on('click', '.tpproduct .button-quick-shop', function (event) {
        _this2.quickShop(event);
      }).on('click', '.remove-compare-item', function (event) {
        _this2.removeFromCompare(event);
      }).on('click', '.add-to-wishlist', function (event) {
        _this2.addToWishlist(event);
      }).on('click', '.remove-wishlist-item', function (event) {
        _this2.removeFromWishlist(event);
      }).on('click', '.product-area .basic-pagination ul li a', function (event) {
        _this2.handleProductsPagination(event);
      }).on('change', '.product-area .tp-shop-selector select[name="sort-by"]', function (event) {
        _this2.handleProductsSorting(event);
      }).on('change', '.product-area .tp-shop-selector select[name="per-page"]', function (event) {
        _this2.handleProductsPerPage(event);
      }).on('click', '.product-area .product-filter-nav button', function (event) {
        _this2.handleProductsLayout(event);
      }).on('change', '.bb-product-form-filter select, input', function (event) {
        if ($(event.currentTarget).closest('#quick-shop-popup').length) {
          return;
        }
        _this2.$body.find('.bb-product-form-filter').trigger('submit');
      }).on('click', '.product-filter-button', function () {
        _this2.$body.find('.product-filter-mobile').addClass('active');
      }).on('click', '.product-filter-mobile .backdrop, .close-product-filter-mobile', function () {
        _this2.$body.find('.product-filter-mobile').removeClass('active');
      }).on('click', 'form.cart-form button[type=submit]', function (event) {
        _this2.addProductToCart(event);
      }).on('click', '.tpproduct-details__reviewers', function () {
        _this2.$body.find('.tpproduct-details__nav #reviews-tab').trigger('click');
        var $navTab = $('.tpproduct-details__navtab');
        if ($navTab.length) {
          $('html, body').animate({
            scrollTop: $navTab.offset().top - 100
          });
        }
      }).on('click', '.product-sidebar__list .f-right', function (event) {
        event.preventDefault();
        $(event.currentTarget).closest('.category-filter').find('.product-sidebar__list').slideToggle();
      });
      this.priceFilter();
      this.productGallery($('.product-gallery'));
      this.quickSearchProducts();
      var _this = this;
      window.onBeforeChangeSwatches = function (data, $attrs) {
        var $product = $attrs.closest('.tpproduct-details__content');
        var $form = $product.find('.cart-form');
        $product.find('.error-message').hide();
        $product.find('.success-message').hide();
        $product.find('.number-items-available').html('').hide();
        var $submit = $form.find('button[type=submit]');
        if (data) {
          $submit.prop('disabled', true);
        }
      };
      window.onChangeSwatchesSuccess = function (response, $attrs) {
        var $product = $attrs.closest('.tpproduct-details__content');
        var $form = $product.find('.cart-form');
        var $footerCartForm = $('.footer-cart-form');
        if (!response) {
          return;
        }
        var $submit = $form.find('button[type=submit]');
        if (response.error) {
          $submit.prop('disabled', true);
          $product.find('.number-items-available').html("<span class='text-danger'>(".concat(response.message, ")</span>")).show();
          $form.find('.hidden-product-id').val('');
          $footerCartForm.find('.hidden-product-id').val('');
        } else {
          var data = response.data;
          var $price = $product.find('.tpproduct-details__price');
          var $salePrice = $price.find('.product-price-sale');
          var $originalPrice = $price.find('.product-price-original');
          if (data.sale_price !== data.price) {
            $originalPrice.removeClass('d-none');
          } else {
            $originalPrice.addClass('d-none');
          }
          $salePrice.text(data.display_sale_price);
          $originalPrice.text(data.display_price);
          if (data.sku) {
            $product.find('.meta-sku .meta-value').text(data.sku);
            $product.find('.meta-sku').removeClass('d-none');
          } else {
            $product.find('.meta-sku').addClass('d-none');
          }
          $form.find('.hidden-product-id').val(data.id);
          $footerCartForm.find('.hidden-product-id').val(data.id);
          $submit.prop('disabled', false);
          if (data.error_message) {
            $submit.prop('disabled', true);
            $product.find('.number-items-available').html("<span class='text-danger'>(".concat(data.error_message, ")</span>")).show();
          } else if (data.success_message) {
            $product.find('.number-items-available').html(response.data.stock_status_html).show();
          } else {
            $product.find('.number-items-available').html('').hide();
          }
          $product.find('.tpproduct-details__stock').html(data.stock_status_html);
          var unavailableAttributeIds = data.unavailable_attribute_ids || [];
          $product.find('.attribute-swatch-item').removeClass('disabled');
          $product.find('.product-filter-item option').prop('disabled', false);
          if (unavailableAttributeIds && unavailableAttributeIds.length) {
            unavailableAttributeIds.map(function (id) {
              var $item = $product.find(".attribute-swatch-item[data-id=\"".concat(id, "\"]"));
              if ($item.length) {
                $item.addClass('disabled');
                $item.find('input').prop('checked', false);
              } else {
                $item = $product.find(".product-filter-item option[data-id=\"".concat(id, "\"]"));
                if ($item.length) {
                  $item.prop('disabled', 'disabled').prop('selected', false);
                }
              }
            });
          }
          var $gallery = $product.closest('.product-area').find('.product-gallery');
          var imageHtml = '';
          data.image_with_sizes.origin.forEach(function (item) {
            imageHtml += "<a href='".concat(item, "'>\n                        <img title='").concat(data.name, "' title='").concat(data.name, "' src='").concat(siteConfig.img_placeholder ? siteConfig.img_placeholder : item, "' data-lazy='").concat(item, "'>\n                    </a>");
          });
          $gallery.find('.product-gallery__wrapper').slick('unslick').html(imageHtml);
          var thumbHtml = '';
          data.image_with_sizes.thumb.forEach(function (item) {
            thumbHtml += "<img alt='".concat(data.name, "' title='").concat(data.name, "' src='").concat(siteConfig.img_placeholder ? siteConfig.img_placeholder : item, "' data-src='").concat(item, "' data-lazy='").concat(item, "'>");
          });
          $gallery.find('.product-thumbnails').slick('unslick').html(thumbHtml);
          _this.productGallery($gallery);
          setTimeout(function () {
            var $productGalleryWrapper = $('.product-gallery__wrapper');
            if ($productGalleryWrapper.length && !$productGalleryWrapper.width()) {
              _this.productGallery($gallery);
            }
          }, 1500);
        }
      };
    }
  }, {
    key: "productGallery",
    value: function productGallery($gallery) {
      if (!$gallery.length) {
        return;
      }
      var first = $gallery.find('.product-gallery__wrapper');
      var thumbnails = $gallery.find('.product-thumbnails');
      if (first.length) {
        if (first.hasClass('slick-initialized')) {
          first.slick('unslick');
        }
        first.slick({
          rtl: Theme.isRtl(),
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          dots: false,
          arrows: false,
          lazyLoad: 'ondemand'
        });
      }
      if (thumbnails.length) {
        if (thumbnails.hasClass('slick-initialized')) {
          thumbnails.slick('unslick');
        }
        thumbnails.slick({
          rtl: Theme.isRtl(),
          slidesToShow: 6,
          slidesToScroll: 1,
          infinite: false,
          focusOnSelect: true,
          asNavFor: first,
          vertical: thumbnails.data('vertical') === 1,
          nextArrow: '<button class="slick-next slick-arrow"><i class="fas fa-chevron-down"></i></button>',
          prevArrow: '<button class="slick-prev slick-arrow"><i class="fas fa-chevron-up"></i></button>',
          responsive: [{
            breakpoint: 768,
            settings: {
              slidesToShow: 4,
              vertical: false
            }
          }, {
            breakpoint: 480,
            settings: {
              slidesToShow: 3,
              vertical: false
            }
          }]
        });
      }
      this.lightGallery($gallery);
    }
  }, {
    key: "quickSearchProducts",
    value: function quickSearchProducts() {
      var quickSearch = '.form--quick-search';
      var $quickSearch = $('.form--quick-search');
      $('body').on('click', function (e) {
        if (!$(e.target).closest(quickSearch).length) {
          $('.panel--search-result').removeClass('active');
        }
      });
      var currentRequest = null;
      $quickSearch.on('keyup', '.input-search-product', function () {
        var $form = $(this).closest('form');
        ajaxSearchProduct($form);
      });
      $quickSearch.on('change', '.product-category-select', function () {
        var $form = $(this).closest('form');
        ajaxSearchProduct($form);
      });
      $quickSearch.on('click', '.loadmore', function (e) {
        e.preventDefault();
        var $form = $(this).closest('form');
        $(this).addClass('loading');
        ajaxSearchProduct($form, $(this).attr('href'));
      });
      function ajaxSearchProduct($form) {
        var url = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
        var $panel = $form.find('.panel--search-result');
        var k = $form.find('.input-search-product').val();
        if (!k) {
          $panel.html('').removeClass('active');
          return;
        }
        $quickSearch.find('.input-search-product').val(k);
        var $button = $form.find('button[type=submit]');
        currentRequest = $.ajax({
          type: 'GET',
          url: url || $form.data('url'),
          dataType: 'json',
          data: url ? [] : $form.serialize(),
          beforeSend: function beforeSend() {
            $button.addClass('loading');
            if (currentRequest !== null) {
              currentRequest.abort();
            }
          },
          success: function success(_ref) {
            var error = _ref.error,
              data = _ref.data;
            if (!error) {
              if (url) {
                var $content = $("<div>".concat(data, "</div>"));
                $panel.find('.panel__content').find('.loadmore-container').remove();
                $panel.find('.panel__content').append($content.find('.panel__content p-3').contents());
              } else {
                $panel.html(data).addClass('active');
              }
              return;
            }
            $panel.html('').removeClass('active');
          },
          complete: function complete() {
            $button.removeClass('loading');
          }
        });
      }
    }
  }, {
    key: "addToCart",
    value: function addToCart(event) {
      var _this3 = this;
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'POST',
        data: {
          id: $currentTarget.data('id')
        },
        dataType: 'json',
        beforeSend: function beforeSend() {
          $currentTarget.addClass('loading');
        },
        success: function success(_ref2) {
          var error = _ref2.error,
            message = _ref2.message;
          if (error) {
            Theme.showError(message);
            return;
          }
          _this3.loadAjaxCart();
          _this3.$body.find('.tp-cart-toggle').trigger('click');
        },
        error: function error(_error) {
          return Theme.handleError(_error);
        },
        complete: function complete() {
          $currentTarget.removeClass('loading');
        }
      });
    }
  }, {
    key: "addProductToCart",
    value: function addProductToCart(event) {
      var _this4 = this;
      event.preventDefault();
      var $button = $(event.currentTarget);
      var $form = $button.closest('form.cart-form');
      var data = $form.serializeArray();
      data.push({
        name: 'checkout',
        value: $button.prop('name') === 'checkout' ? 1 : 0
      });
      $.ajax({
        type: 'POST',
        url: $form.prop('action'),
        data: $.param(data),
        beforeSend: function beforeSend() {
          $button.addClass('button-loading');
        },
        success: function success(_ref3) {
          var error = _ref3.error,
            message = _ref3.message,
            data = _ref3.data;
          if (error) {
            Theme.showError(message);
            if ((data === null || data === void 0 ? void 0 : data.next_url) !== undefined) {
              setTimeout(function () {
                window.location.href = data.next_url;
              }, 500);
            }
            return;
          }
          if ((data === null || data === void 0 ? void 0 : data.next_url) !== undefined) {
            window.location.href = data.next_url;
            return;
          }
          _this4.$body.find('.tp-cart-toggle').trigger('click');
          _this4.loadAjaxCart();
        },
        error: function error(_error2) {
          Theme.handleError(_error2);
        },
        complete: function complete() {
          $button.removeClass('button-loading');
        }
      });
    }
  }, {
    key: "addToCompare",
    value: function addToCompare(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'POST',
        beforeSend: function beforeSend() {
          $currentTarget.addClass('loading');
        },
        success: function success(response) {
          var error = response.error,
            data = response.data,
            message = response.message;
          if (error) {
            Theme.showError(message);
          } else {
            Theme.showSuccess(message);
            $('.header-cart .tp-product-compare-count').text(data.count);
          }
        },
        error: function error(_error3) {
          Theme.handleError(_error3);
        },
        complete: function complete() {
          $currentTarget.removeClass('loading');
        }
      });
    }
  }, {
    key: "removeFromCompare",
    value: function removeFromCompare(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'POST',
        data: {
          _method: 'DELETE'
        },
        success: function success(response) {
          var error = response.error,
            data = response.data,
            message = response.message;
          if (error) {
            Theme.showError(message);
          } else {
            Theme.showSuccess(message);
            $('.header-cart .tp-product-compare-count').text(data.count);
            $('.compare-area').load(window.location.href + ' .compare-area > *');
          }
        },
        error: function error(_error4) {
          Theme.handleError(_error4);
        }
      });
    }
  }, {
    key: "removeFromCart",
    value: function removeFromCart(event) {
      var _this5 = this;
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'GET',
        beforeSend: function beforeSend() {
          $currentTarget.addClass('loading');
        },
        success: function success(response) {
          var _window$siteConfig;
          if (response.error) {
            Theme.showError(response.message);
            return;
          }
          var $cartArea = $('.cart-area');
          if ($cartArea.length && (_window$siteConfig = window.siteConfig) !== null && _window$siteConfig !== void 0 && _window$siteConfig.cartUrl) {
            $cartArea.load(window.siteConfig.cartUrl + ' .cart-area > *');
          }
          _this5.loadAjaxCart();
        },
        error: function error(res) {
          Theme.showError(res.message);
        },
        complete: function complete() {
          $currentTarget.removeClass('loading');
        }
      });
    }
  }, {
    key: "addToWishlist",
    value: function addToWishlist(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'POST',
        beforeSend: function beforeSend() {
          $currentTarget.addClass('loading');
        },
        success: function success(response) {
          var error = response.error,
            message = response.message,
            data = response.data;
          if (error) {
            Theme.showError(message);
          } else {
            Theme.showSuccess(message);
            $('.header-cart .tp-product-wishlist-count').text(data.count);
            if (data.added) {
              $currentTarget.find('i').removeClass('fal').addClass('fas');
            } else {
              $currentTarget.find('i').removeClass('fas').addClass('fal');
            }
          }
        },
        error: function error(_error5) {
          Theme.handleError(_error5);
        },
        complete: function complete() {
          $currentTarget.removeClass('loading');
        }
      });
    }
  }, {
    key: "removeFromWishlist",
    value: function removeFromWishlist(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      $.ajax({
        url: $currentTarget.data('url'),
        method: 'POST',
        data: {
          _method: 'DELETE'
        },
        success: function success(response) {
          if (response.error) {
            Theme.showError(response.message);
          } else {
            Theme.showSuccess(response.message);
            $('.header-cart .tp-product-wishlist-count').text(response.data.count);
            $('.wishlist-area').load(window.location.href + ' .wishlist-area > *');
          }
        },
        error: function error(_error6) {
          Theme.handleError(_error6);
        }
      });
    }
  }, {
    key: "loadAjaxCart",
    value: function loadAjaxCart() {
      var _window$siteConfig2,
        _this6 = this;
      if ((_window$siteConfig2 = window.siteConfig) !== null && _window$siteConfig2 !== void 0 && _window$siteConfig2.ajaxCart) {
        $.ajax({
          url: window.siteConfig.ajaxCart,
          method: 'GET',
          success: function success(response) {
            var data = response.data,
              error = response.error;
            if (!error) {
              _this6.$body.find('.tpcartinfo .tpcart__product').html(data.html);
              _this6.$body.find('.header-cart .tp-product-count').text(data.count);
            }
          }
        });
      }
    }
  }, {
    key: "applyCouponCode",
    value: function applyCouponCode(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      var couponCode = $currentTarget.closest('.coupon').find('#coupon_code').val();
      $.ajax({
        url: $currentTarget.data('url'),
        type: 'POST',
        data: {
          coupon_code: couponCode
        },
        beforeSend: function beforeSend() {
          $currentTarget.prop('disabled', true).addClass('button-loading');
        },
        success: function success(response) {
          if (!response.error) {
            $('.cart-area').load(window.location.href + '?applied_coupon=1 .cart-area > *', function () {
              $currentTarget.prop('disabled', false).removeClass('button-loading');
              Theme.showSuccess(response.message);
            });
          } else {
            Theme.showError(response.message);
          }
        },
        error: function error(_error7) {
          Theme.handleError(_error7);
        },
        complete: function complete(response) {
          var _response$responseJSO;
          if (!(response.status === 200 && !(response !== null && response !== void 0 && (_response$responseJSO = response.responseJSON) !== null && _response$responseJSO !== void 0 && _response$responseJSO.error))) {
            $currentTarget.prop('disabled', false).removeClass('button-loading');
          }
        }
      });
    }
  }, {
    key: "removeCouponCode",
    value: function removeCouponCode(event) {
      event.preventDefault();
      var $currentTarget = $(event.currentTarget);
      var buttonText = $currentTarget.text();
      $currentTarget.text($currentTarget.data('loading-text'));
      $.ajax({
        url: $currentTarget.data('url'),
        type: 'POST',
        success: function success(response) {
          if (!response.error) {
            $('.cart-area').load(window.location.href + ' .cart-area > *', function () {
              $currentTarget.text(buttonText);
            });
          } else {
            Theme.showError(response.message);
          }
        },
        error: function error(_error8) {
          Theme.handleError(_error8);
        },
        complete: function complete(response) {
          var _response$responseJSO2;
          if (!(response.status === 200 && !(response !== null && response !== void 0 && (_response$responseJSO2 = response.responseJSON) !== null && _response$responseJSO2 !== void 0 && _response$responseJSO2.error))) {
            $currentTarget.text(buttonText);
          }
        }
      });
    }
  }, {
    key: "changeCartQuantity",
    value: function changeCartQuantity(event) {
      var $target = $(event.target);
      var $quantity = $target.parent().find('input');
      var step = parseInt($quantity.attr('step'), 10);
      var min = parseInt($quantity.attr('min'), 10);
      var max = parseInt($quantity.attr('max'), 10);
      var current = parseInt($quantity.val(), 10);
      if ($target.hasClass('cart-minus') && current > min) {
        $quantity.val(current - step);
        $quantity.trigger('change');
      }
      if ($target.hasClass('cart-plus') && current < max) {
        $quantity.val(current + step);
        $quantity.trigger('change');
      }
      this.updateCart(event);
    }
  }, {
    key: "onChangeQuantityInput",
    value: function onChangeQuantityInput(event) {
      var $target = $(event.target);
      var min = parseInt($target.attr('min'), 10);
      var max = parseInt($target.attr('max'), 10);
      var current = parseInt($target.val(), 10);
      if (current < min) {
        $target.val(min);
      }
      if (current > max) {
        $target.val(max);
      }
      this.updateCart(event);
    }
  }, {
    key: "updateCart",
    value: function updateCart(event) {
      var _this7 = this;
      event.preventDefault();
      var $form = this.$body.find('.cart-form');
      if (!$form.length) {
        return;
      }
      $.ajax({
        type: 'POST',
        cache: false,
        url: $form.prop('action'),
        data: new FormData($form[0]),
        contentType: false,
        processData: false,
        success: function success(response) {
          var error = response.error,
            message = response.message;
          if (error) {
            Theme.showError(message);
          } else {
            $('.cart-area').load(window.siteConfig.cartUrl + ' .cart-area > *');
            _this7.loadAjaxCart();
            Theme.showSuccess(message);
          }
        },
        error: function error(_error9) {
          Theme.handleError(_error9);
        }
      });
    }
  }, {
    key: "handleProductsPagination",
    value: function handleProductsPagination(event) {
      event.preventDefault();
      var url = new URL($(event.currentTarget).attr('href'));
      var page = url.searchParams.get('page');
      this.$body.find('.bb-product-form-filter').find('input[name="page"]').val(page).trigger('change');
    }
  }, {
    key: "handleProductsSorting",
    value: function handleProductsSorting(event) {
      var $currentTarget = $(event.currentTarget);
      this.$body.find('.bb-product-form-filter').find('input[name="sort-by"]').val($currentTarget.val()).trigger('change');
    }
  }, {
    key: "handleProductsPerPage",
    value: function handleProductsPerPage(event) {
      var $currentTarget = $(event.currentTarget);
      this.$body.find('.bb-product-form-filter').find('input[name="per-page"]').val($currentTarget.val()).trigger('change');
    }
  }, {
    key: "handleProductsLayout",
    value: function handleProductsLayout(event) {
      var $currentTarget = $(event.currentTarget);
      $currentTarget.addClass('active');
      $currentTarget.siblings().removeClass('active');
      this.$body.find('.bb-product-form-filter').find('input[name="layout"]').val($currentTarget.data('type')).trigger('change');
    }
  }, {
    key: "priceFilter",
    value: function priceFilter() {
      var $sliderRange = $(document).find('#slider-range');
      if ($sliderRange.length) {
        var min = $sliderRange.data('min');
        var max = $sliderRange.data('max');
        var $priceFilter = $(document).find('.price-filter');
        $sliderRange.slider({
          range: true,
          min: min,
          max: max,
          values: [$priceFilter.find('input[name="min_price"]').val(), $priceFilter.find('input[name="max_price"]').val()],
          slide: function slide(event, ui) {
            $priceFilter.find('#amount').text("".concat(ui.values[0].format_price(), " - ").concat(ui.values[1].format_price()));
          },
          change: function change(event, ui) {
            $priceFilter.find('input[name="min_price"]').val(ui.values[0]);
            $priceFilter.find('input[name="max_price"]').val(ui.values[1]).trigger('change');
          }
        });
        $priceFilter.find('#amount').text("".concat($sliderRange.slider('values', 0).format_price(), " - ").concat($sliderRange.slider('values', 1).format_price()));
      }
    }

    /**
     @param {jQuery} element
     */
  }, {
    key: "lightGallery",
    value: function lightGallery(element) {
      if (element.data('lightGallery')) {
        element.data('lightGallery').destroy(true);
      }
      element.lightGallery({
        selector: 'a',
        thumbnail: true,
        share: false,
        fullScreen: false,
        autoplay: false,
        autoplayControls: false,
        actualSize: false
      });
    }
  }, {
    key: "quickView",
    value: function quickView(event) {
      event.preventDefault();
      var $this = $(event.currentTarget);
      $.ajax({
        url: $this.data('url'),
        type: 'GET',
        beforeSend: function beforeSend() {
          $this.addClass('loading');
        },
        success: function success(_ref4) {
          var data = _ref4.data;
          $('#quick-view-popup').html(data);
          $.magnificPopup.open({
            items: {
              src: '#quick-view-popup'
            },
            type: 'inline'
          });
          $('.thumbnails .images').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            adaptiveHeight: false,
            rtl: Theme.isRtl()
          });
        },
        error: function error(_error10) {
          Theme.handleError(_error10);
        },
        complete: function complete() {
          $this.removeClass('loading');
        }
      });
    }
  }, {
    key: "quickShop",
    value: function quickShop(event) {
      event.preventDefault();
      var $this = $(event.currentTarget);
      $.ajax({
        url: $this.data('url'),
        type: 'GET',
        beforeSend: function beforeSend() {
          $this.addClass('loading');
        },
        success: function success(_ref5) {
          var data = _ref5.data;
          $('#quick-shop-popup').html(data);
          $.magnificPopup.open({
            items: {
              src: '#quick-shop-popup'
            },
            type: 'inline'
          });
        },
        error: function error(_error11) {
          Theme.handleError(_error11);
        },
        complete: function complete() {
          $this.removeClass('loading');
        }
      });
    }
  }]);
}();
$(function () {
  var AppEcommerce = new Ecommerce();
  AppEcommerce.init();
  setTimeout(function () {
    var $productGalleryWrapper = $('.product-gallery__wrapper');
    if ($productGalleryWrapper.length && !$productGalleryWrapper.width()) {
      AppEcommerce.productGallery($('.product-gallery'));
    }
  }, 1500);
  $.each($('.product-sidebar__list .category-filter input[type="checkbox"]:checked'), function () {
    $(this).closest('.product-sidebar__list').show();
  });
  var $productListing = $(document).find('.product-sidebar__product-item');
  document.addEventListener('ecommerce.product-filter.before', function () {
    $productListing.find('.loading-spinner').removeClass('d-none');
  });
  document.addEventListener('ecommerce.product-filter.success', function (event) {
    $('.product-filter-content .product-item-count span').html(event.detail.data.message);
    $productListing.find('.loading-spinner').addClass('d-none');
  });
  $(document).on('click', '[data-bb-toggle="scroll-to-review"]', function (e) {
    e.preventDefault();
    scrollToReviewTab();
  });
  function scrollToReviewTab() {
    if ($('.nav-tabs button#reviews-tab').length) {
      var $tab = $('.nav-tabs button#reviews-tab');
      var $container = $('.product-review-container');
      if ($tab.length && $container.length) {
        $tab.tab('show');
        $('html, body').animate({
          scrollTop: $container.offset().top - 120
        });
      }
    }
  }
  if (window.location.href.indexOf('#reviews') !== -1) {
    scrollToReviewTab();
  }

  /**
   * Mobile Search Results Fix
   * Ensures search results appear properly in mobile sidebar
   */
  var $mobileSearchBar = $('.mobile-search-bar');
  var $mobileSearchInput = $('.mobile-search-input');

  // Debug function to check if elements exist
  function debugMobileSearch() {
    console.log('Mobile search bar found:', $mobileSearchBar.length);
    console.log('Mobile search input found:', $mobileSearchInput.length);
    console.log('Form found:', $mobileSearchBar.find('form').length);
    console.log('Panel found:', $mobileSearchBar.find('.panel--search-result').length);
  }

  // Call debug function
  debugMobileSearch();

  // Enhanced search functionality for mobile
  $(document).on('keyup', '.mobile-search-input', function () {
    var $form = $(this).closest('form');
    var $panel = $form.find('.panel--search-result');
    var searchValue = $(this).val();
    console.log('Mobile search keyup triggered, value:', searchValue);
    console.log('Panel element:', $panel.length);
    if (searchValue.length > 0) {
      // Force show the panel with important
      $panel.css('display', 'block').addClass('active');
      console.log('Panel should be visible now');
    } else {
      $panel.removeClass('active').css('display', 'none');
    }
  });

  // Use MutationObserver to watch for panel changes
  if (window.MutationObserver && $mobileSearchBar.length) {
    var observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.type === 'childList' || mutation.type === 'attributes') {
          var $target = $(mutation.target);
          if ($target.hasClass('panel--search-result')) {
            console.log('Panel mutation detected:', $target.hasClass('active'));
            if ($target.hasClass('active')) {
              $target.css('display', 'block !important');
            }
          }
        }
      });
    });
    $mobileSearchBar.find('.panel--search-result').each(function () {
      observer.observe(this, {
        attributes: true,
        childList: true,
        subtree: true,
        attributeFilter: ['class']
      });
    });
  }

  // Hide results when clicking on a result
  $(document).on('click', '.mobile-search-bar .panel--search-result a', function () {
    $('.mobile-search-bar .panel--search-result').removeClass('active').css('display', 'none');
  });

  // Enhanced blur handling with delay
  $mobileSearchInput.on('blur', function () {
    setTimeout(function () {
      if (!$('.mobile-search-bar .panel--search-result:hover').length) {
        $('.mobile-search-bar .panel--search-result').removeClass('active').css('display', 'none');
      }
    }, 200);
  });
});
/******/ })()
;