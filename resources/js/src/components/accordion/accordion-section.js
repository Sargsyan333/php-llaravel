import React, { Component } from "react";
import PropTypes from "prop-types";
import styled from "styled-components";

class AccordionSection extends Component {
    /* static propTypes = {
    children: PropTypes.instanceOf(Object).isRequired,
    isOpen: PropTypes.bool.isRequired,
    label: PropTypes.string.isRequired,
    onClick: PropTypes.func.isRequired,
  }; */
    constructor(props) {
        super(props);
        this.sectionRef = React.createRef();
        this.state = {
            height: 8000,
            domLoaded: false
        }
    }

    onClick() {
        this.props.onClick(this.props.label);
    }

    getHeight() {
        this.setState({height:this.sectionRef.current.clientHeight, domLoaded: true});
    }

    componentDidMount() {
        setTimeout(()=>{
            this.getHeight();
        }, 200)
    }

    render() {
        const {
            props: { isOpen, label }
        } = this;

        return (
            <SectionStyle isOpen={isOpen}>
                <div
                    onClick={() => this.onClick()}
                    style={{ cursor: "pointer" }}
                >
                    <div className="faq-title">
                        <div className="label-text"><span className="icon-down"></span> {label}</div>
                        <SectionWrapper className="sectionwrapper" isLoaded={this.state.domLoaded} style={{maxHeight: this.state.domLoaded ? isOpen ? this.state.height : 0 : this.state.height }} ref={this.sectionRef}>{this.props.children}</SectionWrapper>
                    </div>
                    
                </div>
            </SectionStyle>
        );
    }
}

export default AccordionSection;

const SectionWrapper = styled.div`
    overflow: hidden;
    transition: max-height 0.2s;
    & > div {
        padding-top: 30px;
        line-height: 25px;
        .header {
            font-weight: 600;
        }
    }
`

const SectionStyle = styled.div`
    margin-bottom: 10px;
    padding: 0;
    div.faq-title {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,0.05);
        background-color: #ffffff;
        padding: 25px 10px 25px 25px;
        transition: ease-in-out 0.2s all;
        cursor: pointer;
        position: relative;
        .label-text {
            transition: color 0.2s ease-in-out;
            &:hover {
                color: #4383FF;
            }
        }
        span {
            position: absolute;
            width: 10px;
            height: 10px;
            display: block;
            right: 0px;
            top: 0px;
            height: 30px;
            height: 69px;
            width: 60px;
            &::before {
                position: absolute;
                content: '';
                background-color: #000000;
                height: 3px;
                width: 18px;
                display: block;
                top: 32px;
                left: 20px;
            }
            &::after {
                position: absolute;
                content: '';
                background-color: #000000;
                height: 3px;
                width: 18px;
                display: block;
                top: 32px;
                left: 20px;
                transition: transform 0.2s ease-in-out;
                transform: ${props => !props.isOpen ? 'rotate(90deg)' : 'rotate(0deg)'};
            }
        }
    }
`;
