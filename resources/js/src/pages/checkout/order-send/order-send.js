import React from "react";
import { connect } from 'react-redux';
import { isEmpty } from 'lodash';
import moment from 'moment'
import PageContainer from "../../../components/page-container/page-container";
import styled from "styled-components";
import { ApplicationContext } from "../../../stores/application-store";
import Contact from "../../../components/contact/contact"

class OrderSend extends React.Component {
  static contextType = ApplicationContext;
  componentDidMount() {
    this.context.setContinue('Opret ny ordre', '/product-list');
    this.context.setProgress(100);
    const { currentCheckout } = this.props;
    if (isEmpty(currentCheckout.products)) {
      this.props.history.push('/checkout/product-list')
    }
  }
  render() {
    const { currentCheckout } = this.props;
    return (
      <div className="transition-item default-page">
        <PageContainer>
            <OrderSendStyle>
                <h1 className="text-center">Tak for bestillingen</h1>
                <div className="description text-center">
                    Vi har modtaget ordren, og begynder at pakke den hurtigst muligt.
                </div>
                <div className="package-info text-center">
                    <h2>Pakken forventes leveret fredag d. {currentCheckout.userInfo.delivery ? moment(currentCheckout.userInfo.delivery.delivery_date).format('DD.MM.YYYY') : ''}</h2>
                    <div className="extra-info">i tidsrummet kl. 08.00 - 18.00</div>
                    <div>
                        1. Hvis email er oplyst sendes track & tracec nummer <br />
                        2. Hvis mobilnummer er oplyst sendes SMS ved levering
                    </div>
                </div>
                <Contact />
            </OrderSendStyle>
        </PageContainer>
      </div>
    );
  }
}

const OrderSendStyle = styled.div`
    margin-top: 15px;
    margin-bottom: 150px;
    padding-top: 50px;
    .description {
        margin-top: 30px;
        margin-bottom: 10px;
    }
    .package-info {
        h2 {
            color: #4886fb;
            margin-bottom: 20px;
        }
        .extra-info {
          color: #4886fb;
        }
        line-height: 25px;
        margin-top: 60px;
    }
`;

const mapStateToProps = (state) => {
  return {
    currentCheckout: state.orders.currentCheckout
  }
}

export default connect(
  mapStateToProps,
  null
)(OrderSend)
