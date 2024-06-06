import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('create-block/banner', {
    title: __('Homepage - Banner', 'banner'),
    icon: 'smiley',
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
