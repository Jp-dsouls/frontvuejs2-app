require('./bootstrap');

window.Vue = require('vue').default;

import AOS from 'aos';
import 'aos/dist/aos.css';
import Vue from 'vue';
AOS.init();

//import GoogleMapsLoader from "google-maps";


window.axios = require('axios');
const metas = document.getElementsByTagName('meta');
for (let i = 0; i < metas.length; i++) {
    if (metas[i].getAttribute('name') === "csrf-token") {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = metas[i].getAttribute('content');
    }
}

// FILTROS
//filters
Vue.filter('acorcad', function (text) {
    if (text.length > 15)
        return text.slice(0, 15) + "..."
    else return text
});

Vue.filter('status', function (text) {
    return (text) ? "Activo" : "Inactivo"
});

Vue.filter('factmy', function (text) {
    return (text) ? "Si" : "No"
});

Vue.filter('esvacio', function (text) {
    return (text) ? text : "----"
});

Vue.filter('statusUser', function (text) {
    switch (text) {
        case -1: return "Eliminado";
        case 0: return "Suspendido";
        case 1: return "Activo";
    }
});

Vue.filter('statusArqueo', function (text) {
    switch (text) {
        case 1: return "Por Depositar";
        case 2: return "Depositado";
    }
});

Vue.filter('statusTurno', function (text) {
    switch (text) {
        case 1: return "Abierto";
        case 2: return "Cerrado";
        case 3: return "Suspendido";
        case 4: return "En Revisión";
        case 5: return "Verificado";
    }
});

Vue.filter('statusFactura', function (text) {
    switch (text) {
        case 0: return "Creado";
        case 1: return "Impreso";
        case 2: return "Anulado";
        case 3: return "Devolucion Parcial";
        case 4: return "Devolucion Total";
    }
});

Vue.filter('tipoPago', function (text) {
    if (text == 0) {
        return "Todos";
    }
    else {
        return (text == 1) ? "Tarjeta de Debito" : "Tarjeta de Credito";
    }
});

Vue.filter('tipoUser', function (text) {
    let tipo = "Sin Tipo";

    switch (text) {
        case 0: tipo = "Administrador"; break;
        case 1: tipo = "Autorizado"; break;
        case 2: tipo = "Limitado"; break;
        case 3: tipo = "User"; break;
    }

    return tipo;
});

Vue.filter('upText', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('mayus', function (text) {
    return text.toUpperCase();
});

Vue.filter('myTime', function (created) {
    //return moment(created, 'YYYY-MM-DD').format(format);//moment(created).format('MMMM Do YYYY');
    if (created == null) return "*";
    return moment(created).format('hh:mm a');
});

Vue.filter('myDate', function (created) {
    //return moment(created, 'YYYY-MM-DD').format(format);//moment(created).format('MMMM Do YYYY');
    return moment(created).format('DD/MM/YYYY');
});

Vue.filter('myDateTime', function (created) {
    //moment(date, 'YYYY-MM-DD').format(format);//moment(created).format('MMMM Do YYYY');
    if (created)
        return moment(created).format('DD/MM/YYYY hh:mm a');
    else
        return "----";
});

Vue.filter('moneda', function (text) {
    if (text != "----") {
        let val = (text / 1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
    return text
});

Vue.filter('ActInc', function (text) {
    if (text) {
        return "Activado"
    }
    return "Inactivo"
});

Vue.filter('tipoMoneda', function (text, formaPago) {
    if (text != "----") {
        let val = (text / 1).toFixed(2).replace('.', ',')
        let fp = (formaPago == 2 || formaPago == 6) ? "$" : "Bs."
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " " + fp
    }
    return text
});

Vue.filter('zfill', function (number, width = 6) {
    var numberOutput = Math.abs(number); /* Valor absoluto del número */
    var length = number.toString().length; /* Largo del número */
    var zero = "0"; /* String de cero */

    if (width <= length) {
        if (number < 0) {
            return ("-" + numberOutput.toString());
        } else {
            return numberOutput.toString();
        }
    } else {
        if (number < 0) {
            return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
        } else {
            return ((zero.repeat(width - length)) + numberOutput.toString());
        }
    }
});

// COMPONENTES
Vue.use(require('vue-moment'));

Vue.component('Home', require('./components/home/Home.vue').default);
Vue.component('Login', require('./components/auth/Login.vue').default);
Vue.component('Register', require('./components/auth/Register.vue').default);

Vue.component('AdminCreate', require('./components/admin/subcomponents/Create.vue').default);

Vue.component('Request', require('./components/buyer/request/Request.vue').default);
Vue.component('CreateRequest', require('./components/buyer/request/Create.vue').default);
Vue.component('SellerRequest', require('./components/seller/request/Request.vue').default);
Vue.component('SellerShow', require('./components/seller/request/Show.vue').default);

Vue.component('Profile', require('./components/auth/Profile.vue').default);

Vue.component('User', require('./components/admin/user/User.vue').default);

Vue.component('SellerOverview', require('./components/seller/Overview.vue').default);
Vue.component('AdminOverview', require('./components/admin/Overview.vue').default);

Vue.component('Product', require('./components/seller/product/Product.vue').default);
Vue.component('CreateProduct', require('./components/seller/product/Create.vue').default);

Vue.component('Note', require('./components/admin/note/Note.vue').default);
Vue.component('CreateNote', require('./components/admin/note/Create.vue').default);

Vue.component('Project', require('./components/admin/project/Project.vue').default);
Vue.component('CreateProject', require('./components/admin/project/Create.vue').default);

Vue.component('Feedback', require('./components/feedback/Feedback.vue').default);
Vue.component('CreateFeedback', require('./components/feedback/Create.vue').default);

Vue.component('Map', require('./components/map/Map.vue').default);

Vue.component('Offer', require('./components/seller/offer/Offer.vue').default);
Vue.component('ShowOffer', require('./components/buyer/offer/Show.vue').default);

Vue.component('Order', require('./components/buyer/order/Order.vue').default);
Vue.component('SellerOrder', require('./components/seller/order/Order.vue').default);

Vue.component('Payment', require('./components/payment/Payment.vue').default);

Vue.component('Herramienta', require('./components/herramienta/HerramientaSNF.vue').default);


window.Fire = new Vue();

const app = new Vue({
    el: '#app',
});
