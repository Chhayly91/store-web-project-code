import bcrypt from 'bcryptjs'

const data = {
    users: [
        {
            name: 'chhayly',
            email: 'admin@test.com',
            password: bcrypt.hashSync('1234', 8),
            isAdmin: true
        },
        {
            name: 'jonh',
            email: 'jonh@test.com',
            password: bcrypt.hashSync('1234', 8),
            isAdmin: false
        }
    ],
    products:[
        {
            image:'./images/p1.jpg',
            name:'nike shirt',
            category:'Shirts',
            price:120,
            countInstock:5,
            brand:'Nike',
            rating:4.5,
            numReviews:5,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Puma shirt',
            category:'Pant',
            price:120,
            countInstock:0,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Addidas shirt',
            category:'Short',
            price:120,
            countInstock:15,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Chanel shirt',
            category:'cloth',
            price:120,
            countInstock:18,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Levis shirt',
            category:'Shirts',
            price:120,
            countInstock:10,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Lima shirt',
            category:'Shirts',
            price:120,
            countInstock:8,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Ankor shirt',
            category:'Shirts',
            price:120,
            countInstock:11,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        },
        {
            image:'./images/p1.jpg',
            name:'Phnom Penh shirt',
            category:'Shirts',
            price:120,
            countInstock:12,
            brand:'Nike',
            rating:4.5,
            numReviews:10,
            description:'high quality product'
        }
    ]
}

export default data