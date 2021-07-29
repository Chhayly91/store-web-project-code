import React, { useEffect } from "react";
// import axios from 'axios';
// import data from '../Data';
import Product from "../components/Product";
import LoadingBox from "../components/LoadingBox";
import MessageBox from "../components/MessageBox";
import { useSelector, useDispatch } from "react-redux";
import { listProducts } from "../actions/productActions";

function HomeScreen() {
  // const [products, setProducts] = useState([]);
  // const [loading, setLoading] = useState(false);
  // const [error, setError] = useState(false);
  //Using Redux
  const dispatch = useDispatch();
  const productLists = useSelector((state) => state.productLists);
  // console.log(`product list:${productLists}`);

  const { loading, error, products } = productLists;
  // console.log(loading);

  useEffect(() => {
    // const fecthData = async ()=>{
    //   try{
    //     setLoading(true);
    //     const {data} = await axios.get('/api/products');
    //     setLoading(false);
    //     setProducts(data);
    //   }catch(err){
    //     setError(err.message);
    //     setLoading(false);
    //   }
    // }
    // fecthData();
    dispatch(listProducts());
  }, [dispatch]);
  return (
    <div>
      {loading ? (
        <LoadingBox></LoadingBox>
      ) : error ? (
        <MessageBox variant="danger">{error}</MessageBox>
      ) : (
        <div className="row center">
          {products.map((product) => (
            <Product key={product._id} product={product} />
          ))}
        </div>
      )}
    </div>
  );
}

export default HomeScreen;
