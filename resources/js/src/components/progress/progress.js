import React from 'react';
import styled from 'styled-components';
import {withRouter} from 'react-router-dom';
import {ApplicationContext} from '../../stores/application-store';

const Progress = class extends React.Component {
    static contextType = ApplicationContext;
    showProgress = () => {
        let arr = ['/product-list', '/client-info', '/confirm-order', '/order-confirm']
        return arr.indexOf(this.props.location.pathname) > -1
    }
    render() {
        return (
            <ProgressStyle progress={this.context.progress} show={this.showProgress()}>
                <div className="progress-bar"></div>
            </ProgressStyle>
        )
    }
}

export default withRouter(Progress);

const ProgressStyle = styled.div`
    width: 100%;
    background-color: #dfe9f0;
    position: absolute;
    top: 50px;
    height: 5px;
    transition: opacity 0.5s ease-in-out;
    opacity: ${props => props.show ? '1' : '0'};
    .progress-bar {
        width: ${props=>props.progress ? props.progress : '0'}%;
        transition: width 0.5s ease-in-out;
        height: 5px;
        postion: absolute;
        left: 0px;
        top: 0px;
        background-color: #bbd1dc;
    }
`