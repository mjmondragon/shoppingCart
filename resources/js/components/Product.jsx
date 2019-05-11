import React, { Component } from 'react';
import PropTypes from 'prop-types';

class Product extends Component{

    constructor(props){
        super(props);
        this.state = {
            product: props.product
        }
        this.handleClick = this.handleClick.bind(this);
    }
    handleClick(){
        this.props.onClick(this.state.product);
    }
    render(){
        const product = this.state.product;
        return (
            <div className="flex-xs-1">
                <div className="panel pr-xs-3">
                    <h3>{product.name}</h3>
                    <div>
                        <strong>Price:</strong> {product.price.toFixed(2)}
                    </div>
                    <div className="mt-xs-3">
                        <button className="btn btn-primary btn-block" onClick={this.handleClick}>Add to basket</button>
                    </div>
                </div>
            </div>
        )
    }
}
Product.propTypes = {
    product: PropTypes.object.isRequired,
    onClick: PropTypes.func.isRequired
}
export default Product;