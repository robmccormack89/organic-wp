// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// The following line makes it finally work:
window.UIkit = UIkit;

// wrap all jQuery functions
jQuery(function($){
  
  var xhr;
  
  // add to cart button triggers modal when item is added to cart
  $(document).on( 'added_to_cart', function( e, fragments, cart_hash, this_button ) {
    var modal = UIkit.modal("#modal-overflow");
    modal.show(); 
  });

  
});