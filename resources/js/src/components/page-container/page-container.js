import React from 'react';
import styled from 'styled-components';

const PageContainer = (props) => (
    <PageWrapper>
        <PageContainerStyle>{props.children}</PageContainerStyle>
    </PageWrapper>
)

export default PageContainer;

const PageWrapper = styled.div`
    display: flex;
    justify-content: center;
    align-items: center;
`

const PageContainerStyle = styled.div`
    width: 800px;
`