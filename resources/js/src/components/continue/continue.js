import React from 'react';
import styled from 'styled-components';
import { withRouter } from 'react-router-dom'
import { ApplicationContext } from '../../stores/application-store';

const Continue = class Contine extends React.Component {
    constructor(props) {
        super(props)
    }
    static contextType = ApplicationContext;
    render() {
        return (
            <ContinueStyle show={true}>
                <button disabled={!this.props.canContinue} onClick={this.props.onContinue}>{this.context.continueText}</button>
            </ContinueStyle>
        )
    }
}
export default withRouter(Continue);

const ContinueStyle = styled.div`
    position: fixed;
    width: 100%;
    height: 100px;
    background-color: ${props => props.disabled ? '#ffffff' : '#f3f7fa'};
    color: ${props => props.disabled ? '#ffffff' : '#A1A4A6'};
    bottom: 0px;
    left: 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-top: 1px solid #c8d5dd;
    z-index: 100;
    transition: transform 0.5s ease-in-out;
    transition-delay: 0.5s;
    transform: ${props => props.show ? `translateY(0%)` : `translateY(100%)`};

    button {
        transition: all 0.5s ease-in-out;
        width: 400px;
        &:disabled, &button[disabled]{
            border: 1px solid #DDE5EC;
            background-color: #ffffff;
            color: #A1A4A6;
            &:hover {
                background-color: #ffffff;
            }
        }
        &:hover {
            background-color: #5997fc;
        }
    }
`