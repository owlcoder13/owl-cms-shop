import React from 'react';
import ReactDOM from 'react-dom';

import ProductAdminAttributes from "./components/ProductAdminAttributes";
import ProductAdminSkus from "./components/ProductAdminSkus";


$.fn.productAdminSkus = function () {
    if (this[0]) {
        let el = this[0];
        let data = $(this).data()

        ReactDOM.render(<ProductAdminSkus {...data} />, el);
    }
}

$.fn.productAdminAttributes = function () {
    if (this[0]) {
        let el = this[0];
        let data = $(this).data()

        ReactDOM.render(<ProductAdminAttributes {...data} />, el);
    }
}

