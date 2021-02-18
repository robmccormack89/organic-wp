// require debounce & make available in window
window._ = require('debounce');

// import uikit & icons
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// use the Icon plugin
UIkit.use(Icons);

// Make uikit available in window for inline scripts
window.UIkit = UIkit;