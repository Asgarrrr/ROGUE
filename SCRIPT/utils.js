/**
 *
 * @param   {String}  endpoint    Request URL
 * @param   {Object}  body        Request parameters
 * @param   {String}  method      [ GET || POST ]
 * @returns {any}
 */
async function fetchAPI(endpoint, body = {}, method = "POST") {

    if (window.fetch) {

        return await fetch(endpoint, {
            method  : method,
            body    : JSON.stringify(body),
            mode    : 'cors'
        })
        .then ( res => res.json() )
        .catch( err => err );

    }
}