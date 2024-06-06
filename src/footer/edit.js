import { useState } from '@wordpress/element';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import './editor.scss';

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

            <div class="footer">
				<div class="footer__container">
					<div class="footer__about">
						<h2>{aboutTitle}</h2>
						<p>{aboutDescription}</p>
						<a href="#" class="footer__email"><span>{emailLabel} : </span>{email}</a>
						<a href="tel:%6$s" class="footer__phone"><span>{phoneLabel} : </span>{phone}</a>
					</div>
					<div class="footer__menu">
						<div class="footer__menu__link footer__menu__link--1">
							<h2>{menu1}</h2>
							{menu1Value}
						</div>
						<div class="footer__menu__link footer__menu__link--2">
							<h2>{menu2}</h2>
							{menu2Value}
						</div>
					</div>
					<div class="footer__subscribe">
						<form action="/submit-form" method="POST">
							<div class="footer__subscribe__top">
								<h2>{newsletterTitle}</h2>
								<p>{newsletterDescription}</p>
							</div>
							<div class="footer__subscribe__bottom">
								<input type="text" id="title" name="title" required />
								<button type="button" onclick="return false;">{newsletterButtonLabel}</button>
							</div>
						</form>
					</div>

					<div class="footer__copyright">
						<div class="footer__copyright__left">
							<img src="%16$s" />
							<div class="footer__copyright__description">
								<h3>MyBlog</h3>
								<span>{footerBottomCopyright}</span>
							</div>
						</div>
						<div class="footer__copyright__right">
							<nav>
							{FooterBottomMenu}
							</nav>

						</div>
					</div>
				</div>
			</div>
            </div>
        </Fragment>
    );
};

export default Edit;
