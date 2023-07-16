export let LoginSuccess = ()=>{
    let user = localStorage.getItem('user');
    let token = localStorage.getItem('token');
    return user && token ? true : false;
}
