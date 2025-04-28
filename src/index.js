import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const withAriaLabelControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        if (props.name !== 'core/button') {
            return <BlockEdit {...props} />;
        }

        const { attributes, setAttributes } = props;
        const { ariaLabel, hideFromScreenReaders } = attributes;

        return (
            <>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Accessibility Settings', 'unbox')}
                        initialOpen={true}
                    >
                        <TextControl
                            label={__('ARIA Label', 'unbox')}
                            value={ariaLabel || ''}
                            onChange={(value) => setAttributes({ ariaLabel: value })}
                            help={__('Add a descriptive label for screen readers', 'unbox')}
                        />
                        <ToggleControl
                            label={__('Hide from Screen Readers', 'unbox')}
                            checked={hideFromScreenReaders || false}
                            onChange={(value) => setAttributes({ hideFromScreenReaders: value })}
                            help={__('Toggle to hide this button from screen readers', 'unbox')}
                        />
                    </PanelBody>
                </InspectorControls>
            </>
        );
    };
}, 'withAriaLabelControls');

addFilter(
    'editor.BlockEdit',
    'unbox-button-aria-labels/with-aria-label-controls',
    withAriaLabelControls
);

const addAriaLabelAttributes = (settings, name) => {
    if (name !== 'core/button') {
        return settings;
    }

    return {
        ...settings,
        attributes: {
            ...settings.attributes,
            ariaLabel: {
                type: 'string',
                default: '',
            },
            hideFromScreenReaders: {
                type: 'boolean',
                default: false,
            },
        },
    };
};

addFilter(
    'blocks.registerBlockType',
    'unbox-button-aria-labels/add-aria-label-attributes',
    addAriaLabelAttributes
);

// Modify the save function to add ARIA attributes to the inner a tag
const modifyButtonSave = (element, blockType, attributes) => {
    if (blockType.name !== 'core/button') {
        return element;
    }

    const { ariaLabel, hideFromScreenReaders } = attributes;

    if (!ariaLabel && !hideFromScreenReaders) {
        return element;
    }

    // Clone the element to avoid mutating the original
    const newElement = { ...element };

    // Find the inner a tag and add ARIA attributes
    if (newElement.props && newElement.props.children) {
        const children = Array.isArray(newElement.props.children) 
            ? newElement.props.children 
            : [newElement.props.children];

        newElement.props.children = children.map(child => {
            if (child && child.props && child.props.className && child.props.className.includes('wp-block-button__link')) {
                return {
                    ...child,
                    props: {
                        ...child.props,
                        'aria-label': ariaLabel || undefined,
                        'aria-hidden': hideFromScreenReaders ? 'true' : undefined
                    }
                };
            }
            return child;
        });
    }

    return newElement;
};

addFilter(
    'blocks.getSaveElement',
    'unbox-button-aria-labels/modify-button-save',
    modifyButtonSave
); 