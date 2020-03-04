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

        let iconEdit = <i className="fa fa-edit"></i>;
        let iconDelete = <i className="fa fa-trash"></i>;
        let iconRefresh = <i className="fa fa-retweet"></i>;

        const actions = [
            {action: 'edit', baseUrl: 'domain', icon: iconEdit},
            {action: 'delete', baseUrl: 'domain', icon: iconDelete},
            {id:'domainRefresh', action: '', baseUrl: '#', icon: iconRefresh}
        ];

        return (
            <DataTable url="/api/v1/domains" columns={columns} actions={actions} /*custom={this.handleDomainRefresh}*/ />
        );
    }
}
