/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import mitt from 'mitt';
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const emitter = mitt();
const app = createApp({});

window.noty = function(notification) {
    emitter.emit('notification', notification);
}

window.handleErrors = function(error) {
    if (error.response.status == 422) {
        window.noty({
            message: "You had validation errors. Please try again.",
            type: "danger",
        });
    }

    window.noty({
        message: "Something went wrong. Please refresh the page.",
        type: "danger",
    });
}

import VueNofy from './components/Noty.vue'
import LoginComponent from './components/LoginComponent.vue';
import LessonsComponent from './components/LessonsComponent.vue';
app.component('login-component', LoginComponent);
app.component('lessons-component', LessonsComponent);
app.component('vue-noty', VueNofy);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.config.globalProperties.emitter = emitter;
app.mount('#app');
