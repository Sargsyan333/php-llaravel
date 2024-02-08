import React from "react";
import { isEmpty } from 'lodash';
import moment from 'moment';
import PageContainer from "../../../components/page-container/page-container";
import styled from "styled-components";
import SkeeInput from "../../../components/skee-input/skee-input";
import { ApplicationContext } from "../../../stores/application-store";
import SkeeSelect from "../../../components/skee-input/skee-select";
import { connect } from 'react-redux';
import { adminUpdateCheckout } from '../../../actions/order';
import { packagesFind } from '../../../actions/common' 
import StyleVariables from "../../../style-variables";
import DatePicker from "react-datepicker";
 
import "react-datepicker/dist/react-datepicker.css";

class ClientInfo extends React.Component {
  static contextType = ApplicationContext;

  constructor(props) {
    super(props);
    let startDate = ''
    if (this.props.checkoutUserInfo && this.props.checkoutUserInfo.delivery) {
      startDate = moment(this.props.checkoutUserInfo.delivery.delivery_date.slice(0, 10)).toDate()
    }
    this.state = {
      startDate
    };
  }

  // state = {
  //   name: '',
  //   address: '',
  //   city: '',
  //   zipcode: '',
  //   email: '',
  //   mobile: '',
  //   packagePlacement: '',
  //   delivery: '',
  //   validated: false
  // }

  componentDidMount() {
    this.context.setContinue('Fortsæt bestilling', '/order-confirm');
    this.context.setProgress(66);
    this.context.disableContinue(true);
    const { currentCheckout, packagesFind, packages } = this.props;
    const self = this;
    if (isEmpty(currentCheckout.products)) {
      this.props.history.push('/checkout/product-list')
      return;
    }
    if (!packages.loaded) {
      packagesFind()
    }

    const dawaAutocomplete2 = require('dawa-autocomplete2');
    const inputElm = document.getElementById('dawa-autocomplete-input');
    dawaAutocomplete2.dawaAutocomplete(inputElm, {
      select: function(selected) {
        const { checkoutUserInfo, adminUpdateCheckout } = self.props;
        console.log('HELLO selected')
        setTimeout(() => {
          const userInfo = { ...checkoutUserInfo, address: `${selected.data.vejnavn} ${selected.data.husnr}`, zipcode: selected.data.postnr, city: selected.data.postnrnavn};
          adminUpdateCheckout({userInfo});  
        }, 100)
      }
    });
  }

  /*
  caretpos: 25
data:
dør: null
etage: null
href: "https://dawa.aws.dk/adresser/0a3f50af-c133-32b8-e044-0003ba298018"
husnr: "5"
id: "0a3f50af-c133-32b8-e044-0003ba298018"
postnr: "4920"
postnrnavn: "Søllested"
stormodtagerpostnr: null
stormodtagerpostnrnavn: null
supplerendebynavn: null
vejnavn: "Abedvej"
__proto__: Object
forslagstekst: "Abedvej 5↵4920 Søllested"
stormodtagerpostnr: false
tekst: "Abedvej 5, 4920 Søllested"
type: "adresse"
*/

  handleChangeEvent = (event) => {
    const { checkoutUserInfo, adminUpdateCheckout } = this.props;
    const userInfo = { ...checkoutUserInfo, [event.target.name]: event.target.value};
    adminUpdateCheckout({userInfo})
  }

  handleSelectChangeEvent = (name) => (value) => {
    const { checkoutUserInfo, adminUpdateCheckout } = this.props;
    const userInfo = { ...checkoutUserInfo, [name]:value}
    adminUpdateCheckout({userInfo})
  }

  handleDeliveryChange = (date) => {
    const { deliveries, adminUpdateCheckout, checkoutUserInfo } = this.props;
    const dateString = moment(date).format('YYYY-MM-DD');
    const delivery = deliveries.find(item => item.delivery_date.slice(0, 10) == dateString);
    const userInfo = { ...checkoutUserInfo, delivery }
    adminUpdateCheckout({userInfo})

    this.setState({
      startDate: date
    });
  }

  

