/* empty css                        */
import { c as createComponent, r as renderTemplate, a as renderComponent, m as maybeRenderHead, b as addAttribute } from '../chunks/astro/server_WzlIhxCB.mjs';
import 'kleur/colors';
import 'html-escaper';
import { $ as $$Layout, a as $$Header, b as $$Footer } from '../chunks/Footer_DTNDvwpf.mjs';
/* empty css                           */
export { renderers } from '../renderers.mjs';

const $$Services = createComponent(($$result, $$props, $$slots) => {
  const services = [
    {
      title: "AI Automation & Workflow Optimization",
      description: "Transform your business operations with intelligent automation that adapts and learns.",
      icon: "\u{1F916}",
      features: [
        "Custom workflow automation solutions",
        "Machine learning-powered process optimization",
        "Intelligent document processing",
        "Automated decision-making systems",
        "Real-time performance monitoring"
      ],
      benefits: [
        "Reduce operational costs by up to 40%",
        "Minimize human error in critical processes",
        "Increase productivity and throughput",
        "24/7 automated operations"
      ],
      stats: {
        value: "40%",
        label: "Average Cost Reduction",
        icon: "\u{1F4C8}"
      }
    },
    {
      title: "Custom AI Solutions",
      description: "Get tailored AI solutions designed specifically for your industry and unique business challenges.",
      icon: "\u2699\uFE0F",
      features: [
        "Custom AI model development",
        "Industry-specific solutions",
        "Integration with existing systems",
        "Scalable architecture design",
        "Continuous model improvement"
      ],
      benefits: [
        "Solutions tailored to your exact needs",
        "Competitive advantage through AI",
        "Improved decision-making accuracy",
        "Future-proof scalability"
      ],
      stats: {
        value: "95%",
        label: "Client Satisfaction Rate",
        icon: "\u{1F3AF}"
      }
    },
    {
      title: "Data Analytics & Insights",
      description: "Unlock the power of your data with advanced analytics solutions.",
      icon: "\u{1F4CA}",
      features: [
        "Advanced data analytics platforms",
        "Predictive analytics models",
        "Real-time data visualization",
        "Business intelligence dashboards",
        "Trend analysis and forecasting"
      ],
      benefits: [
        "Data-driven decision making",
        "Improved forecast accuracy",
        "Real-time business insights",
        "Competitive market analysis"
      ],
      stats: {
        value: "85%",
        label: "Forecast Accuracy",
        icon: "\u{1F4CA}"
      }
    },
    {
      title: "AI Integration Services",
      description: "Seamlessly integrate AI capabilities into your existing systems and workflows.",
      icon: "\u{1F504}",
      features: [
        "System integration planning",
        "API development and integration",
        "Legacy system modernization",
        "Cloud integration services",
        "Security and compliance implementation"
      ],
      benefits: [
        "Seamless integration with existing systems",
        "Minimal operational disruption",
        "Enhanced system capabilities",
        "Improved data flow and accessibility"
      ],
      stats: {
        value: "99%",
        label: "System Uptime",
        icon: "\u26A1"
      }
    }
  ];
  const industries = [
    { name: "Finance & Banking", icon: "\u{1F3E6}" },
    { name: "Healthcare", icon: "\u{1F3E5}" },
    { name: "Manufacturing", icon: "\u{1F3ED}" },
    { name: "Retail & E-commerce", icon: "\u{1F6CD}\uFE0F" },
    { name: "Logistics & Supply Chain", icon: "\u{1F69A}" },
    { name: "Professional Services", icon: "\u{1F454}" }
  ];
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Our Services - QuickSummit", "data-astro-cid-ucd2ps2b": true }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Header", $$Header, { "data-astro-cid-ucd2ps2b": true })} ${maybeRenderHead()}<main class="bg-white" data-astro-cid-ucd2ps2b> <!-- Interactive Hero Section with prominent CTA --> <section class="relative min-h-[90vh] flex items-center bg-gradient-to-br from-gray-900 to-gray-800 text-white" data-astro-cid-ucd2ps2b> <div class="absolute inset-0" data-astro-cid-ucd2ps2b> <div class="absolute inset-0 bg-gradient-to-r from-blue-500/30 to-purple-500/30" data-astro-cid-ucd2ps2b></div> <div class="absolute inset-0 bg-grid-white/[0.05] bg-[length:32px_32px]" data-astro-cid-ucd2ps2b></div> </div> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative py-24" data-astro-cid-ucd2ps2b> <div class="text-center max-w-3xl mx-auto" data-astro-cid-ucd2ps2b> <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-purple-200" data-astro-cid-ucd2ps2b>
AI-Powered Solutions for Your Business
</h1> <p class="text-xl md:text-2xl text-gray-300 leading-relaxed mb-8" data-astro-cid-ucd2ps2b>
Transform your business with intelligent automation
</p> <!-- Primary CTA --> <div class="mb-12" data-astro-cid-ucd2ps2b> <a href="/consultation" class="inline-flex items-center px-8 py-4 text-lg font-medium rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-blue-500/25" data-astro-cid-ucd2ps2b>
Book Your Free Consultation
<svg class="ml-2 w-5 h-5 animate-bounce-x" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" data-astro-cid-ucd2ps2b></path> </svg> </a> </div> <!-- Interactive Industry Selector --> <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-2xl mx-auto" data-astro-cid-ucd2ps2b> ${industries.map((industry) => renderTemplate`<button class="group p-4 rounded-lg bg-white/10 hover:bg-white/20 transition-all duration-300 text-white border border-white/20" data-astro-cid-ucd2ps2b> <div class="text-2xl mb-2" data-astro-cid-ucd2ps2b>${industry.icon}</div> <div class="text-sm font-medium" data-astro-cid-ucd2ps2b>${industry.name}</div> </button>`)} </div> </div> </div> </section> <!-- Stats Section with improved visual cohesion --> <section class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden" data-astro-cid-ucd2ps2b> <div class="absolute inset-0 bg-grid-gray-900/[0.02] bg-[length:32px_32px]" data-astro-cid-ucd2ps2b></div> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative" data-astro-cid-ucd2ps2b> <div class="grid grid-cols-1 md:grid-cols-4 gap-8" data-astro-cid-ucd2ps2b> ${services.map((service) => renderTemplate`<div class="text-center transform hover:scale-105 transition-all duration-300" data-astro-cid-ucd2ps2b> <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300" data-astro-cid-ucd2ps2b> <div class="text-4xl mb-4" data-astro-cid-ucd2ps2b>${service.stats.icon}</div> <div class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 mb-2" data-astro-cid-ucd2ps2b> ${service.stats.value} </div> <div class="text-gray-600 text-sm font-medium" data-astro-cid-ucd2ps2b> ${service.stats.label} </div> </div> </div>`)} </div> </div> </section> <!-- Services Section with improved readability and visual hierarchy --> <section class="py-24" data-astro-cid-ucd2ps2b> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-astro-cid-ucd2ps2b> ${services.map((service, index) => renderTemplate`<div${addAttribute(`flex flex-col md:flex-row items-center gap-12 ${index % 2 === 0 ? "" : "md:flex-row-reverse"} mb-24`, "class")} data-astro-cid-ucd2ps2b> <!-- Content with improved typography --> <div class="flex-1 space-y-8" data-astro-cid-ucd2ps2b> <div class="flex items-center space-x-4" data-astro-cid-ucd2ps2b> <div class="text-4xl" data-astro-cid-ucd2ps2b>${service.icon}</div> <h2 class="text-3xl font-bold text-gray-900" data-astro-cid-ucd2ps2b>${service.title}</h2> </div> <p class="text-xl leading-relaxed text-gray-600" data-astro-cid-ucd2ps2b>${service.description}</p> <!-- Collapsible Features Section --> <details class="group" data-astro-cid-ucd2ps2b> <summary class="flex items-center cursor-pointer" data-astro-cid-ucd2ps2b> <h3 class="text-lg font-semibold text-gray-900 flex items-center" data-astro-cid-ucd2ps2b> <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" data-astro-cid-ucd2ps2b></path> </svg>
Key Features
</h3> <svg class="w-5 h-5 ml-2 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" data-astro-cid-ucd2ps2b></path> </svg> </summary> <ul class="mt-4 space-y-4 pl-6" data-astro-cid-ucd2ps2b> ${service.features.map((feature) => renderTemplate`<li class="flex items-start" data-astro-cid-ucd2ps2b> <svg class="h-6 w-6 text-blue-500 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" data-astro-cid-ucd2ps2b></path> </svg> <span class="ml-3 text-lg text-gray-600" data-astro-cid-ucd2ps2b>${feature}</span> </li>`)} </ul> </details> </div> <!-- Visual Element with improved design --> <div class="flex-1 relative" data-astro-cid-ucd2ps2b> <div class="aspect-square rounded-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 p-8 shadow-lg hover:shadow-xl transition-shadow duration-300" data-astro-cid-ucd2ps2b> <div class="w-full h-full rounded-full border-2 border-blue-500/30 flex items-center justify-center relative overflow-hidden group" data-astro-cid-ucd2ps2b> <div class="text-7xl transform group-hover:scale-110 transition-transform duration-500" data-astro-cid-ucd2ps2b>${service.icon}</div> <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500" data-astro-cid-ucd2ps2b></div> </div> </div> ${index !== services.length - 1 && renderTemplate`<div class="absolute h-24 w-px bg-gradient-to-b from-blue-500/30 to-transparent left-1/2 -bottom-24 hidden md:block" data-astro-cid-ucd2ps2b></div>`} </div> </div>`)} </div> </section> <!-- Enhanced CTA Section --> <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white py-24" data-astro-cid-ucd2ps2b> <div class="absolute inset-0" data-astro-cid-ucd2ps2b> <div class="absolute inset-0 bg-gradient-to-r from-blue-500/30 to-purple-500/30" data-astro-cid-ucd2ps2b></div> <div class="absolute inset-0 bg-grid-white/[0.05] bg-[length:32px_32px]" data-astro-cid-ucd2ps2b></div> </div> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative" data-astro-cid-ucd2ps2b> <div class="text-center" data-astro-cid-ucd2ps2b> <h2 class="text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-purple-200" data-astro-cid-ucd2ps2b>
Ready to Transform Your Business?
</h2> <p class="text-xl text-gray-300 mb-12 max-w-2xl mx-auto" data-astro-cid-ucd2ps2b>
Take the first step towards intelligent automation
</p> <!-- Unified CTA Options --> <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto" data-astro-cid-ucd2ps2b> <a href="/consultation" class="group p-8 rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 transition-all duration-300 text-center transform hover:scale-105" data-astro-cid-ucd2ps2b> <div class="text-4xl mb-4" data-astro-cid-ucd2ps2b>💡</div> <h3 class="text-xl font-semibold mb-2" data-astro-cid-ucd2ps2b>Book a Consultation</h3> <p class="text-gray-200 mb-4" data-astro-cid-ucd2ps2b>Get expert advice on your specific needs</p> <span class="inline-flex items-center text-white group-hover:translate-x-1 transition-transform" data-astro-cid-ucd2ps2b>
Get Started
<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" data-astro-cid-ucd2ps2b></path> </svg> </span> </a> <a href="/demo" class="group p-8 rounded-lg bg-white/10 hover:bg-white/20 transition-all duration-300 text-center" data-astro-cid-ucd2ps2b> <div class="text-4xl mb-4" data-astro-cid-ucd2ps2b>🎮</div> <h3 class="text-xl font-semibold mb-2" data-astro-cid-ucd2ps2b>Watch Demo</h3> <p class="text-gray-400 mb-4" data-astro-cid-ucd2ps2b>See our solutions in action</p> <span class="inline-flex items-center text-blue-400 group-hover:text-blue-300" data-astro-cid-ucd2ps2b>
Play Demo
<svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" data-astro-cid-ucd2ps2b></path> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" data-astro-cid-ucd2ps2b></path> </svg> </span> </a> <a href="/contact" class="group p-8 rounded-lg bg-white/10 hover:bg-white/20 transition-all duration-300 text-center" data-astro-cid-ucd2ps2b> <div class="text-4xl mb-4" data-astro-cid-ucd2ps2b>📞</div> <h3 class="text-xl font-semibold mb-2" data-astro-cid-ucd2ps2b>Contact Sales</h3> <p class="text-gray-400 mb-4" data-astro-cid-ucd2ps2b>Discuss pricing and packages</p> <span class="inline-flex items-center text-blue-400 group-hover:text-blue-300" data-astro-cid-ucd2ps2b>
Get in Touch
<svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-ucd2ps2b> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" data-astro-cid-ucd2ps2b></path> </svg> </span> </a> </div> </div> </div> </section> </main> ${renderComponent($$result2, "Footer", $$Footer, { "data-astro-cid-ucd2ps2b": true })} ` })} `;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/pages/services.astro", void 0);

const $$file = "C:/Users/mkhay/windsurf/nebulous-nova/src/pages/services.astro";
const $$url = "/https://quicksummit.net/services.html";

const _page = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Services,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

const page = () => _page;

export { page };
