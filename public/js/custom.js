
$(document).ready(function(){

    $(".whois").click(function(){
        var domainTd = $(this).closest('td').prev('td').prev('td');
        var domainName = domainTd.text();
        alert('Running WHOIS on domain: ' + domainName );
        getWhois(domainTd, domainName);
    });

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
