import { __ } from '@wordpress/i18n';

const Save = ({ attributes }) => {
    const { selectValue, posts } = attributes;
    const selectedPost = posts && selectValue ? posts.find(post => post.id.toString() === selectValue) : null;

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
        <div>
            {selectedPost ? (
                <div>
                    <h2>{postTitle}</h2>
                    <p>by <a href={authorLink}>{authorName}</a></p>
                    <p>{publishedDate}</p>
                    <div dangerouslySetInnerHTML={{ __html: postExcerpt }} />
                    {firstTag && <div>Tag: {firstTag}</div>}
                </div>
            ) : (
                <p>{__('No post selected.', 'create-block')}</p>
            )}
        </div>
    );
};

export default Save;
