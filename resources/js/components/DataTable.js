import React, { Component } from 'react';

export default class DataTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            entities: {
                data: [],
                meta: {
                    current_page: 1,
                    from: 1,
                    last_page: 1,
                    per_page: 5,
                    to: 1,
                    total: 1,
                },
            },
            first_page: 1,
            current_page: 1,
            sorted_column: this.props.columns[0].fieldName,
            offset: 4,
            order: 'asc',
        };
    }

    /**
     * Set state's entities, which includes domain specific data
     */
    componentDidMount() {
        this.setState({ current_page: this.state.entities.meta.current_page }, () => {this.fetchEntities()});
    }

    /**
     * Get domain data
     */
    fetchEntities() {
        let fetchUrl = `${this.props.url}/?page=${this.state.current_page}&column=${this.state.sorted_column}&order=${this.state.order}&per_page=${this.state.entities.meta.per_page}`;

        axios.get(fetchUrl)
            .then(response => {
                this.setState({ entities: response.data });
            })
            .catch(e => {
                console.error(e);
            });
    }

    /**
     * Column headers
     *
     * @param value
     * @returns {string}
     */
    columnHead(value) {
        let header = value.split('_').join(' ');
        return header.split('.').join(' ').toUpperCase();
    }

    /**
     * Table headers
     *
     * @returns {*}
     */
    tableHeads() {
        let icon;
        if (this.state.order === 'asc') {
            icon = <i className="fa fa-arrow-circle-up ml-1"></i>;
        } else {
            icon = <i className="fa fa-arrow-circle-down ml-1"></i>;
        }

        let cols = this.props.columns.map(obj => {
            return <th className="table-head" key={obj.fieldName} onClick={() => this.sortByColumn(obj.fieldName)}>
                { this.columnHead(obj.headerName) }
                { obj.fieldName === this.state.sorted_column && icon }
            </th>
        });

        let actions = <th className="table-head" key="actions">Actions</th>;

        cols.push(actions);

        return cols;
    }

    /**
     * Generates table rows and cells with domain data
     * @returns {*[]|*}
     */
    domainList() {
        if (this.state.entities.data.length) {

            let iconEdit = <i className="fa fa-edit"></i>;
            let iconDelete = <i className="fa fa-trash"></i>;
            let iconRefresh = <i className="fa fa-retweet"></i>;

            return this.state.entities.data.map(domain => {
                return <tr>
                    <td>{domain['domain_name']}</td>
                    <td>{domain.client.company_name}</td>
                    <td>{domain.client.name}</td>
                    <td>{domain.client.email}</td>
                    <td>{domain.client.phone}</td>
                    <td>{domain['domain_expires_date']}</td>
                    <td>
                        <a href={'/domain/' + domain['id'] + '/edit'}> {iconEdit}</a>
                        <a href={'/domain/' + domain['id'] + '/destroy' }> {iconDelete}</a>
                        <a href="#" onClick={() => this.handleDomainRefresh(domain['domain_name'])} > {iconRefresh}</a>
                    </td>
                </tr>
            })
        } else {
            return <tr>
                <td colSpan={this.props.columns.length} className="text-center">No Records Found.</td>
            </tr>
        }
    }

    /**
     * Handles fetching domain data from the WhoIs API using an internal gateway
     * Updates the domain expiration date (both in the DB and in state)
     *
     * @see Api\WhoisController
     * @param domainName
     */
    handleDomainRefresh(domainName) {
        fetch('api/v1/whois?domainName=' + domainName)
            .then(response => response.json())
            .then(res => {

                let domainData = this.state.entities.data.filter((data) => {
                    // If a matching domainName is found in state, then update its expiration date
                    if (data.domain_name === domainName) {
                        return data.domain_expires_date = res.domain_expires_date;
                    }
                    return data;
                })

                this.setState({
                    entities: {
                        ...this.state.entities,
                        data: domainData
                    }
                })
            })
    }

    /**
     * Sorting by column header
     *
     * @param column
     */
    sortByColumn(column) {
        if (column === this.state.sorted_column) {
            this.state.order === 'asc' ? this.setState({ order: 'desc', current_page: this.state.first_page }, () => {this.fetchEntities()}) : this.setState({ order: 'asc' }, () => {this.fetchEntities()});
        } else {
            this.setState({ sorted_column: column, order: 'asc', current_page: this.state.first_page }, () => {this.fetchEntities()});
        }
    }

    /**
     * Pagination
     *
     * @param pageNumber
     */
    changePage(pageNumber) {
        this.setState({ current_page: pageNumber }, () => {this.fetchEntities()});
    }

    /**
     * Pagination
     *
     * @returns {[]|*[]}
     */
    pagesNumbers() {
        if (!this.state.entities.meta.to) {
            return [];
        }
        let from = this.state.entities.meta.current_page - this.state.offset;
        if (from < 1) {
            from = 1;
        }
        let to = from + (this.state.offset * 2);
        if (to >= this.state.entities.meta.last_page) {
            to = this.state.entities.meta.last_page;
        }
        let pagesArray = [];
        for (let page = from; page <= to; page++) {
            pagesArray.push(page);
        }
        return pagesArray;
    }

    /**
     * Pagination
     *
     * @returns {*[]}
     */
    pageList() {
        return this.pagesNumbers().map(page => {
            return <li className={ page === this.state.entities.meta.current_page ? 'page-item active' : 'page-item' } key={page}>
                <button className="page-link" onClick={() => this.changePage(page)}>{page}</button>
            </li>
        })
    }

    /**
     * Render DataTable
     *
     * @returns {*}
     */
    render() {
        return (
            <div className="data-table">
                <table className="table table-sm table-responsive-sm table-stripped table-hover">
                    <thead className="thead-dark">
                    <tr>{ this.tableHeads() }</tr>
                    </thead>
                    <tbody>{ this.domainList() }</tbody>
                </table>
                { (this.state.entities.data && this.state.entities.data.length > 0) &&
                <nav>
                    <ul className="pagination">
                        <li className="page-item">
                            <button className="page-link"
                                    disabled={ 1 === this.state.entities.meta.current_page }
                                    onClick={() => this.changePage(this.state.entities.meta.current_page - 1)}
                            >
                                Previous
                            </button>
                        </li>
                        { this.pageList() }
                        <li className="page-item">
                            <button className="page-link"
                                    disabled={this.state.entities.meta.last_page === this.state.entities.meta.current_page}
                                    onClick={() => this.changePage(this.state.entities.meta.current_page + 1)}
                            >
                                Next
                            </button>
                        </li>
                        <span style={{ marginTop: '8px' }}> &nbsp; <i>Displaying { this.state.entities.data.length } of { this.state.entities.meta.total } entries.</i></span>
                    </ul>
                </nav>
                }
            </div>
        );
    }
}
