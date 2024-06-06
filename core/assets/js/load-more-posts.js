jQuery(document).ready(function ($) {
    $(document).on('click', '.posts__btn', function (e) {
        e.preventDefault();

        var button = $(this);
        var page = button.data('page');
        var postsToShow = button.data('poststoshow');
        var totalPosts = $('.posts').data('total-posts');
        var postsDisplayed = $('.posts__card').length;

        if (postsDisplayed >= totalPosts) {
            button.remove();
            return;
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: page,
                postsToShow: postsToShow,
            },
            beforeSend: function () {
                button.text('Loading...').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $('.posts').append(response.data);
                    button.data('page', page + 1);

                    if ($('.posts__card').length >= totalPosts) {
                        button.remove();
                    } else {
                        button.text('View All Post').prop('disabled', false);
                    }
                } else {
                    button.text('No more posts').prop('disabled', true);
                }
            },
            error: function () {
                button.text('Error').prop('disabled', true);
            }
        });
    });
});
