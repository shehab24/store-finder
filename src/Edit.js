
import { produce } from 'immer';
import { useEffect, useState } from 'react';
// Settings Components
import { tabController } from '../../Components/utils/functions';

import Settings from './Settings';
import Style from './Style';


const Edit = props => {
	const { className, attributes, setAttributes, clientId, isSelected } = props;
	const { items, columns, layout, content, icon, img } = attributes;

	useEffect(() => { clientId && setAttributes({ cId: clientId.substring(0, 10) }); }, [clientId]); // Set & Update clientId to cId

	useEffect(() => tabController(), [isSelected]);

	const [activeIndex, setActiveIndex] = useState(0);

	const updateItem = (object, property, val, childProp = false) => {
		const newObj = produce(attributes[object], draft => {
			if (false !== childProp) {
				draft[property][childProp] = val;
			} else {
				draft[property] = val;
			}
		});
		setAttributes({ [object]: newObj });
	}

	return <>
		<Settings attributes={attributes} setAttributes={setAttributes} updateItem={updateItem} activeIndex={activeIndex} setActiveIndex={setActiveIndex} />

		<div className={className} id={`storefindStoreFinder-${clientId}`}>
			<Style attributes={attributes} clientId={clientId} />

			<div className={`storefindStoreFinder columns-${columns.desktop} columns-tablet-${columns.tablet} columns-mobile-${columns.mobile} ${layout || 'vertical'}`}>
				<span>Preview Will Show in Frontend</span>
			</div>
		</div>
	</>;
};
export default Edit;