import React, { Component } from 'react';
import CartItem from './CartItem';
import pluralize from 'pluralize';
import PropTypes from 'prop-types';


class ShoppingCart extends Component{
    constructor(props){
        super(props);
        this.state = {}
        this.handleDelete = this.handleDelete.bind(this);
        this._renderCart = this._renderCart.bind(this);
    }
    countItems(){
        let cart = this.props.shoppingCart;
        let total = 0;
        for (let item of cart.items){
            total += item.quantity;
        }
        return total;
    }
    totalAmount(){
        let cart = this.props.shoppingCart;
        let total = 0;
        for (let item of cart.items){
            total += (item.price / 100) * item.quantity;
        }
        return total;
    }
    handleDelete(item){
        this.props.onDelete(item);
    }
    _renderCart(){
        let cart = this.props.shoppingCart;
        if(!cart || cart.items.size == 0){
            return (
                <div className="panel text-center">
                    Your basket is empty.
                </div>
            )
        }else{
            let items = Array.from(cart.items).map(item => <CartItem key={item.id} item={item} onDelete={this.handleDelete}/>)
            const quantity = this.countItems();
            const totalAmount = this.totalAmount();
            return (
                <div>
                    <h2>{quantity} {pluralize('item', quantity)} in your basket</h2>
                    <div className="panel display-flex">
                        <div className="flex-xs-2 br-xs-1 pr-xs-3">
                            {items}
                        </div>
                        <div className="flex-xs-1 pl-xs-3">
                            <div>
                                <table className="width-full">
                                    <tbody>
                                        <tr>
                                            <th>Item(s) total</th>
                                            <td className="text-right">{totalAmount.toFixed(2)}</td>
                                        </tr>
                                        <tr>
                                            <td colSpan={2}>
                                                <div className="bt-xs-1 mt-xs-1 mb-xs-1">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total ({quantity} {pluralize('item', quantity)})</th>
                                            <td className="text-right">{totalAmount.toFixed(2)}</td>
                                        </tr>
                                        <tr>
                                            <td colSpan={2}>
                                                <button type="button" className="btn btn-secondary btn-block mt-3">
                                                    <strong>Proceed to checkout</strong>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            )
        }
    }
    render(){
        return(
            <div>
                {this._renderCart()}
            </div>
        )
    }
}
ShoppingCart.propTypes = {
    onDelete: PropTypes.func.isRequired,
    shoppingCart: PropTypes.object,
}

export default ShoppingCart;