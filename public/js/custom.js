
$(document).ready(function(){

    $(".whois").click(function(){
        var domain = $(this).closest('td').prev('td').prev('td').text();

        alert('Running WHOIS on domain: ' + domain );

        $.ajax({
            url: '/api/v1/whois',
            type: 'get',
            data: {'domainName': domain},
            dataType: 'json',
        }).done(function() {
            $(this).css('background-color', 'green');
            console.log('WHOIS success.')
        }).fail(function() {
            console.log('WHOIS failure.')
        });
    });

});