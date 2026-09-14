// GBI prototype — minimal interactions

// Video modal — smooth fade+scale lightbox triggered by any .video-trigger
// element. Reads data-video-src for the iframe URL; if empty, shows a
// "video coming soon" placeholder so the modal mechanism still demos.
(function () {
  const modal = document.querySelector('[data-video-modal]');
  if (!modal) return;
  const frame = modal.querySelector('[data-video-frame]');

  function autoplayUrl(src) {
    // Append autoplay params for Vimeo / YouTube so the video starts on open.
    if (!src) return '';
    const join = src.includes('?') ? '&' : '?';
    if (/vimeo\.com|player\.vimeo\.com/i.test(src)) {
      return src + join + 'autoplay=1&dnt=1';
    }
    if (/youtube\.com|youtu\.be/i.test(src)) {
      return src + join + 'autoplay=1&rel=0';
    }
    return src;
  }

  function open(src) {
    if (!src) return;
    frame.innerHTML = `<iframe src="${autoplayUrl(src)}" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>`;
    modal.hidden = false;
    document.body.classList.add('video-modal-open');
    // Force a reflow so the transition runs (otherwise opacity goes 0→1 instantly).
    void modal.offsetWidth;
    modal.setAttribute('data-open', '');
    modal.setAttribute('aria-hidden', 'false');
  }

  function close() {
    modal.removeAttribute('data-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('video-modal-open');
    // Wait for the fade-out to finish before hiding + clearing the iframe.
    setTimeout(() => {
      modal.hidden = true;
      frame.innerHTML = '';
    }, 320);
  }

  // Open on click of any .video-trigger
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('.video-trigger');
    if (trigger) {
      e.preventDefault();
      open(trigger.getAttribute('data-video-src') || '');
      return;
    }
    if (e.target.closest('[data-video-close]')) {
      close();
    }
  });

  // ESC to close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.hasAttribute('data-open')) close();
  });
})();


// Animate stats counters on scroll into view
(function () {
  const els = document.querySelectorAll('[data-count]');
  if (!els.length || !('IntersectionObserver' in window)) {
    els.forEach(el => el.textContent = el.dataset.count);
    return;
  }
  const fmt = (n, decimals) => decimals ? n.toFixed(decimals) : Math.round(n).toLocaleString();
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = parseFloat(el.dataset.count);
      const decimals = (el.dataset.count.split('.')[1] || '').length;
      const dur = 1400;
      const start = performance.now();
      const ease = (t) => 1 - Math.pow(1 - t, 3);
      const tick = (now) => {
        const t = Math.min(1, (now - start) / dur);
        el.textContent = fmt(target * ease(t), decimals);
        if (t < 1) requestAnimationFrame(tick);
        else el.textContent = fmt(target, decimals);
      };
      requestAnimationFrame(tick);
      obs.unobserve(el);
    });
  }, { threshold: 0.4 });
  els.forEach(el => obs.observe(el));
})();

