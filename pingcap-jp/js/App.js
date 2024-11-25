import Lazyload from 'vanilla-lazyload';

import Modal from './components/modal';
import ScrollSubNav from './components/scroll-sub-nav';
import GetStarted from './components/get-started';
import CardTierTabs from './components/card-tier-tabs';
import PricingSearch from './components/pricing-search';
import PackageDownload from './components/package-download';
import StatsCarousel from './components/stats-carousel';
import DropdownMenuClickActivate from './components/dropdown-menu-click-activate';

import BannerDefaultVideo from './components/banner-default-video';

import HubspotForm from './components/hubspot-form';

import AlgoliaPostsListBlog from './components/posts-list/algolia-posts-list-blog';
import PostsListBlog from './components/posts-list/posts-list-blog';
import PostsListNews from './components/posts-list/posts-list-news';
import PostsListEvent from './components/posts-list/posts-list-event';
import PostsListCaseStudy from './components/posts-list/posts-list-case-study';
import PostsListAuthor from './components/posts-list/posts-list-author';
import PostsListSearch from './components/posts-list/posts-list-search';
import PostsListEbookWhitepaper from './components/posts-list/posts-list-ebook-whitepaper';

import BlockTestimonials from './blocks/testimonials';
import BlockTestimonialsSlide from './blocks/testimonials-slide';
import BlockOpenPositions from './blocks/open-positions';
import BlockTabs from './blocks/tabs';
import BlockTabsSlide from './blocks/tabs-slide';
import BlockTabsCard from './blocks/tabs-card';
import BlockStats from './blocks/stats';
import BlockResources from './blocks/resources';
import BlockCarousel from './blocks/carousel';
import BlockCTA from './blocks/cta';
import BlockPricing from './blocks/pricing';
import BlockTablePricing from './blocks/table-pricing';

import TemplateFrontPage from './templates/front-page';
import ActivityPage from './templates/activity-page';
import AIPage from './templates/ai-page';

import { processExternalLinks, safeParseJSON } from './util/general-util';
import SiteEvents, { SiteEventNames } from './util/site-events';
import { createSingleUseObserver } from './util/intersection-observer';
import setupEventDelegators from './util/setup-event-delegators';
import { showVideoModal, showFormModal } from './util/modal-helpers';
import { loadPrismJS } from './util/load-dependencies';
import {
	autodetectCodeElLanguage,
	getRequestedLanguages,
	loadLanguage,
	loadPlugin,
	loadTheme
} from './util/prism-js';
import MobileMenus from './util/mobile-menus';

class App {
	constructor() {
		this.instances = {
			components: {
				getStarted: [],
				pricingSearch: [],
				packageDownload: [],
				statsCarousel: [],
				dropdownMenuClickActivate: [],
				bannerDefaultVideo: null,
				postsListBlog: [],
				postsListNews: [],
				postsListEvent: [],
				postsListEbookWhitepaper: [],
				postsListCaseStudy: [],
				postsListAuthor: [],
				postsListSearch: [],
				hubspotForm: []
			},
			templates: {
				frontPage: null,
				activityPage: null,
				aiPage: null
			},
			blocks: {
				testimonials: [],
				testimonialsSlide: [],
				openPositions: [],
				tabs: [],
				tabsSlide: [],
				tabsCard: [],
				stats: [],
				resources: [],
				carousel: [],
				cta: [],
				pricing: [],
				tabsPricing: [],
				tablePricing: []
			},
			lazyload: null
		};

		this.init();
		this.initComponents();
		this.initTemplates();
		this.initBlocks();
		this.initSocialShare();
		this.initSyntaxHighlighting();
		this.initUTMSessionStorage();
		this.initUTMLink();
	}

