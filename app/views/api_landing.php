<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f6f2">
    <meta name="description" content="LavaLust Product Desk API overview and endpoint reference.">
    <title>LavaLust API — Product Desk</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #1e3028;
            background: #f5f6f2;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            --green: #27634b;
            --muted: #708077;
            --line: #e5eae3;
        }

        * { box-sizing: border-box; }
        body { min-width: 320px; margin: 0; }
        a { color: inherit; }
        .shell { width: min(1080px, calc(100% - 48px)); margin: 0 auto; }
        header { display: flex; height: 82px; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--line); }
        .brand { display: inline-flex; align-items: center; gap: 11px; font-size: .91rem; font-weight: 750; letter-spacing: -.02em; text-decoration: none; }
        .brand-mark { display: grid; width: 36px; height: 36px; place-items: center; border-radius: 12px; background: var(--green); color: white; font-family: Georgia, serif; font-size: 1.2rem; }
        .header-note { color: var(--muted); font-size: .78rem; }
        main { padding: 72px 0 56px; }
        .hero { display: grid; grid-template-columns: 1.12fr .88fr; align-items: center; gap: 54px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 9px; margin: 0; color: var(--green); font-size: .69rem; font-weight: 750; letter-spacing: .14em; text-transform: uppercase; }
        .pulse { width: 8px; height: 8px; border-radius: 50%; background: #45a276; box-shadow: 0 0 0 4px #e0f1e5; }
        h1 { max-width: 620px; margin: 19px 0 16px; font-family: Georgia, "Times New Roman", serif; font-size: clamp(2.8rem, 6vw, 4.7rem); font-weight: 500; letter-spacing: -.055em; line-height: 1.03; }
        h1 em { color: var(--green); font-weight: 500; }
        .intro { max-width: 520px; margin: 0; color: #69776f; font-size: 1rem; line-height: 1.8; }
        .actions { display: flex; flex-wrap: wrap; gap: 11px; margin-top: 27px; }
        .button { display: inline-flex; min-height: 44px; align-items: center; justify-content: center; gap: 9px; border: 1px solid transparent; border-radius: 9px; padding: 0 16px; font-size: .8rem; font-weight: 700; text-decoration: none; transition: transform .18s, background .18s, box-shadow .18s; }
        .button:hover { transform: translateY(-2px); }
        .button.primary { background: var(--green); color: #fff; box-shadow: 0 7px 16px #27634b24; }
        .button.primary:hover { background: #1e503b; }
        .button.secondary { border-color: #dfe5dd; background: #fff; color: #394b41; }
        .button.secondary:hover { box-shadow: 0 5px 14px #213b2b12; }
        .preview { overflow: hidden; border: 1px solid #263c31; border-radius: 17px; background: #17251e; box-shadow: 0 24px 60px #1c332624; }
        .preview-bar { display: flex; height: 46px; align-items: center; gap: 6px; border-bottom: 1px solid #ffffff12; padding: 0 16px; }
        .dot { width: 7px; height: 7px; border-radius: 50%; background: #577264; }
        .preview-label { margin-left: 7px; color: #a5b7ab; font-size: .68rem; }
        .preview-body { padding: 24px; }
        .response-label { margin: 0 0 12px; color: #89a795; font-size: .65rem; font-weight: 700; letter-spacing: .13em; text-transform: uppercase; }
        pre { overflow-x: auto; margin: 0; color: #dbe8dc; font-family: "SFMono-Regular", Consolas, monospace; font-size: .79rem; line-height: 1.9; }
        .key { color: #a9c98c; }
        .value { color: #f0d797; }
        .section-heading { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin: 72px 0 18px; }
        h2 { margin: 0; font-family: Georgia, "Times New Roman", serif; font-size: 1.9rem; font-weight: 500; letter-spacing: -.035em; }
        .section-note { margin: 0; color: var(--muted); font-size: .76rem; }
        .endpoint-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .endpoint { display: grid; grid-template-columns: 57px minmax(0, 1fr); align-items: start; gap: 13px; border: 1px solid var(--line); border-radius: 11px; background: #fff; padding: 17px; }
        .method { display: inline-flex; min-height: 24px; align-items: center; justify-content: center; border-radius: 6px; background: #edf5ef; color: var(--green); font-size: .59rem; font-weight: 800; letter-spacing: .04em; }
        .method.post { background: #eef2fa; color: #4e6091; }
        .method.put { background: #fcf3e6; color: #936321; }
        .method.delete { background: #fbefed; color: #a45348; }
        .endpoint code { color: #2b3e33; font-size: .78rem; font-weight: 700; }
        .endpoint p { margin: 5px 0 0; color: var(--muted); font-size: .72rem; line-height: 1.55; }
        .secure-note { display: flex; gap: 13px; align-items: flex-start; margin-top: 20px; border: 1px solid #dce9dc; border-radius: 11px; background: #eff6ee; padding: 16px 18px; color: #47634e; }
        .secure-icon { font-size: 1.1rem; }
        .secure-note p { margin: 0; font-size: .76rem; line-height: 1.65; }
        .secure-note strong { color: #2d5138; }
        footer { display: flex; justify-content: space-between; gap: 16px; border-top: 1px solid var(--line); padding: 22px 0 28px; color: var(--muted); font-size: .7rem; }
        footer a { color: var(--green); font-weight: 700; text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        @media (max-width: 760px) {
            .shell { width: min(100% - 36px, 560px); }
            main { padding-top: 48px; }
            .hero { grid-template-columns: 1fr; gap: 34px; }
            h1 { max-width: 560px; }
            .section-heading { align-items: start; flex-direction: column; margin-top: 52px; gap: 7px; }
        }
        @media (max-width: 520px) {
            .shell { width: calc(100% - 32px); }
            header { height: 70px; }
            .header-note { font-size: .68rem; }
            main { padding-top: 39px; }
            .endpoint-grid { grid-template-columns: 1fr; }
            .preview-body { padding: 18px; }
            pre { font-size: .69rem; }
            footer { flex-direction: column; }
        }
    </style>
</head>
<body>
    <header class="shell">
        <a class="brand" href="/" aria-label="LavaLust Product Desk API home">
            <span class="brand-mark">L</span>
            <span>LavaLust <span style="color:#829087;font-weight:500">/ Product API</span></span>
        </a>
        <span class="header-note">API overview</span>
    </header>

    <main class="shell">
        <section class="hero" aria-labelledby="page-title">
            <div>
                <p class="eyebrow"><span class="pulse" aria-hidden="true"></span> Service online</p>
                <h1 id="page-title">Your inventory,<br><em>well managed.</em></h1>
                <p class="intro">A secure REST API for the Product Desk application. Sign in to manage your catalog through the React client.</p>
                <div class="actions">
                    <a class="button primary" href="https://delarosa-gade-lavalust.vercel.app/">Open Product Desk <span aria-hidden="true">↗</span></a>
                    <a class="button secondary" href="/health">View API health <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <aside class="preview" aria-label="API health response preview">
                <div class="preview-bar"><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="preview-label">GET /health · application/json</span></div>
                <div class="preview-body">
                    <p class="response-label">200 · Service ready</p>
                    <pre>{
  <span class="key">"status"</span>: <span class="value">"ok"</span>,
  <span class="key">"service"</span>: <span class="value">"LavaLust Products API"</span>,
  <span class="key">"endpoints"</span>: {
    <span class="key">"login"</span>: <span class="value">"/api/auth/login"</span>,
    <span class="key">"products"</span>: <span class="value">"/api/products"</span>
  }
}</pre>
                </div>
            </aside>
        </section>

        <section aria-labelledby="endpoints-title">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">API REFERENCE</p>
                    <h2 id="endpoints-title">Available endpoints</h2>
                </div>
                <p class="section-note">Product operations require a valid access token.</p>
            </div>
            <div class="endpoint-grid">
                <article class="endpoint"><span class="method post">POST</span><div><code>/api/auth/register</code><p>Create an account and receive tokens.</p></div></article>
                <article class="endpoint"><span class="method post">POST</span><div><code>/api/auth/login</code><p>Sign in to receive an access token.</p></div></article>
                <article class="endpoint"><span class="method">GET</span><div><code>/api/products</code><p>List products for an authenticated user.</p></div></article>
                <article class="endpoint"><span class="method post">POST</span><div><code>/api/products</code><p>Add a product to the catalog.</p></div></article>
                <article class="endpoint"><span class="method put">PUT / PATCH</span><div><code>/api/products/{id}</code><p>Update an existing product.</p></div></article>
                <article class="endpoint"><span class="method delete">DELETE</span><div><code>/api/products/{id}</code><p>Remove a product from the catalog.</p></div></article>
            </div>
            <div class="secure-note">
                <span class="secure-icon" aria-hidden="true">◆</span>
                <p><strong>Built with security in mind.</strong> Product CRUD requests are authenticated. The frontend communicates with this API; database credentials stay on the server and are never sent to the browser.</p>
            </div>
        </section>
    </main>

    <footer class="shell">
        <span>LavaLust Product Management API</span>
        <a href="https://delarosa-gade-lavalust.vercel.app/">Go to Product Desk ↗</a>
    </footer>
</body>
</html>
