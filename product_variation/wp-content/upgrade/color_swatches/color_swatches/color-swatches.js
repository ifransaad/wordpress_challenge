jQuery(document).ready(function ($) {
    // Handle color swatch click event
    $('.color-swatches .swatch').on('click', function () {
      var color = $(this).data('color');
  
      // Change the product image based on the selected color
      $('.woocommerce-product-gallery__image img').attr('src', color_image_map[color]);
    });
  
    // Define a mapping of color to image URLs
    var color_image_map = {
      'color-1': 'URL_TO_IMAGE_FOR_COLOR_1',
      'color-2': 'URL_TO_IMAGE_FOR_COLOR_2',
      // Add more color-image mappings as needed
    };
  });

  jQuery(document).ready(function ($) {
    // Handle color swatch click event
    $('.color-swatches .swatch').on('click', function () {
      var color = $(this).data('color');
  
      // Change the product image based on the selected color
      $('.woocommerce-product-gallery__image img').attr('src', color_image_map[color]);
    });
  
    // Handle size dropdown change event
    $('#size-dropdown').on('change', function () {
      var selectedSize = $(this).val();
  
      // Highlight the selected size
      $('.size-selection option').removeClass('selected');
      $('.size-selection option[value="' + selectedSize + '"]').addClass('selected');
    });
  
    // Define a mapping of color to image URLs
    var color_image_map = {
      'color-1': 'URL_TO_IMAGE_FOR_COLOR_1',
      'color-2': 'URL_TO_IMAGE_FOR_COLOR_2',
      // Add more color-image mappings as needed
    };
  });

  jQuery(document).ready(function ($) {
    // Handle color swatch click event
    $('.color-swatches .swatch').on('click', function () {
      var color = $(this).data('color');
  
      // Change the product image based on the selected color
      $('.woocommerce-product-gallery__image img').attr('src', color_image_map[color]);
  
      // Update the price based on the selected color and size
      updateProductPrice();
    });
  
    $('#size-dropdown').on('change', function () {
        // Validate and sanitize the selected size
        var selectedSize = validateSanitizeSize($(this).val());
    
        // Highlight the selected size
        $('.size-selection option').removeClass('selected');
        $('.size-selection option[value="' + selectedSize + '"]').addClass('selected');
    
        // Update the price based on the selected color and size
        updateProductPrice();
      });
  
    // Define a mapping of color to image URLs
    var color_image_map = {
      'color-1': 'URL_TO_IMAGE_FOR_COLOR_1',
      'color-2': 'URL_TO_IMAGE_FOR_COLOR_2',
      // Add more color-image mappings as needed
    };
  
    // Function to update the product price based on the selected color and size
    function updateProductPrice() {
      var selectedColor = $('.color-swatches .swatch.active').data('color');
      var selectedSize = $('#size-dropdown').val();
  
      // Get the variation price based on the selected color and size
      var variationPrice = $('.variation-price.color-' + selectedColor + '.size-' + selectedSize).text();
  
      // Update the displayed price on the page
      $('.woocommerce-Price-amount').text(variationPrice);
    }
  });

  jQuery(document).ready(function ($) {
    // Handle color swatch click event
    $('.color-swatches .swatch').on('click', function () {
      var color = $(this).data('color');
  
      // Change the product image based on the selected color
      $('.woocommerce-product-gallery__image img').attr('src', color_image_map[color]);
  
      // Update the price based on the selected color and size
      updateProductPrice();
    });
  
    // Handle size dropdown change event
    $('#size-dropdown').on('change', function () {
      // Highlight the selected size
      var selectedSize = $(this).val();
      $('.size-selection option').removeClass('selected');
      $('.size-selection option[value="' + selectedSize + '"]').addClass('selected');
  
      // Update the price based on the selected color and size
      updateProductPrice();
    });
  
    // Define a mapping of color to image URLs
    var color_image_map = {
      'color-1': 'URL_TO_IMAGE_FOR_COLOR_1',
      'color-2': 'URL_TO_IMAGE_FOR_COLOR_2',
      // Add more color-image mappings as needed
    };

    // Function to validate and sanitize the selected size
    function validateSanitizeSize(size) {
    // Define the allowed size values or patterns
    var allowedSizes = ['small', 'medium', 'large'];
  
    // Check if the given size is in the allowed list
    if (allowedSizes.includes(size)) {
      return size;
    }
  
    // If the size is not in the allowed list, use a default size
    return 'default-size';
  }
  
    // Function to update the product price based on the selected color and size
    function updateProductPrice() {
      var selectedColor = $('.color-swatches .swatch.active').data('color');
      var selectedSize = $('#size-dropdown').val();
  
      // Get the variation price based on the selected color and size
      var variationPrice = $('.variation-price.color-' + selectedColor + '.size-' + selectedSize).text();
  
      // Update the displayed price on the page
      $('.woocommerce-Price-amount').text(variationPrice);
    }
  
    // Close the color swatch and size dropdown when clicking outside
    $(document).on('click', function (e) {
      var container = $('.color-swatches, .size-selection');
  
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.color-swatches .swatch').removeClass('active');
        $('#size-dropdown').removeClass('active');
      }
    });
  
    // Toggle the color swatch and size dropdown on click
    $('.color-swatches .swatch').on('click', function () {
      $(this).toggleClass('active');
      $('#size-dropdown').removeClass('active');
    });
  
    $('#size-dropdown').on('click', function () {
      $(this).toggleClass('active');
      $('.color-swatches .swatch').removeClass('active');
    });
  });