// Projects filter UI — dropdowns + multi-select + active-pill chips.
// Multi-select within a category (OR), AND across categories.
(function () {
  const filterPanel = document.querySelector('[data-project-filters]');
  const grid = document.querySelector('[data-gallery-grid], [data-project-grid]');
  if (!filterPanel) return;

  const CATEGORY_LABEL = {
    service: 'Service',
    industry: 'Industry',
    product: 'Product',
    state: 'State',
  };

  function gatherSelections() {
    // Returns {category: [values...]}
    const sel = {};
    filterPanel.querySelectorAll('.filter-dropdown').forEach(dd => {
      const cat = dd.dataset.filter;
      sel[cat] = Array.from(dd.querySelectorAll('input[type="checkbox"]:checked'))
        .map(input => ({
          value: input.dataset.value,
          label: input.parentElement.querySelector('.label').textContent,
        }));
    });
    return sel;
  }

  // Map category key → data-attribute name (data-services is plural, others match)
  const CAT_ATTR = { service: 'services', industry: 'industry', product: 'product', state: 'state' };

  // Does a card satisfy filters in category `cat`? (multi-value dataset supported for service/industry/product)
  function cardMatchesCat(card, cat, selections) {
    const chosen = selections[cat];
    if (!chosen || chosen.length === 0) return true;
    if (cat === 'state') {
      const v = card.dataset.state || '';
      return chosen.some(s => s.value === v);
    }
    const raw = (card.dataset[CAT_ATTR[cat]] || '').split(/\s+/).filter(Boolean);
    return chosen.some(s => raw.includes(s.value));
  }

  // Pagination for gallery: show first BATCH_SIZE tiles initially,
  // reveal BATCH_SIZE more per "Load More" click. Filters bypass pagination
  // (when any filter is active, all matches are shown).
  const BATCH_SIZE = 20;
  let visibleBatch = BATCH_SIZE;

  function applyFilters() {
    const sel = gatherSelections();
    const cards = grid ? Array.from(grid.querySelectorAll('.project-card, .gallery-tile')) : [];
    const anyFilter = Object.values(sel).some(arr => arr && arr.length > 0);

    let totalMatches = 0;
    let shownMatches = 0;
    if (grid) {
      cards.forEach(card => {
        const matches =
          cardMatchesCat(card, 'service', sel) &&
          cardMatchesCat(card, 'industry', sel) &&
          cardMatchesCat(card, 'product', sel) &&
          cardMatchesCat(card, 'state', sel);
        if (!matches) { card.style.display = 'none'; return; }
        totalMatches++;
        // Show all when filtered; otherwise only first N
        if (anyFilter || shownMatches < visibleBatch) {
          card.style.display = '';
          shownMatches++;
        } else {
          card.style.display = 'none';
        }
      });

      const countEl = document.querySelector('.js-count');
      if (countEl) countEl.textContent = totalMatches;
      const noResults = document.querySelector('.js-no-results');
      if (noResults) noResults.style.display = totalMatches === 0 ? 'block' : 'none';
      grid.style.display = totalMatches === 0 ? 'none' : '';

      // Update Load More button
      const loadMoreWrap = document.querySelector('.gallery-load-more-wrap');
      const loadMoreBtn = document.querySelector('[data-load-more]');
      if (loadMoreWrap && loadMoreBtn) {
        const remaining = totalMatches - shownMatches;
        if (anyFilter || remaining <= 0) {
          loadMoreWrap.style.display = 'none';
        } else {
          loadMoreWrap.style.display = '';
          loadMoreBtn.textContent = 'Load More Images (' + remaining + ' remaining)';
        }
      }
    }

    // Faceted counts + hide-zero: for each dropdown, count cards that would remain visible
    // if this dropdown's own filter were removed, then update each option label.
    filterPanel.querySelectorAll('.filter-dropdown').forEach(dd => {
      const cat = dd.dataset.filter;
      const attr = CAT_ATTR[cat];

      // Recompute against "other" filters only
      const optionCounts = {};
      cards.forEach(card => {
        const passesOthers =
          (cat === 'service'  || cardMatchesCat(card, 'service',  sel)) &&
          (cat === 'industry' || cardMatchesCat(card, 'industry', sel)) &&
          (cat === 'product'  || cardMatchesCat(card, 'product',  sel)) &&
          (cat === 'state'    || cardMatchesCat(card, 'state',    sel));
        if (!passesOthers) return;
        const values = cat === 'state'
          ? [card.dataset.state || '']
          : (card.dataset[attr] || '').split(/\s+/).filter(Boolean);
        values.forEach(v => { if (v) optionCounts[v] = (optionCounts[v] || 0) + 1; });
      });

      dd.querySelectorAll('.filter-option').forEach(opt => {
        const val = opt.dataset.value;
        const count = optionCounts[val] || 0;
        const labelEl = opt.querySelector('.label');
        // append/update count badge
        let countEl = labelEl.querySelector('.option-count');
        if (!countEl) {
          countEl = document.createElement('span');
          countEl.className = 'option-count';
          labelEl.appendChild(countEl);
        }
        countEl.textContent = count > 0 ? ' (' + count + ')' : '';
        // hide zero-count options unless currently selected
        const isChecked = opt.querySelector('input[type="checkbox"]').checked;
        opt.style.display = (count === 0 && !isChecked) ? 'none' : '';
      });

      // Existing "N selected" badge on the dropdown button
      const selCount = sel[cat].length;
      dd.classList.toggle('is-active', selCount > 0);
      const countBadge = dd.querySelector('.filter-count');
      if (countBadge) countBadge.textContent = selCount > 0 ? '(' + selCount + ')' : '';
    });

    // Render active pills
    const pillsContainer = filterPanel.querySelector('[data-active-pills]');
    const clearAllBtn = filterPanel.querySelector('[data-clear-all]');
    const totalSelected = Object.values(sel).reduce((sum, arr) => sum + arr.length, 0);
    if (pillsContainer) {
      pillsContainer.innerHTML = '';
      Object.entries(sel).forEach(([cat, items]) => {
        items.forEach(item => {
          const pill = document.createElement('span');
          pill.className = 'filter-pill';
          pill.innerHTML =
            `<span class="filter-pill-cat">${CATEGORY_LABEL[cat]}</span>` +
            `<span>${item.label}</span>` +
            `<button type="button" class="filter-pill-x" aria-label="Remove ${item.label} filter" ` +
            `data-cat="${cat}" data-value="${item.value}">×</button>`;
          pillsContainer.appendChild(pill);
        });
      });
      pillsContainer.hidden = totalSelected === 0;
    }
    if (clearAllBtn) clearAllBtn.hidden = totalSelected === 0;
  }

  // Open/close dropdowns
  filterPanel.addEventListener('click', (e) => {
    const btn = e.target.closest('.filter-dropdown-btn');
    if (btn) {
      const dd = btn.closest('.filter-dropdown');
      const wasOpen = dd.classList.contains('is-open');
      // Close all others
      filterPanel.querySelectorAll('.filter-dropdown.is-open').forEach(d => {
        d.classList.remove('is-open');
        d.querySelector('.filter-dropdown-btn')?.setAttribute('aria-expanded', 'false');
      });
      if (!wasOpen) {
        dd.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
      }
      return;
    }
    // Click on a filter-option toggles its checkbox
    const opt = e.target.closest('.filter-option');
    if (opt) {
      const cb = opt.querySelector('input[type="checkbox"]');
      // Native checkbox toggling handles itself if user clicks the input directly;
      // if they clicked the label area, the browser also toggles via the label semantic.
      // We only need to recompute filters after change.
      // Defer so the checked state is updated by the browser first.
      setTimeout(applyFilters, 0);
      return;
    }
    // Pill × button
    const x = e.target.closest('.filter-pill-x');
    if (x) {
      const { cat, value } = x.dataset;
      const cb = filterPanel.querySelector(`.filter-dropdown[data-filter="${cat}"] input[data-value="${value}"]`);
      if (cb) {
        cb.checked = false;
        applyFilters();
      }
      return;
    }
    // Clear all
    if (e.target.closest('[data-clear-all]')) {
      filterPanel.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
      filterPanel.querySelectorAll('.filter-dropdown.is-open').forEach(d => d.classList.remove('is-open'));
      applyFilters();
      return;
    }
  });

  // Close any open dropdown when click isn't on the dropdown itself (its button or menu).
  // This means clicking on project cards, the pill row, whitespace, or anywhere else
  // closes any open dropdown.
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.filter-dropdown')) {
      filterPanel.querySelectorAll('.filter-dropdown.is-open').forEach(d => {
        d.classList.remove('is-open');
        d.querySelector('.filter-dropdown-btn')?.setAttribute('aria-expanded', 'false');
      });
    }
  });

  // Escape closes any open dropdown
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      filterPanel.querySelectorAll('.filter-dropdown.is-open').forEach(d => {
        d.classList.remove('is-open');
        d.querySelector('.filter-dropdown-btn')?.setAttribute('aria-expanded', 'false');
      });
    }
  });

  // Reset button inside no-results state
  document.addEventListener('click', (e) => {
    if (e.target.closest('[data-reset-filters]')) {
      filterPanel.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
      visibleBatch = BATCH_SIZE;
      applyFilters();
    }
  });

  // Load More button — reveals next batch of gallery tiles
  document.addEventListener('click', (e) => {
    if (e.target.closest('[data-load-more]')) {
      visibleBatch += BATCH_SIZE;
      applyFilters();
    }
  });

  // Initial state
  applyFilters();
})();