	init() {
		processExternalLinks({
			target: '_blank',
			rel: 'noopener'
		});

		Modal.setDefaults({
			closeDuration: 400,
			closeButtonContent: `
				<svg xmlns="http://www.w3.org/2000/svg" class="modal__close-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			`.trim()
		});

		const hubspotTriggerEl = Array.from(document.querySelectorAll('.js--trigger-form-modal'));
		if (hubspotTriggerEl.length && typeof window.hbspt === 'undefined') {
			const script = document.createElement('script');
			script.src = '//js.hsforms.net/forms/v2.js';
			script.type = 'text/javascript';
			script.async = true;

			document.head.appendChild(script);
		}

		/**
		 * Setup event delegators
		 */
		setupEventDelegators('body', {
			'js--trigger-video-modal': (el) => {
				const videoUrl = el.href || '';

				showVideoModal(videoUrl);
			},
			'js--trigger-form-modal': (el) => {
				showFormModal(el);
			}
		});

		// mobile menu button handler
		const btnMobileMenu = document.querySelector('.site-header__mobile-menu-button');

		if (btnMobileMenu) {
			btnMobileMenu.addEventListener('click', () => {
				if (MobileMenus.isOpen()) {
					MobileMenus.closeAll();
				} else {
					MobileMenus.openDefault();
				}
			});
		}

		// mobile menu CTA button handler
		const btnMobileMenuCTA = document.querySelector('.site-header__cta-mobile-button');

		if (btnMobileMenuCTA) {
			btnMobileMenuCTA.addEventListener('click', () => {
				if (MobileMenus.isOpen()) {
					MobileMenus.closeAll();
				} else {
					MobileMenus.openCTA();
				}
			});
		}

		// mobile filter categories handler
		const tagTitle = document.querySelectorAll('.tmpl-archive-sidebar .tag-container-title');

		if (tagTitle) {
			tagTitle.forEach(function (item) {
				item.addEventListener('click', function () {
					if (item.parentElement.classList.contains('open')) {
						item.parentElement.classList.remove('open');
					} else {
						item.parentElement.classList.add('open');
					}
				});
			});
		}

		// initialize LazyLoad and setup events
		this.instances.lazyLoad = new Lazyload();

		SiteEvents.subscribe(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE, () => {
			this.instances.lazyLoad.update();
		});

		// remove "banner-animate" classes on page load
		const bannerAnimateEls = Array.from(document.querySelectorAll('.banner-animate'));

		bannerAnimateEls.forEach((el) => el.classList.remove('banner-animate'));

		document.addEventListener('click', function (event) {
			const target = event.target.closest('[data-href]');
			if (target) {
				const url = target.getAttribute('data-href');
				const isExternal =
					new URL(url, window.location.origin).origin !== window.location.origin;

				if (isExternal) {
					window.open(url, '_blank');
				} else {
					window.location.href = url;
				}
			}
		});
	}

	async initComponents() {
		// scroll sub nav
		const subNavEl = document.querySelector('.sub-nav');
		if (subNavEl) {
			new ScrollSubNav(subNavEl);
		}

		// get started
		Array.from(document.querySelectorAll('.get-started')).forEach((getStartedEl) => {
			this.instances.components.getStarted.push(new GetStarted(getStartedEl));
		});

		// pricing search
		Array.from(document.querySelectorAll('.pricing-search')).forEach((pricingSearchEl) => {
			this.instances.components.pricingSearch.push(new PricingSearch(pricingSearchEl));
		});

		// package download
		Array.from(document.querySelectorAll('.package-download')).forEach((packageDownloadEl) => {
			this.instances.components.packageDownload.push(new PackageDownload(packageDownloadEl));
		});

		// stats carousel
		Array.from(document.querySelectorAll('.stats-carousel')).forEach((statsCarouselEl) => {
			this.instances.components.statsCarousel.push(new StatsCarousel(statsCarouselEl));
		});

		// dropdown menu click activate
		Array.from(
			document.querySelectorAll('.site-header__dropdown-menu-container--click-activate')
		).forEach((dropdownEl) => {
			this.instances.components.dropdownMenuClickActivate.push(
				new DropdownMenuClickActivate(dropdownEl)
			);
		});

		// card tier tabs
		const tabEl = document.querySelector('.card-tier__tabs-container');
		if (tabEl) {
			new CardTierTabs(tabEl);
		}

		// banner default - video
		const bannerEl = document.querySelector('.banner-default--has-video');

		if (bannerEl) {
			this.instances.components.bannerDefaultVideo = new BannerDefaultVideo(bannerEl);
		}

		// posts list - blog
		Array.from(document.querySelectorAll('.posts-list-blog')).forEach((postsListBlogEl) => {
			this.instances.components.postsListBlog.push(new PostsListBlog(postsListBlogEl));
		});

		Array.from(document.querySelectorAll('.posts-list-blog-algolia')).forEach(
			(postsListBlogEl) => {
				this.instances.components.postsListBlog.push(
					new AlgoliaPostsListBlog(postsListBlogEl)
				);
			}
		);

		// posts list - news
		Array.from(document.querySelectorAll('.posts-list-news')).forEach((postsListNewsEl) => {
			this.instances.components.postsListNews.push(new PostsListNews(postsListNewsEl));
		});

		// posts list - event
		Array.from(document.querySelectorAll('.posts-list-event')).forEach((postsListEventEl) => {
			this.instances.components.postsListEvent.push(new PostsListEvent(postsListEventEl));
		});

		// posts list - ebook whitepaper
		Array.from(document.querySelectorAll('.posts-list-ebook-whitepaper')).forEach(
			(postsListEbookWhitepaperEl) => {
				this.instances.components.postsListEbookWhitepaper.push(
					new PostsListEbookWhitepaper(postsListEbookWhitepaperEl)
				);
			}
		);

		// posts list - case study
		Array.from(document.querySelectorAll('.posts-list-case-study')).forEach(
			(postsListCaseStudyEl) => {
				this.instances.components.postsListCaseStudy.push(
					new PostsListCaseStudy(postsListCaseStudyEl)
				);
			}
		);

		// posts list - author
		Array.from(document.querySelectorAll('.posts-list-author')).forEach((postsListAuthorEl) => {
			this.instances.components.postsListAuthor.push(new PostsListAuthor(postsListAuthorEl));
		});

		// posts list - search
		Array.from(document.querySelectorAll('.posts-list-search')).forEach((postsListSearchEl) => {
			this.instances.components.postsListSearch.push(new PostsListSearch(postsListSearchEl));
		});

		// hubspot form phone field
		Array.from(document.querySelectorAll('.hs-form-container')).forEach((formEl) => {
			this.instances.components.hubspotForm.push(new HubspotForm(formEl));
		});
	}

