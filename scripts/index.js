const decades = document.getElementsByClassName('decade');
const comicCovers = document.getElementsByClassName('comic-covers');
const allExpandedInfo = document.getElementsByClassName('expanded-info');
const expandContractToggles = document.getElementsByClassName('expand-contract-toggle');

function removeExpandClass(el) {
  el.classList.remove('expanded');
};

function addContractClass(el) {
  el.classList.add('contracted');
};

function addHiddenClass(el) {
    el.classList.add('hidden');
};

function hideAll(els) {
  const total = els.length;

  for (let i = 0; i < total; i++) {
    addHiddenClass(els[i]);
  };
};

function onlyDisplayFirst(els) {
  const total = els.length;

  for (let i = 1; i < total; i++) {
    addHiddenClass(els[i]);
  };
};

function toggleVisibility(el) {
  el.classList.toggle('hidden');
};

function toggleContent(e) {
  const decade = e.target.parentElement;
  const expandedInfo = decade.querySelector('.expanded-info');

  if (e.target.textContent == 'See More' && expandedInfo.classList.contains('hidden')) {
    toggleVisibility(expandedInfo);
    e.target.textContent = 'See Less';
  } else if (e.target.textContent == 'See Less' && !(expandedInfo.classList.contains('hidden'))) {
    toggleVisibility(expandedInfo);
    e.target.textContent = 'See More';
  }
};

hideAll(allExpandedInfo);
onlyDisplayFirst(decades);

for (let i = 0; i < comicCovers.length; i++) {
  const comics = comicCovers[i].getElementsByClassName('comic');

  removeExpandClass(decades[i]);
  addContractClass(decades[i]);
  onlyDisplayFirst(comics);
}

for (let i = 0; i < expandContractToggles.length; i++) {
  expandContractToggles[i].addEventListener('pointerdown', toggleContent);
}

/* gonna start looking messy, need to organize */
const rightArrows = document.getElementsByClassName('right-arrow');

function showNext(e) {
  const currentComic = document.querySelector(".decade:not(.hidden)");
  let nextComic = currentComic.nextElementSibling;

  toggleVisibility(currentComic);

  if (nextComic == null) {
    nextComic = decades[0];
  }

  toggleVisibility(nextComic);
};

for (let i = 0; i < rightArrows.length; i++) {
  rightArrows[i].addEventListener('pointerdown', showNext);
}

const leftArrows = document.getElementsByClassName('left-arrow');

function showPrevious(e) {
  const currentComic = document.querySelector(".decade:not(.hidden)");
  let previousComic = currentComic.previousElementSibling;

  toggleVisibility(currentComic);

  if (previousComic == null) {
    previousComic = decades[decades.length - 1];
  }

  toggleVisibility(previousComic);
};

for (let i = 0; i < leftArrows.length; i++) {
  leftArrows[i].addEventListener('pointerdown', showPrevious);
}
