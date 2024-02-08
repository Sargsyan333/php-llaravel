import React from 'react';
import * as _ from 'lodash'
import { connect } from 'react-redux';
import {
    BrowserRouter as Router,
    Route,
    Switch,
    Redirect
} from "react-router-dom";
import styled from "styled-components";
// Stores
import Continue from "../../components/continue/continue";
// Authenticated Pages
import ProductList from '../checkout/product-list/product-list'
import ClientInfo from "../checkout/client-info/client-info";
import OrderConfirm from "../checkout/order-confirm/order-confirm";
import OrderSend from "../checkout/order-send/order-send";
import { adminOrdersCreate, adminUpdateCheckout } from '../../actions/order';
import { adminLoadDeliveries } from '../../actions/delivery';
import { DEAFULT_CHECKOUT } from '../../common/constants'

const checkoutUrls = [
    '/checkout/product-list',
    '/checkout/client-info',
    '/checkout/order-confirm',
    '/checkout/order-send'
 ]

class Checkout extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedProducts: 0
        }
    }

    componentDidMount() {
        const { adminLoadDeliveries, deliveries, adminUpdateCheckout } = this.props;
        if (!deliveries || deliveries.length === 0) {
            adminLoadDeliveries()
        }
        adminUpdateCheckout(_.cloneDeep(DEAFULT_CHECKOUT))
    }

    componentDidUpdate(prevProps) {
        if (prevProps.orderSaving === true && this.props.orderSaving === false) {
            // Order finished
            if (this.props.orderError) {
                // Failrue.
                alert(`${this.props.orderError}`)
            } else {
                this.props.history.push('/checkout/order-send')
            }
        }
    }

    onContinue = async () => {
        // Get the curren index
        const index =  checkoutUrls.indexOf(this.props.location.pathname) + 1

        if (this.props.location.pathname === '/checkout/order-confirm') {
            // Call API Order
            try {
                this.orderProduct()
            } catch (error) {
                alert(`${error}`)
            }
        } else if (this.props.location.pathname === '/checkout/order-send') {
            this.props.history.push('/dashboard')
        } else {
            this.props.history.push(checkoutUrls[index])
        }
    }

    orderProduct = () => {
        const { adminOrdersCreate, currentCheckout } = this.props;
        const product = Object.values(currentCheckout.products).map(p => ({
            count: p.count,
            id: p.product.id
        }))
        let package_delivery_information = currentCheckout.userInfo.packagePlacement
        if (package_delivery_information === 'Other') {
            package_delivery_information = currentCheckout.userInfo.packagePlacementOther
        }
        adminOrdersCreate(
            {
                name: currentCheckout.userInfo.name,
                product: product,
                delivery_id: currentCheckout.userInfo.delivery.id,
                email: currentCheckout.userInfo.email,
                city: currentCheckout.userInfo.city,
                zipcode: currentCheckout.userInfo.zipcode,
                address: currentCheckout.userInfo.address,
                mobile: currentCheckout.userInfo.mobile,
                package_delivery_information: package_delivery_information
            }
        );
    }


    CanContinue = () => {
        const index =  checkoutUrls.indexOf(this.props.location.pathname) +1
        // If in product - list
        if(index==1) {
            return this.validateProductsList()
        }
        // if user info page
        if(index==2) {
            return this.validateUserInfo()
        }
        if (index == 3) {
            return !this.props.orderSaving;
        }
        return true
    }

    validateProductsList() {
        const { currentCheckout } = this.props;

        if (_.isEmpty(currentCheckout.products)) {
            return false;
        }
        else {
            return true;
        }
    }

    validateUserInfo() {
        const { userInfo }= this.props.currentCheckout
        if(!userInfo.name || !userInfo.address || !userInfo.city || !userInfo.zipcode || !userInfo.email || !userInfo.mobile || !userInfo.packagePlacement || !userInfo.delivery) {
            return false
        }
        return true
    }

    render() {
        const { path } = this.props.match
        const canContinue = this.CanContinue()

        return (
            <Style>
                <div className="checdeliveriesout-page">
                    <Switch>
                        <Route
                            exact
                            path={`${path}/product-list`}
                            component={ProductList}
                        />
                        <Route exact path={`${path}/client-info`} component={ClientInfo} />
                        <Route exact path={`${path}/order-confirm`} component={OrderConfirm} />
                        <Route exact path={`${path}/order-send`} component={OrderSend} />
                        <Redirect to={`${path}/product-list`} />
                    </Switch>
                    <Continue canContinue={canContinue} onContinue={this.onContinue}/>
                </div>
            </Style>
        )
    }
}

const Style = styled.div`
    width: 100%;
`

const mapStateToProps = (state, ownProps) => {
    return {
        products: state.products.list,
        currentCheckout : state.orders.currentCheckout,
        orderProduct: state.orders,
        orderSaving : state.orders.saving,
        orderError : state.orders.error,
        deliveries: state.deliveries.list
    }
 }

export default connect(
    mapStateToProps,
    {
        adminLoadDeliveries, adminOrdersCreate, adminUpdateCheckout
    }
)(Checkout)