import React from 'react';
import styled from 'styled-components';
import {withRouter, NavLink, Link} from 'react-router-dom'
import Authfunc from '../../functions/authfunc';
import { logout } from '../../actions/authActions';
import { logout as logoutApi} from '../../utils/ApiManager';
import { connect } from 'react-redux';
import { ApplicationContext } from '../../stores/application-store';

const Menu = class Menu extends React.Component {
    static contextType = ApplicationContext;

    logout = async () => {
        logoutApi(null);
        const { logout } = this.props;
        logout(null);
    }

    render() {
        return (
            <MenuStyle show={Authfunc.isUserAuthenticated()}>
                <div>
                    <Link to="/dashboard" className="no-color">Skee Ismejeri</Link>
                </div>
                <div className="menu">
                    <ul>
                        <li><NavLink to="/checkout/product-list/">Opret ordre</NavLink></li>
                        <li><NavLink to="/order-find">Find ordre</NavLink></li>
                        <li><NavLink to="/faq">Hjælp til bestilling</NavLink></li>
                    </ul>
                </div>
                <div>
                    <Link to="#" onClick={this.logout}>Log ud</Link>
                </div>
            </MenuStyle>
        )
    }
}

export default withRouter(
    connect(
        null,
        {
          logout
        }
    )(Menu)
);

const MenuStyle = styled.div`
    z-index: 100;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s all ease-in-out;
    transform: ${props => props.show ? `translateY(0%)` : `translateY(-100%)`};
    .no-color {
        color: #414b56;
    }
    div {
        &:first-child {
            padding-left: 40px;
        }
        &:last-child {
            padding-right: 40px;
        }
    }
    .menu {
        flex: 1;
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align: center;
            justify-content: center;
            li {
                margin: 0px 20px;
                a {
                    color: #414b56;
                    transition: color 0.5s ease-in-out;
                    &.active {
                        color: #4383FF;
                    }
                    &:hover {
                        color: #4383FF;
                    }
                }
            }
        }
    }
`