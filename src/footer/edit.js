import { useState } from '@wordpress/element';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';

const Edit = ({ attributes, setAttributes }) => {
    const {
        aboutTitle,
        aboutDescription,
        emailLabel,
        email,
        phoneLabel,
        phone,
        menuLabel1,
        menu1,
        menuLabel2,
        menu2,
        newsletterTitle,
        newsletterDescription,
        newsletterEmail,
        newsletterButtonLabel,
        footerBottomCopyright,
        FooterBottomMenu
    } = attributes;
    const blockProps = useBlockProps();

    const [emailValue, setEmailValue] = useState(email);
    const [phoneValue, setPhoneValue] = useState(phone);
    const [menu1Value, setMenu1Value] = useState(menu1);
    const [menu2Value, setMenu2Value] = useState(menu2);

    const onChangeEmail = ( newValue ) => {
        setAttributes({ email: newValue });
        setEmailValue(newValue);
    };

    const onChangePhone = ( newValue ) => {
        setAttributes({ phone: newValue });
        setPhoneValue(newValue);
    };

    const onChangeMenu1 = ( newValue ) => {
        setAttributes({ menu1: newValue });
        setMenu1Value(newValue);
    };

    const onChangeMenu2 = ( newValue ) => {
        setAttributes({ menu2: newValue });
        setMenu2Value(newValue);
    };

    const handleSubscribe = () => {
        // Implement subscription logic here
        alert(`Subscribing email: ${newsletterEmail}`);
    };

    return (
        <Fragment>
            <InspectorControls>
                <PanelBody title={ __( 'About', 'custom-sections-block' ) }>
                    <TextControl
                        label={ __( 'Title', 'custom-sections-block' ) }
                        value={ aboutTitle }
                        onChange={ ( newValue ) => setAttributes({ aboutTitle: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Title', 'custom-sections-block' ) }
                        value={ aboutDescription }
                        onChange={ ( newValue ) => setAttributes({ aboutDescription: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Email Label', 'custom-sections-block' ) }
                        value={ emailLabel }
                        onChange={ ( newValue ) => setAttributes({ emailLabel: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Email', 'custom-sections-block' ) }
                        value={ emailValue }
                        onChange={ onChangeEmail }
                    />
                     <TextControl
                        label={ __( 'Phone Label', 'custom-sections-block' ) }
                        value={ phoneLabel }
                        onChange={ ( newValue ) => setAttributes({ phoneLabel: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Phone', 'custom-sections-block' ) }
                        value={ phoneValue }
                        onChange={ onChangePhone }
                    />
                </PanelBody>
                <PanelBody title={ __( 'Menu 1', 'custom-sections-block' ) }>
                    <TextControl
                        label={ __( 'Title', 'custom-sections-block' ) }
                        value={ menuLabel1 }
                        onChange={ ( newValue ) => setAttributes({ menuLabel1: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Menu', 'custom-sections-block' ) }
                        value={ menu1Value }
                        onChange={ onChangeMenu1 }
                    />
                </PanelBody>
                <PanelBody title={ __( 'Menu 2', 'custom-sections-block' ) }>
                    <TextControl
                        label={ __( 'Title', 'custom-sections-block' ) }
                        value={ menuLabel2 }
                        onChange={ ( newValue ) => setAttributes({ menuLabel2: newValue }) }
                    />
                    <TextControl
                        label={ __( 'Menu', 'custom-sections-block' ) }
                        value={ menu2Value }
                        onChange={ onChangeMenu2 }
                    />
                </PanelBody>
            </InspectorControls>
            <InspectorControls>
            <PanelBody title={ __( 'Newsletter', 'custom-sections-block' ) }>
                <TextControl
                    label={ __( 'Title', 'custom-sections-block' ) }
                    value={ newsletterTitle }
                    onChange={ ( newValue ) => setAttributes({ newsletterTitle: newValue }) }

                />
                <TextControl
                    label={ __( 'Description', 'custom-sections-block' ) }
                    value={ newsletterDescription }
                    onChange={ ( newValue ) => setAttributes({ newsletterDescription: newValue }) }
                />
                <TextControl
                    label={ __( 'Email', 'custom-sections-block' ) }
                    value={ newsletterEmail }
                    onChange={ ( newValue ) => setAttributes({ newsletterEmail: newValue }) }
                />
                <Button isPrimary onClick={ handleSubscribe }>
                    { newsletterButtonLabel }
                </Button>
            </PanelBody>
            </InspectorControls>
            <InspectorControls>
            <PanelBody title={ __( 'Footer Bottom Section', 'custom-sections-block' ) }>
                <TextControl
                    label={ __( 'Copyright Text', 'custom-sections-block' ) }
                    value={ footerBottomCopyright }
                    onChange={ ( newValue ) => setAttributes({ footerBottomCopyright: newValue }) }

                />
                <TextControl
                    label={ __( 'Footer Menu Slug', 'custom-sections-block' ) }
                    value={ FooterBottomMenu }
                    onChange={ ( newValue ) => setAttributes({ FooterBottomMenu: newValue }) }
                />
            </PanelBody>
            </InspectorControls>
            <div {...blockProps}>

                <p>{aboutTitle}</p>
                <p>{aboutDescription}</p>
                <p>{emailLabel}</p>
                <p>{email}</p>
                <p>{phoneLabel}</p>
                <p>{phone}</p>
                <p>{menuLabel1}</p>
                <p>{menu1}</p>
                <p>{menuLabel2}</p>
                <p>{menu2}</p>
                <p>{newsletterDescription}</p>
                <p>{newsletterEmail}</p>
                <p>{newsletterButtonLabel}</p>
                <p>{newsletterTitle}</p>
                <p>{footerBottomCopyright}</p>
                <p>{FooterBottomMenu}</p>
            </div>
        </Fragment>
    );
};

export default Edit;
