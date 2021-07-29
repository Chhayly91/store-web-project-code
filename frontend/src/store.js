// import data from "./Data";
import { createStore, compose, applyMiddleware, combineReducers } from "redux";
import thunk from "redux-thunk";
import {
  productListReducer,
  productDetailsReducer,
} from "./reducers/productReducers";
import { cartReducer } from "./reducers/cartReducers";
import {
  userSigninReducer,
  userRegisterReducer,
  userDetailsReducer,
  userUpadateProfileReducer,
} from "./reducers/userReducers";
import {
  orderCreateReducer,
  orderDetailsReducer,
  orderPayReducer,
  orderMineListReducer,
} from "./reducers/orderReducers";

const initialState = {
  cart: {
    cartItems: localStorage.getItem("cartItems")
      ? JSON.parse(localStorage.getItem("cartItems"))
      : [],
    shippingAddress: localStorage.getItem("shippingAddress")
      ? JSON.parse(localStorage.getItem("shippingAddress"))
      : {},
    paymentMethod: "PayPal",
  },
  userSignin: {
    userInfo: localStorage.getItem("userInfo")
      ? JSON.parse(localStorage.getItem("userInfo"))
      : null, //we can use null or undifined
  },
};
const reducer = combineReducers({
  productLists: productListReducer,
  productDetails: productDetailsReducer,
  cart: cartReducer,
  userSignin: userSigninReducer,
  userRegister: userRegisterReducer,
  orderCreate: orderCreateReducer,
  orderDetails: orderDetailsReducer,
  orderPay: orderPayReducer,
  orderMineList: orderMineListReducer,
  userDetails: userDetailsReducer,
  userUpdateProfile: userUpadateProfileReducer,
});

const composeEnhancer = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;
const store = createStore(
  reducer,
  initialState,
  composeEnhancer(applyMiddleware(thunk))
);

// console.log(store);
export default store;
