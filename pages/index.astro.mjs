/* empty css                        */
import { c as createComponent, r as renderTemplate, m as maybeRenderHead, b as addAttribute, a as renderComponent } from '../chunks/astro/server_WzlIhxCB.mjs';
import 'kleur/colors';
import 'html-escaper';
import { $ as $$Layout, a as $$Header, b as $$Footer } from '../chunks/Footer_DTNDvwpf.mjs';
import 'clsx';
export { renderers } from '../renderers.mjs';

const $$Hero = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<section class="relative bg-gradient-to-br from-indigo-900 via-indigo-800 to-indigo-900 text-white"> <div class="absolute inset-0"> <div class="absolute inset-0 bg-[url('/grid.svg')] opacity-10"></div> <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/90 via-indigo-800/90 to-indigo-900/90"></div> </div> <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32"> <div class="text-center"> <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6">
Empowering Your Business with AI-Powered Automation
</h1> <p class="text-xl md:text-2xl text-indigo-100 mb-12 max-w-3xl mx-auto">
Unlock efficiency and boost revenue with intelligent automation solutions that transform your business operations.
</p> <div class="flex flex-col sm:flex-row gap-4 justify-center"> <a href="/consultation" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 md:text-lg">
Book a Free Consultation
</a> <a href="/services" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg">
Explore Our Services
</a> </div> </div> </div> <!-- Animated background elements --> <div class="absolute inset-0 overflow-hidden pointer-events-none"> <div class="absolute -top-1/2 -left-1/2 w-full h-full transform rotate-12 opacity-30"> <div class="w-full h-full bg-gradient-to-br from-indigo-500/20 to-transparent rounded-full animate-pulse"></div> </div> <div class="absolute -bottom-1/2 -right-1/2 w-full h-full transform -rotate-12 opacity-30"> <div class="w-full h-full bg-gradient-to-br from-indigo-500/20 to-transparent rounded-full animate-pulse" style="animation-delay: 1s;"></div> </div> </div> </section>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Hero.astro", void 0);