// Mobile menu toggle (very lightweight)
(function () {
  document.querySelectorAll('.nav-mobile').forEach(btn => {
    btn.addEventListener('click', () => {
      const nav = btn.closest('.nav-row')?.querySelector('.primary-nav');
      if (nav) nav.classList.toggle('is-open');
    });
  });
})();

// Nav dropdowns (Services / Industries)
// Desktop: hover handles it (CSS-only). This JS adds:
//   - touch-device support (tap parent to open instead of navigating)
//   - keyboard support (Enter on parent toggles)
//   - outside-click and Escape to close
(function () {
  const items = document.querySelectorAll('.nav-item.has-dropdown');
  if (!items.length) return;

  const isTouchOnly = window.matchMedia('(hover: none)').matches;

  function closeAll(except) {
    items.forEach(item => {
      if (item === except) return;
      item.classList.remove('is-open');
      const p = item.querySelector('.nav-parent');
      if (p) p.setAttribute('aria-expanded', 'false');
    });
  }

  items.forEach(item => {
    const parent = item.querySelector('.nav-parent');
    if (!parent) return;
    parent.addEventListener('click', (e) => {
      // If the parent is a button (no href), always toggle.
      // If the parent is a link, on touch-only devices we toggle first
      // and require a second tap to follow the link. On hover-capable
      // devices we let the link navigate normally.
      const isLink = parent.tagName === 'A';
      const shouldToggle = !isLink || isTouchOnly;
      if (shouldToggle) {
        if (!item.classList.contains('is-open')) {
          e.preventDefault();
          closeAll(item);
          item.classList.add('is-open');
          parent.setAttribute('aria-expanded', 'true');
        }
        // Second tap: let it through (navigate)
      }
    });
    parent.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const open = item.classList.toggle('is-open');
        parent.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) closeAll(item);
      }
    });
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.nav-item.has-dropdown')) closeAll();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
  });
})();

