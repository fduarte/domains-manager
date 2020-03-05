import React from 'react';
import ReactDOM from "react-dom";

require('./bootstrap');

/**
 * Render index page React DataTable
 */
import DomainsDataTable from './DomainsDataTable';
import ClientsDataTable from './ClientsDataTable';

if (document.getElementById('domains-datatable')) {
    ReactDOM.render(<DomainsDataTable />, document.getElementById('domains-datatable'));
}

if (document.getElementById('clients-datatable')) {
    ReactDOM.render(<ClientsDataTable />, document.getElementById('clients-datatable'));
}