const $$Services = createComponent(($$result, $$props, $$slots) => {
  const services = [
    {
      title: "AI Automation & Workflow Optimization",
      description: "Streamline your operations with intelligent automation solutions that learn and adapt to your business needs.",
      icon: "\u{1F916}",
      link: "/services/automation"
    },
    {
      title: "Custom AI Solutions",
      description: "Tailored AI implementations designed specifically for your industry and business challenges.",
      icon: "\u2699\uFE0F",
      link: "/services/custom-solutions"
    },
    {
      title: "Data Analytics & Insights",
      description: "Transform your raw data into actionable insights with our advanced analytics solutions.",
      icon: "\u{1F4CA}",
      link: "/services/analytics"
    },
    {
      title: "AI Integration Services",
      description: "Seamlessly integrate AI capabilities into your existing systems and workflows.",
      icon: "\u{1F504}",
      link: "/services/integration"
    }
  ];
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-gray-50"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="text-center mb-16"> <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2> <p class="text-xl text-gray-600 max-w-3xl mx-auto">
Discover how our AI-powered solutions can transform your business operations and drive growth.
</p> </div> <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"> ${services.map((service) => renderTemplate`<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"> <div class="p-6"> <div class="text-4xl mb-4">${service.icon}</div> <h3 class="text-xl font-semibold text-gray-900 mb-2">${service.title}</h3> <p class="text-gray-600 mb-4">${service.description}</p> <a${addAttribute(service.link, "href")} class="inline-flex items-center text-indigo-600 hover:text-indigo-500">
Learn more
<svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path> </svg> </a> </div> </div>`)} </div> </div> </section>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Services.astro", void 0);

const $$Testimonials = createComponent(($$result, $$props, $$slots) => {
  const testimonials = [
    {
      quote: "BrickxBrick.ai transformed our business operations. Their AI solutions helped us reduce costs by 40% while improving efficiency.",
      author: "Sarah Johnson",
      role: "CTO, TechCorp Solutions"
    },
    {
      quote: "The team's expertise in AI automation is unmatched. They delivered exactly what we needed and more.",
      author: "Michael Chen",
      role: "Operations Director, InnovateCo"
    },
    {
      quote: "Working with BrickxBrick.ai was a game-changer for our company. Their AI solutions streamlined our workflows perfectly.",
      author: "Emily Rodriguez",
      role: "CEO, Future Systems"
    }
  ];
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="text-center mb-16"> <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h2> <p class="text-xl text-gray-600">Trusted by industry leaders worldwide</p> </div> <div class="grid grid-cols-1 md:grid-cols-3 gap-8"> ${testimonials.map((testimonial) => renderTemplate`<div class="bg-gray-50 rounded-lg p-8 relative"> <div class="absolute top-4 left-4 text-indigo-200 text-6xl">"</div> <div class="relative"> <p class="text-gray-600 mb-6 italic"> ${testimonial.quote} </p> <div> <p class="font-semibold text-gray-900">${testimonial.author}</p> <p class="text-gray-600">${testimonial.role}</p> </div> </div> </div>`)} </div> <div class="mt-16 text-center"> <h3 class="text-2xl font-bold text-gray-900 mb-8">Trusted By Industry Leaders</h3> <div class="flex flex-wrap justify-center items-center gap-8 opacity-50"> <!-- Replace these with actual client logos --> <div class="w-32 h-12 bg-gray-200 rounded"></div> <div class="w-32 h-12 bg-gray-200 rounded"></div> <div class="w-32 h-12 bg-gray-200 rounded"></div> <div class="w-32 h-12 bg-gray-200 rounded"></div> <div class="w-32 h-12 bg-gray-200 rounded"></div> </div> </div> </div> </section>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Testimonials.astro", void 0);

const $$BlogPreview = createComponent(($$result, $$props, $$slots) => {
  const posts = [
    {
      title: "The Future of AI Automation in Business",
      excerpt: "Discover how AI is revolutionizing business operations and what it means for your company's future.",
      image: "/blog/ai-future.jpg",
      date: "2025-02-14",
      author: "Dr. Alex Thompson",
      slug: "future-of-ai-automation"
    },
    {
      title: "5 Ways AI Can Boost Your Productivity",
      excerpt: "Learn the key strategies for implementing AI to enhance your team's productivity and efficiency.",
      image: "/blog/productivity.jpg",
      date: "2025-02-10",
      author: "Maria Garcia",
      slug: "ai-productivity-boost"
    },
    {
      title: "Understanding Machine Learning in Business",
      excerpt: "A comprehensive guide to understanding how machine learning can transform your business processes.",
      image: "/blog/machine-learning.jpg",
      date: "2025-02-07",
      author: "James Wilson",
      slug: "machine-learning-guide"
    }
  ];
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-gray-50"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="text-center mb-16"> <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Insights & Innovations in AI Automation</h2> <p class="text-xl text-gray-600">Stay updated with the latest trends and insights in AI technology</p> </div> <div class="grid grid-cols-1 md:grid-cols-3 gap-8"> ${posts.map((post) => renderTemplate`<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"> <div class="aspect-w-16 aspect-h-9 bg-gray-200"> <div class="w-full h-48 bg-gray-200"></div> </div> <div class="p-6"> <div class="text-sm text-gray-500 mb-2"> ${new Date(post.date).toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric"
  })} • ${post.author} </div> <h3 class="text-xl font-semibold text-gray-900 mb-2"> <a${addAttribute(`/blog/${post.slug}`, "href")} class="hover:text-indigo-600"> ${post.title} </a> </h3> <p class="text-gray-600 mb-4"> ${post.excerpt} </p> <a${addAttribute(`/blog/${post.slug}`, "href")} class="inline-flex items-center text-indigo-600 hover:text-indigo-500">
Read More
<svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path> </svg> </a> </div> </article>`)} </div> <div class="text-center mt-12"> <a href="/blog" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
View All Posts
</a> </div> </div> </section>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/BlogPreview.astro", void 0);

const $$ContactCTA = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<section class="py-20 bg-indigo-900 text-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="max-w-3xl mx-auto text-center"> <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Transform Your Business?</h2> <p class="text-xl text-indigo-100 mb-8">
Discover how AI can transform your business. Schedule your free consultation today!
</p> <div class="flex flex-col sm:flex-row gap-4 justify-center"> <a href="/consultation" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 md:text-lg">
Book Your Free Consultation
</a> <a href="/contact" class="inline-flex items-center justify-center px-8 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-indigo-800 md:text-lg">
Contact Us
</a> </div> </div> </div> </section>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/ContactCTA.astro", void 0);

const $$Index = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "QuickSummit - AI Business Automation Solutions" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Header", $$Header, {})} ${maybeRenderHead()}<main> ${renderComponent($$result2, "Hero", $$Hero, {})} ${renderComponent($$result2, "Services", $$Services, {})} ${renderComponent($$result2, "Testimonials", $$Testimonials, {})} ${renderComponent($$result2, "BlogPreview", $$BlogPreview, {})} ${renderComponent($$result2, "ContactCTA", $$ContactCTA, {})} </main> ${renderComponent($$result2, "Footer", $$Footer, {})} ` })}`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/pages/index.astro", void 0);

const $$file = "C:/Users/mkhay/windsurf/nebulous-nova/src/pages/index.astro";
const $$url = "/https://quicksummit.net.html";

const _page = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Index,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

const page = () => _page;

export { page };
