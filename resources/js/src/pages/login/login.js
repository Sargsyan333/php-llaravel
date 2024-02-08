import React from 'react';

import styled from 'styled-components';
import {Link} from "react-router-dom";
import SkeeInput from "../../components/skee-input/skee-input";
import { login } from '../../actions/authActions'
import { connect } from 'react-redux'
import { ApplicationContext } from '../../stores/application-store';

class Login extends React.Component {
    static contextType = ApplicationContext;

    state = {
        email: '',
        password: '',
        firstLogin: true,
        loginFailed: true
    };

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevProps.loading === true && this.props.loading === false) {
          if (this.props.error) {
              this.setState({ loginFailed: true });
          } else {
            this.setState({ loginFailed: false });
            this.props.history.push('/dashboard');
          }
        }
    }

    handleChange = (type, value) => {
        this.setState({
            [type]: value
        })
    };

    login = async () => {
        const { login } = this.props;
        this.setState({ firstLogin: false });
        login({email: this.state.email, password: this.state.password});
    };

    render() {
        const { loading } = this.props
        console.log('AUTH firstLogin ', this.state.firstLogin);
        console.log('AUTH loginFailed ', this.state.loginFailed);
        return (
            <div className="transition-item login-page">
                <LoginContainer>
                    <LoginWrapper>
                        <div>Skee Ismejeri ApS</div>
                        <h1>Log ind</h1>
                        <p className="form-text">Indtast email og den adgangskode som du har modtaget på email for at logge ind.</p>
                        {
                            (!this.state.firstLogin && this.state.loginFailed)?
                                <span style={{ color: "red" }}>Ugyldig email eller kodeord</span>:null
                        }
                        <SkeeInput onChange={e => this.handleChange('email', e.target.value)} placeholder="E-mail" value={this.state.email} />
                        <SkeeInput onChange={e => this.handleChange('password', e.target.value)} placeholder="Kode" type="password" value={this.state.password} />
                        <div className="cta-wrapper">
                            <button onClick={this.login} disabled={loading}>Log ind</button> <Link to="/reset-password">Glemt adgangskode</Link>
                        </div>
                        <h3 className="help-text">Problemer med login?</h3>
                        <p className="help-text">
                            Ring til os på telefon 57 60 05 28 eller skriv til os på e-mail <a href="mailto:skeeis@skeeis.dk">skeeis@skeeis.dk</a>
                        </p>
                    </LoginWrapper>
                </LoginContainer>
            </div>
        )
    }
}

const LoginContainer = styled.div`
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
`

const LoginWrapper = styled.div `
    width: 400px;
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

const mapStateToProps = (state, ownProps) => {
    return {
      loading: state.auth.loading,
      signedUp: state.auth.signedUp,
      error: state.auth.error
    }
 }

export default connect(
    mapStateToProps,
    {
      login
    }
)(Login)
