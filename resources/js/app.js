import Splide from '@splidejs/splide';
import '@splidejs/splide/css';

/**
 * Carousel presets, selected with `data-carousel="<preset>"` on a `.splide` element.
 * Optional `data-prev` / `data-next` hold the ids of external navigation buttons.
 */
const presets = {
    cards: {
        arrows: false,
        perPage: 3,
        gap: '3rem',
        focus: 0,
        omitEnd: true,
        breakpoints: {
            1180: { perPage: 2 },
            640: { perPage: 1 },
        },
    },
    chips: {
        fixedWidth: 150,
        gap: 20,
        pagination: false,
        drag: 'free',
        snap: true,
        arrows: false,
        breakpoints: {
            992: { gap: 10, fixedWidth: 130 },
            576: { gap: 5, fixedWidth: 110 },
        },
    },
    gallery: {
        perPage: 4,
        gap: '1rem',
        focus: 0,
        omitEnd: true,
        pagination: false,
        breakpoints: {
            1180: { perPage: 3 },
            640: { perPage: 2 },
        },
    },
};

function setButtonState(button, disabled) {
    button.disabled = disabled;
    button.classList.toggle('bg-primary2', !disabled);
    button.classList.toggle('bg-gray-400', disabled);
}

function mountCarousel(element) {
    const splide = new Splide(element, presets[element.dataset.carousel] ?? {}).mount();

    const prev = document.getElementById(element.dataset.prev);
    const next = document.getElementById(element.dataset.next);
    if (!prev || !next) {
        return;
    }

    const update = () => {
        setButtonState(prev, splide.index <= 0);
        setButtonState(next, splide.index >= splide.Components.Controller.getEnd());
    };

    prev.addEventListener('click', () => splide.go('<'));
    next.addEventListener('click', () => splide.go('>'));
    splide.on('moved resized', update);
    update();
}

/**
 * Product gallery: clicking a thumbnail shows it in the large `#main-preview` frame.
 */
function mountGallery() {
    const preview = document.getElementById('main-preview');
    if (!preview) {
        return;
    }

    document.querySelectorAll('[data-preview-src]').forEach((thumbnail) => {
        thumbnail.addEventListener('click', () => {
            const media = document.createElement(thumbnail.dataset.previewType === 'video' ? 'video' : 'img');
            media.src = thumbnail.dataset.previewSrc;
            media.className = 'w-full h-[24rem] object-cover rounded-md';
            if (media.tagName === 'VIDEO') {
                media.controls = true;
            } else {
                media.alt = thumbnail.dataset.previewAlt ?? '';
            }
            preview.replaceChildren(media);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.splide[data-carousel]').forEach(mountCarousel);
    mountGallery();
    document.querySelectorAll('dialog[data-open-on-load]').forEach((dialog) => dialog.showModal());
});
