import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import { isDesktopViewport } from '../util/viewport';
import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import EmblaPagination from '../util/embla/pagination';

gsap.registerPlugin(ScrollTrigger);

class TemplateFrontPage {
  constructor(el) {
    this.el = el;
    this.tabNavEls = Array.from(this.el.querySelectorAll('.featured-tabs__tab'));
    this.tabContentEls = Array.from(this.el.querySelectorAll('.featured-tabs__content-item'));

    gsap.fromTo(
      '.banner-home__text-container',
      { opacity: 0, y: 50 },
      { opacity: 1, y: 0, duration: 1 }
    );
    gsap.fromTo(
      '.banner-home__desc-container',
      { opacity: 0, y: 50 },
      { opacity: 1, y: 0, duration: 1 }
    );
    gsap.fromTo('.banner-home__video-container', { opacity: 0 }, { opacity: 1, duration: 1 });

    gsap.fromTo(
      '.case-framer',
      {
        y: 50,
        opacity: 0
      },
      {
        y: 0,
        opacity: 1,
        duration: 1,
        stagger: 0.1,
        scrollTrigger: {
          trigger: '.case-framer',
          start: 'top 80%',
          end: 'top 30%'
        }
      }
    );

    const blockTitle = gsap.utils.toArray('.block-title');
    blockTitle.forEach((block) => {
      gsap.fromTo(
        block,
        {
          y: 50,
          opacity: 0
        },
        {
          y: 0,
          opacity: 1,
          duration: 1,
          stagger: 0.1,
          scrollTrigger: {
            trigger: block,
            start: 'top 80%',
            end: 'bottom 30%'
          }
        }
      );
    });

    this.testimonialInitialized = false;
    this.initTestimonials();

    Array.from(this.el.querySelectorAll('.button-link')).forEach((el) => {
      el.addEventListener('click', (e) => {
        if (el.getAttribute('href').includes('#demo')) {
          e.preventDefault();
          const topOffset =
            document.querySelector('.site-header').clientHeight +
            (document.querySelector('#wpadminbar')?.clientHeight || 0);
          window.scrollTo({
            top:
              document.querySelector('#demo').getBoundingClientRect().top +
              window.pageYOffset -
              topOffset,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  async initTestimonials() {
    if (this.testimonialInitialized) {
      return;
    }

    try {
      const EmblaCarousel = await loadEmblaCarousel();
      const emblaRootEl = this.el.querySelector('.embla-instance');
      const emblaContainerEl = this.el.querySelector('.embla__container');

      if (!emblaRootEl) {
        return;
      }

      const emblaEl = emblaRootEl.querySelector('.embla');
      const paginationEl = this.el.querySelector('.embla__pagination');
      const instance = {
        embla: EmblaCarousel(emblaEl, {
          axis: isDesktopViewport() ? 'y' : 'x',
          align: 'start',
          draggable: !isDesktopViewport(),
          loop: 1,
          duration: 40
        }),
        autoplay: null
      };

      if (instance.embla) {
        instance.autoplay = new EmblaAutoplay(instance.embla, 4000);

        stopAutoplayOnHover(emblaContainerEl, instance.autoplay, 1000);
      }

      if (paginationEl) {
        instance.pagination = new EmblaPagination(instance.embla, paginationEl, {
          buttonClassName: 'embla__pagination-button'
        });
      }

      this.testimonialInitialized = true;
    } catch (err) {
      console.error('Embla Carousel dynamic import failed', err);
    }
  }
}

export default TemplateFrontPage;