  render() {
    //const ss = this;
    const { checkoutUserInfo, deliveries, packages } = this.props;
    const currentDate = moment().add(3, 'days').format('YYYY-MM-DD');
    const dateVals = deliveries.filter(item => item.delivery_date.slice(0, 10) >= currentDate).map(item => 
      moment(item.delivery_date.slice(0, 10)).toDate()
    )

    const packagesData = [
      ...packages.list.map(d => ({
      value: d.package_delivery_information,
      name: d.package_delivery_information
      })), 
      { value: 'Other', name: 'Andet..' }
    ]

    return (
      <div className="transition-item default-page">
        <PageContainer>
          <ClientInfoStyle>
            <div className="text-center progress-status">2 / 3</div>
            <h1 className="text-center">Kundens oplysninger</h1>
            <div className="description text-center">
              Udfyld kundens oplysninger. Adressen tjekkes automatisk med dansk
              adresseregister.
            </div>
            <InputInformation>
              <div className="input-wrapper">
                <InputRow validated={checkoutUserInfo.name}>
                  <div className="input">
                    <SkeeInput name="name" onChange={this.handleChangeEvent} placeholder="Fornavn og efternavn" value={checkoutUserInfo.name} autoComplete="off" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.address}>
                  <div className="autocomplete-container input">
                    <input type="search" id="dawa-autocomplete-input" name="address" onChange={this.handleChangeEvent} placeholder="Adresse" value={checkoutUserInfo.address} />
                  </div>         
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.city}>
                  <div className="input">
                    <SkeeInput name="city" onChange={this.handleChangeEvent} placeholder="By" value={checkoutUserInfo.city} autoComplete="off" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.zipcode}>
                  <div className="input">
                    <SkeeInput name="zipcode" onChange={this.handleChangeEvent} placeholder="Postnummer" value={checkoutUserInfo.zipcode} autoComplete="off" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.email}>
                  <div className="input">
                    <SkeeInput name="email" onChange={this.handleChangeEvent} placeholder="Email" value={checkoutUserInfo.email} autoComplete="off" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.mobile}>
                  <div className="input">
                    <SkeeInput name="mobile" onChange={this.handleChangeEvent} placeholder="Mobiltelefon" value={checkoutUserInfo.mobile} autoComplete="off" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>

                <InputRow validated={checkoutUserInfo.packagePlacement}>
                  <div className="input">
                    <SkeeSelect name="packagePlacement" onChange={this.handleSelectChangeEvent('packagePlacement')} values={packagesData} placeholder="Hvor må vi stille pakken?" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>
                {checkoutUserInfo.packagePlacement === 'Other' &&
                  <InputRow validated={checkoutUserInfo.packagePlacementOther}>
                    <div className="input">
                      <SkeeInput name="packagePlacementOther" onChange={this.handleChangeEvent} placeholder="" maxLength="45" autoComplete="off" />
                    </div>
                    <div className="input-validation">
                      <img src="/images/icon_check.png" alt="" />
                    </div>
                  </InputRow>
                }
                <SectionHeader className="text-center">Vælg leveringsdato</SectionHeader>

                <InputRow validated={checkoutUserInfo.delivery}>
                  <div className="autocomplete-container input">
                    <DatePicker
                      selected={ this.state.startDate }
                      onChange={ this.handleDeliveryChange }
                      includeDates={ dateVals }
                      placeholderText="Vælg dato" />
                  </div>
                  <div className="input-validation">
                    <img src="/images/icon_check.png" alt="" />
                  </div>
                </InputRow>
              </div>
            </InputInformation>
          </ClientInfoStyle>
        </PageContainer>
      </div>
    );
  }
}

const SectionHeader = styled.div`
  margin-top: 20px;
  margin-bottom: 20px;
  width: 370px;
`

const InputRow = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;

  .input-validation {
    margin-left: 10px;
    transition: opacity 0.4s ease-in-out;
    opacity: ${props => props.validated === true ? '1' : '0'};
    position: absolute;
    right: -28px;
    top: 25px;
  }
`

const InputInformation = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  input {
    display: block;
  }
`

const ClientInfoStyle = styled.div`
  margin-top: 15px;
  margin-bottom: 150px;
  .description {
    margin-top: 30px;
    margin-bottom: 50px;
  }

  .autocomplete-container {
      /* relative position for at de absolut positionerede forslag får korrekt placering.*/
      position: relative;
      max-width: 30em;
  }

  .autocomplete-container input {
      /* Både input og forslag får samme bredde som omkringliggende DIV */
      box-sizing: border-box;
      padding: 20px 15px;
      font-size: 15px;
      color: ${StyleVariables.defaultFontColor};
      min-width: 340px;
      margin: 5px 0px;
      border: 1px solid #DDE5EC;
  }

  .dawa-autocomplete-suggestions {
      margin: 0.3em 0 0 0;
      padding: 0;
      text-align: left;
      border-radius: 0.3125em;
      background: #fcfcfc;
      box-shadow: 0 0.0625em 0.15625em rgba(0,0,0,.15);
      position: absolute;
      left: 0;
      right: 0;
      z-index: 9999;
      overflow-y: auto;
      box-sizing: border-box;
  }

  .dawa-autocomplete-suggestions .dawa-autocomplete-suggestion {
      margin: 0;
      list-style: none;
      cursor: pointer;
      padding: 0.4em 0.6em;
      color: #333;
      border: 0.0625em solid #ddd;
      border-bottom-width: 0;
  }

  .dawa-autocomplete-suggestions .dawa-autocomplete-suggestion:first-child {
      border-top-left-radius: inherit;
      border-top-right-radius: inherit;
  }

  .dawa-autocomplete-suggestions .dawa-autocomplete-suggestion:last-child {
      border-bottom-left-radius: inherit;
      border-bottom-right-radius: inherit;
      border-bottom-width: 0.0625em;
  }

  .dawa-autocomplete-suggestions .dawa-autocomplete-suggestion.dawa-selected,
  .dawa-autocomplete-suggestions .dawa-autocomplete-suggestion:hover {
      background: #f0f0f0;
  }

`
const mapStateToProps = (state, ownProps) => {
  return {
      checkoutUserInfo: state.orders.currentCheckout.userInfo,
      currentCheckout: state.orders.currentCheckout,
      deliveries: state.deliveries.list,
      packages: state.commons.packages
  }
}

export default connect(
  mapStateToProps,
  { adminUpdateCheckout, packagesFind }
)(ClientInfo)