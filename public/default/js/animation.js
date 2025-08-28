/* public/default/js/animation.js */
(function () {
  const formatBR = n => n.toLocaleString('pt-BR');

  // easings mais suaves
  const eases = {
    outCubic: t => 1 - Math.pow(1 - t, 3),
    outQuart: t => 1 - Math.pow(1 - t, 4),
    outQuint: t => 1 - Math.pow(1 - t, 5),
    outExpo:  t => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)),
    inOutCubic: t => t < .5 ? 4*t*t*t : 1 - Math.pow(-2*t + 2, 3)/2
  };

  const DEFAULTS = { duration: 2000, ease: 'outQuint', delayStep: 120 }; // <- mais suave

  function animate(el) {
    if (!el || el.dataset.counted === '1') return;
    el.dataset.counted = '1';

    const target   = parseInt(el.getAttribute('data-target'), 10) || 0;
    const duration = parseInt(el.getAttribute('data-duration'), 10) || DEFAULTS.duration;
    const easeName = el.getAttribute('data-ease') || DEFAULTS.ease;
    const ease     = eases[easeName] || eases[DEFAULTS.ease];

    const start = performance.now();
    el.textContent = '0';

    function frame(now) {
      const p = Math.min((now - start) / duration, 1);
      const val = Math.round(target * ease(p));
      el.textContent = formatBR(val);
      if (p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  function initCountups(root) {
    const els = (root || document).querySelectorAll('.featured-results .number-value');
    if (!els.length) return;

    // anima em cascata leve
    els.forEach((el, i) => setTimeout(() => animate(el), i * DEFAULTS.delayStep));
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initCountups(), { once: true });
  } else {
    initCountups();
  }

  // reexecutar em navegações “soft”
  window.MPAnimateCountups = initCountups;
  ['turbo:load','turbolinks:load'].forEach(evt =>
    window.addEventListener(evt, () => initCountups())
  );
  document.addEventListener('livewire:load',  () => initCountups());
  document.addEventListener('htmx:afterSwap', e => initCountups(e.target || document));
})();