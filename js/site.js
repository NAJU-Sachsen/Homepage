
/**
 * site.js
 * v0.2.0
 *
 */

//
// Listing cards height
//

function adjustListingCardsHeight(container) {
	const cards = container.getElementsByClassName('listing-card');
	const maxHeight = Math.max(...Array.from(cards).map((card) => card.clientHeight));

	for (const card of cards) {
		card.style.height = '' + maxHeight + 'px';
		const footers = card.getElementsByClassName('card-footer');
		if (footers) {
			footers[0].style.position = 'absolute';
			footers[0].style.bottom = '0';
		}
	}
}

window.addEventListener('load', () => {
	const cardContainers = document.getElementsByClassName('listing-cards-container');
	for (const cardContainer of cardContainers) {
		adjustListingCardsHeight(cardContainer);
	}

	const scrollSpyers = document.querySelectorAll('[data-spy="scroll"]');
	for (const spyer of scrollSpyers) {
		console.log(spyer);
		spyer.dataset.offset = window.innerHeight - spyer.getBoundingClientRect().top;
		console.log(spyer);
	}
	//$('[data-spy="scroll"]').each(() => $(this).scrollspy('refresh'));

});

//
// Iframe lazy loading
//

function lazyLoadIframe(container, src, height) {
	const iframe = container.getElementsByClassName('iframe-holder')[0];
	iframe.setAttribute('src', src);
	iframe.style.height = height;
	while (container.firstChild !== iframe) {
		container.removeChild(container.firstChild);
	}
	while (container.lastChild !== iframe) {
		container.removeChild(container.lastChild);
	}
	container.className = 'iframe-container loaded';
	iframe.className = 'iframe-holder';
}

document.addEventListener('DOMContentLoaded', () => {
	const iframeContainers = document.getElementsByClassName('iframe-container load-on-demand');
	for (const iframe of iframeContainers) {
		const src = iframe.dataset.iframeSrc;
		const height = iframe.dataset.iframeHeight;
		const loadBtn = iframe.getElementsByClassName('iframe-load-btn')[0];
		loadBtn.addEventListener('click', () => lazyLoadIframe(iframe, src, height));
	}
});
