import React from 'react';
import PageContainer from '../../../components/page-container/page-container';
import styled from 'styled-components';
import ProductItem from './product-item/product-item';
import { ApplicationContext } from '../../../stores/application-store';
import { connect } from 'react-redux';
import { adminLoadProducts } from '../../../actions/products'
import { adminUpdateCheckout } from '../../../actions/order';

class ProductList extends React.Component {
    static contextType = ApplicationContext;
    constructor(props) {
        super(props);
        this.state = {
            selectedProducts: 0
        }
    }
    componentDidMount() {
        this.context.setContinue('Fortsæt bestilling', '/client-info');
        this.context.setProgress(33);
        this.context.disableContinue(true);

        const { loaded } = this.props;
        if(!loaded) {
            this.props.adminLoadProducts();
        }
    }

    addProduct = (product, count = 1) => {
        const { adminUpdateCheckout, selectedProducts } = this.props;
        let productCheckout = selectedProducts[product.id];
        if (!productCheckout) {
            productCheckout = { product, count: 1 }
        } else {
            productCheckout = { product, count: productCheckout.count + 1 }
        }
        const products = { ...selectedProducts, [product.id]: productCheckout };
        adminUpdateCheckout({products})
    }

    removeProduct = (product) => {
        const { adminUpdateCheckout, selectedProducts } = this.props;
        const products = { ...selectedProducts };
        let productCheckout = products[product.id];
        if (!productCheckout) {
            return;
        }
        productCheckout = {...productCheckout, count: productCheckout.count - 1}
        if (productCheckout.count > 0) {
            products[product.id] = productCheckout
        } else {
            delete products[product.id];
        }
        adminUpdateCheckout({products})
    }

    updateContinue = () => {
        this.state.selectedProducts > 0 ? this.context.disableContinue(false) : this.context.disableContinue(true);
    }

    render() {
        const { products, selectedProducts } = this.props;
        return (
            <div className="default-page">
                <PageContainer>
                    <ProductListStyle>
                        <div className="text-center progress-status">1 / 3</div>
                        <h1 className="text-center">Vælg produkt</h1>
                        <div className="description text-center">Klik og vælg ét eller flere produkter. Vælg antal og tilføj produkt.</div>
                        {
                            products.map((product, index) => <ProductItem addProduct={this.addProduct} removeProduct={this.removeProduct} key={`product-item-${index}`} product={product} checkoutInfo={selectedProducts[product.id]} />)
                        }
                    </ProductListStyle>
                </PageContainer>
            </div>
        )
    }
}

const ProductListStyle = styled.div`
    margin-top: 15px;
    margin-bottom: 150px;
    .description {
        margin-top: 30px;
        margin-bottom: 50px;
    }
`

const mapStateToProps = (state, ownProps) => {
    return {
        products: state.products.list,
        selectedProducts: state.orders.currentCheckout.products,
        loaded: state.products.loaded,
        loading: state.products.loading,
    }
 }

export default connect(
    mapStateToProps,
    { adminLoadProducts, adminUpdateCheckout }
)(ProductList)