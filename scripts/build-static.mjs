// Minimal, dependency-free static build for the Cloudflare Workers preview
// deploy (wonderwater.didi-0aa.workers.dev). Cloudflare Workers can't run
// PHP, so the Laravel app itself never serves anything there. This writes a
// single self-contained test page with no external asset references, so the
// build can't fail on anything else while we confirm the Workers deploy
// pipeline (wrangler.jsonc + assets directory) actually serves a page.
// The real Laravel app is unaffected and keeps deploying to TransIP per
// DEPLOY.md.

import { mkdirSync, writeFileSync } from 'node:fs';

const page = `<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WonderWater — test deploy</title>
        <style>
            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #0a0d0c;
                color: #f6f4ee;
                font-family: ui-sans-serif, system-ui, sans-serif;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div>
            <p style="font-size: 0.75rem; letter-spacing: 0.4em; text-transform: uppercase; color: #b8f3e4;">WonderWater</p>
            <h1 style="font-weight: 300; margin: 1rem 0;">Cloudflare deploy is live.</h1>
            <p style="opacity: 0.6;">This is a temporary test page while we confirm the Workers deploy pipeline.</p>
        </div>
    </body>
</html>
`;

mkdirSync('dist', { recursive: true });
writeFileSync('dist/index.html', page);

console.log('Test page built into dist/');
