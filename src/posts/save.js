import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { title, description, recommendedImageSize } = attributes;
    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps} className='posts'>
            <div class="posts__box">
                <h4>{title}</h4>
                <p>{description}</p>
                <span>{recommendedImageSize}</span>
            </div>
        </div>
    );
}
