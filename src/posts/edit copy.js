import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { sectionTitle, numberOfPosts, viewMoreText } = attributes;
    const blockProps = useBlockProps();

    const onChangeSectionTitle = (value) => {
        setAttributes({ sectionTitle: value });
    };

    const onChangeNumberOfPosts = (value) => {
        setAttributes({ numberOfPosts: value });
    };

    const onChangeViewMorePosts = (value) => {
        setAttributes({ viewMoreText: value });
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Banner Settings', 'create-block')}>
                    <TextControl
                        label={__('Section Title', 'create-block')}
                        value={sectionTitle}
                        onChange={onChangeSectionTitle}
                    />

                    <RangeControl
                        help={__('Select Number of Posts', 'create-block')}
                        initialPosition={numberOfPosts}
                        label={__('Number of Posts', 'create-block')}
                        max={100}
                        min={0}
                        onChange={onChangeNumberOfPosts}
                    />

                    <TextControl
                        label={__('View More Text', 'create-block')}
                        value={viewMoreText}
                        onChange={onChangeViewMorePosts}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <div class="posts">
                    <div class="posts__title">
                        <h3>{sectionTitle} {numberOfPosts}</h3>
                    </div>
                    <div class="posts__card">
                        <img class="posts__card__img" src="<?php echo get_template_directory_uri() ?>/assets/images/img-01.jpeg" alt="" />
                            <div class="posts__card__detail">
                                <span class="posts__card__tag">Technology</span>
                                <h2>The Impact of Technology on the Workplace: How Technology is Changing</h2>
                                <div class="posts__card__author">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/logo-1.jpeg" alt="" />
                                        <h3>Jason Francisco</h3>
                                        <p>August 20,2022</p>
                                </div>
                            </div>
                    </div>

                    <button class="posts__btn">{viewMoreText}</button>
                </div>
            </div>
        </>
    );
}
