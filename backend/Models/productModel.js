import mongoose from 'mongoose';


const productSchema = new mongoose.Schema({
    image: {type:String, required:true},
    name: {type:String, required:true, unique:true},
    category: {type:String, required:true},
    price: {type:Number, required:true},
    countInstock: {type:Number, required:true},
    brand: {type:String, required:true},
    rating: {type:Number, required:true},
    numReviews: {type:Number, required:true},
    description: {type:String, required:true}
}, {
    timestamps:true
});

const  Product = mongoose.model('Product', productSchema);
export default Product;