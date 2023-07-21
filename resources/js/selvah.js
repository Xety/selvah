import './bootstrap';
import Dismiss from './libs/dismiss.js'
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import { French } from "flatpickr/dist/l10n/fr.js";
import { vsprintf } from "sprintf-js";

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import Notifications from "./Components/Notifications.vue";


const app = createApp({
    components: {
        Notifications
    }
});
app.mount("#selvah-vue");


// Set the datetime picker locale to french
flatpickr.localize(French);

//window.ApexCharts = ApexCharts;
window.Alpine = Alpine;
Alpine.start();

export default {
    Dismiss
}

 // Scroll to Top
let buttonBackToTop = document.getElementById('btn-back-to-top');
let drawer = document.getElementsByClassName('drawer-content')[0];
// When the user clicks on the button, scroll to the top of the document
buttonBackToTop.addEventListener('click', function() {
    drawer.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

 // When the user scrolls down 60px from the top of the document, show the button
 drawer.onscroll = function () {
    if (drawer.scrollTop > 60) {
        buttonBackToTop.style.display = 'block';
    } else {
        buttonBackToTop.style.display = 'none';
    }
};