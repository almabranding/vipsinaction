jQuery(document).ready(function($) {
  jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
  $('#banner').royalSlider({
    arrowsNav: true,
    arrowsNavAutoHide: false,
    keyboardNav:false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: 'bullets',
    imageScaleMode: 'none',
    imageAlignCenter:false,
    blockLoop: false,
    loop: false,
    allowCSS3: true, 
    autoHeight:true,
    numImagesToPreload: 6,
    transitionType: 'move',
    keyboardNavEnabled: true,
    block: {
      delay: 10
    }
    ,autoPlay: {
    		// autoplay options go gere
    		enabled: true,
    		pauseOnHover: true,
                delay:10000
    	}
  });
});