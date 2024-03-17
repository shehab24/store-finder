import { AlignmentToolbar, BlockControls, InspectorControls } from '@wordpress/block-editor';
import { CheckboxControl, Dashicon, PanelBody, PanelRow, RadioControl, SelectControl, TabPanel, ToggleControl, ToolbarButton, ToolbarGroup, __experimentalUnitControl as UnitControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { produce } from 'immer';
import { useState } from 'react';

// Settings Components
import { BColor, Background, BorderControl, ColorsControl, Label, MultiShadowControl, SeparatorControl, SpaceControl, Typography } from '../../Components';
import { tabController } from '../../Components/utils/functions';
import { emUnit, perUnit, pxUnit } from '../../Components/utils/options';

import { TextControl } from '@wordpress/components';
import { generalStyleTabs, layouts } from './utils/options';

const Settings = ({ attributes, setAttributes, updateItem, activeIndex, setActiveIndex }) => {
	const { items, columns, columnGap, rowGap, layout, alignment, textAlign, width, background, typography, color, colors, isIcon, icon, img, separator, padding, margin, border, shadow, storeDetails } = attributes;

	const [device, setDevice] = useState('desktop');

	const addItem = () => {
		setAttributes({
			items: [...items, {
				number: 10,
				text: 'Vertical'
			}]
		});
		setActiveIndex(items.length);
	}

	const updateAllItem = (type, val, otherType = false) => {
		const newItems = [...items];

		newItems.map((item, index) => {
			if (otherType) {
				newItems[index][type][otherType] = val;
			} else {
				newItems[index][type] = val;
			}
		});
		setAttributes({ items: newItems });
	}

	const duplicateItem = e => {
		e.preventDefault();

		setAttributes({ items: [...items.slice(0, activeIndex), { ...items[activeIndex] }, ...items.slice(activeIndex)] });

		setActiveIndex(activeIndex + 1);
	}

	const removeItem = e => {
		e.preventDefault();

		setAttributes({ items: [...items.slice(0, activeIndex), ...items.slice(activeIndex + 1)] });

		setActiveIndex(0 === activeIndex ? 0 : activeIndex - 1);
	}



	return <>
		<InspectorControls>

			<TabPanel className='bPlTabPanel' activeClass='activeTab' tabs={generalStyleTabs} onSelect={tabController}>{tab => <>
				{'general' === tab.name && <>
					<PanelBody className='bPlPanelBody addRemoveItems editItem' title={__('Add or Remove Items', 'store-finder')}>
						<TextControl label={__('Store Name:', 'store-finder')} value={storeDetails.storeName} onChange={val => updateItem('storeDetails', 'storeName', val)} />
						<TextControl label={__('Store Address:', 'store-finder')} value={storeDetails.storeAddress} onChange={val => updateItem('storeDetails', 'storeAddress', val)} />
						<TextControl label={__('Store Mobile:', 'store-finder')} value={storeDetails.storeMobile} onChange={val => updateItem('storeDetails', 'storeMobile', val)} />
						<TextControl label={__('Store Email:', 'store-finder')} value={storeDetails.storeEmail} onChange={val => updateItem('storeDetails', 'storeEmail', val)} />


					</PanelBody>


					<PanelBody className='bPlPanelBody' title={__('Component Settings', 'store-finder')} initialOpen={false}>
						<ToggleControl label={__('Toggle?', 'store-finder')} checked={isIcon} onChange={val => setAttributes({ isIcon: val })} />

						<CheckboxControl className='mt20' label={__('Toggle?', 'store-finder')} checked={isIcon} onChange={val => setAttributes({ isIcon: val })} />

						<PanelRow>
							<Label mt='0' mb='0'>{__('Layout:', 'store-finder')}</Label>
							<SelectControl value={layout} onChange={val => {
								setAttributes({ layout: val });
								'vertical' === val && updateAllItem('number', 10);
								'horizontal' === val && updateAllItem('number', 20);
							}} options={layouts} />
						</PanelRow>
						<small>{__('Some settings may change when layout will be changed.', 'store-finder')}</small>

						<PanelRow>
							<Label mt='0' mb='0'>{__('Layout:', 'b-blocks')}</Label>
							<RadioControl selected={layout} onChange={val => setAttributes({ layout: val })} options={layouts} />
						</PanelRow>

						<UnitControl className='mt20' label={__('Width:', 'store-finder')} labelPosition='left' value={width} onChange={val => setAttributes({ width: val })} units={[pxUnit(900), perUnit(100), emUnit(56)]} isResetValueOnUnitChange={true} />
						<small>{__('Keep width 0, to auto width.', 'store-finder')}</small>
					</PanelBody>


				</>}


				{'style' === tab.name && <>
					<PanelBody className='bPlPanelBody' title={__('Custom Style', 'store-finder')}>
						<Background label={__('Background:', 'store-finder')} value={background} onChange={val => setAttributes({ background: val })} />

						<Typography className='mt20' label={__('Typography:', 'store-finder')} value={typography} onChange={val => setAttributes({ typography: val })} defaults={{ fontSize: 25 }} produce={produce} />

						<BColor label={__('Color:', 'store-finder')} value={color} onChange={val => setAttributes({ color: val })} defaultColor='#333' />

						<ColorsControl value={colors} onChange={val => setAttributes({ colors: val })} defaults={{ color: '#333', bg: '#fff' }} />

						<SpaceControl className='mt20' label={__('Padding:', 'store-finder')} value={padding} onChange={val => setAttributes({ padding: val })} defaults={{ vertical: '15px', horizontal: '30px' }} />

						<SeparatorControl className='mt20' value={separator} onChange={val => setAttributes({ separator: val })} defaults={{ width: '20%', height: '2px', style: 'solid', color: '#bbb' }} />

						<SpaceControl className='mt20' label={__('Margin:', 'store-finder')} value={margin} onChange={val => setAttributes({ margin: val })} defaults={{ side: 2, bottom: '15px' }} />

						<BorderControl label={__('Border:', 'store-finder')} value={border} onChange={val => setAttributes({ border: val })} defaults={{ radius: '5px' }} />

						<MultiShadowControl label={__('Shadow:', 'store-finder')} value={shadow} onChange={val => setAttributes({ shadow: val })} produce={produce} />
					</PanelBody>
				</>}
			</>}</TabPanel>
		</InspectorControls>


		<BlockControls>
			<ToolbarGroup className='bPlToolbar'>
				<ToolbarButton label={__('Add New Item', 'b-blocks')} onClick={addItem}><Dashicon icon='plus' size={23} /></ToolbarButton>
			</ToolbarGroup>

			<AlignmentToolbar value={alignment} onChange={val => setAttributes({ alignment: val })} describedBy={__('Store Finder Alignment')} alignmentControls={[
				{ title: __('Store Finder in left', 'store-finder'), align: 'left', icon: 'align-left' },
				{ title: __('Store Finder in center', 'store-finder'), align: 'center', icon: 'align-center' },
				{ title: __('Store Finder in right', 'store-finder'), align: 'right', icon: 'align-right' }
			]} />

			<AlignmentToolbar value={textAlign} onChange={val => setAttributes({ textAlign: val })} />
		</BlockControls>
	</>;
};
export default Settings;