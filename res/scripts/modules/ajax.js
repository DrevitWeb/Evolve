function ajaxRequest(type, request, callback, data = null, formId="form", errorCallback = null, async = true)
{
    /*let xhr;
    // Create XML HTTP request.
    xhr = new XMLHttpRequest();
    if (type === 'GET' && data != null) {request += '?' + data;}

    xhr.open(type, request, async);
    if(!(data instanceof FormData)) {xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');}

    // Add the onload function.
    xhr.onload = function ()
    {
        switch (xhr.status) {
            case 200:
            case 201:
                callback(xhr.responseText);
                break;
            case 400:
                $("#"+formId).html(xhr.responseText);
                break;
            default:
                errorCallback(data, xhr.responseText);
        }
    };
    // Send XML HTTP request.
    xhr.send(data);*/

    $.ajax({
        url: request,
        type: type,
        data:data,
        processData: false,
        contentType: false,
        complete: function(jqXHR, textStatus) {
            switch (jqXHR.status) {
                case 200:
                case 201:
                    callback(jqXHR.responseText);
                    break;
                case 400:
                    $("#"+formId).html(jqXHR.responseText);
                    break;
                default:
                    errorCallback(data, jqXHR.responseText);
                    break;
            }
        }
    });
}