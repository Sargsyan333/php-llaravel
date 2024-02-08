import React from 'react';
import styled from 'styled-components';

export default class SkeeSelect extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            open: false,
            selectedValue: ''
        }
    }
    selectOption(e) {
        this.setState({
            selectedValue: e.name,
            open: false
        });
        this.props.onChange(e.value)
    }
    toggleSelect = () => {
        this.setState({
            open: !this.state.open
        })
    }

    render() {
        return (
            <SkeeSelectStyle open={this.state.open}>
                <div className="selected-value" onClick={this.toggleSelect}>
                    {this.state.selectedValue !== '' ? this.state.selectedValue : this.props.placeholder}
                    <span className="arrow" />
                </div>
                <div className="drop-down">
                    <ul>
                        {this.props.values.map((e, i) => {
                            return (
                                <li onClick={() => this.selectOption(e)} key={i}>{e.name}</li>
                            )
                        })}
                    </ul>
                </div>
                <input type="hidden" value={this.state.selectedValue} onChange={this.props.onChange} />
            </SkeeSelectStyle>
        )
    }
}

const SkeeSelectStyle = styled.div`
    position: relative;
    div.drop-down {
        position: relative;
        min-height: ${props => props.open ? '380px' : '0px'};
        transition: all ease-in-out 0.4s;
    }
    div.selected-value {
        padding: 20px 15px;
        font-size: 15px;
        color: #414b56;
        min-width: 340px;
        margin: 5px 0px;
        border: 1px solid #DDE5EC;
        background-color: #ffffff;
        position: relative;
        cursor: pointer;
        .arrow {
            background-image: url(images/arrow.svg);
            width: 14px;
            display: block;
            height: 9px;
            background-repeat: no-repeat;
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%) ${props => props.open ? 'rotate(180deg)' : 'rotate(0)'};
            background-size: contain;
            transition: ease-in-out 0.4s transform;
        }

    }
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
        border: 1px solid #DDE5EC;
        background-color: #ffffff;
        position: absolute;
        top: -6px;
        width: calc(100% - 2px);
        max-height: ${props => props.open ? '380px' : '0px'};
        transition: all ease-in-out 0.4s;
        overflow-y: scroll;
        visibility: ${props => props.open ? 'visible' : 'hidden'};
        li {
            padding: 20px 15px;
            border-bottom: 1px solid #DDE5EC;
            background-color: #ffffff;
            &:last-child {
                border: none;
            }
            &:hover {
                background-color: #eeeeee;
                cursor: pointer;
            }
        }
    }
`