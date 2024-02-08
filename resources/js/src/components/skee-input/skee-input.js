import React from 'react';
import styled from 'styled-components';
import StyleVariables from "../../style-variables";

const SkeeInput = (props) => {
    return (
        <SkeeInputStyle {...props} defaultValue={props.defaultValue} placeholder={props.placeholder} type={props.type ? props.type : 'text'} />
    )
};

export default SkeeInput

const SkeeInputStyle = styled.input`
    padding: 20px 15px;
    font-size: 15px;
    color: ${StyleVariables.defaultFontColor};
    min-width: 340px;
    margin: 5px 0px;
    border: 1px solid #DDE5EC;
`