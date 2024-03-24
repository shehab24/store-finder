import { createRoot } from 'react-dom';
import Style from './Style';
import './style.scss';

// Store Finder
document.addEventListener('DOMContentLoaded', () => {
	const blockEls = document.querySelectorAll('.wp-block-storefind-store-finder');
	blockEls.forEach(blockEl => {
		const attributes = JSON.parse(blockEl.dataset.attributes);

		createRoot(blockEl).render(<>
			<Style attributes={attributes} clientId={attributes.cId} />

			<StoreFinder attributes={attributes} />
		</>);

		blockEl?.removeAttribute('data-attributes');
	});
});

const StoreFinder = ({ attributes }) => {
	const { items, columns, layout, content, icon, img } = attributes;

	return <div className={`storefindStoreFinder columns-${columns.desktop} columns-tablet-${columns.tablet} columns-mobile-${columns.mobile} ${layout || 'vertical'}`}>

	</div>
}