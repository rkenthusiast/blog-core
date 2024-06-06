import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { title, description, recommendedImageSize } = attributes;
    const blockProps = useBlockProps();

    const onChangeTitle = (value) => {
        setAttributes({ title: value });
    };

    const onChangeDescription = (value) => {
        setAttributes({ description: value });
    };

    const onChangeRecommendedImageSize = (value) => {
        setAttributes({ recommendedImageSize: value });
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Banner Settings', 'create-block')}>
                    <TextControl
                        label={__('Title', 'create-block')}
                        value={title}
                        onChange={onChangeTitle}
                    />
                    <TextControl
                        label={__('Description', 'create-block')}
                        value={description}
                        onChange={onChangeDescription}
                    />
                    <TextControl
                        label={__('Recommended Image Size', 'create-block')}
                        value={recommendedImageSize}
                        onChange={onChangeRecommendedImageSize}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <div className='advertisement'>
                    <div class="advertisement__box">
                        <h4>{title}</h4>
                        <p>{description}</p>
                        <span>{recommendedImageSize}</span>
                    </div>
                </div>
            </div>
        </>
    );
}
