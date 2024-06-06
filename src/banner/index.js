import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('create-block/banner', {
    title: __('My Banner', 'your-text-domain'),
    icon: 'dashicons-admin-settings',
    category: 'common',
    attributes: {
        selectValue: {
            type: 'string',
            default: 'option1'
        },
        posts: {
            type: 'array',
            default: []
        }
    },
    edit: Edit,
    save: Save,
});
