import React from 'react';
import ReactDOM from 'react-dom';

function ProductAdminSkus(props) {
    return <div>
        {JSON.stringify(props)}
    </div>
}

$.fn.productAdminSkus = function () {
    if (this[0]) {
        let el = this[0];
        let data = $(this).data()

        ReactDOM.render(<ProductAdminSkus data={data} />, el);
    }
}
