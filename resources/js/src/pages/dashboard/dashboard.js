import React from "react";
import { connect } from 'react-redux';

import PageContainer from "../../components/page-container/page-container";
import styled from "styled-components";
import { ApplicationContext } from "../../stores/application-store";
import Contact from "../../components/contact/contact";

class Dashboard extends React.Component {
  static contextType = ApplicationContext;
  render() {
    const { currentUser } = this.props;
    return (
      <div className="transition-item default-page">
        <PageContainer>
            <DashboardStyle>
                <h1 className="text-center">Velkommen <b>{currentUser.name}</b></h1>
                <div className="description text-center">
                    Opret ny ordre, find eksisterende ordre eller søg information i vores FAQ.
                </div>
                <div className="dash-buttons">
                    <div className="dash-box" onClick={()=>this.props.history.push('/checkout/product-list')}>
                        <div className="title">Opret ordre</div>
                        <div className="info">Tilføj varer til ordre, udfyld kunde information og send ordre</div>
                    </div>
                    <div className="dash-box" onClick={()=>this.props.history.push('/order-find')}>
                        <div className="title">Find ordre</div>
                        <div className="info">Liste over eksisterende ordre og forsendelsesstatus</div>
                    </div>
                    <div className="dash-box" onClick={()=>this.props.history.push('/faq')}>
                        <div className="title">FAQ</div>
                        <div className="info">Find hjælp til bestilling, løs om proteinberiget is, forsendelse, returret mv.</div>
                    </div>
                </div>
                <Contact />
            </DashboardStyle>
        </PageContainer>
      </div>
    );
  }
}

const DashboardStyle = styled.div`
    margin-top: 15px;
    margin-bottom: 150px;
    padding-top: 50px;
    h1 {
        font-weight: 100;
    }
    .description {
        margin-top: 40px;
        font-style: italic;
        font-weight: 100;
    }
    .dash-buttons {
        margin-top: 70px;
        display: flex;
        .dash-box {
            background: #FFFFFF;
            border: 1px solid #E8E9ED;
            box-shadow: 0 1px 6px 0 rgba(0,0,0,0.05);
            margin: 0px 15px;
            padding: 20px;
            flex-grow: 1;
            flex-basis: 0;
            transition: all ease-in-out 0.4s;
            cursor: pointer;
            .title {
                font-size: 22px;
                margin-bottom: 10px;
            }
            .info {
                color: #9B9B9B;
                font-size: 14px;
                font-weight: 100;
            }
            &:hover {
                color: #4886fb;
                border: 1px solid #4886fb;
            }
        }
    }
`;

const mapStateToProps = (state, ownProps) => {
    return {
        currentUser: state.auth.user
    }
}

export default connect(mapStateToProps, null)(Dashboard)
