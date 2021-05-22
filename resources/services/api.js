export default() => {

    let token = localStorage.getItem('access_token');

    let params = {
        headers : {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization':'Bearer '+token
        }
    };

    return axios.create(params);

}
