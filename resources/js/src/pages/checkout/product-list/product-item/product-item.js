import React from 'react';
import styled from 'styled-components';

export default class ProductItem extends React.Component {
    addProduct = () => {
        this.props.addProduct(this.props.product);
    }
    removeProduct = () => {
        this.props.removeProduct(this.props.product);
    }

    render() {
        const { checkoutInfo } = this.props
        const productCount = checkoutInfo ? checkoutInfo.count : 0
        const imageurl = this.props.product.images[0].filename;
        
        return (
            <ProductItemStyle >
                <div className="image">
                    <img src={`/storage/uploads/${imageurl}`} alt="" className="product-image"/>
                </div>
                <div className="product-description">
                    <div className="product-title">{this.props.product.name}</div>
                    <div className="product-description-text">
                        {this.props.product.description}
                    </div>
                    <div className="product-details">
                        <span>{this.props.product.colli_size}</span>
                        <span>{this.props.product.pharmacy_item_number}</span>
                        <span>{this.props.product.skeeis_item_number}</span>
                        <span>{this.props.product.price} kroner</span>
                    </div>
                </div>
                <ProductAction showButtons={productCount > 0 ? true : false}>
                    <div className="addProduct" onClick={() => this.addProduct(this.props.product)}>
                        + Tilføj ordre
                    </div>
                    <div className="product-control">
                        <div className="add" onClick={this.addProduct}>+</div>
                        <div className="pieces-text">
                            <div className="amount">{productCount} kasse</div>
                            <div className="pieces">{this.props.product.piecesText}</div>
                        </div>
                        <div className="sub" onClick={this.removeProduct}>-</div>
                    </div>
                </ProductAction>
            </ProductItemStyle>
        )
    }
}

const ProductAction = styled.div`
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 150px;
    transition: all 0.4s ease-in-out;
    color: #4886fb;
    white-space: nowrap;
    overflow: hidden;
    position: relative;
    padding: 20px;
    /* &:hover {
        background-color: #4383ff;
        color: #ffffff;
        cursor: pointer;
    } */
    .addProduct {
        width: 100%;
        text-align: center;
        cursor: pointer;
        transition: transform 0.5s ease-in-out;
        transform:${props => props.showButtons === true ? `translateX(-110%)` : `translateX(0%)`};
    }
    .product-control {
        position: absolute;
        left: 0;
        top: 0;
        background-color: #4383ff;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        opacity: ${props => props.showButtons === true ? `1` : `0`};
        visibility: ${props => props.showButtons === true ? `visible` : `hidden`};
        transition: all 0.2s ease-in-out;
        transition-delay: 0.5s;
        .pieces-text {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            flex-direction: column;
        }
        div {
            &.add {
                background-color: #7ba8ff;
                color: #ffffff;
                text-align: center;
                font-size: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                height: ${props => props.showButtons === true ? `35px` : `0px`};
                transition: height 0.2s ease-in-out;
                transition-delay: 0.8s;
                cursor: pointer;
            }
            &.sub {
                background-color: #7ba8ff;
                color: #ffffff;
                text-align: center;
                font-size: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                height: 0px;
                height: ${props => props.showButtons === true ? `35px` : `0px`};
                transition: height 0.2s ease-in-out;
                transition-delay: 0.8s;
                cursor: pointer;
            }
        }
    }
`

const ProductItemStyle = styled.div`
    background-color: #ffffff;
    display: flex;
    border: 1px solid #edf2f6;
    margin: 3px 0px;
    .image {
        display: flex;
        img {
            flex: 1;
        }

        .product-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            display: flex;
        }
    }
    .product-description {
        padding: 10px 20px;
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        .product-description-text {
            flex: 1;
        }
        .product-title {
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .product-details {
            span {
                border-left: 1px solid #edf2f6;
                padding: 0px 10px;
                &:first-child {
                    border-left: none;
                    padding: 0px 10px 0px 0px;
                }
            }
        }
    }
`