/******/ (() => { // webpackBootstrap
/*!***************************************************************!*\
  !*** ./platform/plugins/ecommerce/resources/js/flash-sale.js ***!
  \***************************************************************/
$(function () {
  $(document).on('click', '.list-search-data .selectable-item', function (event) {
    event.preventDefault();
    var _self = $(event.currentTarget);
    var $input = _self.closest('.box-search-advance').find('input[type=hidden]');
    var existedValues = [];
    $.each($input.val().split(','), function (index, el) {
      if (el && el !== '') {
        existedValues[index] = parseInt(el);
      }
    });
    if ($.inArray(_self.data('id'), existedValues) < 0) {
      if ($input.val()) {
        $input.val("".concat($input.val(), ",").concat(_self.data('id')));
      } else {
        $input.val(_self.data('id'));
      }
      var template = $(document).find('#selected_product_list_template').html();
      var productItem = template.replace(/__name__/gi, _self.data('name')).replace(/__id__/gi, _self.data('id')).replace(/__index__/gi, existedValues.length).replace(/__url__/gi, _self.data('url')).replace(/__image__/gi, _self.data('image')).replace(/__price__/gi, _self.data('price')).replace(/__attributes__/gi, _self.find('a span').text());
      _self.closest('.box-search-advance').find('.list-selected-products').show();
      _self.closest('.box-search-advance').find('.list-selected-products').append(productItem);
    }
    _self.closest('.card').hide();
  });
  $(document).on('click', '[data-bb-toggle="product-search-advanced"]', function (event) {
    var _self = $(event.currentTarget);
    var $formBody = _self.closest('.box-search-advance').find('.card');
    $formBody.show();
    $formBody.addClass('active');
    if ($formBody.find('.card-body').length === 0) {
      Botble.showLoading($formBody);
      $.ajax({
        url: _self.data('bb-target'),
        type: 'GET',
        success: function success(res) {
          if (res.error) {
            Botble.showError(res.message);
          } else {
            $formBody.html(res.data);
          }
        },
        error: function error(data) {
          Botble.handleError(data);
        },
        complete: function complete() {
          Botble.hideLoading($formBody);
        }
      });
    }
  });
  $(document).on('keyup', '[data-bb-toggle="product-search-advanced"]', function (event) {
    var _self = $(event.currentTarget);
    var $formBody = _self.closest('.box-search-advance').find('.card');
    setTimeout(function () {
      Botble.hideLoading($formBody);
      $.ajax({
        url: "".concat(_self.data('bb-target'), "?keyword=").concat(_self.val()),
        type: 'GET',
        success: function success(res) {
          if (res.error) {
            Botble.showError(res.message);
          } else {
            $formBody.html(res.data);
          }
        },
        error: function error(data) {
          Botble.handleError(data);
        },
        complete: function complete() {
          Botble.hideLoading($formBody);
        }
      });
    }, 500);
  });
  $(document).on('click', '.box-search-advance .page-link', function (event) {
    event.preventDefault();
    var $searchBox = $(event.currentTarget).closest('.box-search-advance').find('[data-bb-toggle="product-search-advanced"]');
    if (!$searchBox.closest('.page-item').hasClass('disabled') && $searchBox.data('bb-target')) {
      var $formBody = $searchBox.closest('.box-search-advance').find('.card');
      Botble.showLoading($formBody);
      $.ajax({
        url: "".concat($(event.currentTarget).prop('href'), "&keyword=").concat($searchBox.val()),
        type: 'GET',
        success: function success(res) {
          if (res.error) {
            Botble.showError(res.message);
          } else {
            $formBody.html(res.data);
          }
        },
        error: function error(data) {
          Botble.handleError(data);
        },
        complete: function complete() {
          Botble.hideLoading($formBody);
        }
      });
    }
  });
  $(document).on('click', 'body', function (e) {
    var container = $('.box-search-advance');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.find('.card').hide();
    }
  });
  $(document).on('click', '[data-bb-toggle="product-delete-item"]', function (event) {
    event.preventDefault();
    var $input = $(event.currentTarget).closest('.box-search-advance').find('input[type=hidden]');
    var existedValues = $input.val().split(',');
    $.each(existedValues, function (index, el) {
      el = el.trim();
      if (!_.isEmpty(el)) {
        existedValues[index] = parseInt(el);
      }
    });
    var index = existedValues.indexOf($(event.currentTarget).data('bb-target'));
    if (index > -1) {
      delete existedValues[index];
    }
    $input.val(existedValues.join(','));
    if ($(event.currentTarget).closest('.list-group').find('.list-group-item').length < 2) {
      $(event.currentTarget).closest('.list-selected-products').hide();
    }
    $(event.currentTarget).closest('.list-group').find(".list-group-item[data-product-id=".concat($(event.currentTarget).data('bb-target'), "]")).remove();
  });
});
/******/ })()
;