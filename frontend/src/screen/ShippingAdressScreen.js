import React, { useState } from "react";
import CheckoutSteps from "../components/CheckoutSteps";
import { useDispatch, useSelector } from "react-redux";
import { saveShippingAddress } from "../actions/cartActions";



function ShippingAdressScreen(props) {
    const dispatch = useDispatch();
    const userSignin = useSelector(stage => stage.userSignin);
    const {userInfo} = userSignin;

    const cart = useSelector(stage => stage.cart);
    const {shippingAddress, cartItems} = cart;
    // console.log(cartItems.length);
    if(!userInfo){
        props.history.push('/signin');
    }
    if(!cartItems.length){
      props.history.push('/signin');
    }

    const [fullName,setFullName] = useState(shippingAddress.fullName);
    const [address,setAddress] = useState(shippingAddress.address);
    const [city,setCity] = useState(shippingAddress.city);
    const [postalCode,setPostalCode] = useState(shippingAddress.postalCode);
    const [country,setCountry] = useState(shippingAddress.country);
    const submitHanler = e => {
        e.preventDefault();
        //TODO dispatch save shipping
        dispatch(saveShippingAddress({fullName,address,city,postalCode,country}));
        props.history.push('/payment');
    };
  return (
    <div>
      <CheckoutSteps step1 step2></CheckoutSteps>
      <form className="form" onSubmit={submitHanler}>
        <div>
          <h1>Shipping Address</h1>
        </div>
        <div>
          <label htmlFor="fullName">Full Name</label>
          <input
            type="text"
            id="fullName"
            placeholder="Enter full name"
            value={fullName || ""} 
            onChange={e=>setFullName(e.target.value)}
            required
          ></input>
        </div>

        <div>
          <label htmlFor="address">Address</label>
          <input
            type="text"
            id="address"
            placeholder="Enter Address"
            value={address || ""}
            onChange={e=>setAddress(e.target.value)}
            required
          ></input>
        </div>

        <div>
          <label htmlFor="city">City</label>
          <input
            type="text"
            id="city"
            placeholder="Enter City"
            value={city || ""}
            onChange={e=>setCity(e.target.value)}
            required
          ></input>
        </div>

        <div>
          <label htmlFor="postalCode">Postal Code</label>
          <input
            type="text"
            id="postalCode"
            placeholder="Enter postal code"
            value={postalCode || ""}
            onChange={e=>setPostalCode(e.target.value)}
            required
          ></input>
        </div>

        <div>
          <label htmlFor="country">Country</label>
          <input
            type="text"
            id="country"
            placeholder="Enter country"
            value={country || ""}
            onChange={e=>setCountry(e.target.value)}
            required
          ></input>
        </div>

        <div>
            <label/>
            <button className="primary" type="submit">Countinue</button>
        </div>
      </form>
    </div>
  );
}

export default ShippingAdressScreen;
