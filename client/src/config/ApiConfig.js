import axios from "axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/api"

let user = localStorage.getItem('user');
let token = localStorage.getItem('token');

if(user && token){
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}