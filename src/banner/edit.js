import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { SelectControl, PanelBody } from '@wordpress/components';
import { withSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import './editor.scss';

const Edit = withSelect((select) => {
    return {
        posts: select('core').getEntityRecords('postType', 'post', { per_page: -1 })
    };
})(({ attributes, setAttributes, posts }) => {
    const { selectValue } = attributes;

    const onChangeSelect = (newSelectValue) => {
        setAttributes({ selectValue: newSelectValue });
    };

    const selectedPost = posts && selectValue ? posts.find(post => post.id.toString() === selectValue) : null;

    const blockProps = useBlockProps();
    const options = posts ? posts.map(post => ({
        label: post.title.rendered,
        value: post.id.toString()
    })) : [];

    const authorName = selectedPost && selectedPost._embedded && selectedPost._embedded.author[0].name;
    const authorLink = selectedPost && selectedPost._embedded && selectedPost._embedded.author[0].link;
    const publishedDate = selectedPost && new Date(selectedPost.date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    const postTitle = selectedPost && selectedPost.title.rendered;
    const postExcerpt = selectedPost && selectedPost.excerpt.rendered;
    const firstTag = selectedPost && selectedPost.tags.length > 0 ? selectedPost.tags[0] : null;

    return (
        <Fragment>
            <InspectorControls>
                <PanelBody title={__('Select Post', 'create-block')}>
                    <SelectControl
                        label={__('Select an option', 'create-block')}
                        value={selectValue}
                        options={options}
                        onChange={onChangeSelect}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                {selectedPost ? (
                    <div class="hero">
                        <div class="hero__card">
                            {firstTag && <div class="hero__card__tag">
                                {firstTag}
                            </div>}
                            <div className='"hero__card__title"'>
                                {postTitle}
                                </div>
                            <div class="hero__card__author">
                                <img src="" alt="" />
                                    <h3>{authorName}</h3>
                                    <p>{publishedDate}</p>
                            </div>
                        </div>
                    </div>
                ) : (
                    <p>{__('Please select a post.', 'create-block')}</p>
                )}
            </div>
        </Fragment>
    );
});

export default Edit;
