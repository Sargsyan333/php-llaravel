import React from 'react';
import styled from 'styled-components';
import {Link} from 'react-router-dom';

const Contact = () => (
    <ContactStyle>
        <div className="contact-info text-center">
            <div className="company-name">Skee Ismejeri ApS</div>
            <div>
                Vi er til rådighed på telefon 57 60 05 28 <br />
                mandag - fredag, kl 09.00 - 15.00
            </div>
        </div>
        <div className="icon-links">
            <div className="icon-wrapper">
                <div className="icon">
                    <img src="/images/faq.png" alt=""/>
                </div>
                <div className="icon-text">
                    <Link to="/faq">FAQ</Link>
                </div>
            </div>
            <div className="icon-wrapper">
                <div className="icon">
                    <img src="/images/email.png" alt=""/>
                </div>
                <div className="icon-text">
                    <a href="mailto:skeeis@skeeis.dk">Email</a>
                </div>
            </div>
            
        </div>
    </ContactStyle>
)

export default Contact

const ContactStyle = styled.div`
.contact-info {
    .company-name {
        font-size: 20px;
        margin-bottom: 20px;
    }
    line-height: 25px;
    margin-top: 100px;
}
.icon-links {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    .icon-wrapper {
        margin: 0px 20px;
        .icon-text {
            margin-top: 5px;
            text-align: center;
        }
    }
    .icon {
        text-align: center;
        img {
            height: 25px;
        }
    }
}
`