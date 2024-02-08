import React from "react";
import PageContainer from "../../components/page-container/page-container";
import styled from "styled-components";
import { ApplicationContext } from "../../stores/application-store";
import Contact from "../../components/contact/contact"
import { connect } from 'react-redux';
import { userOrdersFind } from '../../actions/order';
import OrderItem from './order-item/order-item';
import Accordion from '../../components/accordion/accordion';

class OrderFind extends React.Component {
  static contextType = ApplicationContext;

  constructor(props) {
    super(props);
    this.state = {
      searchtext: ''
    }
  }

  componentDidMount() {
    const { loaded } = this.props;
    if (!loaded) {
      this.props.userOrdersFind();
    }
  }

  handleChange = (type, value) => {
    this.setState({
      [type]: value
    })
  };

  render() {
    // const { orders } = this.props;
    // this.props.orders
    let orders = this.props.orders.filter(order => {
      let totalString = order.name + order.address + order.email + order.mobile;
      return totalString.toLowerCase().indexOf(this.state.searchtext.toLowerCase()) !== -1;
    });


    return (
      <div className="transition-item default-page">

        <OrderFindStyle>
          <div className="header">
            <h1 className="text-center">Find ordre</h1>
          </div>

          <div className="description text-center">
            <h4 className="text-center">Her kan du søge efter dine ordre</h4>
          </div>
          <div className="search-input">
            <input type="text" onChange={e => this.handleChange('searchtext', e.target.value)} placeholder="Indtast navn, telefon eller email..." />
          </div>
          <div className="order-list">
            {
              orders.map(
                (order, index) => (
                  <Accordion allowMultipleOpen={false} key={`order-accordion-${index}`}>
                    <div label={`${order.mobile}, ${order.name}, ${order.email}`}  >
                      <div class="order-wrapper">
                        <OrderItem order={order} />
                      </div>
                    </div>

                  </Accordion>
                )
              )
            }
          </div>
          <Contact />
        </OrderFindStyle>

      </div>
    );
  }
}

const mapStateToProps = (state, ownProps) => {
  return {
    orders: state.orders.list,
    loaded: state.orders.loaded,
    loading: state.orders.loading,
    error: state.orders.error,
  }
}

export default connect(
  mapStateToProps,
  { userOrdersFind }
)(OrderFind)

const OrderFindStyle = styled.div`
    width: 100%;
    margin-top: 15px;
    margin-bottom: 100px;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    .header {
      flex-grow: 1;
    }
    .order-wrapper {
      width: 600px;
    }
    .description {
      flex-grow: 1;
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .order-list {
      width: 100vh;
      flex-grow: 6;
      margin-top: 10px;
      margin-bottom: 10px;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
      padding-bottom: 20px;
      justify-content: center;
      align-items: center;
    }
    .search-input {
      margin-top: 20px;
      margin-bottom: 40px;
      input {
        font-size: 15px;
        color: rgb(65, 75, 86);
        min-width: 340px;
        padding: 20px 15px;
        margin: 5px 0px;
        border-width: 1px;
        border-style: solid;
        border-color: rgb(221, 229, 236);
        border-image: initial;
      }
    }
`;

