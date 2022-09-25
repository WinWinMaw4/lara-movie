// import './bootstrap';
//
// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();

import * as bootstrap from 'bootstrap';
// import 'venobox';
import VenoBox from "venobox";

new VenoBox({
    selector: '.venobox',
    numeration: true,
    infinigall: true,
    share: true,
    spinner: 'rotating-plane',
    titleattr: 'data-title',
});
