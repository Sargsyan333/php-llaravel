import React from 'react';
import styled from "styled-components";
import { ApplicationContext } from "../../stores/application-store";
import {Link} from "react-router-dom";
import SkeeInput from "../../components/skee-input/skee-input";
import { recover } from "../../functions/api";

export default class ResetPassword extends React.Component {

    state = {
        email: ''
    };

    resetPassword = async () => {
        await recover({ email: this.state.email });

        this.props.history.push('/login');
    };

    handleChange = (type, value) => {
        this.setState({
            [type]: value
        })
    };

    render() {
        return (
            <div className="transition-item login-page">
                <ResetPasswordStyle>
                    <ResetPasswordWrapper>
                        <h1>Reset password</h1>
                        <p className="form-text">Har du glemt din adgangskode? Indtast din email og modtag en ny adgangskode.</p>
                        <SkeeInput onChange={e => this.handleChange('email', e.target.value)} placeholder="E-mail" value={this.state.email} />
                        <div className="cta-wrapper">
                            <button onClick={this.resetPassword}>Send kode</button>
                        </div>
                    </ResetPasswordWrapper>
                </ResetPasswordStyle>
            </div>
        )
    }
}


const ResetPasswordStyle = styled.div`
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
`

const ResetPasswordWrapper = styled.div `
    width: 450px;
    h1 {
        margin-top: 20px;
    }
    h3 {
        &.help-text {
            margin-top: 60px;
        }
    }
    p {
        margin-bottom: 30px;
        &.form-text {
            margin-top: 15px;
        }
    }
    .cta-wrapper {
        margin-top: 15px;
        a {
            margin-left: 15px;
        }
    }
`