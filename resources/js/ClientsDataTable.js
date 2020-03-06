import React, { Component } from "react";
import DataTable from "./components/DataTable";

export default class ClientsDataTable extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        const columns = [
            {fieldName: 'name', headerName: 'Name'},
            {fieldName: 'company_name', headerName: 'Company'},
            {fieldName: 'email', headerName: 'Email'},
            {fieldName: 'phone', headerName: 'Phone'},
        ];

        let iconEdit = <i className="fa fa-edit"></i>;
        let iconDelete = <i className="fa fa-trash"></i>;

        const actions = [
            {action: 'edit', baseUrl: 'client', icon: iconEdit},
            {action: 'destroy', baseUrl: 'client', icon: iconDelete},
        ];

        return (
            <DataTable url="/api/v1/clients" tableClassName="clients-datatable" columns={columns} actions={actions} />
        );
    }
}
