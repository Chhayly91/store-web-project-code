import { BrowserRouter, Route, Link } from "react-router-dom";
import ProductScreen from "./screen/ProductScreen";
import HomeScreen from "./screen/HomeScreen";
import CartScreen from "./screen/CartScreen";
import { useSelector, useDispatch } from "react-redux";
import SigninScreen from "./screen/SigninScreen";
import RegisterScreen from "./screen/RegisterScreen";
import { signout } from "./actions/userActions";
import ShippingAdressScreen from "./screen/ShippingAdressScreen";
import PaymentMethodScreen from "./screen/PaymentMethodScreen";
import PlaceOrderScreen from "./screen/PlaceOrderScreen";
import OrderScreen from "./screen/OrderScreen";
import OrdersHistoryScreen from "./screen/OrdersHistoryScreen";
import ProfileScreen from "./screen/ProfileScreen";
import PrivateRoute from "./components/PrivateRoute";

// import {postData} from './TestPost';

function App() {
  // console.log(data)
  const cart = useSelector((state) => state.cart);
  const { cartItems } = cart;

  const userSignin = useSelector((state) => state.userSignin);
  let { userInfo } = userSignin;

  // userInfo = undefined;
  // console.log("userInfo: " + userInfo);
  const dispatch = useDispatch();
  const signoutHandler = () => {
    dispatch(signout());
  };

  // console.log(postData);
  // console.log('user INfo '+localStorage.removeItem('userInfo'))
  return (
    <BrowserRouter>
      <div className="grid-container">
        <header className="row">
          <div>
            <Link className="brand" to="/">
              KHMERSHOP
            </Link>
          </div>
          <div>
            <Link to="/cart">
              Cart
              {cartItems.length > 0 && (
                <span className="badge">{cartItems.length}</span>
              )}
            </Link>
            {userInfo ? (
              <div className="dropdown">
                <Link to="#">
                  {userInfo.name} <i className="fa fa-caret-down"></i>
                </Link>
                <ul className="dropdown-content">
                  <li>
                    <Link to="/profile">Profile</Link>
                  </li>
                  <li>
                    <Link to="/orderhistory">Order History</Link>
                  </li>
                  <li>
                    <Link to="#signout" onClick={signoutHandler}>
                      Sign Out
                    </Link>
                  </li>
                </ul>
              </div>
            ) : (
              <Link to="/signin">Sign In</Link>
            )}
            {userInfo && userInfo.isAdmin && (
              <div className="dropdown">
                <Link to="/#admin">
                  Admin <i className="fa fa-caret-down"></i>{" "}
                </Link>
                <ul className="dropdown-content">
                  <li>
                    <Link to="/dashboard">Dashboard</Link>
                  </li>
                  <li>
                    <Link to="/productlist">Products</Link>
                  </li>
                  <li>
                    <Link to="/orderlist">Orders</Link>
                  </li>
                  <li>
                    <Link to="/userlist">Users</Link>
                  </li>
                </ul>
              </div>
            )}
          </div>
        </header>
        <main>
          <Route path="/cart/:id?" component={CartScreen} />
          <Route path="/product/:id" component={ProductScreen}></Route>
          <Route path="/signin" component={SigninScreen}></Route>
          <Route path="/register" component={RegisterScreen}></Route>
          <Route path="/shipping" component={ShippingAdressScreen}></Route>
          <Route path="/payment" component={PaymentMethodScreen}></Route>
          <Route path="/placeorder" component={PlaceOrderScreen}></Route>
          <Route path="/order/:id" component={OrderScreen}></Route>
          <Route path="/orderhistory" component={OrdersHistoryScreen}></Route>
          <PrivateRoute
            path="/profile"
            component={ProfileScreen}
          ></PrivateRoute>
          <Route path="/" component={HomeScreen} exact></Route>
        </main>
        <footer className="row center">All right reserved</footer>
      </div>
    </BrowserRouter>
  );
}

export default App;
