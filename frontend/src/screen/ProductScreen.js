import React, { useEffect, useState } from "react";
import Rating from "../components/Rating";
// import data from '../Data';
import { Link } from "react-router-dom";
import { useSelector, useDispatch } from "react-redux";
import LoadingBox from "../components/LoadingBox";
import MessageBox from "../components/MessageBox";
import { detailsProduct } from "../actions/productActions";

function ProductScreen(props) {
  // console.log(props.match)
  // const product = data.products.find((x) => x._id === props.match.params.id);
  //Using Redux
  const productDetails = useSelector(state => state.productDetails);
  const productId = props.match.params.id;
  const [qty, setQty] = useState(1);
  const { loading, error, product } = productDetails;

  // console.log(product)

  const dispatch = useDispatch();
  //using UseEffect
  useEffect(() => {
    dispatch(detailsProduct(productId));
  }, [dispatch, productId]);

  // if(!product){
  //     return <div>Product not Found</div>
  //     // return console.log(product)
  // }
  const addToCartHandler = () => {
    props.history.push(`/cart/${productId}?qty=${qty}`);
  };
  return (
    <div>
      {loading ? (
        <LoadingBox></LoadingBox>
      ) : error ? (
        <MessageBox variant="danger">{error}</MessageBox>
      ) : (
        <div>
          <Link to="/">Back to</Link>
          <div className="row top">
            <div className="col-2">
              <img
                className="large"
                src={`.${product.image}`}
                alt={product.name}
              ></img>
            </div>
            <div className="col-1">
              <ul>
                <li>
                  <h1>{product.name}</h1>
                </li>
                <li>
                  <Rating
                    rating={product.rating}
                    numReviews={product.numReviews}
                  />
                </li>
                <li>Price : ${product.price}</li>
                <li>
                  Description : <p>{product.description}</p>
                </li>
              </ul>
            </div>
            <div className="col-1">
              <div className="card card-body">
                <ul>
                  <li>
                    <div className="row">
                      <div>Price</div>
                      <div className="price">${product.price}</div>
                    </div>
                  </li>
                  <li>
                    <div className="row">
                      <div>Status</div>
                      <div>
                        {product.countInstock > 0 ? (
                          <span className="success">In Stock</span>
                        ) : (
                          <span className="danger">Unavailable</span>
                        )}
                      </div>
                    </div>
                  </li>
                  {product.countInstock > 0 && (
                    <>
                      <li>
                        <div className="row">
                          <div>QTY</div>
                          <div>
                            <select
                              value={qty}
                              onChange={e => setQty(e.target.value)}
                            >
                              {[...Array(product.countInstock).keys()].map(
                                x => (
                                  <option key={x + 1} value={x + 1}>
                                    {x + 1}
                                  </option>
                                )
                              )}
                            </select>
                          </div>
                        </div>
                      </li>
                      <li>
                        <button
                          onClick={addToCartHandler}
                          className="primary block"
                        >
                          Add to Cart
                        </button>
                      </li>
                    </>
                  )}
                </ul>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}

export default ProductScreen;
