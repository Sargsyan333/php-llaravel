import React from "react";
import { isEmpty } from 'lodash';
import { connect } from 'react-redux';
import PageContainer from "../../../components/page-container/page-container";
import styled from "styled-components";
import { ApplicationContext } from "../../../stores/application-store";
import ProductSelected from "../product-list/product-item/product-selected";

class OrderConfirm extends React.Component {
  static contextType = ApplicationContext;

  componentDidMount() {
    this.context.setContinue('Send ordre', '/order-send');
    this.context.setProgress(100);
    const { currentCheckout } = this.props;
    if (isEmpty(currentCheckout.products)) {
      this.props.history.push('/checkout/product-list')
    }
  }

  render() {
    const { currentCheckout } = this.props;
    const productsArray = Object.values(currentCheckout.products);
    return (
      <div className="transition-item default-page">
        <PageContainer>
          <OrderConfirmStyle>
            <div className="text-center progress-status">3 / 3</div>
            <h1 className="text-center">Gennemse ordre</h1>
            <div className="description text-center">
              Tjek om oplysningerne er korrekte og send ordre
                </div>
            <InputInformation>
              <DataField>
                {currentCheckout.userInfo.name}
              </DataField>
              <DataField>
                {currentCheckout.userInfo.address}, {currentCheckout.userInfo.city}, {currentCheckout.userInfo.zipcode}
              </DataField>
              <DataField>
              {currentCheckout.userInfo.email}
              </DataField>
              <DataField>
              {currentCheckout.userInfo.mobile}
              </DataField>
              <DataField>
              {currentCheckout.userInfo.packagePlacement === 'Other' ? currentCheckout.userInfo.packagePlacementOther : currentCheckout.userInfo.packagePlacement}
              </DataField>
              <SectionHeader className="text-center">Leveringsdato</SectionHeader>
              <DataField>
              {currentCheckout.userInfo.delivery ? currentCheckout.userInfo.delivery.delivery_date.slice(0, 10) : ''}
              </DataField>
            </InputInformation>
            <SectionHeader className="text-center">
              Valgte produkter
            </SectionHeader>
            <Style>
              {productsArray.map((productInfo, index) =>
                <ProductSelected product={productInfo.product} productCount={productInfo.count} key={index} />
              )}
            </Style>
          </OrderConfirmStyle>
        </PageContainer>
      </div>
    );
  }
}

const Style = styled.div`
    width: 100%;
`

const SectionHeader = styled.div`
  margin-top: 20px;
  margin-bottom: 20px;
`

const DataField = styled.div`
  padding: 20px 15px;
  font-size: 15px;
  color: #414b56;
  min-width: 400px;
  margin: 5px 0px;
  border: 1px solid #DDE5EC;
  background-color: #ffffff;
  display: inline-block;
`
const InputInformation = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  input {
    display: block;
    flex: 1;
  }
`;

const OrderConfirmStyle = styled.div`
    margin-top: 15px;
    margin-bottom: 150px;
    .description {
    margin-top: 30px;
    margin-bottom: 50px;
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
)(OrderConfirm)