// Leadership bio expand/collapse
//   Each row of 3 cards shares one bio panel. Clicking + on a card:
//   - fills its name/role/bio into the row's panel
//   - opens the panel
//   - marks that card as active (lime accent)
//   Clicking again on the same card OR the panel's × closes it.
//   Clicking a different card in the same row swaps the content.
//   Clicking a card in a different row closes the previous panel + opens new one.
(function () {
  const cards = document.querySelectorAll('.bio-card');
  if (!cards.length) return;

  function closePanel(panel) {
    if (!panel) return;
    panel.classList.remove('is-open');
    panel.setAttribute('aria-hidden', 'true');
    // Reset all cards' open state for cards belonging to this panel's row
    const row = panel.dataset.row;
    document.querySelectorAll(`.bio-card`).forEach((c, idx) => {
      if (Math.floor(idx / 3) === Number(row)) {
        c.classList.remove('is-open');
        const t = c.querySelector('.bio-toggle');
        if (t) t.setAttribute('aria-expanded', 'false');
      }
    });
  }

  function openCard(card) {
    // Locate the panel for this card's row
    const cardList = Array.from(document.querySelectorAll('.bio-card'));
    const idx = cardList.indexOf(card);
    const row = Math.floor(idx / 3);
    const panel = document.querySelector(`.bio-panel[data-row="${row}"]`);
    if (!panel) return;

    // Close any other open panels (in other rows)
    document.querySelectorAll('.bio-panel.is-open').forEach(p => {
      if (p !== panel) closePanel(p);
    });

    // Mark this card as the active one in its row
    cardList.forEach((c, i) => {
      if (Math.floor(i / 3) === row) {
        c.classList.toggle('is-open', c === card);
        const t = c.querySelector('.bio-toggle');
        if (t) t.setAttribute('aria-expanded', c === card ? 'true' : 'false');
      }
    });

    // Populate panel content from data attributes
    panel.querySelector('.js-bio-name').textContent = card.dataset.name || '';
    panel.querySelector('.js-bio-role').textContent = card.dataset.role || '';
    panel.querySelector('.js-bio-text').innerHTML = `<p>${card.dataset.bio || ''}</p>`;

    panel.classList.add('is-open');
    panel.setAttribute('aria-hidden', 'false');
  }

  document.addEventListener('click', (e) => {
    const toggle = e.target.closest('.bio-toggle');
    if (toggle) {
      const card = toggle.closest('.bio-card');
      if (!card) return;
      if (card.classList.contains('is-open')) {
        // Toggle off
        const cardList = Array.from(document.querySelectorAll('.bio-card'));
        const idx = cardList.indexOf(card);
        const row = Math.floor(idx / 3);
        const panel = document.querySelector(`.bio-panel[data-row="${row}"]`);
        closePanel(panel);
      } else {
        openCard(card);
      }
      return;
    }
    const close = e.target.closest('.bio-panel-close');
    if (close) {
      closePanel(close.closest('.bio-panel'));
    }
  });

  // Escape closes any open panel
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('.bio-panel.is-open').forEach(closePanel);
  });
})();

