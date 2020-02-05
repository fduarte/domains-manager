
$(document).ready(function() {

    $(".whois").click(function(){
        var domainTd = $(this).closest('td').prev('td').prev('td');
        var domainName = domainTd.text();
        alert('Running WHOIS on domain: ' + domainName );
        getWhois(domainTd, domainName);
    });

    // $('#domains-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('domain.index') }}",
    //     columns: [
    //         { data: 'client', name: 'client' },
    //         { data: 'domain_name', name: 'domain_name' },
    //         { data: 'domain_expires_date', name: 'domain_expires_date' },
    //         { data: 'action', name: 'action', orderable: false },
    //     ]
    // });

});

/**
 * Get WHOIS data
 */
function getWhois(domainTd, domainName) {

    $('body').addClass('overlay');
    $('#loader').show();

    $.ajax({
        url: '/api/v1/whois',
        type: 'get',
        data: {'domainName': domainName},
        dataType: 'json',
    }).done(function() {
        console.log('WHOIS success.')
        $('#loader').hide();
        $('body').removeClass('overlay');
        domainTd.addClass('text-success');
    }).fail(function() {
        console.log('WHOIS failure.')
        $('#loader').hide();
        $('body').removeClass('overlay');
        domainTd.addClass('text-danger');
    });
}


