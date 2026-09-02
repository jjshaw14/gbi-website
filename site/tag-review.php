<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex,nofollow" />
<title>Gallery Tag Review · Great Basin Industrial</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/styles.css" />
<style>
  :root {
    --review-warn:#c14a1a;
    --review-ok:#3f8f37;
  }
  body { background: var(--gbi-offwhite); }
  .review-wrap { max-width: 1180px; margin: 0 auto; padding: 40px 24px 120px; }
  .review-hdr h1 { font-size: 2rem; color: var(--gbi-navy); margin: 0 0 8px; letter-spacing: -0.01em; }
  .review-hdr .lead { color: var(--ink-soft); font-size: 1rem; line-height: 1.55; margin-bottom: 24px; max-width: 780px; }
  .review-stats { display:flex; gap:32px; align-items:center; padding:20px 24px; background:var(--white); border:1px solid var(--rule); margin-bottom:24px; }
  .review-stats > div { font-size:.95rem; color:var(--ink-soft); }
  .review-stats strong { color: var(--gbi-navy); font-weight:800; font-size:1.35rem; display:block; }
  .review-toolbar { position: sticky; top: 0; z-index: 20; background: var(--gbi-offwhite); padding: 12px 0 16px; margin-bottom: 16px; display:flex; gap:12px; align-items:center; flex-wrap:wrap; border-bottom:1px solid var(--rule); }
  .review-toolbar button { font-family: inherit; font-size: .82rem; letter-spacing:.1em; text-transform: uppercase; font-weight: 800; padding: 12px 20px; border-radius: 2px; cursor: pointer; border:0; }
  .review-toolbar .btn-download { background: var(--gbi-lime); color: var(--gbi-navy); }
  .review-toolbar .btn-clear { background: transparent; color: var(--ink-soft); border:1px solid var(--rule); }
  .review-toolbar .btn-download:hover { transform: translateY(-1px); }
  .review-toolbar .progress { margin-left:auto; font-size:.9rem; color: var(--ink-soft); }
  .review-toolbar .progress strong { color: var(--gbi-navy); font-weight:800; }
  .tag-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 16px; }
  .tag-card { background: var(--white); border:1px solid var(--rule); display:flex; flex-direction:column; transition: box-shadow .18s ease, border-color .18s ease; }
  .tag-card.is-picked { border-color: var(--review-ok); box-shadow: inset 4px 0 0 var(--review-ok); }
  .tag-card-thumb { background:#111; aspect-ratio: 16/10; overflow:hidden; }
  .tag-card-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
  .tag-card-meta { padding: 16px 18px 18px; display:flex; flex-direction:column; gap:8px; }
  .tag-card-title { font-weight: 800; color: var(--gbi-navy); font-size: 1rem; line-height:1.3; }
  .tag-card-desc { color: var(--ink-soft); font-size:.9rem; line-height:1.5; }
  .tag-card-empty { color: var(--muted); font-style: italic; }
  .tag-card-meta-row { display:flex; gap:16px; flex-wrap:wrap; margin-top:4px; font-size:.78rem; color: var(--muted); }
  .tag-card-meta-row code { background: var(--gbi-offwhite); padding: 2px 6px; font-size:.75rem; color: var(--gbi-blue); }
  .tag-card-meta-row strong { color: var(--ink-soft); font-weight:700; }
  .tag-card-picker { margin-top: 8px; padding-top:12px; border-top:1px solid var(--rule); display:flex; gap:8px; align-items:center; }
  .tag-card-picker label { font-size:.78rem; color:var(--muted); letter-spacing:.06em; text-transform:uppercase; font-weight:700; }
  .tag-card-picker select { flex:1; padding: 8px 10px; font-family: inherit; font-size:.9rem; border: 1px solid var(--rule); background: var(--white); color: var(--gbi-navy); font-weight: 600; }
  .tag-card-picker select:focus { outline: 2px solid var(--gbi-blue); outline-offset: 1px; }
  .removal-note { padding: 16px 20px; background: #fff8e6; border: 1px solid #f0d288; color: #6b4d00; margin-bottom: 20px; font-size:.9rem; line-height: 1.5; }
</style>
</head>
<body>

<?php $NAV_ACTIVE = 'projects'; include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<div class="review-wrap">
  <div class="review-hdr">
    <h1>Gallery Product Tag Review</h1>
    <p class="lead">These are the 91 project gallery photos that our auto-classifier couldn't confidently assign to a product category. Pick the right tag for each one from the dropdown below, then click <strong>Download JSON</strong> at the top to send back your selections. Your selections auto-save in this browser, so you can leave and come back without losing progress.</p>
  </div>

  <div class="removal-note">
    <strong>REVIEW PAGE ONLY</strong> — this URL will be removed before the site goes live. If you find any items marked "skip / needs GBI", they'll stay untagged in the gallery until someone at GBI tells us what they are.
  </div>

  <div class="review-stats">
    <div><strong>91</strong>Photos to review</div>
    <div><strong id="stat-picked">0</strong>Tags assigned</div>
    <div><strong id="stat-skipped">0</strong>Marked as skip</div>
    <div><strong id="stat-remaining">91</strong>Still untouched</div>
  </div>

  <div class="review-toolbar">
    <button type="button" class="btn-download" id="btn-download">↓ Download JSON</button>
    <button type="button" class="btn-clear" id="btn-clear">Clear all selections</button>
    <div class="progress"><strong id="progress-count">0</strong> of 91 decided</div>
  </div>

  <div class="tag-grid">
    
    <div class="tag-card" data-tile-id="0">
      <div class="tag-card-thumb">
        <img src="/assets/images/case-studies/coors-g150-hero.jpg" alt="Coors G150 Brewery Tank Project" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Coors G150 Brewery Tank Project</div>
        <div class="tag-card-desc">Ziemann Holvrieka / Molson Coors &middot; Golden, CO. On-site fabrication &amp; installation of 118 stainless steel process tanks to ASME and food-grade sanitary standards.</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>water-other</strong></span>
          <span class="tag-card-file">File: <code>coors-g150-hero.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-0">Product tag:</label>
          <select id="pick-0" data-tile-id="0">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="5">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/111-scaled.jpg" alt="Power Generation" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generation</div>
        <div class="tag-card-desc">Air Cooled Condenser Rebundling. Fabrication of steam distribution and condensate collection manifolds. Onsite demolition of existing manifolds, tube bundles and structural and replacement with new.</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>111-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-5">Product tag:</label>
          <select id="pick-5" data-tile-id="5">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="8">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/23-scaled.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(6) 280′ Flare Stacks and Ignitors for STAR, world’s largest crude oil refinery in Turkey</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>23-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-8">Product tag:</label>
          <select id="pick-8" data-tile-id="8">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="10">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/1.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(2) 62′ Elevated Surge Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-10">Product tag:</label>
          <select id="pick-10" data-tile-id="10">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="12">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/2-scaled.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">Fire Sunset Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>2-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-12">Product tag:</label>
          <select id="pick-12" data-tile-id="12">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="13">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/3-scaled.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(2) 123’d x 56′ API Tanks w/ IFR</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>3-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-13">Product tag:</label>
          <select id="pick-13" data-tile-id="13">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="15">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/5-scaled.jpg" alt="Power Generating Station ACC work" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generating Station ACC work</div>
        <div class="tag-card-desc">Removal and replacement of expansion joint</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>5-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-15">Product tag:</label>
          <select id="pick-15" data-tile-id="15">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="16">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/6-scaled.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(5) 120′ x 56′ API Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>6-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-16">Product tag:</label>
          <select id="pick-16" data-tile-id="16">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="24">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/12.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(2) 50’d Elevated Oil/Water Separator Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>12.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-24">Product tag:</label>
          <select id="pick-24" data-tile-id="24">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="30">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/18.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">API Tank EFR Seal Replacement</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>18.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-30">Product tag:</label>
          <select id="pick-30" data-tile-id="30">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="32">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/19-1.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">API Tank Bottom Replacement</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>19-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-32">Product tag:</label>
          <select id="pick-32" data-tile-id="32">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="34">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/21-1.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">API Tank Clean Out Door</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>21-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-34">Product tag:</label>
          <select id="pick-34" data-tile-id="34">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="35">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/22-scaled.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">(5) 125′ dia x 56′ API Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>22-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-35">Product tag:</label>
          <select id="pick-35" data-tile-id="35">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="40">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/28.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">Shell Course Replacement with Helical Stairway</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>28.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-40">Product tag:</label>
          <select id="pick-40" data-tile-id="40">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="41">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/29.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">API Tank, Ladder &amp; Sample Station</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>29.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-41">Product tag:</label>
          <select id="pick-41" data-tile-id="41">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="42">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/30.jpg" alt="" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title"><span class="tag-card-empty">(no title)</span></div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>30.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-42">Product tag:</label>
          <select id="pick-42" data-tile-id="42">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="43">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/31.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">24 Various Storage &amp; Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>31.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-43">Product tag:</label>
          <select id="pick-43" data-tile-id="43">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="44">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/32.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">39’d x 67′ Elevated Thickener</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>32.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-44">Product tag:</label>
          <select id="pick-44" data-tile-id="44">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="45">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/32-1.jpg" alt="MIning &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">MIning &amp; Aggregates</div>
        <div class="tag-card-desc">Elevated Load Out Bin</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>32-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-45">Product tag:</label>
          <select id="pick-45" data-tile-id="45">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="46">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/33.jpg" alt="MIning &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">MIning &amp; Aggregates</div>
        <div class="tag-card-desc">Night Work on Elevated Thickener</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>33.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-46">Product tag:</label>
          <select id="pick-46" data-tile-id="46">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="47">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/34.jpg" alt="MIning &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">MIning &amp; Aggregates</div>
        <div class="tag-card-desc">24’d x 18′ Stainless Steel Acid Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>34.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-47">Product tag:</label>
          <select id="pick-47" data-tile-id="47">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="48">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/35.jpg" alt="MIning &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">MIning &amp; Aggregates</div>
        <div class="tag-card-desc">24’d x 18′ Stainless Steel Acid Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>35.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-48">Product tag:</label>
          <select id="pick-48" data-tile-id="48">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="49">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/36-scaled.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">(2) 55’d x 32′ Acid Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>36-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-49">Product tag:</label>
          <select id="pick-49" data-tile-id="49">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="51">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/38.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">(5) 125’d Elevated Thickeners w/ Scalloped Bottoms</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>38.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-51">Product tag:</label>
          <select id="pick-51" data-tile-id="51">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="52">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/39.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Platform on Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>39.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-52">Product tag:</label>
          <select id="pick-52" data-tile-id="52">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="53">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/40.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">148’d Elevated Thickener w/ Scalloped Bottoms</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>40.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-53">Product tag:</label>
          <select id="pick-53" data-tile-id="53">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="54">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/41.jpg" alt="Rubber-Lined Hopper 1" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Rubber-Lined Hopper 1</div>
        <div class="tag-card-desc">Rubber-Lined Hopper 1</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>41.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-54">Product tag:</label>
          <select id="pick-54" data-tile-id="54">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="55">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/42.jpg" alt="Mining" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining</div>
        <div class="tag-card-desc">Elevated Reactor Vessel</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>42.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-55">Product tag:</label>
          <select id="pick-55" data-tile-id="55">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="56">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/43.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Multiple Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>43.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-56">Product tag:</label>
          <select id="pick-56" data-tile-id="56">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="57">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/44.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">85’d x 45′ Sulfuric Acid Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>44.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-57">Product tag:</label>
          <select id="pick-57" data-tile-id="57">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="58">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/45.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Rubber-Lined Hopper 2</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>45.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-58">Product tag:</label>
          <select id="pick-58" data-tile-id="58">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="59">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/46.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">9 Storage &amp; Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>46.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-59">Product tag:</label>
          <select id="pick-59" data-tile-id="59">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="60">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/071.jpg" alt="" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title"><span class="tag-card-empty">(no title)</span></div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>071.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-60">Product tag:</label>
          <select id="pick-60" data-tile-id="60">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="64">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/c276-high-nickel-alloy-reactor-tank.jpg" alt="Power Generation" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generation</div>
        <div class="tag-card-desc">Multiple Process ﻿Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>c276-high-nickel-alloy-reactor-tank.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-64">Product tag:</label>
          <select id="pick-64" data-tile-id="64">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="66">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/water-tank-roof-structure-1.jpg" alt="Waste &amp; Wastewater" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Waste &amp; Wastewater</div>
        <div class="tag-card-desc">Water Tank Roof Structure</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>water-tank-roof-structure-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-66">Product tag:</label>
          <select id="pick-66" data-tile-id="66">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="67">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/img_2692.jpg" alt="Power Generation" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generation</div>
        <div class="tag-card-desc">C276 High-Nickel Alloy Reactor Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>img_2692.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-67">Product tag:</label>
          <select id="pick-67" data-tile-id="67">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="68">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/img_0623.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Water Tank Roof</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>img_0623.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-68">Product tag:</label>
          <select id="pick-68" data-tile-id="68">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="69">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/copy_0_44d-x-48-water-tank-construction.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">44’d x 48′ Water Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>copy_0_44d-x-48-water-tank-construction.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-69">Product tag:</label>
          <select id="pick-69" data-tile-id="69">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="72">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/2-50-d-elevated-oil-water-separator-tanks.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">(2) 50’d Elevated Oil/Water Separator Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>2-50-d-elevated-oil-water-separator-tanks.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-72">Product tag:</label>
          <select id="pick-72" data-tile-id="72">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="73">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/014.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">86’d x 27′ Municipal Water Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>014.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-73">Product tag:</label>
          <select id="pick-73" data-tile-id="73">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="74">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/chippewa-falls-6.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Multiple Process﻿ Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>chippewa-falls-6.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-74">Product tag:</label>
          <select id="pick-74" data-tile-id="74">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="78">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/spreader-bar.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Spreader Bar</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>spreader-bar.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-78">Product tag:</label>
          <select id="pick-78" data-tile-id="78">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="79">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/pict0653.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Shop Tank with Galvanized Ladder &amp; Rail</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>pict0653.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-79">Product tag:</label>
          <select id="pick-79" data-tile-id="79">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="80">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/stair-tower.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Stair Tower</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>stair-tower.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-80">Product tag:</label>
          <select id="pick-80" data-tile-id="80">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="82">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/pict0885.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">(4) 13.5’d x 35′ Stainless Steel Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>pict0885.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-82">Product tag:</label>
          <select id="pick-82" data-tile-id="82">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="83">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/shoptank.jpg" alt="Industrial Tanks &amp; Storage" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Industrial Tanks &amp; Storage</div>
        <div class="tag-card-desc">Shop Tank w/ Stair &amp; Rail</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>shoptank.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-83">Product tag:</label>
          <select id="pick-83" data-tile-id="83">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="96">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/ACCPlymouth230kb.jpg" alt="Steam Distribution Manifolds for ACC" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Steam Distribution Manifolds for ACC</div>
        <div class="tag-card-desc">Project fabricated and installed for power plant in WY</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>ACCPlymouth230kb.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-96">Product tag:</label>
          <select id="pick-96" data-tile-id="96">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="132">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_8598.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc">117’d x 28′ API Tank w/ Internal Floating Roof and Geodesic Dome</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_8598.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-132">Product tag:</label>
          <select id="pick-132" data-tile-id="132">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="133">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/ConeBottomTankFab-scaled.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Cone Bottom Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>ConeBottomTankFab-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-133">Product tag:</label>
          <select id="pick-133" data-tile-id="133">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="135">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_1071-1.jpg" alt="Oil Gas &amp; Chemical" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Oil Gas &amp; Chemical</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_1071-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-135">Product tag:</label>
          <select id="pick-135" data-tile-id="135">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="142">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_10121.jpg" alt="Railcar Offloading facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_10121.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-142">Product tag:</label>
          <select id="pick-142" data-tile-id="142">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="143">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_10531.jpg" alt="Railcar Offloading Facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading Facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_10531.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-143">Product tag:</label>
          <select id="pick-143" data-tile-id="143">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="144">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_09011.jpg" alt="Railcar Offloading Facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading Facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_09011.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-144">Product tag:</label>
          <select id="pick-144" data-tile-id="144">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="145">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_1157.jpg" alt="Railcar Offloading Facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading Facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_1157.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-145">Product tag:</label>
          <select id="pick-145" data-tile-id="145">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="146">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_1153.jpg" alt="Railcar Offloading Facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading Facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_1153.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-146">Product tag:</label>
          <select id="pick-146" data-tile-id="146">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="147">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/IMG_1154-1.jpg" alt="Railcar Offloading Facility" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Railcar Offloading Facility</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>IMG_1154-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-147">Product tag:</label>
          <select id="pick-147" data-tile-id="147">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="148">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/2575.jpeg" alt="Stainless Cone Bottom Tank" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Stainless Cone Bottom Tank</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>2575.jpeg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-148">Product tag:</label>
          <select id="pick-148" data-tile-id="148">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="156">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/PumpJacksESPsPLCsROCstransmitters.jpg" alt="ESPs PLCs ROCs Transmitters for Oilfield" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">ESPs PLCs ROCs Transmitters for Oilfield</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>PumpJacksESPsPLCsROCstransmitters.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-156">Product tag:</label>
          <select id="pick-156" data-tile-id="156">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="157">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/Pump.jpg" alt="Pumps" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Pumps</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>Pump.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-157">Product tag:</label>
          <select id="pick-157" data-tile-id="157">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="159">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/MotorsforSWpumpsonSWD.jpg" alt="Motors for Salt Water Pumps" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Motors for Salt Water Pumps</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>MotorsforSWpumpsonSWD.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-159">Product tag:</label>
          <select id="pick-159" data-tile-id="159">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="161">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/Nightshot.jpg" alt="" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title"><span class="tag-card-empty">(no title)</span></div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>Nightshot.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-161">Product tag:</label>
          <select id="pick-161" data-tile-id="161">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="162">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/PLC1.jpg" alt="Complete Panels" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Complete Panels</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>PLC1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-162">Product tag:</label>
          <select id="pick-162" data-tile-id="162">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="165">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/Piping.jpg" alt="" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title"><span class="tag-card-empty">(no title)</span></div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>Piping.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-165">Product tag:</label>
          <select id="pick-165" data-tile-id="165">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="167">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/runs-1.jpg" alt="" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title"><span class="tag-card-empty">(no title)</span></div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>runs-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-167">Product tag:</label>
          <select id="pick-167" data-tile-id="167">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="168">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/compressorstations-1.jpg" alt="Compressor Stations" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Compressor Stations</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>compressorstations-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-168">Product tag:</label>
          <select id="pick-168" data-tile-id="168">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="169">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/6-2.jpg" alt="Power Generating Station ACC work" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generating Station ACC work</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>6-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-169">Product tag:</label>
          <select id="pick-169" data-tile-id="169">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="172">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/30928-2.jpeg" alt="Tank Foundations" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Tank Foundations</div>
        <div class="tag-card-desc">20 large diameter foundations and tanks for terminal</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>oil-gas-chemical</strong></span>
          <span class="tag-card-file">File: <code>30928-2.jpeg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-172">Product tag:</label>
          <select id="pick-172" data-tile-id="172">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="175">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/24-storage-process-tank-units-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">24 Various Storage &amp; Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>24-storage-process-tank-units-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-175">Product tag:</label>
          <select id="pick-175" data-tile-id="175">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="176">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/39-d-x-67-elevated-thickener-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">39’d x 67′ Elevated Thickener</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>39-d-x-67-elevated-thickener-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-176">Product tag:</label>
          <select id="pick-176" data-tile-id="176">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="177">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/elevated-load-out-bin-1.jpg" alt="MIning &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">MIning &amp; Aggregates</div>
        <div class="tag-card-desc">Elevated Load Out Bin</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>elevated-load-out-bin-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-177">Product tag:</label>
          <select id="pick-177" data-tile-id="177">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="178">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/imag0338-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Night Work on Elevated Thickener</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>imag0338-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-178">Product tag:</label>
          <select id="pick-178" data-tile-id="178">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="179">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/copy_0_24d-x-18-stainless-steel-acid-tank-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">24’d x 18′ Stainless Steel Acid Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>copy_0_24d-x-18-stainless-steel-acid-tank-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-179">Product tag:</label>
          <select id="pick-179" data-tile-id="179">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="183">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/741-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">(5) 125’d Elevated Thickeners w/ Scalloped Bottoms</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>741-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-183">Product tag:</label>
          <select id="pick-183" data-tile-id="183">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="184">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/platform-on-top-of-tank-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Platform on Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>platform-on-top-of-tank-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-184">Product tag:</label>
          <select id="pick-184" data-tile-id="184">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="185">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/barrick-148-dia-thickener-6-21-13-003-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">148’d Elevated Thickener w/ Scalloped Bottoms</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>barrick-148-dia-thickener-6-21-13-003-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-185">Product tag:</label>
          <select id="pick-185" data-tile-id="185">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="186">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/rubber-lined-hopper-1-2.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Rubber-Lined Hopper 1</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>rubber-lined-hopper-1-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-186">Product tag:</label>
          <select id="pick-186" data-tile-id="186">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="187">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/elevated-reactor-vessel-1.jpg" alt="Mining" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining</div>
        <div class="tag-card-desc">Elevated Reactor Vessel</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>elevated-reactor-vessel-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-187">Product tag:</label>
          <select id="pick-187" data-tile-id="187">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="189">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/85-d-x-45-sulfuric-acid-tank-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">85’d x 45′ Sulfuric Acid Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>85-d-x-45-sulfuric-acid-tank-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-189">Product tag:</label>
          <select id="pick-189" data-tile-id="189">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="190">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/rubber-lined-hopper-2-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">Rubber-Lined Hopper 2</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>rubber-lined-hopper-2-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-190">Product tag:</label>
          <select id="pick-190" data-tile-id="190">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="191">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/20130621_110039-2-1.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">9 Storage &amp; Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>20130621_110039-2-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-191">Product tag:</label>
          <select id="pick-191" data-tile-id="191">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="192">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/071-2.jpg" alt="Mining &amp; Aggregates" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Mining &amp; Aggregates</div>
        <div class="tag-card-desc">4 Storage &amp; Process Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>071-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-192">Product tag:</label>
          <select id="pick-192" data-tile-id="192">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="196">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/2575-1-1.jpeg" alt="Stainless Cone Bottom Tank" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Stainless Cone Bottom Tank</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>mining</strong></span>
          <span class="tag-card-file">File: <code>2575-1-1.jpeg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-196">Product tag:</label>
          <select id="pick-196" data-tile-id="196">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="199">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/ACCphotoWY-scaled.jpg" alt="Power Generation" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generation</div>
        <div class="tag-card-desc">Air Cooled Condenser Rebundling. Fabrication of steam distribution and condensate collection manifolds. Onsite demolition of existing manifolds, tube bundles and structural and replacement with new.</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>power</strong></span>
          <span class="tag-card-file">File: <code>ACCphotoWY-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-199">Product tag:</label>
          <select id="pick-199" data-tile-id="199">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="200">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/10-1-scaled.jpg" alt="Power Generating Station ACC work" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generating Station ACC work</div>
        <div class="tag-card-desc">Removal and replacement of expansion joint</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>power</strong></span>
          <span class="tag-card-file">File: <code>10-1-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-200">Product tag:</label>
          <select id="pick-200" data-tile-id="200">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="205">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/c276-high-nickel-alloy-reactor-tank-2.jpg" alt="Power Generation" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generation</div>
        <div class="tag-card-desc">Removal and replacement of expansion joint</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>power</strong></span>
          <span class="tag-card-file">File: <code>c276-high-nickel-alloy-reactor-tank-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-205">Product tag:</label>
          <select id="pick-205" data-tile-id="205">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="207">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/ACCPlymouth230kb-2.jpg" alt="Steam Distribution Manifolds for ACC" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Steam Distribution Manifolds for ACC</div>
        <div class="tag-card-desc">Project fabricated and installed for power plant in WY</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>power</strong></span>
          <span class="tag-card-file">File: <code>ACCPlymouth230kb-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-207">Product tag:</label>
          <select id="pick-207" data-tile-id="207">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="212">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/6-1-1.jpg" alt="Power Generating Station ACC work" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Power Generating Station ACC work</div>
        <div class="tag-card-desc"><span class="tag-card-empty">(no description)</span></div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>power</strong></span>
          <span class="tag-card-file">File: <code>6-1-1.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-212">Product tag:</label>
          <select id="pick-212" data-tile-id="212">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="217">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/spreader-bar-3.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Spreader Bar</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>water-other</strong></span>
          <span class="tag-card-file">File: <code>spreader-bar-3.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-217">Product tag:</label>
          <select id="pick-217" data-tile-id="217">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="218">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/stair-tower-3.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Stair Tower</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>water-other</strong></span>
          <span class="tag-card-file">File: <code>stair-tower-3.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-218">Product tag:</label>
          <select id="pick-218" data-tile-id="218">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="220">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/pict0885-2.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">(4) 13.5’d x 35′ Stainless Steel Tanks</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>water-other</strong></span>
          <span class="tag-card-file">File: <code>pict0885-2.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-220">Product tag:</label>
          <select id="pick-220" data-tile-id="220">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
    <div class="tag-card" data-tile-id="222">
      <div class="tag-card-thumb">
        <img src="/assets/images/gallery/ConeBottomTankFab-1-scaled.jpg" alt="Water &amp; Other" loading="lazy" />
      </div>
      <div class="tag-card-meta">
        <div class="tag-card-title">Water &amp; Other</div>
        <div class="tag-card-desc">Cone Bottom Tank</div>
        <div class="tag-card-meta-row">
          <span class="tag-card-industry">Industry: <strong>water-other</strong></span>
          <span class="tag-card-file">File: <code>ConeBottomTankFab-1-scaled.jpg</code></span>
        </div>
        <div class="tag-card-picker">
          <label for="pick-222">Product tag:</label>
          <select id="pick-222" data-tile-id="222">
            <option value="">— skip / needs GBI —</option>
            <option value="tanks">Tanks &amp; Plate Steel</option>
            <option value="smp">Structural, Mechanical &amp; Piping (SMP)</option>
            <option value="ie">Instrumentation &amp; Electrical (I&amp;E)</option>
            <option value="air-pollution-control">Air Pollution Control</option>
            <option value="coatings">Coatings</option>
            <option value="maintenance">Maintenance, Repairs &amp; Alterations</option>
            <option value="railroad">Railroad</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>

<script>
(function() {
  var LS_KEY = 'gbi_tag_review_v1';
  var TOTAL = 91;
  var picks = {};
  try { picks = JSON.parse(localStorage.getItem(LS_KEY)) || {}; } catch (e) { picks = {}; }

  function updateStats() {
    var picked = 0, skipped = 0, decided = 0;
    for (var k in picks) {
      if (!picks.hasOwnProperty(k)) continue;
      var v = picks[k];
      if (v === '__SKIP__') { skipped++; decided++; }
      else if (v) { picked++; decided++; }
    }
    document.getElementById('stat-picked').textContent = picked;
    document.getElementById('stat-skipped').textContent = skipped;
    document.getElementById('stat-remaining').textContent = TOTAL - decided;
    document.getElementById('progress-count').textContent = decided;
  }

  // Initialize selects from localStorage
  document.querySelectorAll('select[data-tile-id]').forEach(function(sel) {
    var id = sel.dataset.tileId;
    var stored = picks[id];
    if (stored && stored !== '__SKIP__') {
      sel.value = stored;
      sel.closest('.tag-card').classList.add('is-picked');
    }
    sel.addEventListener('change', function() {
      if (this.value === '') {
        // User picked "skip" — record that as an explicit decision
        picks[id] = '__SKIP__';
      } else {
        picks[id] = this.value;
      }
      localStorage.setItem(LS_KEY, JSON.stringify(picks));
      this.closest('.tag-card').classList.toggle('is-picked', this.value !== '');
      updateStats();
    });
  });

  document.getElementById('btn-clear').addEventListener('click', function() {
    if (!confirm('Clear ALL selections? This cannot be undone.')) return;
    picks = {};
    localStorage.removeItem(LS_KEY);
    document.querySelectorAll('select[data-tile-id]').forEach(function(s) {
      s.value = '';
      s.closest('.tag-card').classList.remove('is-picked');
    });
    updateStats();
  });

  document.getElementById('btn-download').addEventListener('click', function() {
    // Build JSON payload — one entry per DECIDED tile
    var payload = [];
    document.querySelectorAll('.tag-card').forEach(function(card) {
      var id = card.dataset.tileId;
      var stored = picks[id];
      if (!stored) return;  // never touched — skip entirely
      var title = card.querySelector('.tag-card-title').textContent.trim();
      var img = card.querySelector('.tag-card-thumb img').getAttribute('src');
      payload.push({
        id: parseInt(id, 10),
        title: title,
        img: img,
        product_tag: stored === '__SKIP__' ? '' : stored,
        marked_skip: stored === '__SKIP__'
      });
    });
    var blob = new Blob([JSON.stringify(payload, null, 2)], {type: 'application/json'});
    var url = URL.createObjectURL(blob);
    var d = new Date();
    var stamp = d.toISOString().slice(0,10);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'gbi-gallery-tags-' + stamp + '.json';
    document.body.appendChild(a);
    a.click();
    setTimeout(function() {
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
    }, 100);
  });

  updateStats();
})();
</script>
</body>
</html>
