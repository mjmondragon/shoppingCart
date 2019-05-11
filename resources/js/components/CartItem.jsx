import React, { Component } from 'react';
import PropTypes from 'prop-types';

class CartItem extends Component{
    constructor(props){
        super(props);
        this.state = {}
        this.handleClick = this.handleClick.bind(this);
    }
    handleClick(){
        this.props.onDelete(this.props.item);
    }
    render(){
        const item = this.props.item;
        return(
            <div className="bb-xs-1 pb-xs-3 pt-xs-3">
                <div className="">
                    <h3>{item.title}</h3>
                </div>
                <div>
                    <span className=""><strong>Quantity:</strong> {item.quantity}</span>
                    <span className="ml-2"><strong>Price:</strong> {(item.price / 100).toFixed(2)}</span>
                    <span className="float-right"> <strong>total:</strong> {((item.price / 100) * item.quantity).toFixed(2) }</span>
                </div>
                <div className="mt-xs-3">
                    <button type="button" className="btn" onClick={this.handleClick}>Remove</button>
                </div>
            </div>
        )
    }
}
CartItem.propTypes = {
    onDelete: PropTypes.func.isRequired,
    item: PropTypes.object.isRequired
}
export default CartItem;