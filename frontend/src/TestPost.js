
import axios from 'axios'


    export const postData = axios
    .post('/api/users/register',{
        name:"Thy",
        email:"thy@test.com",
        password: "1234"
    })
    .then((res)=>{
        console.log(res);
    })
    .catch(res=>console.log(res))



