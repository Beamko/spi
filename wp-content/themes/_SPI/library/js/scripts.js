/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  $(document).foundation();

  var spi = {},
      stickyNavLoaded = false;

  spi.init = function () {
    spi.setUpIsotope();
    spi.stickyNav();
    spi.mobileMenus();
    spi.scrollToSection();
    spi.filterEvents();
    spi.newsletterSignup();
    spi.searchSite();

    $(window).on("resize", spi.stickyNav);
  }

  spi.setUpIsotope = function () {
    $container = $('.js-isotope');

    $container.isotope({
      // options
      itemSelector: '.item',
      layoutMode: 'fitRows',
    });

    // layout Isotope again after all images have loaded
    $container.imagesLoaded( function() {
      $container.isotope('layout');
    });
  }

  spi.stickyNav = function () {

    var useStickyNav = ($('html').hasClass('touch') && $(window).width >=768) || Modernizr.mq('only all and (max-width: 768px)') ? false : true;

    if (useStickyNav && !stickyNavLoaded) {
      $('#subnav').sticky({ topSpacing: 64, getWidthFrom: '.article-header', responsiveWidth: true, className: 'subnav-sticky' });
      stickyNavLoaded = true;
    } else if (!useStickyNav && stickyNavLoaded) {
      $('#subnav').unstick();
      stickyNavLoaded = false;
    }
  }

  spi.mobileMenus = function () {
    $('.js-open-mobile-menu').click(function (e) {
      e.preventDefault();
      //_gaq.push(['_trackEvent', 'mobile-nav', 'toggle']);
      $('.js-mobile-menu').slideToggle('fast');
    });

    $('.js-mobile-menu a').click(function (e) {
      $('.js-mobile-menu').slideToggle('fast');
    });
  }

  spi.scrollToSection = function () {
    $('.js-subnav-link').on('click', function (e) {
      e.preventDefault();
      var section = $(e.target).attr('href')
      var offset = 143; //Offset of 20px

      $('html, body').animate({
          scrollTop: $(section).offset().top - offset
      }, 350);
    });
  }

  spi.filterEvents = function () {
    $('.js-filter-all').on('click', function (e) {
      e.preventDefault();

      $container.isotope({ filter: '.js-event-item' });
    });

    $('.js-filter-upcoming').on('click', function (e) {
      e.preventDefault();

      $container.isotope({ filter: '.js-upcoming' });

    });

    $('.js-filter-past').on('click', function (e) {
      e.preventDefault();

      $container.isotope({ filter: '.js-past' });

    });

    $('.js-filter-ongoing').on('click', function (e) {
      e.preventDefault();

      $container.isotope({ filter: '.js-ongoing' });

    });
  }

  spi.newsletterSignup = function () {
    $('.js-open-newsletter-modal').click(function (e) {
      e.preventDefault();
      // _gaq.push(['_trackEvent', 'footer', 'open-newsletter-sign-up']);

      $('.js-newsletter-form').slideToggle('fast');

    });

    $('.js-submit-newsletter').on('click', function (e) {
      e.preventDefault();
      // _gaq.push(['_trackEvent', 'footer', 'newsletter-sign-up']);

      var form = $('#mc-embedded-subscribe-form');
      var formEmail = form.find('#mce-EMAIL');
      var emailVal = formEmail.val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      formEmail.removeClass('invalid');
      form.find('.error').remove();

      if (emailVal == '') {
        formEmail.addClass('invalid');
        formEmail.focus();
        formEmail.after("<div class='error error-message'>Please enter your email.</div>");
      } else if (!regex.test(emailVal)) {
        formEmail.addClass('invalid');
        formEmail.focus();
        formEmail.after("<div class='error error-message'>Please enter a valid email address.</div>");
      } else {
        form.submit();
      }
    });

    $('.js-newsletter-form a').click(function (e) {
      $('.js-newsletter-form').slideToggle('fast');
    });
  }

  spi.searchSite = function () {
    $('.js-open-search').click(function (e) {
      e.preventDefault();
      //_gaq.push(['_trackEvent', 'mobile-nav', 'toggle']);

      $('.js-search-modal').slideToggle('fast');
    });

    $('.js-search-modal a').click(function (e) {
      $('.js-search-modal').slideToggle('fast');
    });
  }

  $(function () { spi.init(); });

}); /* end of as page load scripts */
