////////////////
//utility stuff/
///////////////

/**
 * function: myXHR
 * description:  -getPost  GET/POST
 *               -d  data, looks like {name:value;name2:value2;}
 *               -id  id of the parent for the spinner
 */
function myXHR(getPost,d,url){
    return $.ajax({
        type: getPost,
        async: true,
        cache: false,
        url: url,
        data: d,
        dataType: 'json'
    });
}