	initTemplates() {
		// front page
		const frontPageEl = document.querySelector('.tmpl-front-page');

		if (frontPageEl) {
			this.instances.templates.frontPage = new TemplateFrontPage(frontPageEl);
		}

		// Activity page
		const activityPage = document.querySelector('.activity-main-page');
		if (activityPage) {
			this.instances.templates.activityPage = new ActivityPage(activityPage);
		}

		// ai page
		const aiPageEl = document.querySelector('.tmpl-ai-page');

		if (aiPageEl) {
			this.instances.templates.aiPage = new AIPage(aiPageEl);
		}

		const tidbPage = document.querySelector('.tmpl-tidb');
		if (tidbPage) {
			this.loadRepoInfo();
		}
	}

	initBlocks() {
		// setup block animation watchers
		const animateBlocks = document.querySelectorAll('.block-animate');

		if (animateBlocks && animateBlocks.length) {
			animateBlocks.forEach((watchEl) =>
				createSingleUseObserver(watchEl, (entry, el) => {
					el.classList.remove('block-animate');
				})
			);
		}

		// Testimonials
		Array.from(document.querySelectorAll('.block-testimonials')).forEach(
			(blockTestimonialsEl) => {
				this.instances.blocks.testimonials.push(new BlockTestimonials(blockTestimonialsEl));
			}
		);

		// Testimonials Slide
		Array.from(document.querySelectorAll('.block-testimonials-slide')).forEach(
			(blockTestimonialsSlideEl) => {
				this.instances.blocks.testimonialsSlide.push(
					new BlockTestimonialsSlide(blockTestimonialsSlideEl)
				);
			}
		);

		// Open Positions
		Array.from(document.querySelectorAll('.block-open-positions')).forEach(
			(blockOpenPositionsEl) => {
				this.instances.blocks.openPositions.push(
					new BlockOpenPositions(blockOpenPositionsEl)
				);
			}
		);

		// Tabs
		Array.from(document.querySelectorAll('.block-tabs')).forEach((blockTabsEl) => {
			this.instances.blocks.tabs.push(new BlockTabs(blockTabsEl));
		});

		// Tabs Slide
		Array.from(document.querySelectorAll('.block-tabs-slide')).forEach((blockTabsSlideEl) => {
			this.instances.blocks.tabsSlide.push(new BlockTabsSlide(blockTabsSlideEl));
		});

		// Tabs
		Array.from(document.querySelectorAll('.block-tabs__nav-button-card')).forEach(
			(blockTabsCardEl) => {
				this.instances.blocks.tabsCard.push(new BlockTabsCard(blockTabsCardEl));
			}
		);

		// Stats
		Array.from(document.querySelectorAll('.block-stats')).forEach((blockStatsEl) => {
			this.instances.blocks.stats.push(new BlockStats(blockStatsEl));
		});

		// Resources
		Array.from(document.querySelectorAll('.block-resources')).forEach((blockResourcesEl) => {
			this.instances.blocks.resources.push(new BlockResources(blockResourcesEl));
		});

		// Carousel
		Array.from(document.querySelectorAll('.block-carousel')).forEach((blockCarouselEl) => {
			this.instances.blocks.carousel.push(new BlockCarousel(blockCarouselEl));
		});

		// CTA
		Array.from(document.querySelectorAll('.block-cta')).forEach((blockCtaEl) => {
			this.instances.blocks.cta.push(new BlockCTA(blockCtaEl));
		});

		// Table Pricing
		Array.from(document.querySelectorAll('.block-table-pricing')).forEach(
			(blockTablePricingEl) => {
				this.instances.blocks.tablePricing.push(new BlockTablePricing(blockTablePricingEl));
			}
		);

		// Pricing
		Array.from(document.querySelectorAll('.block-pricing')).forEach((blockPricingEl) => {
			this.instances.blocks.pricing.push(new BlockPricing(blockPricingEl));
		});

		// Pricing - New
		Array.from(document.querySelectorAll('.block-pricing-new')).forEach((blockPricingEl) => {
			this.instances.blocks.pricing.push(new BlockPricing(blockPricingEl));
		});
	}

