
/**
 * site.js
 * v0.0.1
 * 
 */

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
});

// window.onload = () => {
// 	const cardContainers = document.getElementsByClassName('listing-cards-container');

// 	console.log('containers:', cardContainers);

// 	for (const cardContainer of cardContainers) {
// 		adjustListingCardsHeight(cardContainer);
// 	}
// };
