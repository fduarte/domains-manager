import React, { Component } from "react";
import DataTable from "./components/DataTable";

export default class ReactDataTableApp extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        const columns = [
            {fieldName: 'domain_name', headerName: 'Domain'},
            {fieldName: 'client.company_name', headerName: 'Company'},
            {fieldName: 'client.name', headerName: 'Client'},
            {fieldName: 'client.email', headerName: 'Email'},
            {fieldName: 'client.phone', headerName: 'Phone'},
            {fieldName: 'domain_expires_date', headerName: 'Expiration'}
        ];

        return (
            <DataTable url="/api/v1/domains" columns={columns} />
        );
    }
}