// Photo specs toggle — hides/shows the lime photo-direction chips site-wide.
// Footer button writes localStorage so the choice persists across pages.
(function () {
  const KEY = 'gbi-hide-photo-specs';

  function apply(hidden) {
    document.body.classList.toggle('hide-photo-specs', hidden);
    document.querySelectorAll('.photo-specs-toggle').forEach(btn => {
      btn.textContent = hidden ? 'Photo specs: off' : 'Photo specs: on';
      btn.setAttribute('aria-pressed', hidden ? 'false' : 'true');
    });
  }

  // Apply saved state on load
  const saved = localStorage.getItem(KEY) === '1';
  apply(saved);

  // Wire up clicks
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.photo-specs-toggle');
    if (!btn) return;
    const willHide = !document.body.classList.contains('hide-photo-specs');
    localStorage.setItem(KEY, willHide ? '1' : '0');
    apply(willHide);
  });
})();


// Contact form — posts the project inquiry to a Power Automate HTTP-trigger
// flow, then confirms on screen. Never leaves a submitter without an answer:
// on any failure it surfaces the error AND a mailto fallback carrying what
// they typed, so the lead is not lost silently.
//
// CORS note, and it is load-bearing: the request is sent as text/plain, not
// application/json. text/plain is a CORS "simple request", so the browser
// skips the preflight OPTIONS call — which Power Automate HTTP triggers do
// not answer. The body is still a JSON string; the flow parses it with
// json(triggerBody()). The flow's Response action must return
// Access-Control-Allow-Origin or the browser will block reading the reply.
// See FORM-INTEGRATION.md.
(function () {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;

  const statusEl = form.querySelector('[data-form-status]');
  const button = form.querySelector('[data-form-submit]');
  const success = document.getElementById('contact-success');
  const endpoint = form.dataset.endpoint || '';
  const FALLBACK_EMAIL = 'sales@mygbi.com';
  const renderedAt = Date.now();

  // Unreplaced build placeholder counts as "not configured".
  const configured = endpoint && !endpoint.includes('__GBI_FORM_ENDPOINT__');

  function setStatus(message, isError) {
    statusEl.textContent = message || '';
    statusEl.classList.toggle('is-error', !!isError);
  }

  function values() {
    const data = {};
    new FormData(form).forEach((value, key) => {
      data[key] = typeof value === 'string' ? value.trim() : value;
    });
    return data;
  }

  // Everything the submitter typed, as a mailto they can send in one click.
  function mailtoFallback(data) {
    const lines = [
      ['Name', [data.firstName, data.lastName].filter(Boolean).join(' ')],
      ['Company', data.company],
      ['Title', data.jobTitle],
      ['Phone', data.phone],
      ['Email', data.email],
      ['Project Location', data.projectLocation],
      ['Project Type', data.projectType],
      ['How they heard about us', data.referralSource],
      ['', ''],
      ['Project Description', data.projectDescription],
    ]
      .filter(([label, value]) => label === '' || value)
      .map(([label, value]) => (label ? label + ': ' + value : ''))
      .join('\n');

    return (
      'mailto:' + FALLBACK_EMAIL +
      '?subject=' + encodeURIComponent('Project Inquiry — ' + (data.company || data.lastName || 'Website')) +
      '&body=' + encodeURIComponent(lines)
    );
  }

  function failed(data, message) {
    const link = document.createElement('a');
    link.href = mailtoFallback(data);
    link.textContent = 'send it to ' + FALLBACK_EMAIL + ' instead';

    statusEl.classList.add('is-error');
    statusEl.textContent = message + ' You can ';
    statusEl.appendChild(link);
    statusEl.appendChild(document.createTextNode(' — we have kept what you typed.'));
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = values();

    // Bot checks. Both fail silently: a real person never trips them, and a
    // bot learns nothing from the response.
    if (data.companyWebsite) return;
    if (Date.now() - renderedAt < 3000) return;
    delete data.companyWebsite;

    if (!configured) {
      failed(data, 'The inquiry form is not connected yet.');
      return;
    }

    button.disabled = true;
    setStatus('Sending your inquiry…', false);

    try {
      const response = await fetch(endpoint, {
        method: 'POST',
        // See the CORS note above — do not change this to application/json.
        headers: { 'Content-Type': 'text/plain;charset=UTF-8' },
        body: JSON.stringify({
          ...data,
          submittedAt: new Date().toISOString(),
          sourcePage: window.location.href,
        }),
      });

      if (!response.ok) throw new Error('HTTP ' + response.status);

      form.hidden = true;
      success.hidden = false;
      success.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } catch (err) {
      button.disabled = false;
      failed(data, 'Something went wrong sending that.');
    }
  });
})();
