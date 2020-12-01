<!-- mod_in_page_nav -->

<?php if (rex::isFrontend()) : ?>
<h3 class="mt-4">Übersicht</h3>
<nav id="page-nav-REX_SLICE_ID" class="page-nav">
	<ul class="nav flex-column">
		<!-- Menu content goes here -->
	</ul>
	<template id="page-nav-template-REX_SLICE_ID">
		<li class="nav-item">
			<a class="nav-link"></a>
		</li>
	</template>
</nav>

<script>
	const sel = '#content hREX_VALUE[1]:not(.page-title)<?= 'REX_VALUE[id=2 ifempty=false]' === 'true' ? '.content-heading' : ''; ?>';

	document.addEventListener('DOMContentLoaded', () => {
		const headerNodes = document.querySelectorAll(sel);
		if (!headerNodes) {
			exit;
		}

		const headers = [];

		// for all headers which do not have an ID we need to create one manually
		for (let header of headerNodes) {
			if (!header.id) {

				// the ID will be based on the header's content
				let generatedId = null;
				for (const headerContent of header.childNodes) {
					if (headerContent.nodeType === Node.TEXT_NODE) {
						generatedId = headerContent.nodeValue;
						break;
					}
				}
				if (!generatedId) {
					generatedId = header.innerText;
				}

				// but in a simplified version with all lower case
				generatedId = generatedId.toLowerCase();

				// without whitespace
				generatedId = generatedId.replace(/ /g, '-');

				// with expanded umlauts
				generatedId = generatedId.replace(/ä/g, 'ae');
				generatedId = generatedId.replace(/ö/g, 'oe');
				generatedId = generatedId.replace(/ü/g, 'ue');
				generatedId = generatedId.replace(/ß/g, 'ss');

				// and only basic characters
				generatedId = generatedId.replace(/[^a-z0-9_-]/g, '');

				// we also need to make sure we did not create an ID that is already used by accident
				while (document.getElementById(generatedId)) {
					generatedId += '1';
				}

				header.id = generatedId;
			}
			headers.push(header);
		}

		// We will try to generate the heading based on the templating mechanism.
		// If that fails we will use old-school string interpolation instead

		if ('content' in document.createElement('template')) {
			const template = document.getElementById('page-nav-template-REX_SLICE_ID');
			const nav = document.querySelector('#page-nav-REX_SLICE_ID ul');

			for (let heading of headers) {
				const menuEntry = template.content.cloneNode(true);
				const anchor = menuEntry.querySelector('a');
				anchor.href = '#' + heading.id;
				let headingText = null;
				for (const headingContent of heading.childNodes) {
					if (headingContent.nodeType === Node.TEXT_NODE) {
						headingText = headingContent.nodeValue;
						break;
					}
				}
				if (!headingText) {
					headingText = heading.innerText;
				}
				anchor.innerText = headingText;
				nav.appendChild(menuEntry);
			}
		}

	});

</script>
<?php else: ?>
	<h3>Gliederung</h3>
	<p class="alert alert-info">Die Gliederung wird nur im Frontend generiert</p>
<?php endif; ?>
