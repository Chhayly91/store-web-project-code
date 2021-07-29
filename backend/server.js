import express from "express";
import mongoose from "mongoose";
import dotenv from "dotenv";
import userRouter from "./Routers/userRouter.js";
import productRouter from "./Routers/productRouter.js";
import orderRouter from "./Routers/orderRouter.js";

dotenv.config();
const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

mongoose.connect(process.env.PORT || "mongodb://localhost/amazona", {
  useNewUrlParser: true,
  useUnifiedTopology: true,
  useCreateIndex: true
});

// app.get('/api/products/:id', (req,res)=>{
//     const product = data.products.find(x =>x._id === req.params.id);
//     // console.log(req.params.id)
//     if(product){
//         res.send(product)
//     }else{
//         res.status(404).send({message:'Product not Found'});
//     }

// });

// app.get('/api/products', (req,res)=>{
//     res.send(data.products)
// });

app.use("/api/users", userRouter);
app.use("/api/products", productRouter);
app.use('/api/orders', orderRouter);
app.use('/api/config/paypal', (req,res)=>{
  res.send(process.env.PAYPAL_CLIENT_ID || 'sb');
})
// app.use('/', productRouter);

app.use((err, req, res, next) => {
  res.status(500).send({ message: err.message });
});

app.get("/", (req, res) => {
  res.send("Server is ready");
});

const port = process.env.PORT || 5000;
app.listen(port, () => {
  console.log(`server at http://localhost:${port}`);
});