	initSocialShare() {
		const socialShareEls = document.querySelectorAll('[data-social-share]');

		Array.from(socialShareEls).forEach((el) => {
			el.addEventListener('click', (e) => {
				const site = el.getAttribute('data-social-share');
				const shareUrl = el.getAttribute('href');

				e.preventDefault();

				if (!shareUrl) {
					return;
				}

				window.open(shareUrl, `${site}Share`, 'width=626,height=436');
			});
		});
	}

	async initSyntaxHighlighting() {
		const codeEls = Array.from(document.getElementsByTagName('code'));

		if (!codeEls.length) {
			return;
		}

		try {
			await loadPrismJS();
		} catch (err) {
			console.error('PrismJS dynamic import failed', err);
			return;
		}

		if (!window.Prism || typeof window.Prism !== 'object') {
			console.error('PrismJS was not loaded successfully');
			return;
		}

		codeEls.forEach((codeEl) => {
			autodetectCodeElLanguage(codeEl, window.Prism);
		});

		const requestedLangs = getRequestedLanguages(codeEls);

		try {
			await loadTheme('prism-ateliersulphurpool-light');
		} catch (err) {
			console.error(err);
			return;
		}

		// load all requested languages in parallel
		await Promise.all(
			requestedLangs.map(async (lang) => {
				try {
					await loadLanguage(lang);
				} catch (err) {
					console.error(err);
				}
			})
		);

		// load plugins
		try {
			await loadPlugin('toolbar');
			await loadPlugin('copy-to-clipboard');
		} catch (err) {
			console.error(err);
		}

		if (window.Prism && typeof window.Prism === 'object') {
			window.Prism?.highlightAll();
		}
	}

	initUTMSessionStorage() {
		const params = location.search
			.replace('?', '')
			.split('&')
			.map((v) => v.split('='))
			.reduce((acc, [key, value]) => Object.assign(acc, value ? { [key]: value } : {}), {});
		const { referrer } = document;
		if (referrer && referrer.toLowerCase().indexOf('pingcap.com') === -1) {
			[params.website_referrer_url] = referrer.split('?');
		}

		if (Object.keys(params).length) {
			sessionStorage.setItem('PINGCAP_EN_UTM', JSON.stringify(params));
		}
	}

	initUTMLink() {
		const supportLinks = [
			'https://tidbcloud.com/free-trial',
			'https://tidbcloud.com/signup',
			'https://forms.pingcap.com/f/hackathon-2022-apac',
			'/htap-summit/register'
		];
		const ignoreUTMCampaign = ['chat2query_202301'];
		const targetEls = document.querySelectorAll('a');
		const data = safeParseJSON(sessionStorage.getItem('PINGCAP_EN_UTM'), '');

		if (!data || !Object.keys(data).length) {
			return;
		}

		Array.from(targetEls).forEach((el) => {
			const link = el.getAttribute('href') ?? '';
			if (!supportLinks.includes(link.split('?')[0])) {
				return;
			}
			el.addEventListener('click', function (e) {
				e.preventDefault();
				const url = this.getAttribute('href');
				const urlParams = url.includes('?')
					? url
							.split('?')[1]
							.split('&')
							.map((v) => v.split('='))
							.reduce((acc, [key, value]) => Object.assign(acc, { [key]: value }), {})
					: {};
				const matchCampaign = ignoreUTMCampaign.find((item) => url.includes(item));

				['utm_source', 'utm_medium', 'utm_campaign', 'website_referrer_url'].forEach(
					(item) => {
						if (item === 'utm_campaign' && matchCampaign) {
							urlParams[item] = matchCampaign;
							return;
						}
						if (data[item]) {
							urlParams[item] = data[item];
						}
					}
				);

				const utm = Object.keys(urlParams)
					.filter(Boolean)
					.map((item) => `${item}=${urlParams[item]}`)
					.join('&');

				if (utm) {
					window.open(
						url.includes('?') ? `${url.split('?')[0]}?${utm}` : `${url}?${utm}`
					);
				} else {
					window.open(url);
				}
			});
		});
	}

	async loadRepoInfo() {
		const response = await fetch('https://api.github.com/repos/pingcap/tidb');
		const stats = await response.json();
		const starCount10K = stats.stargazers_count / 1000;
		const starCount = Math.round(10 * starCount10K) / 10;
		document.getElementById('github_stars').innerHTML = starCount + 'K';
	}
}

export default App;
