import React from 'react';
import AccordionSection from './accordion-section';
import PropTypes from 'prop-types';

const Accordion = class Accordion extends React.Component {

    constructor(props) {
        super(props);

        const openSections = {};

        React.Children.forEach(this.props.children, (child, i) => {
            if (child.props.isOpen) {
                openSections[child.props.label] = true;
            }
        });
      
        this.state = { openSections };
    }

    onClick (label) {
        const {
          props: { allowMultipleOpen },
          state: { openSections },
        } = this;
    
        const isOpen = !!openSections[label];
    
        if (allowMultipleOpen) {
          this.setState({
            openSections: {
              ...openSections,
              [label]: !isOpen
            }
          });
        } else {
          this.setState({
            openSections: {
              [label]: !isOpen
            }
          });
        }
      };

      render() {
        const {
          props: { children },
          state: { openSections },
        } = this;
    
        return (
          <div>
            {React.Children.map(children, (child)=>{
                return(<AccordionSection
                isOpen={!!openSections[child.props.label]}
                label={child.props.label}
                onClick={(label) => this.onClick(label)}
              >
                {child.props.children}
              </AccordionSection>)
            })}
          </div>
        );
      }
}

Accordion.propTypes = {
    allowMultipleOpen: PropTypes.bool,
    children: PropTypes.instanceOf(Object).isRequired,
};

export default Accordion;