import { d as createAstro, c as createComponent, r as renderTemplate, e as renderScript, f as renderSlot, a as renderComponent, F as Fragment, g as renderHead, b as addAttribute, u as unescapeHTML, m as maybeRenderHead } from './astro/server_h_lBtYiF.mjs';
import 'kleur/colors';
import { readFileSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';
/* empty css                */
import 'clsx';

var __freeze = Object.freeze;
var __defProp = Object.defineProperty;
var __template = (cooked, raw) => __freeze(__defProp(cooked, "raw", { value: __freeze(cooked.slice()) }));
var _a;
const $$Astro = createAstro("https://quicksummit.net");
const $$Layout = createComponent(($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro, $$props, $$slots);
  Astro2.self = $$Layout;
  const { title, description = "Empowering Your Business with AI-Powered Automation" } = Astro2.props;
  const __filename = fileURLToPath(import.meta.url);
  const __dirname = dirname(__filename);
  const headerPath = join(__dirname, "../../../shared/header.html");
  const headerContent = readFileSync(headerPath, "utf-8");
  return renderTemplate(_a || (_a = __template(['<html lang="en"> <head><meta charset="UTF-8"><meta name="viewport" content="width=device-width"><link rel="icon" type="image/svg+xml" href="/favicon.svg"><meta name="generator"', '><meta name="description"', "><title>", `</title><!-- Google Analytics (GA4) --><script async src="https://www.googletagmanager.com/gtag/js?id=G-WR44D96CMZ"><\/script><script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-WR44D96CMZ');
    <\/script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="/style.css">`, '</head> <body class="min-h-screen bg-white"> ', " ", " ", " </body> </html> "])), addAttribute(Astro2.generator, "content"), addAttribute(description, "content"), title, renderHead(), renderComponent($$result, "Fragment", Fragment, {}, { "default": ($$result2) => renderTemplate`${unescapeHTML(headerContent)}` }), renderSlot($$result, $$slots["default"]), renderScript($$result, "C:/Users/mkhay/windsurf/nebulous-nova/src/layouts/Layout.astro?astro&type=script&index=0&lang.ts"));
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/layouts/Layout.astro", void 0);

const $$Header = createComponent(($$result, $$props, $$slots) => {
  return renderTemplate`${maybeRenderHead()}<header class="fixed w-full bg-white/95 backdrop-blur-sm z-50 shadow-sm"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="flex justify-between items-center py-4"> <div class="flex items-center"> <a href="/" class="flex items-center"> <img src="/logo.svg" alt="QuickSummit Logo" class="h-8 w-auto"> <span class="ml-2 text-xl font-bold text-gray-900">QuickSummit</span> </a> </div> <!-- Desktop Navigation --> <nav class="hidden md:flex items-center space-x-8"> <a href="/" class="text-gray-700 hover:text-gray-900">Home</a> <a href="/services" class="text-gray-700 hover:text-gray-900">Services</a> <a href="/blog" class="text-gray-700 hover:text-gray-900">Blog</a> <a href="/about" class="text-gray-700 hover:text-gray-900">About</a> <a href="/contact" class="text-gray-700 hover:text-gray-900">Contact</a> <a href="/consultation" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
Book a Free Consultation
</a> </nav> <!-- Mobile menu button --> <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false" id="mobile-menu-button"> <span class="sr-only">Open main menu</span> <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path> </svg> </button> </div> <!-- Mobile Navigation --> <div class="md:hidden hidden" id="mobile-menu"> <div class="px-2 pt-2 pb-3 space-y-1"> <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a> <a href="/services" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Services</a> <a href="/blog" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Blog</a> <a href="/about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">About</a> <a href="/contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contact</a> <a href="/consultation" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
Book a Free Consultation
</a> </div> </div> </div> </header> ${renderScript($$result, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Header.astro?astro&type=script&index=0&lang.ts")}`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Header.astro", void 0);

const $$Footer = createComponent(($$result, $$props, $$slots) => {
  const currentYear = (/* @__PURE__ */ new Date()).getFullYear();
  const footerLinks = {
    Company: [
      { name: "About", href: "/about" },
      { name: "Services", href: "/services" },
      { name: "Blog", href: "/blog" },
      { name: "Contact", href: "/contact" }
    ],
    Resources: [
      { name: "Documentation", href: "/docs" },
      { name: "Case Studies", href: "/case-studies" },
      { name: "FAQs", href: "/faqs" },
      { name: "Support", href: "/support" }
    ],
    Legal: [
      { name: "Privacy Policy", href: "/privacy" },
      { name: "Terms of Service", href: "/terms" },
      { name: "Cookie Policy", href: "/cookies" }
    ]
  };
  const socialLinks = [
    { name: "Twitter", href: "https://twitter.com/quicksummit", icon: "twitter" },
    { name: "LinkedIn", href: "https://linkedin.com/company/quicksummit", icon: "linkedin" },
    { name: "GitHub", href: "https://github.com/quicksummit", icon: "github" }
  ];
  return renderTemplate`${maybeRenderHead()}<footer class="bg-gray-900 text-white"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"> <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8"> <!-- Company Info --> <div> <div class="flex items-center mb-4"> <img src="/static/logo-white.svg" alt="QuickSummit Logo" class="h-8 w-auto"> <span class="ml-2 text-xl font-bold">QuickSummit</span> </div> <p class="text-gray-400 mb-4">
Empowering businesses with intelligent automation solutions.
</p> <div class="flex space-x-4"> ${socialLinks.map((social) => renderTemplate`<a${addAttribute(social.href, "href")} class="text-gray-400 hover:text-white transition-colors duration-200" target="_blank" rel="noopener noreferrer"> <span class="sr-only">${social.name}</span> <div class="w-6 h-6 bg-gray-400 rounded"></div> </a>`)} </div> </div> <!-- Footer Links --> ${Object.entries(footerLinks).map(([category, links]) => renderTemplate`<div> <h3 class="text-lg font-semibold mb-4">${category}</h3> <ul class="space-y-2"> ${links.map((link) => renderTemplate`<li> <a${addAttribute(link.href, "href")} class="text-gray-400 hover:text-white transition-colors duration-200"> ${link.name} </a> </li>`)} </ul> </div>`)} </div> <div class="border-t border-gray-800 pt-8 mt-8"> <div class="flex flex-col md:flex-row justify-between items-center"> <p class="text-gray-400 text-sm"> ${currentYear} QuickSummit. All rights reserved.
</p> <div class="mt-4 md:mt-0"> <a href="/contact" class="text-gray-400 hover:text-white">
contact@quicksummit.net
</a> </div> </div> </div> </div> </footer>`;
}, "C:/Users/mkhay/windsurf/nebulous-nova/src/components/Footer.astro", void 0);

export { $$Layout as $, $$Header as a, $$Footer as b };
