import React, { Component } from "react";
import DataTable from "./components/DataTable";

export default class ServicesDataTable extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        const columns = [
            {fieldName: 'name', headerName: 'Name'},
            {fieldName: 'price', headerName: 'Price'},
        ];

        let iconEdit = <i className="fa fa-edit"></i>;
        let iconDelete = <i className="fa fa-trash"></i>;

        const actions = [
            {action: 'edit', baseUrl: 'service', icon: iconEdit},
            {action: 'destroy', baseUrl: 'service', icon: iconDelete},
        ];

        return (
            <DataTable url="/api/v1/services" tableClassName="services-datatable" columns={columns} actions={actions} />
        );
    }
}
