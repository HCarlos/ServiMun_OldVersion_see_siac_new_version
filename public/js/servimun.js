var axios = require("axios").default;
var CURP = $('#curp').val();
var options = {
    method: 'POST',
    url: 'https://curp-renapo.p.rapidapi.com/v1/curp',
    headers: {
        'content-type': 'application/json',
        'x-rapidapi-host': 'curp-renapo.p.rapidapi.com',
        'x-rapidapi-key': '443ebd50abmsh706bc0616bc2595p1dacbajsn5d699f5df978'
    },
    data: {curp: CURP}
};

axios.request(options).then(function (response) {
    console.log(response.data);
}).catch(function (error) {
    console.error(error);
});
