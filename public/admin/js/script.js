function showLoading() {
    $('#loading').show();
}

function hideLoading() {
    $('#loading').hide();
}

$(document).ajaxStart(function(){ showLoading(); });
$(document).ajaxStop(function(){ hideLoading(); });

async function ajax(method = 'GET', url, body) {
    try {
        const response = await $.ajax({ method, url, body, dataType: "json" });
        console.log('request: ', { method, url, body, response });
        return response;
    } catch (error) {
        console.log(error);
    }
}
