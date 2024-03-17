import { __ } from '@wordpress/i18n';

import { horizontalLineIcon, verticalLineIcon } from './icons';

export const layouts = [
	{ label: __('Vertical', 'store-finder'), value: 'vertical', icon: verticalLineIcon },
	{ label: __('Horizontal', 'store-finder'), value: 'horizontal', icon: horizontalLineIcon }
];

export const generalStyleTabs = [
	{ name: 'general', title: __('General', 'store-finder') },
	{ name: 'style', title: __('Style', 'store-finder') }
];