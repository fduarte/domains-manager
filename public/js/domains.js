$('#domains-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: route,
    columns: [
        {data: 'client', name: 'client'},
        {data: 'domain_name', name: 'domain_name'},
        {data: 'domain_expires_date', name: 'domain_expires_date'},
        {data: 'action', name: 'action', orderable: false},
    ]
});
