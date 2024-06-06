import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl, Button } from '@wordpress/components';
import { useState, useEffect } from 'react';
import apiFetch from '@wordpress/api-fetch';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { postsToShow, loadMoreText } = attributes;
    const [posts, setPosts] = useState([]);
    const [page, setPage] = useState(1);
    const [isLoading, setIsLoading] = useState(false);
    const [hasMorePosts, setHasMorePosts] = useState(true);
    const blockProps = useBlockProps();

    useEffect(() => {
        fetchPosts(1);
    }, []);

    const fetchPosts = (page) => {
        setIsLoading(true);
        apiFetch({
            path: `/wp/v2/posts?_embed&per_page=${postsToShow}&page=${page}`,
        }).then((newPosts) => {
            if (newPosts.length < postsToShow) {
                setHasMorePosts(false);
            }
            setPosts((prevPosts) => [...prevPosts, ...newPosts]);
            setIsLoading(false);
        }).catch(() => {
            setHasMorePosts(false);
            setIsLoading(false);
        });
    };

    const loadMorePosts = () => {
        const nextPage = page + 1;
        setPage(nextPage);
        fetchPosts(nextPage);
    };

    const onChangePostsToShow = (value) => {
        setAttributes({ postsToShow: value });
        setPage(1);
        setPosts([]);
        setHasMorePosts(true);
        fetchPosts(1);
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Post Settings', 'create-block')}>
                    <RangeControl
                        label={__('Number of Posts to Show', 'create-block')}
                        value={postsToShow}
                        onChange={onChangePostsToShow}
                        min={1}
                        max={10}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <div className="posts">
                    <div className="posts__title">
                        <h3>{__('Latest Post', 'create-block')}</h3>
                    </div>
                    {posts.map((post) => (
                        <div key={post.id} className="posts__card">
                            {post._embedded['wp:featuredmedia']?.[0]?.source_url && (
                                <img className="posts__card__img" src={post._embedded['wp:featuredmedia'][0].source_url} alt={post.title.rendered} />
                            )}
                            <div className="posts__card__detail">
                                {post._embedded['wp:term']?.[0]?.[0] && (
                                    <span className="posts__card__tag">{post._embedded['wp:term'][0][0].name}</span>
                                )}
                                <h2>{post.title.rendered}</h2>
                                <div className="posts__card__author">
                                    <img src={post._embedded.author[0].avatar_urls['48']} alt={post._embedded.author[0].name} />
                                    <h3>{post._embedded.author[0].name}</h3>
                                    <p>{new Date(post.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
                {hasMorePosts ? (
                        <Button onClick={loadMorePosts} className="posts__btn" disabled={isLoading}>
                            {isLoading ? __('Loading...', 'create-block') : loadMoreText}
                        </Button>
                    ) : (
                        <p>{__('No more posts to load', 'create-block')}</p>
                    )}
            </div>
        </>
    );
}
