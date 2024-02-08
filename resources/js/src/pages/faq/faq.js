import React from "react";
import PageContainer from "../../components/page-container/page-container";
import styled from "styled-components";
import Accordion from "../../components/accordion/accordion";
import {Link} from "react-router-dom";
import { connect } from 'react-redux';
import { userFaqFind } from '../../actions/common';

class Faq extends React.Component {

  componentDidMount() {
    const { loaded } = this.props.faqs;
    if (!loaded) {
      this.props.userFaqFind();
    }
  }

  render() {

    const { faqs } = this.props;

    return (
      <div className="transition-item default-page">
        <PageContainer>
            <FaqStyle>
                <h1 className="text-center">Hjælp til bestilling</h1>
                <div className="text-center">Kontakt</div>
                <div className="description text-center">
                    Ring til os på telefon <a href="tel:57600528">57 60 05 28</a> eller<br />skriv til os på email <a href="mailto:">skeeis@skeeis.dk</a>
                </div>
                <div className="description text-center">
                    FAQ
                </div>
                <div>
                  {
                    faqs.list.map( item => 
                      <Accordion allowMultipleOpen={false}>
                          <div label={`${item.name}`}  >
                              <div>
                                  <div className="header">{`${item.name}`}</div>
                                  {`${item.text}`}
                              </div>
                          </div>
                      </Accordion>
                    )
                  }
                    <div className="text-center back-link">
                        <Link to="/product-list">Tilbage til bestilling</Link>
                    </div>
                </div>
            </FaqStyle>
        </PageContainer>
      </div>
    );
  }
}

const mapStateToProps = (state, ownProps) => {
    return {
      faqs: state.commons.faqs,
    }
  }
  
export default connect(
    mapStateToProps,
    { userFaqFind }
)(Faq)

const FaqStyle = styled.div`
    margin-top: 15px;
    margin-bottom: 150px;
    .description {
    margin-top: 30px;
    margin-bottom: 30px;
    line-height: 25px;
    }
    h1 {
        margin-bottom: 50px;
    }
    .header {
        font-weigth: 500;
    }
    .back-link {
        margin-top: 40px;
    }
`;
