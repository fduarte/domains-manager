import React, { Component } from "react";
import DataTable from "./components/DataTable";

export default class ReactDataTableApp extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        const columns = ['domain_name', 'domain_expires_date'];
        return (
            <DataTable url="/api/v1/domains" columns={columns} />
    );
    }
}