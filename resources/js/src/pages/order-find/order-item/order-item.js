import React from "react";
import { connect } from 'react-redux';
import styled from "styled-components";
import { ApplicationContext } from "../../../stores/application-store";

class OrderItem extends React.Component {
  static contextType = ApplicationContext;

  render() {
    const { products } = this.props.order;
    let total = 0;
    products.map(item => {
      total += (item.pivot.amount * item.pivot.price);
    })
    return (

      <OrderItemStyle>

        <div className="InputInformation">
          <div className="Panel">
            <div className="DataField">
              {this.props.order.name} <br />
              {this.props.order.address} <br />
              {this.props.order.email} <br />
              {this.props.order.mobile} <br />
              Leveringsdato: {this.props.order.delivery.delivery_date.slice(0, 10)}
            </div>
          </div>
        </div>

        <div className="OrderItems">
          {
            products.map((item, index) =>
              <div className="OrderItemid" key={`orderitem-${index}`}>
                <div className="OrderItemdetail g">
                  {item.name}
                </div>
                <div className="OrderItemdetail r">
                  {item.pivot.amount} stk.
                </div>
                <div className="OrderItemdetail r">
                  {item.pivot.price} kr.
                </div>
              </div>

            )
          }
        </div>

        <div className="Total">
          <div>Total:</div>
          <div>{total} kr.</div>
        </div>

      </OrderItemStyle>

    );
  }
}



const OrderItemStyle = styled.div`
    display: flex;
    flex-direction: column;
    width: 100%;

    .InputInformation {
      display: flex;
      flex-grow: 2;
      justify-content: center;
      align-items: center;

      .Panel {
        padding: 3px 5px;
        flex-grow: 1;
        font-size: 15px;
        color: #414b56;
        margin: 5px 0px;
        display: flex;
        flex-direction: column;
      }
    }

    .OrderItems {
      display: flex;
      flex-grow: 4;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      /* padding: 3px 0; */
      padding: 20px;
      background-color: #eeeeee;

      .OrderItemid {
        display: flex;
        width: 100%;
        justify-content: flex-end;

        .OrderItemdetail {
          display: flex;
          font-size: 15px;
          color: #414b56;
          &.g {
            flex: 1;
          }
          &.r {
            text-align: right;
            margin-left: 10px;
          }
        }
      }
    }

    .Total {
      display: flex;
      flex-grow: 1;
      padding: 3px 10px 0px 0px;
      float: right;
      justify-content: space-between;
      font-weight: 700;
      margin-top: 20px;
    }

    .DataField {
      padding: 3px 0px;
      flex-grow: 1;
      color: #414b56;
      margin: 5px 0px;
      display: flex;
      justify-content: left;
      align-items: left;
      text-align: left;
      font-size: 12px;
      line-height: 20px;
    }

`

export default connect(
  null,
  null
)(OrderItem)
