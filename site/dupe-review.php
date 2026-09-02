<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex,nofollow" />
<title>Gallery Duplicate Review · Great Basin Industrial</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/styles.css" />
<style>
  body { background: var(--gbi-offwhite); }
  .review-wrap { max-width: 1180px; margin: 0 auto; padding: 40px 24px 120px; }
  .review-hdr h1 { font-size: 2rem; color: var(--gbi-navy); margin: 0 0 8px; letter-spacing: -0.01em; }
  .review-hdr .lead { color: var(--ink-soft); font-size: 1rem; line-height: 1.55; margin-bottom: 20px; max-width: 820px; }
  .removal-note { padding: 16px 20px; background: #fff8e6; border: 1px solid #f0d288; color: #6b4d00; margin-bottom: 20px; font-size:.9rem; line-height: 1.5; }
  .review-stats { display:flex; gap:32px; align-items:center; padding:20px 24px; background:var(--white); border:1px solid var(--rule); margin-bottom:24px; flex-wrap:wrap; }
  .review-stats > div { font-size:.9rem; color:var(--ink-soft); }
  .review-stats strong { color: var(--gbi-navy); font-weight:800; font-size:1.35rem; display:block; }
  .review-toolbar { position: sticky; top: 0; z-index: 20; background: var(--gbi-offwhite); padding: 12px 0 16px; margin-bottom: 24px; display:flex; gap:12px; align-items:center; flex-wrap:wrap; border-bottom:1px solid var(--rule); }
  .review-toolbar button { font-family: inherit; font-size: .82rem; letter-spacing:.1em; text-transform: uppercase; font-weight: 800; padding: 12px 20px; border-radius: 2px; cursor: pointer; border:0; }
  .review-toolbar .btn-download { background: var(--gbi-lime); color: var(--gbi-navy); }
  .review-toolbar .btn-clear { background: transparent; color: var(--ink-soft); border:1px solid var(--rule); }
  .review-toolbar .progress { margin-left:auto; font-size:.9rem; color: var(--ink-soft); }
  .review-toolbar .progress strong { color: var(--gbi-navy); font-weight:800; }
  .dupe-group { background: var(--white); border: 1px solid var(--rule); margin-bottom: 16px; }
  .dupe-group summary { padding: 16px 20px; cursor: pointer; display: flex; align-items: center; gap: 24px; font-size:.95rem; color: var(--ink-soft); background: #f9fbff; border-bottom: 1px solid var(--rule); }
  .dupe-group summary::-webkit-details-marker { color: var(--gbi-blue); }
  .dupe-group-num { font-weight: 800; color: var(--gbi-navy); font-size: 1rem; }
  .dupe-group-count { color: var(--gbi-blue); font-weight: 700; }
  .dupe-group-hash { margin-left: auto; color: var(--muted); font-size: .82rem; }
  .dupe-group-hash code { background: var(--gbi-offwhite); padding: 2px 6px; font-size: .78rem; }
  .dupe-group-body { padding: 16px 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  @media (max-width: 720px) { .dupe-group-body { grid-template-columns: 1fr; } }
  .dupe-tile { display: block; cursor: pointer; position: relative; }
  .dupe-tile input { position: absolute; opacity: 0; }
  .dupe-tile-inner { background: var(--gbi-offwhite); border: 2px solid var(--rule); padding: 12px; display: flex; gap: 12px; transition: border-color .18s ease; position: relative; }
  .dupe-tile input:checked ~ .dupe-tile-inner { border-color: #3f8f37; }
  .dupe-tile input:not(:checked) ~ .dupe-tile-inner { border-color: #c14a1a; opacity: .55; }
  .dupe-tile-thumb { width: 110px; flex-shrink: 0; }
  .dupe-tile-thumb img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; background: #111; }
  .dupe-tile-meta { flex: 1; display: flex; flex-direction: column; gap: 4px; min-width: 0; }
  .dupe-tile-title { font-weight: 800; color: var(--gbi-navy); font-size: .92rem; line-height: 1.3; }
  .dupe-tile-desc { color: var(--ink-soft); font-size: .82rem; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
  .dupe-tile-tags { margin-top: 6px; display: flex; gap: 8px; flex-wrap: wrap; font-size: .72rem; color: var(--muted); }
  .pill { background: var(--white); padding: 2px 8px; border: 1px solid var(--rule); border-radius: 2px; }
  .pill code { background: transparent; padding: 0; font-size: .72rem; color: var(--gbi-blue); }
  .pill strong { font-weight: 700; color: var(--ink-soft); }
  .dupe-tile-status { margin-top: auto; padding-top: 6px; }
  .dupe-tile-status .keep-badge,
  .dupe-tile-status .remove-badge { display: none; font-size: .72rem; letter-spacing: .12em; text-transform: uppercase; font-weight: 800; padding: 3px 8px; }
  .dupe-tile input:checked ~ .dupe-tile-inner .keep-badge { display: inline-block; background: #3f8f37; color: white; }
  .dupe-tile input:not(:checked) ~ .dupe-tile-inner .remove-badge { display: inline-block; background: #c14a1a; color: white; }
</style>
</head>
<body>

<?php $NAV_ACTIVE = 'projects'; include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<div class="review-wrap">
  <div class="review-hdr">
    <h1>Gallery Duplicate Review</h1>
    <p class="lead">100 groups of duplicate photos are currently showing in the project gallery — most are byte-for-byte the same file stored under different names, resulting in <strong>218 duplicate tile instances</strong>. For each group, uncheck the tiles you want to remove; leave the ones you want to keep checked. Default is: keep the first tile in each group, remove the rest.</p>
  </div>

  <div class="removal-note">
    <strong>REVIEW PAGE ONLY</strong> — this URL will be removed before the site goes live. Your selections auto-save in this browser. When you're done, click <strong>Download JSON</strong> and send it back; I'll apply the removals to the gallery and prune any orphaned files.
  </div>

  <div class="review-stats">
    <div><strong>100</strong>Duplicate groups</div>
    <div><strong>218</strong>Total dupe tile instances</div>
    <div><strong id="stat-kept">0</strong>Marked keep</div>
    <div><strong id="stat-removed">0</strong>Marked remove</div>
  </div>

  <div class="review-toolbar">
    <button type="button" class="btn-download" id="btn-download">↓ Download JSON</button>
    <button type="button" class="btn-clear" id="btn-clear">Reset to defaults</button>
    <div class="progress"><strong id="progress-count">0</strong> / 218 tiles marked for removal</div>
  </div>

  
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 1</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>8132220079c0</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-74">
          <input type="checkbox" id="tile-74" data-tile-id="74" data-file="2014041395155150-1.jpg" data-gid="0" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2014041395155150-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">18’d x 100′ Lining of Bleach Tower with Super Duplex Stainless Steel</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>2014041395155150-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-212">
          <input type="checkbox" id="tile-212" data-tile-id="212" data-file="2014041395155150.jpg" data-gid="0"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2014041395155150.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">18’d x 100′ Lining of Bleach Tower with Super Duplex Stainless Steel</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>2014041395155150.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 2</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>1c3030cabb4b</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-227">
          <input type="checkbox" id="tile-227" data-tile-id="227" data-file="dekalb3-1.jpg" data-gid="1" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb3-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Finished Coating on Water Tank</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb3-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-153">
          <input type="checkbox" id="tile-153" data-tile-id="153" data-file="dekalb3.jpg" data-gid="1"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Finished Coating on Water Tank</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 3</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a761addb9e54</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-197">
          <input type="checkbox" id="tile-197" data-tile-id="197" data-file="IMG_4688-1-1.jpg" data-gid="2" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_4688-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining Lab &amp;amp; Truck Scales</div>
              <div class="dupe-tile-desc">GC for onsite Mining Laboratory and truck scales; civil, structural, mechanical, APC, electrical, finish, plumbing</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>IMG_4688-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-170">
          <input type="checkbox" id="tile-170" data-tile-id="170" data-file="IMG_4688-1.jpg" data-gid="2"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_4688-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining Lab &amp;amp; Truck Scales</div>
              <div class="dupe-tile-desc">GC for onsite Mining Laboratory and truck scales; civil, structural, mechanical, APC, electrical, finish, plumbing</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>IMG_4688-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 4</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>c86bd003fd21</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-194">
          <input type="checkbox" id="tile-194" data-tile-id="194" data-file="20140310_142905-1-1-scaled.jpg" data-gid="3" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/20140310_142905-1-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(5) elevated clarifiers and mechanisms with hooped bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>20140310_142905-1-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-133">
          <input type="checkbox" id="tile-133" data-tile-id="133" data-file="20140310_142905-scaled.jpg" data-gid="3"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/20140310_142905-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(5) elevated clarifiers and mechanisms with hooped bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>20140310_142905-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 5</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a0eae30e466c</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-39">
          <input type="checkbox" id="tile-39" data-tile-id="39" data-file="28.jpg" data-gid="4" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/28.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">Shell Course Replacement with Helical Stairway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>28.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-244">
          <input type="checkbox" id="tile-244" data-tile-id="244" data-file="api-tank-shell-course-replacement-with-helical-stairway.jpg" data-gid="4"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-shell-course-replacement-with-helical-stairway.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">Shell Course Replacement with Helical Stairway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-shell-course-replacement-with-helical-stairway.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 6</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d059422c0cb5</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-283">
          <input type="checkbox" id="tile-283" data-tile-id="283" data-file="CUSTOMERAPPROVEDDroneShot-2.jpg" data-gid="5" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/CUSTOMERAPPROVEDDroneShot-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Tanks, Structural, Piping for Renewable Diesel</div>
              <div class="dupe-tile-desc">Design, Fabrication, Foundations, Erection, Exteriors for 20+ API 650 Carbon &amp;amp; Stainless Tanks; Construction of piping and structural</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>CUSTOMERAPPROVEDDroneShot-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-0">
          <input type="checkbox" id="tile-0" data-tile-id="0" data-file="CUSTOMERAPPROVEDDroneShot.jpg" data-gid="5"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/CUSTOMERAPPROVEDDroneShot.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Tanks, Structural, Piping for Renewable Diesel</div>
              <div class="dupe-tile-desc">Design, Fabrication, Foundations, Erection, Exteriors for 20+ API 650 Carbon &amp;amp; Stainless Tanks; Construction of piping and structural</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>CUSTOMERAPPROVEDDroneShot.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 7</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>48bcae869fb8</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-253">
          <input type="checkbox" id="tile-253" data-tile-id="253" data-file="api-tank-roof-manway-1.jpg" data-gid="6" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-roof-manway-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Roof Manway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-roof-manway-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-92">
          <input type="checkbox" id="tile-92" data-tile-id="92" data-file="api-tank-roof-manway.jpg" data-gid="6"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-roof-manway.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Roof Manway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-roof-manway.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 8</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>66878dd1016c</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-199">
          <input type="checkbox" id="tile-199" data-tile-id="199" data-file="10-1-scaled.jpg" data-gid="7" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/10-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station ACC work</div>
              <div class="dupe-tile-desc">Removal and replacement of expansion joint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>10-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-288">
          <input type="checkbox" id="tile-288" data-tile-id="288" data-file="10-2-scaled.jpg" data-gid="7"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/10-2-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station ACC work</div>
              <div class="dupe-tile-desc">Power Generating Station ACC work</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>10-2-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-14">
          <input type="checkbox" id="tile-14" data-tile-id="14" data-file="5-scaled.jpg" data-gid="7"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/5-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station ACC work</div>
              <div class="dupe-tile-desc">Removal and replacement of expansion joint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>5-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 9</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>45ea3bcb7dcb</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-286">
          <input type="checkbox" id="tile-286" data-tile-id="286" data-file="2016-09-0111.17.40-1-1.jpg" data-gid="8" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2016-09-0111.17.40-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(18) tanks, (400) tons structural, (14) agitators and drives, (3) thickeners &amp;amp; mechanisms, (8) intermediate screens, (4) 3-deck shakers, 10-ton OH crane &amp;amp; rail, (8) pumps, (3) MCC buildings, (8000′) stainless piping, Plant pre-commissioning crew</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>2016-09-0111.17.40-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-5">
          <input type="checkbox" id="tile-5" data-tile-id="5" data-file="2016-09-0111.17.40-1.jpg" data-gid="8"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2016-09-0111.17.40-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(18) tanks, (400) tons structural, (14) agitators and drives, (3) thickeners &amp;amp; mechanisms, (8) intermediate screens, (4) 3-deck shakers, 10-ton OH crane &amp;amp; rail, (8) pumps, (3) MCC buildings, (8000′) stainless piping, Plant pre-commissioning crew</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>2016-09-0111.17.40-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-263">
          <input type="checkbox" id="tile-263" data-tile-id="263" data-file="2016-09-0111.17.40-3.jpg" data-gid="8"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2016-09-0111.17.40-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(18) tanks,  (400) tons structural, (14) agitators and drives, (3) thickeners &amp;amp; mechanisms, (8) intermediate screens, (4) 3-deck shakers, 10-ton OH crane &amp;amp; rail, (8) pumps, (3) MCC buildings, (8000′) stainless piping, Plant pre-commissioning crew</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>2016-09-0111.17.40-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 10</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>80ef3491d883</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-75">
          <input type="checkbox" id="tile-75" data-tile-id="75" data-file="ducting-repairs-2-1.jpg" data-gid="9" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ducting-repairs-2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>ducting-repairs-2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-246">
          <input type="checkbox" id="tile-246" data-tile-id="246" data-file="ducting-repairs-2-2.jpg" data-gid="9"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ducting-repairs-2-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>ducting-repairs-2-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-213">
          <input type="checkbox" id="tile-213" data-tile-id="213" data-file="ducting-repairs-2.jpg" data-gid="9"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ducting-repairs-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>ducting-repairs-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 11</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>9bd4794b4ba2</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-97">
          <input type="checkbox" id="tile-97" data-tile-id="97" data-file="apitankbottom-1.jpg" data-gid="10" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/apitankbottom-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Bottom &amp;amp; 1st Course Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>apitankbottom-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-257">
          <input type="checkbox" id="tile-257" data-tile-id="257" data-file="apitankbottom-2.jpg" data-gid="10"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/apitankbottom-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Bottom &amp;amp; 1st Course Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>apitankbottom-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 12</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>99a81ed7e3c0</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-252">
          <input type="checkbox" id="tile-252" data-tile-id="252" data-file="api-tank-sample-station-1.jpg" data-gid="11" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-sample-station-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Sample Station</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-sample-station-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-91">
          <input type="checkbox" id="tile-91" data-tile-id="91" data-file="api-tank-sample-station.jpg" data-gid="11"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-sample-station.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Sample Station</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-sample-station.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 13</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d542d480b191</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-251">
          <input type="checkbox" id="tile-251" data-tile-id="251" data-file="api-tank-shell-manway-1.jpg" data-gid="12" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-shell-manway-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Shell Manway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-shell-manway-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-90">
          <input type="checkbox" id="tile-90" data-tile-id="90" data-file="api-tank-shell-manway.jpg" data-gid="12"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-shell-manway.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Shell Manway</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-shell-manway.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 14</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>1942eee88980</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-207">
          <input type="checkbox" id="tile-207" data-tile-id="207" data-file="IMG_0377-min-1-1-scaled.jpg" data-gid="13" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0377-min-1-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0377-min-1-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-136">
          <input type="checkbox" id="tile-136" data-tile-id="136" data-file="IMG_0377-min-1-scaled.jpg" data-gid="13"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0377-min-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0377-min-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 15</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>4c6934fca255</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-259">
          <input type="checkbox" id="tile-259" data-tile-id="259" data-file="api-floating-roof-repair-1.jpg" data-gid="14" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-floating-roof-repair-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Floating Roof Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-floating-roof-repair-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-99">
          <input type="checkbox" id="tile-99" data-tile-id="99" data-file="api-floating-roof-repair.jpg" data-gid="14"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-floating-roof-repair.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Floating Roof Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-floating-roof-repair.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 16</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>7e993b0700e3</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-23">
          <input type="checkbox" id="tile-23" data-tile-id="23" data-file="12.jpg" data-gid="15" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/12.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">(2) 50’d Elevated Oil/Water Separator Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>12.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-71">
          <input type="checkbox" id="tile-71" data-tile-id="71" data-file="2-50-d-elevated-oil-water-separator-tanks.jpg" data-gid="15"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2-50-d-elevated-oil-water-separator-tanks.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">(2) 50’d Elevated Oil/Water Separator Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>2-50-d-elevated-oil-water-separator-tanks.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 17</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>c605c440e74d</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-225">
          <input type="checkbox" id="tile-225" data-tile-id="225" data-file="dekalb-1.jpg" data-gid="16" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">(5) Dome Roof Water Tanks</div>
              <div class="dupe-tile-desc">Full Exterior &amp;amp; Interior Blast and Paint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-151">
          <input type="checkbox" id="tile-151" data-tile-id="151" data-file="dekalb.jpg" data-gid="16"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">(5) Dome Roof Water Tanks</div>
              <div class="dupe-tile-desc">Full Exterior &amp;amp; Interior Blast and Paint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 18</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>b5eeb18863be</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-201">
          <input type="checkbox" id="tile-201" data-tile-id="201" data-file="fgd-scrubber-wash-header-pick-2.jpg" data-gid="17" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-wash-header-pick-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Wash Header Pick</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-wash-header-pick-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-231">
          <input type="checkbox" id="tile-231" data-tile-id="231" data-file="fgd-scrubber-wash-header-pick-3.jpg" data-gid="17"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-wash-header-pick-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Wash Header Pick</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-wash-header-pick-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-60">
          <input type="checkbox" id="tile-60" data-tile-id="60" data-file="fgd-scrubber-wash-header-pick.jpg" data-gid="17"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-wash-header-pick.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Wash Header Pick</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-wash-header-pick.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 19</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>549dcc53146e</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-272">
          <input type="checkbox" id="tile-272" data-tile-id="272" data-file="Nightshot-1.jpg" data-gid="18" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/Nightshot-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Complete Panels</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>Nightshot-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-160">
          <input type="checkbox" id="tile-160" data-tile-id="160" data-file="Nightshot.jpg" data-gid="18"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/Nightshot.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">(no title)</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>Nightshot.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 20</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>c287ff62cd93</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-287">
          <input type="checkbox" id="tile-287" data-tile-id="287" data-file="123_6-1-1.jpeg" data-gid="19" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_6-1-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>123_6-1-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-10">
          <input type="checkbox" id="tile-10" data-tile-id="10" data-file="123_6-1.jpeg" data-gid="19"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_6-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>123_6-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-264">
          <input type="checkbox" id="tile-264" data-tile-id="264" data-file="123_6.jpeg" data-gid="19"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_6.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>123_6.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 21</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>0567e9888657</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-204">
          <input type="checkbox" id="tile-204" data-tile-id="204" data-file="c276-high-nickel-alloy-reactor-tank-2.jpg" data-gid="20" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/c276-high-nickel-alloy-reactor-tank-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Removal and replacement of expansion joint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>c276-high-nickel-alloy-reactor-tank-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-63">
          <input type="checkbox" id="tile-63" data-tile-id="63" data-file="c276-high-nickel-alloy-reactor-tank.jpg" data-gid="20"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/c276-high-nickel-alloy-reactor-tank.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Multiple Process ﻿Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>c276-high-nickel-alloy-reactor-tank.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 22</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>8ac0f3807af1</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-255">
          <input type="checkbox" id="tile-255" data-tile-id="255" data-file="apitankexternalfloatingrepair-1.jpg" data-gid="21" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/apitankexternalfloatingrepair-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank External Floating Roof Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>apitankexternalfloatingrepair-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-94">
          <input type="checkbox" id="tile-94" data-tile-id="94" data-file="apitankexternalfloatingrepair.jpg" data-gid="21"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/apitankexternalfloatingrepair.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank External Floating Roof Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>apitankexternalfloatingrepair.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 23</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>0969a7a41d20</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-278">
          <input type="checkbox" id="tile-278" data-tile-id="278" data-file="ic18-1.jpg" data-gid="22" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic18-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic18-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-115">
          <input type="checkbox" id="tile-115" data-tile-id="115" data-file="ic18.jpg" data-gid="22"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic18.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic18.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 24</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>de129b719806</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-260">
          <input type="checkbox" id="tile-260" data-tile-id="260" data-file="2doortank-1.jpg" data-gid="23" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2doortank-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank 2-Course Door Sheet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>2doortank-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-100">
          <input type="checkbox" id="tile-100" data-tile-id="100" data-file="2doortank.jpg" data-gid="23"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2doortank.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank 2-Course Door Sheet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>2doortank.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 25</span>
        <span class="dupe-group-count">4 duplicate tiles &middot; 4 file copies</span>
        <span class="dupe-group-hash">hash: <code>a8e7c528cc73</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-85">
          <input type="checkbox" id="tile-85" data-tile-id="85" data-file="elevated-lime-silo-1.jpg" data-gid="24" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-lime-silo-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">Elevated Lime Silo for FGD Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>elevated-lime-silo-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-203">
          <input type="checkbox" id="tile-203" data-tile-id="203" data-file="elevated-lime-silo-4.jpg" data-gid="24"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-lime-silo-4.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Elevated Lime Silo</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>elevated-lime-silo-4.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-235">
          <input type="checkbox" id="tile-235" data-tile-id="235" data-file="elevated-lime-silo-5.jpg" data-gid="24"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-lime-silo-5.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">Elevated Lime Silo for FGD Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>elevated-lime-silo-5.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-62">
          <input type="checkbox" id="tile-62" data-tile-id="62" data-file="elevated-lime-silo.jpg" data-gid="24"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-lime-silo.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Elevated Lime Silo</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>elevated-lime-silo.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 26</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>561174ad939f</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-29">
          <input type="checkbox" id="tile-29" data-tile-id="29" data-file="18.jpg" data-gid="25" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/18.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank EFR Seal Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>18.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-240">
          <input type="checkbox" id="tile-240" data-tile-id="240" data-file="api-tank-efr-seal-replacement.jpg" data-gid="25"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-efr-seal-replacement.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank EFR Seal Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-efr-seal-replacement.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 27</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>dafb6ae512c0</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-267">
          <input type="checkbox" id="tile-267" data-tile-id="267" data-file="PumpJacksESPsPLCsROCstransmitters-1.jpg" data-gid="26" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/PumpJacksESPsPLCsROCstransmitters-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">ESPs PLCs ROCs Transmitters for Oilfield</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>PumpJacksESPsPLCsROCstransmitters-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-155">
          <input type="checkbox" id="tile-155" data-tile-id="155" data-file="PumpJacksESPsPLCsROCstransmitters.jpg" data-gid="26"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/PumpJacksESPsPLCsROCstransmitters.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">ESPs PLCs ROCs Transmitters for Oilfield</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>PumpJacksESPsPLCsROCstransmitters.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 28</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>463e36644e19</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-276">
          <input type="checkbox" id="tile-276" data-tile-id="276" data-file="ic21-1.jpg" data-gid="27" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic21-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic21-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-113">
          <input type="checkbox" id="tile-113" data-tile-id="113" data-file="ic21.jpg" data-gid="27"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic21.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic21.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 29</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>99c0cbea2485</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-202">
          <input type="checkbox" id="tile-202" data-tile-id="202" data-file="fgd-scrubber-outlet-duct-pick-2-2.jpg" data-gid="28" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-outlet-duct-pick-2-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Removal and replacement of expansion joint</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-outlet-duct-pick-2-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-232">
          <input type="checkbox" id="tile-232" data-tile-id="232" data-file="fgd-scrubber-outlet-duct-pick-2-3.jpg" data-gid="28"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-outlet-duct-pick-2-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Outlet Duct Pick</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-outlet-duct-pick-2-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-61">
          <input type="checkbox" id="tile-61" data-tile-id="61" data-file="fgd-scrubber-outlet-duct-pick-2.jpg" data-gid="28"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-outlet-duct-pick-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Outlet Duct Pick</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-outlet-duct-pick-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 30</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>f35bddbdb237</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-52">
          <input type="checkbox" id="tile-52" data-tile-id="52" data-file="40.jpg" data-gid="29" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/40.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">148’d Elevated Thickener w/ Scalloped Bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>40.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-184">
          <input type="checkbox" id="tile-184" data-tile-id="184" data-file="barrick-148-dia-thickener-6-21-13-003-1.jpg" data-gid="29"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/barrick-148-dia-thickener-6-21-13-003-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">148’d Elevated Thickener w/ Scalloped Bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>barrick-148-dia-thickener-6-21-13-003-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 31</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a5b1edf093c3</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-268">
          <input type="checkbox" id="tile-268" data-tile-id="268" data-file="Pump-1.jpg" data-gid="30" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/Pump-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Pumps</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>Pump-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-156">
          <input type="checkbox" id="tile-156" data-tile-id="156" data-file="Pump.jpg" data-gid="30"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/Pump.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Pumps</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>Pump.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 32</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>5e9a486ec29d</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-234">
          <input type="checkbox" id="tile-234" data-tile-id="234" data-file="spruce2-photo-one-2.jpg" data-gid="31" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/spruce2-photo-one-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">FGD Scrubber &amp;amp; Stack</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>spruce2-photo-one-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-84">
          <input type="checkbox" id="tile-84" data-tile-id="84" data-file="spruce2-photo-one.jpg" data-gid="31"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/spruce2-photo-one.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">FGD Scrubber &amp;amp; Stack</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>spruce2-photo-one.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 33</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>df7cb110d7cf</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-247">
          <input type="checkbox" id="tile-247" data-tile-id="247" data-file="stair-tower-1.jpg" data-gid="32" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/stair-tower-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Stair Tower</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>stair-tower-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-217">
          <input type="checkbox" id="tile-217" data-tile-id="217" data-file="stair-tower-3.jpg" data-gid="32"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/stair-tower-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Stair Tower</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>stair-tower-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-79">
          <input type="checkbox" id="tile-79" data-tile-id="79" data-file="stair-tower.jpg" data-gid="32"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/stair-tower.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Stair Tower</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>stair-tower.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 34</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>e716bc6e85bf</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-208">
          <input type="checkbox" id="tile-208" data-tile-id="208" data-file="IMG_0228-min-1-scaled.jpg" data-gid="33" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0228-min-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0228-min-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-292">
          <input type="checkbox" id="tile-292" data-tile-id="292" data-file="IMG_0228-min-scaled.jpeg" data-gid="33"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0228-min-scaled.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0228-min-scaled.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-137">
          <input type="checkbox" id="tile-137" data-tile-id="137" data-file="IMG_0228-min-scaled.jpg" data-gid="33"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0228-min-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0228-min-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 35</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>6d21c38b1d91</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-192">
          <input type="checkbox" id="tile-192" data-tile-id="192" data-file="123_4-1.jpeg" data-gid="34" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_4-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>123_4-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-265">
          <input type="checkbox" id="tile-265" data-tile-id="265" data-file="123_4-2.jpeg" data-gid="34"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_4-2.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>123_4-2.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 36</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>8e08f002a7ab</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-51">
          <input type="checkbox" id="tile-51" data-tile-id="51" data-file="39.jpg" data-gid="35" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/39.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Platform on Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>39.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-183">
          <input type="checkbox" id="tile-183" data-tile-id="183" data-file="platform-on-top-of-tank-1.jpg" data-gid="35"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/platform-on-top-of-tank-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Platform on Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>platform-on-top-of-tank-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-289">
          <input type="checkbox" id="tile-289" data-tile-id="289" data-file="platform-on-top-of-tank.jpg" data-gid="35"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/platform-on-top-of-tank.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>platform-on-top-of-tank.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 37</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>66beb0941608</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-269">
          <input type="checkbox" id="tile-269" data-tile-id="269" data-file="CPs-1.jpg" data-gid="36" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/CPs-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Turnkey Instrumentation &amp;amp; Electrical</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>CPs-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-157">
          <input type="checkbox" id="tile-157" data-tile-id="157" data-file="CPs.jpg" data-gid="36"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/CPs.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Turnkey Instrumentation &amp;amp; Electrical</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>CPs.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 38</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>1e850702981d</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-291">
          <input type="checkbox" id="tile-291" data-tile-id="291" data-file="123_10-1-1.jpeg" data-gid="37" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_10-1-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>123_10-1-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-193">
          <input type="checkbox" id="tile-193" data-tile-id="193" data-file="123_10-1.jpeg" data-gid="37"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_10-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Crushers, 750′ overland conveyors, screens, bins, silos, ductwork, process piping, filters, pumps, MCCs,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>123_10-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-266">
          <input type="checkbox" id="tile-266" data-tile-id="266" data-file="123_10-2.jpeg" data-gid="37"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/123_10-2.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>123_10-2.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 39</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>42b25468ad83</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-243">
          <input type="checkbox" id="tile-243" data-tile-id="243" data-file="120-d-x-48-api-tank-bottom-efr-repair.jpg" data-gid="38" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/120-d-x-48-api-tank-bottom-efr-repair.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">120’d x 48′ API Tank Bottom &amp;amp; EFR Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>120-d-x-48-api-tank-bottom-efr-repair.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-37">
          <input type="checkbox" id="tile-37" data-tile-id="37" data-file="26.jpg" data-gid="38"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/26.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">120’d x 48′ API Tank Bottom &amp;amp; EFR Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>26.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 40</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>e02b3fce2e99</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-53">
          <input type="checkbox" id="tile-53" data-tile-id="53" data-file="41.jpg" data-gid="39" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/41.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Rubber-Lined Hopper 1</div>
              <div class="dupe-tile-desc">Rubber-Lined Hopper 1</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>41.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-185">
          <input type="checkbox" id="tile-185" data-tile-id="185" data-file="rubber-lined-hopper-1-2.jpg" data-gid="39"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/rubber-lined-hopper-1-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Rubber-Lined Hopper 1</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>rubber-lined-hopper-1-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 41</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>502b20ef5edf</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-270">
          <input type="checkbox" id="tile-270" data-tile-id="270" data-file="MotorsforSWpumpsonSWD-2.jpg" data-gid="40" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/MotorsforSWpumpsonSWD-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Motors for Salt Water Pumps</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>MotorsforSWpumpsonSWD-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-158">
          <input type="checkbox" id="tile-158" data-tile-id="158" data-file="MotorsforSWpumpsonSWD.jpg" data-gid="40"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/MotorsforSWpumpsonSWD.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Motors for Salt Water Pumps</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>MotorsforSWpumpsonSWD.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 42</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>296ec961a1ea</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-219">
          <input type="checkbox" id="tile-219" data-tile-id="219" data-file="pict0885-2.jpg" data-gid="41" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/pict0885-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">(4) 13.5’d x 35′ Stainless Steel Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>pict0885-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-81">
          <input type="checkbox" id="tile-81" data-tile-id="81" data-file="pict0885.jpg" data-gid="41"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/pict0885.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">(4) 13.5’d x 35′ Stainless Steel Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>pict0885.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 43</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>8d2ab80c69be</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-211">
          <input type="checkbox" id="tile-211" data-tile-id="211" data-file="6-1-1.jpg" data-gid="42" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/6-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station ACC work</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>6-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-168">
          <input type="checkbox" id="tile-168" data-tile-id="168" data-file="6-2.jpg" data-gid="42"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/6-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station ACC work</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>6-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 44</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>5a3a20c1595b</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-190">
          <input type="checkbox" id="tile-190" data-tile-id="190" data-file="20130621_110039-2-1.jpg" data-gid="43" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/20130621_110039-2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">9 Storage &amp;amp; Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>20130621_110039-2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-58">
          <input type="checkbox" id="tile-58" data-tile-id="58" data-file="46.jpg" data-gid="43"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/46.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">9 Storage &amp;amp; Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>46.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 45</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>0e18b9eac7f1</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-237">
          <input type="checkbox" id="tile-237" data-tile-id="237" data-file="45-d-x-155-fgd-wet-scrubber-2.jpg" data-gid="44" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45-d-x-155-fgd-wet-scrubber-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">62’d x 155′ FGD Wet Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>45-d-x-155-fgd-wet-scrubber-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-87">
          <input type="checkbox" id="tile-87" data-tile-id="87" data-file="45-d-x-155-fgd-wet-scrubber.jpg" data-gid="44"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45-d-x-155-fgd-wet-scrubber.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">62’d x 155′ FGD Wet Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>45-d-x-155-fgd-wet-scrubber.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 46</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>2fe01bdcd2c0</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-7">
          <input type="checkbox" id="tile-7" data-tile-id="7" data-file="23-scaled.jpg" data-gid="45" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/23-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">(6) 280′ Flare Stacks and Ignitors for STAR, world’s largest crude oil refinery in Turkey</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>23-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-229">
          <input type="checkbox" id="tile-229" data-tile-id="229" data-file="StacksinTurkey-1-scaled.jpg" data-gid="45"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/StacksinTurkey-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">(6) 280′ Flare Stacks and Ignitors for STAR, world’s largest crude oil refinery in Turkey</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>StacksinTurkey-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 47</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>24edea36b408</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-221">
          <input type="checkbox" id="tile-221" data-tile-id="221" data-file="ConeBottomTankFab-1-scaled.jpg" data-gid="46" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ConeBottomTankFab-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Cone Bottom Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>ConeBottomTankFab-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-132">
          <input type="checkbox" id="tile-132" data-tile-id="132" data-file="ConeBottomTankFab-scaled.jpg" data-gid="46"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ConeBottomTankFab-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Cone Bottom Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>ConeBottomTankFab-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 48</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>61915ed0847d</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-282">
          <input type="checkbox" id="tile-282" data-tile-id="282" data-file="ic14-1.jpg" data-gid="47" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic14-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic14-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-119">
          <input type="checkbox" id="tile-119" data-tile-id="119" data-file="ic14.jpg" data-gid="47"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic14.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic14.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 49</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>7dea8ace14c1</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-281">
          <input type="checkbox" id="tile-281" data-tile-id="281" data-file="ic15-1.jpg" data-gid="48" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic15-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic15-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-118">
          <input type="checkbox" id="tile-118" data-tile-id="118" data-file="ic15.jpg" data-gid="48"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic15.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic15.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 50</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>ecc390762993</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-174">
          <input type="checkbox" id="tile-174" data-tile-id="174" data-file="24-storage-process-tank-units-1.jpg" data-gid="49" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/24-storage-process-tank-units-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">24 Various Storage &amp;amp; Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>24-storage-process-tank-units-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-42">
          <input type="checkbox" id="tile-42" data-tile-id="42" data-file="31.jpg" data-gid="49"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/31.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">24 Various Storage &amp;amp; Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>31.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 51</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>ae1372f9fcd3</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-280">
          <input type="checkbox" id="tile-280" data-tile-id="280" data-file="ic19-1.jpg" data-gid="50" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic19-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic19-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-117">
          <input type="checkbox" id="tile-117" data-tile-id="117" data-file="ic19.jpg" data-gid="50"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic19.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic19.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 52</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d8c559ad7926</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-2">
          <input type="checkbox" id="tile-2" data-tile-id="2" data-file="IMG_0219-min-1-scaled.jpg" data-gid="51" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0219-min-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical power</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0219-min-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-284">
          <input type="checkbox" id="tile-284" data-tile-id="284" data-file="IMG_0219-min-scaled.jpeg" data-gid="51"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0219-min-scaled.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0219-min-scaled.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 53</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>6172f41cda73</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-271">
          <input type="checkbox" id="tile-271" data-tile-id="271" data-file="GasPlantfinfanscableconduit-1.jpg" data-gid="52" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/GasPlantfinfanscableconduit-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Gas Plant Fin Fans, Cable Tray, Conduit, etc.</div>
              <div class="dupe-tile-desc">Ducting Repairs</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>GasPlantfinfanscableconduit-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-159">
          <input type="checkbox" id="tile-159" data-tile-id="159" data-file="GasPlantfinfanscableconduit.jpg" data-gid="52"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/GasPlantfinfanscableconduit.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Gas Plant Fin Fans, Cable Tray, Conduit, etc.</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>GasPlantfinfanscableconduit.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 54</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>7d57353ecaa1</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-26">
          <input type="checkbox" id="tile-26" data-tile-id="26" data-file="15.jpg" data-gid="53" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/15.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Wash Header</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>15.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-200">
          <input type="checkbox" id="tile-200" data-tile-id="200" data-file="fgd-scrubber-wash-header-construction-1.jpg" data-gid="53"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-wash-header-construction-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">FGD Scrubber Wash Header</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-wash-header-construction-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-230">
          <input type="checkbox" id="tile-230" data-tile-id="230" data-file="fgd-scrubber-wash-header-construction-2.jpg" data-gid="53"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/fgd-scrubber-wash-header-construction-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Ducting Repairs 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>fgd-scrubber-wash-header-construction-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 55</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>125e40c1fc57</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-40">
          <input type="checkbox" id="tile-40" data-tile-id="40" data-file="29.jpg" data-gid="54" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/29.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank, Ladder &amp;amp; Sample Station</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>29.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-245">
          <input type="checkbox" id="tile-245" data-tile-id="245" data-file="api-650-tank-sample-station.jpg" data-gid="54"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-650-tank-sample-station.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank, Ladder &amp;amp; Sample Station</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-650-tank-sample-station.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 56</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a447b7e773d8</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-250">
          <input type="checkbox" id="tile-250" data-tile-id="250" data-file="api-tank-single-course-door-sheet-1.jpg" data-gid="55" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-single-course-door-sheet-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Single Course Door Sheet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-single-course-door-sheet-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-89">
          <input type="checkbox" id="tile-89" data-tile-id="89" data-file="api-tank-single-course-door-sheet.jpg" data-gid="55"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-single-course-door-sheet.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Single Course Door Sheet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-single-course-door-sheet.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 57</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>2e15c6b4f2b4</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-238">
          <input type="checkbox" id="tile-238" data-tile-id="238" data-file="c276-outlet-ducting-for-fgd-wet-scrubber-2.jpg" data-gid="56" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/c276-outlet-ducting-for-fgd-wet-scrubber-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">C276 Outlet Duct for FGD Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>c276-outlet-ducting-for-fgd-wet-scrubber-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-88">
          <input type="checkbox" id="tile-88" data-tile-id="88" data-file="c276-outlet-ducting-for-fgd-wet-scrubber.jpg" data-gid="56"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/c276-outlet-ducting-for-fgd-wet-scrubber.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">C276 Outlet Duct for FGD Scrubber</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>c276-outlet-ducting-for-fgd-wet-scrubber.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 58</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>99f284213103</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-210">
          <input type="checkbox" id="tile-210" data-tile-id="210" data-file="SoonerDayA-1.jpg" data-gid="57" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/SoonerDayA-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>SoonerDayA-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-154">
          <input type="checkbox" id="tile-154" data-tile-id="154" data-file="SoonerDayA.jpg" data-gid="57"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/SoonerDayA.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>SoonerDayA.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 59</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>0b335a43d935</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-43">
          <input type="checkbox" id="tile-43" data-tile-id="43" data-file="32.jpg" data-gid="58" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/32.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">39’d x 67′ Elevated Thickener</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>32.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-175">
          <input type="checkbox" id="tile-175" data-tile-id="175" data-file="39-d-x-67-elevated-thickener-1.jpg" data-gid="58"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/39-d-x-67-elevated-thickener-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">39’d x 67′ Elevated Thickener</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>39-d-x-67-elevated-thickener-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 60</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>67debb524035</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-222">
          <input type="checkbox" id="tile-222" data-tile-id="222" data-file="IMG_8671-1-1.jpg" data-gid="59" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8671-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8671-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-148">
          <input type="checkbox" id="tile-148" data-tile-id="148" data-file="IMG_8671-1.jpg" data-gid="59"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8671-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8671-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 61</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>fb8a010be347</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-223">
          <input type="checkbox" id="tile-223" data-tile-id="223" data-file="IMG_8684-1-1.jpg" data-gid="60" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8684-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8684-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-149">
          <input type="checkbox" id="tile-149" data-tile-id="149" data-file="IMG_8684.jpg" data-gid="60"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8684.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8684.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 62</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>844bd3260d5b</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-44">
          <input type="checkbox" id="tile-44" data-tile-id="44" data-file="32-1.jpg" data-gid="61" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/32-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Elevated Load Out Bin</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>32-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-176">
          <input type="checkbox" id="tile-176" data-tile-id="176" data-file="elevated-load-out-bin-1.jpg" data-gid="61"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-load-out-bin-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Elevated Load Out Bin</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>elevated-load-out-bin-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 63</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>688b8c3db257</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-27">
          <input type="checkbox" id="tile-27" data-tile-id="27" data-file="16.jpg" data-gid="62" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/16.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>16.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-172">
          <input type="checkbox" id="tile-172" data-tile-id="172" data-file="IMG952017102495163450011v2-1.jpg" data-gid="62"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG952017102495163450011v2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG952017102495163450011v2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 64</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>535da7a8f783</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-205">
          <input type="checkbox" id="tile-205" data-tile-id="205" data-file="45dx155wetscrubber-2.jpg" data-gid="63" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45dx155wetscrubber-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">65’d x 155′ FGD Wet Scrubber Inlet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>45dx155wetscrubber-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-233">
          <input type="checkbox" id="tile-233" data-tile-id="233" data-file="45dx155wetscrubber-3.jpg" data-gid="63"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45dx155wetscrubber-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">65’d x 155′ FGD Wet Scrubber Inlet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>45dx155wetscrubber-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-64">
          <input type="checkbox" id="tile-64" data-tile-id="64" data-file="45dx155wetscrubber.jpg" data-gid="63"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45dx155wetscrubber.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">65’d x 155′ FGD Wet Scrubber Inlet</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>45dx155wetscrubber.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 65</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>419224b001a7</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-249">
          <input type="checkbox" id="tile-249" data-tile-id="249" data-file="clarifier-mechanism-repair-1.jpg" data-gid="64" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/clarifier-mechanism-repair-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">Clarifier Mechanism Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>clarifier-mechanism-repair-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-220">
          <input type="checkbox" id="tile-220" data-tile-id="220" data-file="clarifier-mechanism-repair-3.jpg" data-gid="64"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/clarifier-mechanism-repair-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">Clarifier Mechanism Repair</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>clarifier-mechanism-repair-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 66</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>2e0debf3dcc5</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-290">
          <input type="checkbox" id="tile-290" data-tile-id="290" data-file="ACCPlymouth230kb-1.jpg" data-gid="65" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ACCPlymouth230kb-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Steam Distribution Manifolds for ACC</div>
              <div class="dupe-tile-desc">Project fabricated and installed for power plant in WY</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>ACCPlymouth230kb-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-206">
          <input type="checkbox" id="tile-206" data-tile-id="206" data-file="ACCPlymouth230kb-2.jpg" data-gid="65"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ACCPlymouth230kb-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Steam Distribution Manifolds for ACC</div>
              <div class="dupe-tile-desc">Project fabricated and installed for power plant in WY</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>ACCPlymouth230kb-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-95">
          <input type="checkbox" id="tile-95" data-tile-id="95" data-file="ACCPlymouth230kb.jpg" data-gid="65"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ACCPlymouth230kb.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Steam Distribution Manifolds for ACC</div>
              <div class="dupe-tile-desc">Project fabricated and installed for power plant in WY</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>ACCPlymouth230kb.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 67</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a8334dbf0c85</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-57">
          <input type="checkbox" id="tile-57" data-tile-id="57" data-file="45.jpg" data-gid="66" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/45.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Rubber-Lined Hopper 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>45.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-189">
          <input type="checkbox" id="tile-189" data-tile-id="189" data-file="rubber-lined-hopper-2-1.jpg" data-gid="66"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/rubber-lined-hopper-2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Rubber-Lined Hopper 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>rubber-lined-hopper-2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 68</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>73c9cd6ba488</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-254">
          <input type="checkbox" id="tile-254" data-tile-id="254" data-file="api-tank-nozzle-1.jpg" data-gid="67" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-nozzle-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Nozzle</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-nozzle-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-93">
          <input type="checkbox" id="tile-93" data-tile-id="93" data-file="api-tank-nozzle.jpg" data-gid="67"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-nozzle.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Nozzle</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-nozzle.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 69</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>ceffdeadc834</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-76">
          <input type="checkbox" id="tile-76" data-tile-id="76" data-file="pict0728-1.jpg" data-gid="68" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/pict0728-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Clarifier Sub-Assembly</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>pict0728-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-214">
          <input type="checkbox" id="tile-214" data-tile-id="214" data-file="pict0728.jpg" data-gid="68"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/pict0728.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Clarifier Sub-Assembly</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>pict0728.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 70</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>92bf9aa67736</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-41">
          <input type="checkbox" id="tile-41" data-tile-id="41" data-file="30.jpg" data-gid="69" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/30.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">(no title)</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>30.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-173">
          <input type="checkbox" id="tile-173" data-tile-id="173" data-file="elevated-thickener-1.jpg" data-gid="69"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-thickener-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>elevated-thickener-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 71</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>5214284b91cb</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-226">
          <input type="checkbox" id="tile-226" data-tile-id="226" data-file="dekalb4-1.jpg" data-gid="70" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb4-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Automated Blasting and Painting on Water Tank Exterior</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb4-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-152">
          <input type="checkbox" id="tile-152" data-tile-id="152" data-file="dekalb4.jpg" data-gid="70"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/dekalb4.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Automated Blasting and Painting on Water Tank Exterior</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>dekalb4.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 72</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>e4473364e2ec</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-277">
          <input type="checkbox" id="tile-277" data-tile-id="277" data-file="ic11-1.jpg" data-gid="71" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic11-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic11-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-114">
          <input type="checkbox" id="tile-114" data-tile-id="114" data-file="ic11.jpg" data-gid="71"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic11.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic11.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 73</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>5c064d1dd114</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-191">
          <input type="checkbox" id="tile-191" data-tile-id="191" data-file="071-2.jpg" data-gid="72" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/071-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">4 Storage &amp;amp; Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>071-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-59">
          <input type="checkbox" id="tile-59" data-tile-id="59" data-file="071.jpg" data-gid="72"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/071.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">(no title)</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>071.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 74</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>1bcbadd3d84c</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-50">
          <input type="checkbox" id="tile-50" data-tile-id="50" data-file="38.jpg" data-gid="73" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/38.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(5) 125’d Elevated Thickeners w/ Scalloped Bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>38.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-182">
          <input type="checkbox" id="tile-182" data-tile-id="182" data-file="741-1.jpg" data-gid="73"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/741-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(5) 125’d Elevated Thickeners w/ Scalloped Bottoms</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>741-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 75</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>8262755858fa</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-47">
          <input type="checkbox" id="tile-47" data-tile-id="47" data-file="35.jpg" data-gid="74" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/35.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">24’d x 18′ Stainless Steel Acid Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>35.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-179">
          <input type="checkbox" id="tile-179" data-tile-id="179" data-file="stainless-roof-pick-1.jpg" data-gid="74"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/stainless-roof-pick-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>stainless-roof-pick-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 76</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>4b04e75773f7</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-98">
          <input type="checkbox" id="tile-98" data-tile-id="98" data-file="api-tank-access-hatch-1.jpg" data-gid="75" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-access-hatch-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Access Hatch</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-access-hatch-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-258">
          <input type="checkbox" id="tile-258" data-tile-id="258" data-file="api-tank-access-hatch-2.jpg" data-gid="75"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-access-hatch-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Access Hatch</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-access-hatch-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 77</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>97cc5274fa2a</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-262">
          <input type="checkbox" id="tile-262" data-tile-id="262" data-file="tankandnozzle-1.jpg" data-gid="76" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/tankandnozzle-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">Tank Nozzle</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>tankandnozzle-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-101">
          <input type="checkbox" id="tile-101" data-tile-id="101" data-file="tankandnozzle.jpg" data-gid="76"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/tankandnozzle.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">Tank Nozzle</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>tankandnozzle.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 78</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>1ba800b35030</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-236">
          <input type="checkbox" id="tile-236" data-tile-id="236" data-file="wetscrubber2-2.jpg" data-gid="77" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/wetscrubber2-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">FGD Wet Scrubber Inlet Construction</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>wetscrubber2-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-86">
          <input type="checkbox" id="tile-86" data-tile-id="86" data-file="wetscrubber2.jpg" data-gid="77"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/wetscrubber2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Air Pollution Control</div>
              <div class="dupe-tile-desc">FGD Wet Scrubber Inlet Construction</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>wetscrubber2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 79</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>c243af1737ba</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-209">
          <input type="checkbox" id="tile-209" data-tile-id="209" data-file="IMG_0294-min-1-1-scaled.jpg" data-gid="78" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0294-min-1-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0294-min-1-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-138">
          <input type="checkbox" id="tile-138" data-tile-id="138" data-file="IMG_0294-min-1-scaled.jpg" data-gid="78"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_0294-min-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generating Station</div>
              <div class="dupe-tile-desc">1/2 mile elevated coal conveyor demo and rebuild</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>IMG_0294-min-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 80</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>192e21e1e8ce</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-33">
          <input type="checkbox" id="tile-33" data-tile-id="33" data-file="21-1.jpg" data-gid="79" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/21-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank Clean Out Door</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>21-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-242">
          <input type="checkbox" id="tile-242" data-tile-id="242" data-file="api-tank-clean-out-door.jpg" data-gid="79"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-clean-out-door.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank Clean Out Door</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-clean-out-door.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 81</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>dd57f8d4aaea</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-46">
          <input type="checkbox" id="tile-46" data-tile-id="46" data-file="34.jpg" data-gid="80" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/34.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">24’d x 18′ Stainless Steel Acid Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>34.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-178">
          <input type="checkbox" id="tile-178" data-tile-id="178" data-file="copy_0_24d-x-18-stainless-steel-acid-tank-1.jpg" data-gid="80"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/copy_0_24d-x-18-stainless-steel-acid-tank-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">24’d x 18′ Stainless Steel Acid Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>copy_0_24d-x-18-stainless-steel-acid-tank-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 82</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>ac52df5d6bf8</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-279">
          <input type="checkbox" id="tile-279" data-tile-id="279" data-file="ic7-1.jpg" data-gid="81" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic7-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic7-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-116">
          <input type="checkbox" id="tile-116" data-tile-id="116" data-file="ic7.jpg" data-gid="81"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic7.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic7.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 83</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>ff607260272c</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-4">
          <input type="checkbox" id="tile-4" data-tile-id="4" data-file="111-scaled.jpg" data-gid="82" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/111-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Air Cooled Condenser Rebundling. Fabrication of steam distribution and condensate collection manifolds. Onsite demolition of existing manifolds, tube bundles and structural and replacement with new.</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>111-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-285">
          <input type="checkbox" id="tile-285" data-tile-id="285" data-file="ACCphotoWY-1-scaled.jpg" data-gid="82"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ACCphotoWY-1-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Air Cooled Condenser Rebundling. Fabrication of steam distribution and condensate collection manifolds. Onsite demolition of existing manifolds, tube bundles and structural and replacement with new. ,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>smp</strong></span>
                <span class="pill pill-file">File: <code>ACCphotoWY-1-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-198">
          <input type="checkbox" id="tile-198" data-tile-id="198" data-file="ACCphotoWY-scaled.jpg" data-gid="82"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ACCphotoWY-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Power Generation</div>
              <div class="dupe-tile-desc">Air Cooled Condenser Rebundling. Fabrication of steam distribution and condensate collection manifolds. Onsite demolition of existing manifolds, tube bundles and structural and replacement with new.</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>power</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>ACCphotoWY-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 84</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>3eec8b178f4d</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-256">
          <input type="checkbox" id="tile-256" data-tile-id="256" data-file="api-tank-clean-out-door-2-1.jpg" data-gid="83" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-clean-out-door-2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Clean Out Door 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-clean-out-door-2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-96">
          <input type="checkbox" id="tile-96" data-tile-id="96" data-file="api-tank-clean-out-door-2.jpg" data-gid="83"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-clean-out-door-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Maintenance Repairs &amp;amp; Alterations</div>
              <div class="dupe-tile-desc">API Tank Clean Out Door 2</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-clean-out-door-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 85</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>3c6e1c15f009</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-49">
          <input type="checkbox" id="tile-49" data-tile-id="49" data-file="37.jpg" data-gid="84" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/37.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Exterior Painting of Process Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>37.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-181">
          <input type="checkbox" id="tile-181" data-tile-id="181" data-file="sam_0258-copy-1.jpg" data-gid="84"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/sam_0258-copy-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Exterior Painting of Process Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>sam_0258-copy-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 86</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d6bf77b2eac6</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-45">
          <input type="checkbox" id="tile-45" data-tile-id="45" data-file="33.jpg" data-gid="85" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/33.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">MIning &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Night Work on Elevated Thickener</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>33.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-177">
          <input type="checkbox" id="tile-177" data-tile-id="177" data-file="imag0338-1.jpg" data-gid="85"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/imag0338-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Night Work on Elevated Thickener</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>imag0338-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 87</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>3dd2ad6df6a9</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-110">
          <input type="checkbox" id="tile-110" data-tile-id="110" data-file="ic2-1.jpg" data-gid="86" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic2-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic2-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-274">
          <input type="checkbox" id="tile-274" data-tile-id="274" data-file="ic2-2.jpg" data-gid="86"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic2-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic2-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 88</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>3e64b9b1dacc</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-196">
          <input type="checkbox" id="tile-196" data-tile-id="196" data-file="IMG_4685-1-1.jpg" data-gid="87" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_4685-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining Laboratory</div>
              <div class="dupe-tile-desc">GC for onsite Mining Laboratory and truck scales; civil, structural, mechanical, APC, electrical, finish, plumbing</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>IMG_4685-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-169">
          <input type="checkbox" id="tile-169" data-tile-id="169" data-file="IMG_4685-1.jpg" data-gid="87"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_4685-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining Laboratory</div>
              <div class="dupe-tile-desc">GC for onsite Mining Laboratory and truck scales; civil, structural, mechanical, APC, electrical, finish, plumbing</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>ie</strong></span>
                <span class="pill pill-file">File: <code>IMG_4685-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-239">
          <input type="checkbox" id="tile-239" data-tile-id="239" data-file="IMG_4685-2.jpg" data-gid="87"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_4685-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining Laboratory</div>
              <div class="dupe-tile-desc">GC for onsite Mining Laboratory and truck scales; civil, structural, mechanical, APC, electrical, finish, plumbing</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>air-pollution-control</strong></span>
                <span class="pill pill-file">File: <code>IMG_4685-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 89</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d2b4a2e3a802</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-20">
          <input type="checkbox" id="tile-20" data-tile-id="20" data-file="1-1.jpg" data-gid="88" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">90’d x 20′ Frac Sands Clarifier</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-73">
          <input type="checkbox" id="tile-73" data-tile-id="73" data-file="chippewa-falls-6.jpg" data-gid="88"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/chippewa-falls-6.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Multiple Process﻿ Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>chippewa-falls-6.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 90</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>dc3281f4813b</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-195">
          <input type="checkbox" id="tile-195" data-tile-id="195" data-file="2575-1-1.jpeg" data-gid="89" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2575-1-1.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Stainless Cone Bottom Tank</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>2575-1-1.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-147">
          <input type="checkbox" id="tile-147" data-tile-id="147" data-file="2575.jpeg" data-gid="89"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/2575.jpeg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Stainless Cone Bottom Tank</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>2575.jpeg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 91</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>19816280a175</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-216">
          <input type="checkbox" id="tile-216" data-tile-id="216" data-file="spreader-bar-3.jpg" data-gid="90" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/spreader-bar-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Spreader Bar</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>spreader-bar-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-77">
          <input type="checkbox" id="tile-77" data-tile-id="77" data-file="spreader-bar.jpg" data-gid="90"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/spreader-bar.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Spreader Bar</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>spreader-bar.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 92</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>a0e998715c1f</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-54">
          <input type="checkbox" id="tile-54" data-tile-id="54" data-file="42.jpg" data-gid="91" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/42.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining</div>
              <div class="dupe-tile-desc">Elevated Reactor Vessel</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>42.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-186">
          <input type="checkbox" id="tile-186" data-tile-id="186" data-file="elevated-reactor-vessel-1.jpg" data-gid="91"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/elevated-reactor-vessel-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining</div>
              <div class="dupe-tile-desc">Elevated Reactor Vessel</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>elevated-reactor-vessel-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 93</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>5ad291d90792</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-224">
          <input type="checkbox" id="tile-224" data-tile-id="224" data-file="IMG_8683-1-1.jpg" data-gid="92" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8683-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8683-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-150">
          <input type="checkbox" id="tile-150" data-tile-id="150" data-file="IMG_8683.jpg" data-gid="92"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_8683.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Biodigester with Cone Bottom</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_8683.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 94</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>7bbf429b7272</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-31">
          <input type="checkbox" id="tile-31" data-tile-id="31" data-file="19-1.jpg" data-gid="93" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/19-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank Bottom Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>19-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-241">
          <input type="checkbox" id="tile-241" data-tile-id="241" data-file="api-tank-bottom-replacement.jpg" data-gid="93"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/api-tank-bottom-replacement.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Oil Gas &amp;amp; Chemical</div>
              <div class="dupe-tile-desc">API Tank Bottom Replacement</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>api-tank-bottom-replacement.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 95</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>2dfbfc426a7b</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-187">
          <input type="checkbox" id="tile-187" data-tile-id="187" data-file="1272-2.jpg" data-gid="94" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/1272-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>1272-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-55">
          <input type="checkbox" id="tile-55" data-tile-id="55" data-file="43.jpg" data-gid="94"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/43.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">Multiple Process Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>43.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 96</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>d9b0bdb50e20</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-48">
          <input type="checkbox" id="tile-48" data-tile-id="48" data-file="36-scaled.jpg" data-gid="95" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/36-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">(2) 55’d x 32′ Acid Tanks</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>36-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-180">
          <input type="checkbox" id="tile-180" data-tile-id="180" data-file="IMG_1154-2-scaled.jpg" data-gid="95"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/IMG_1154-2-scaled.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">50’Ø x 50′ Stainless Acidulation Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>tanks</strong></span>
                <span class="pill pill-file">File: <code>IMG_1154-2-scaled.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 97</span>
        <span class="dupe-group-count">3 duplicate tiles &middot; 3 file copies</span>
        <span class="dupe-group-hash">hash: <code>a9bcf80d05cf</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-248">
          <input type="checkbox" id="tile-248" data-tile-id="248" data-file="copy_0_ducting-repairs-1-1.jpg" data-gid="96" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/copy_0_ducting-repairs-1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>copy_0_ducting-repairs-1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-218">
          <input type="checkbox" id="tile-218" data-tile-id="218" data-file="copy_0_ducting-repairs-1-2.jpg" data-gid="96"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/copy_0_ducting-repairs-1-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>water-other</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>copy_0_ducting-repairs-1-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-80">
          <input type="checkbox" id="tile-80" data-tile-id="80" data-file="copy_0_ducting-repairs-1.jpg" data-gid="96"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/copy_0_ducting-repairs-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Water &amp;amp; Other</div>
              <div class="dupe-tile-desc">Ducting Repairs</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>maintenance</strong></span>
                <span class="pill pill-file">File: <code>copy_0_ducting-repairs-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 98</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>e0740e85e7d9</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-56">
          <input type="checkbox" id="tile-56" data-tile-id="56" data-file="44.jpg" data-gid="97" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/44.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">85’d x 45′ Sulfuric Acid Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>44.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-188">
          <input type="checkbox" id="tile-188" data-tile-id="188" data-file="85-d-x-45-sulfuric-acid-tank-1.jpg" data-gid="97"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/85-d-x-45-sulfuric-acid-tank-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Mining &amp;amp; Aggregates</div>
              <div class="dupe-tile-desc">85’d x 45′ Sulfuric Acid Tank</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>mining</strong></span>
                <span class="pill pill-prod">Product: <strong>(none)</strong></span>
                <span class="pill pill-file">File: <code>85-d-x-45-sulfuric-acid-tank-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 99</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>dadefc28a9d9</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-112">
          <input type="checkbox" id="tile-112" data-tile-id="112" data-file="ic3-1.jpg" data-gid="98" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic3-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic3-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-275">
          <input type="checkbox" id="tile-275" data-tile-id="275" data-file="ic3-3.jpg" data-gid="98"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic3-3.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">,</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic3-3.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
    <details class="dupe-group" open>
      <summary>
        <span class="dupe-group-num">Group 100</span>
        <span class="dupe-group-count">2 duplicate tiles &middot; 2 file copies</span>
        <span class="dupe-group-hash">hash: <code>34174a0b9505</code></span>
      </summary>
      <div class="dupe-group-body">
        
        <label class="dupe-tile" for="tile-109">
          <input type="checkbox" id="tile-109" data-tile-id="109" data-file="ic1-1.jpg" data-gid="99" checked />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic1-1.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>oil-gas-chemical</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic1-1.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
        <label class="dupe-tile" for="tile-273">
          <input type="checkbox" id="tile-273" data-tile-id="273" data-file="ic1-2.jpg" data-gid="99"  />
          <div class="dupe-tile-inner">
            <div class="dupe-tile-thumb"><img src="/assets/images/gallery/ic1-2.jpg" alt="" loading="lazy" /></div>
            <div class="dupe-tile-meta">
              <div class="dupe-tile-title">Industrial Coatings</div>
              <div class="dupe-tile-desc">(no description)</div>
              <div class="dupe-tile-tags">
                <span class="pill pill-ind">Industry: <strong>(none)</strong></span>
                <span class="pill pill-prod">Product: <strong>coatings</strong></span>
                <span class="pill pill-file">File: <code>ic1-2.jpg</code></span>
              </div>
              <div class="dupe-tile-status"><span class="keep-badge">KEEP</span><span class="remove-badge">REMOVE</span></div>
            </div>
          </div>
        </label>
      </div>
    </details>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>

<script>
(function() {
  var LS_KEY = 'gbi_dupe_review_v1';
  var picks = {};
  try { picks = JSON.parse(localStorage.getItem(LS_KEY)) || {}; } catch (e) { picks = {}; }

  var allChecks = document.querySelectorAll('input[type=checkbox][data-tile-id]');

  // Restore from localStorage
  allChecks.forEach(function(cb) {
    var id = cb.dataset.tileId;
    if (picks.hasOwnProperty(id)) {
      cb.checked = picks[id];
    }
  });

  function updateStats() {
    var kept = 0, removed = 0;
    allChecks.forEach(function(cb) {
      if (cb.checked) kept++;
      else removed++;
    });
    document.getElementById('stat-kept').textContent = kept;
    document.getElementById('stat-removed').textContent = removed;
    document.getElementById('progress-count').textContent = removed;
  }

  allChecks.forEach(function(cb) {
    cb.addEventListener('change', function() {
      picks[this.dataset.tileId] = this.checked;
      localStorage.setItem(LS_KEY, JSON.stringify(picks));
      updateStats();
    });
  });

  document.getElementById('btn-clear').addEventListener('click', function() {
    if (!confirm('Reset all selections to the default (keep first tile per group, remove the rest)?')) return;
    picks = {};
    localStorage.removeItem(LS_KEY);
    location.reload();
  });

  document.getElementById('btn-download').addEventListener('click', function() {
    var toRemove = [], toKeep = [];
    allChecks.forEach(function(cb) {
      var entry = { tile_id: parseInt(cb.dataset.tileId,10), file: cb.dataset.file, gid: parseInt(cb.dataset.gid,10) };
      if (cb.checked) toKeep.push(entry);
      else toRemove.push(entry);
    });
    var payload = {
      generated_at: new Date().toISOString(),
      total_groups: 100,
      total_tiles: allChecks.length,
      kept: toKeep,
      remove: toRemove,
    };
    var blob = new Blob([JSON.stringify(payload, null, 2)], {type: 'application/json'});
    var url = URL.createObjectURL(blob);
    var stamp = new Date().toISOString().slice(0,10);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'gbi-gallery-dupe-decisions-' + stamp + '.json';
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
