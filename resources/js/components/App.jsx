import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ShoppingCart from './ShoppingCart';
import Product from './Product';

export default class App extends Component {
    constructor(props){
        super(props);
        this.state = {};
        this.handleAddProduct = this.handleAddProduct.bind(this);
        this.handleDeleteItem = this.handleDeleteItem.bind(this);
    }
    componentWillMount(){
        this.fetchProducts();
        this.fetchShoppingCart();
    }
    fetchProducts(){
        let self = this;
        axios.get('/products')
            .then(response =>{
                let products = response.data;
                self.setState({products});
            }  
            ).catch(error => {
                console.log(error.response);
            });
    }
    fetchShoppingCart(){
        let self = this;
        axios.get('/cart')
            .then(response =>{
                let shoppingCart = response.data;
                shoppingCart.items = new Set(shoppingCart.items);
                self.setState({shoppingCart});
            }  
            ).catch(error => {
                console.log(error.response);
            });
    }
    handleAddProduct(product){
        let self = this;
        let shoppingCart = self.state.shoppingCart;
        product.quantity = 1;
        axios.post('/cart/'+shoppingCart.id+'/item', product)
            .then(response =>{
                self.addItem(response.data);
            }  
            );
    }
    handleDeleteItem(item){
        let self = this;
        let shoppingCart = self.state.shoppingCart;
        axios.delete('/cart/'+shoppingCart.id+'/item/'+item.id)
            .then(response =>{
                shoppingCart.items.delete(item);
                self.setState({shoppingCart});
            }  
            ).catch(error => {
                console.log(error.response);
            });
    }
    addItem(item){
        let shoppingCart = this.state.shoppingCart;
        shoppingCart.items.forEach(itemCart => {
            if (itemCart.id == item.id) {
                shoppingCart.items.delete(itemCart);
              }
        });
        shoppingCart.items.add(item);
        this.setState({shoppingCart});
    }
    render() {
        const products = this.state.products;
        const shoppingCart = this.state.shoppingCart;
        let productsView;
        if(products){
            productsView = this.state.products.map((product, index) => <Product key={index} product={product} onClick={this.handleAddProduct}/>)
        }
        
        return (
            <div>
                <header>
                    <div className="logo">
                        <img src="/css/ezyVet-Logo-22-4.png"/>
                    </div>
                </header>
                <div className="container">
                    <ShoppingCart shoppingCart={shoppingCart} onDelete={this.handleDeleteItem}/>
                </div>
                <div className="container">
                    <h2>Products</h2>
                    <div className="display-flex">
                        {productsView}
                    </div> 
                </div>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
