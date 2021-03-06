import React, {useState, useEffect} from "react";
import {Link} from 'react-router-dom';
import { useDispatch, useSelector } from "react-redux";
import LoadingBox from "../components/LoadingBox";
import MessageBox from "../components/MessageBox";
import { register } from "../actions/userActions";

function RegisterScreen(props) {

    const [name,setName] = useState('');
    const [email,setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');

    const redirect = props.location.search?props.location.search.split('=')[1]:'/';
    const userRegister = useSelector(state => state.userRegister);
    const { userInfo, loading, error } = userRegister;  
    // console.log('test'+userInfo, loading, error)
    const dispatch = useDispatch();

    const submitHandler = (e) =>{
        e.preventDefault();
        if(password !== confirmPassword){
          alert('Password is not match with ConfirmPassword');
        }else{
          dispatch(register(name,email,password));
        }
    }

    useEffect(()=>{
      if(userInfo){
        props.history.push(redirect);
      }
    },[props.history,userInfo,redirect]);

  return (
    <div>
      <form className="form" onSubmit={submitHandler}>
        <div>
          <h1>Create Account</h1>
        </div>
        {loading&&<LoadingBox></LoadingBox>}
        {error&&<MessageBox variant="danger">{error}</MessageBox>}
        <div>
          <label htmlFor="name">Name</label>
          <input
            type="text"
            id="name"
            placeholder="Enter Name"
            required
            onChange={e => setName(e.target.value)}
          ></input>
        </div>

        <div>
          <label htmlFor="email">Email Address</label>
          <input
            type="email"
            id="email"
            placeholder="Enter Email"
            required
            onChange={e => setEmail(e.target.value)}
          ></input>
        </div>

        <div>
          <label htmlFor="password">Password</label>
          <input
            type="password"
            id="password"
            placeholder="Enter Password"
            required
            onChange={e => setPassword(e.target.value)}
          ></input>
        </div>

        <div>
          <label htmlFor="confirmPassword">Confirm Password</label>
          <input
            type="password"
            id="confirmPassword"
            placeholder="Enter Password again"
            required
            onChange={e => setConfirmPassword(e.target.value)}
          ></input>
        </div>

        <div>
            <label />
            <button className="primary" type="submit">register</button>
        </div>

        <div>
            <label/>
            <div>
                Already have an account? <Link to={`/signin?redirect=${redirect}`}>Sign In</Link>
            </div>
        </div>
      </form>
    </div>
  );
}

export default RegisterScreen;
