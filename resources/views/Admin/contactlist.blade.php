@extends('adminlayout.app')
@section('title', 'Contact Stream · Elite Command Center')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ================================================================
   ELITE COMMAND CENTER · CONTACT STREAM v5.0
   MAXIMUM ANIMATION · GPS SYSTEM · CINEMATIC PREMIUM
   ================================================================ */

*, *::before, *::after { box-sizing: border-box; }

:root {
    --red:      #ef4444;
    --red2:     #ff6b35;
    --red-glow: rgba(239,68,68,0.4);
    --amber:    #f59e0b;
    --green:    #22c55e;
    --blue:     #6366f1;
    --purple:   #a855f7;
    --cyan:     #06b6d4;
    --bg:       #020408;
    --bg1:      #060a12;
    --bg2:      #0a0f1e;
    --bg3:      #0f1628;
    --border:   rgba(255,255,255,0.07);
    --border2:  rgba(255,255,255,0.03);
    --muted:    #5c6680;
    --text:     #e8ecf4;
    --font-d:   'Plus Jakarta Sans', sans-serif;
    --font-m:   'JetBrains Mono', monospace;
}

body { background: var(--bg); font-family: var(--font-d); color: var(--text); }

/* ════════════════════════════════
   CINEMATIC GPS BACKGROUND
   ════════════════════════════════ */
.cinematic-bg {
    position: fixed; inset: 0; pointer-events: none; z-index: 0;
    background:
        radial-gradient(ellipse at 85% 10%, rgba(239,68,68,0.06) 0%, transparent 45%),
        radial-gradient(ellipse at 15% 85%, rgba(99,102,241,0.05) 0%, transparent 45%),
        radial-gradient(ellipse at 55% 50%, rgba(6,182,212,0.02) 0%, transparent 60%),
        var(--bg);
    overflow: hidden;
}

/* Animated drift grid */
.grid-overlay {
    position: absolute; inset: -100px;
    background-image:
        linear-gradient(rgba(239,68,68,0.028) 1px, transparent 1px),
        linear-gradient(90deg, rgba(239,68,68,0.028) 1px, transparent 1px);
    background-size: 54px 54px;
    animation: gridDrift 35s linear infinite;
    mask-image: radial-gradient(ellipse at 80% 15%, black 15%, transparent 72%);
}
@keyframes gridDrift {
    0%   { transform: translate(0,0); }
    100% { transform: translate(54px, 54px); }
}

/* GPS Radar rings */
.radar-system {
    position: absolute; top: -200px; right: -200px;
    width: 1000px; height: 1000px;
    animation: radarFloat 12s ease-in-out infinite alternate;
}
@keyframes radarFloat { 0%{transform:scale(1) rotate(0deg)} 100%{transform:scale(1.06) rotate(2deg)} }

.r-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(239,68,68,0.06);
    animation: ringPulse 8s ease-in-out infinite;
}
.r-ring:nth-child(1) { inset: 0;    animation-delay: 0s; }
.r-ring:nth-child(2) { inset: 120px; animation-delay: 1.2s; border-color:rgba(239,68,68,0.045); }
.r-ring:nth-child(3) { inset: 260px; animation-delay: 2.4s; border-color:rgba(239,68,68,0.03); }
.r-ring:nth-child(4) { inset: 420px; animation-delay: 3.6s; border-color:rgba(239,68,68,0.02); }
@keyframes ringPulse {
    0%,100% { opacity:0.5; transform:scale(1); }
    50%     { opacity:1;   transform:scale(1.04); }
}

/* Radar sweep — conic gradient fan */
.radar-sweep {
    position: absolute; top: -200px; right: -200px;
    width: 1000px; height: 1000px; border-radius: 50%;
    animation: sweepSpin 10s linear infinite;
    overflow: hidden;
}
.radar-sweep::before {
    content: '';
    position: absolute; inset: 0;
    background: conic-gradient(
        from 0deg,
        transparent 0deg,
        transparent 330deg,
        rgba(239,68,68,0.07) 345deg,
        rgba(239,68,68,0.18) 360deg
    );
}
.radar-sweep::after {
    content: '';
    position: absolute; top: 50%; left: 0;
    width: 50%; height: 1.5px;
    background: linear-gradient(to left, transparent, rgba(239,68,68,0.7));
    transform-origin: right center;
    box-shadow: 0 0 10px var(--red), 0 0 30px rgba(239,68,68,0.3);
}
@keyframes sweepSpin { to { transform: rotate(360deg); } }

/* GPS Blips */
.blip {
    position: absolute; border-radius: 50%;
    width: 5px; height: 5px;
    background: var(--red);
    box-shadow: 0 0 8px var(--red);
    animation: blipCycle 4.5s ease-in-out infinite;
}
.blip.cyan  { background: var(--cyan);   box-shadow: 0 0 8px var(--cyan); }
.blip.blue  { background: var(--purple); box-shadow: 0 0 8px var(--purple); }
.blip::after {
    content: '';
    position: absolute; inset: -5px; border-radius: 50%;
    border: 1px solid currentColor; opacity: 0.4;
    animation: blipRing 4.5s ease-out infinite;
}
@keyframes blipCycle  { 0%,100%{opacity:0} 25%,75%{opacity:1} }
@keyframes blipRing   { 0%{transform:scale(1);opacity:0.6} 100%{transform:scale(4);opacity:0} }

/* Data stream lines */
.dstream {
    position: absolute; width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(239,68,68,0.12), transparent);
    animation: dsFall 7s linear infinite;
    transform-origin: top;
}
@keyframes dsFall {
    0%   { transform: translateY(-200px) rotate(12deg); opacity:0; }
    15%  { opacity:1; }
    85%  { opacity:1; }
    100% { transform: translateY(110vh)  rotate(12deg); opacity:0; }
}

/* Scanlines */
.scanlines {
    position: fixed; inset: 0; z-index: 1; pointer-events: none;
    background: repeating-linear-gradient(
        0deg, transparent, transparent 2px,
        rgba(0,0,0,0.035) 2px, rgba(0,0,0,0.035) 4px
    );
}

/* ════════════════════════════════
   LAYOUT
   ════════════════════════════════ */
.stream-container {
    position: relative; z-index: 10;
    max-width: 1760px; margin: 0 auto;
    padding: 28px 22px 80px;
}

/* ════════════════════════════════
   HEADER
   ════════════════════════════════ */
.hdr-section {
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 24px; flex-wrap: wrap; margin-bottom: 48px;
}

#hdrLeft, #hdrRight { opacity: 0; }

.live-indicator {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 7px 16px; border-radius: 100px;
    background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.18);
    font-size: 9px; font-weight: 900; letter-spacing: 0.25em;
    text-transform: uppercase; color: var(--green);
    margin-bottom: 16px; width: fit-content;
}
.live-dot {
    width: 7px; height: 7px; background: var(--green);
    border-radius: 50%; box-shadow: 0 0 8px var(--green);
    animation: livePulse 2s ease-out infinite;
}
@keyframes livePulse {
    0%   { box-shadow: 0 0 0 0 rgba(34,197,94,0.6); }
    70%  { box-shadow: 0 0 0 9px rgba(34,197,94,0); }
    100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
}

.hdr-title {
    font-size: clamp(2.6rem, 5.5vw, 4.2rem);
    font-weight: 900; font-style: italic;
    line-height: 0.9; letter-spacing: -0.04em;
    color: white; position: relative;
}
.hdr-title .accent {
    background: linear-gradient(135deg, var(--red) 0%, var(--red2) 55%, #ff9500 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text; position: relative;
}
/* Glow ghost */
.hdr-title .accent::after {
    content: attr(data-t);
    position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--red), var(--red2));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: blur(22px); opacity: 0.35;
    animation: accentGlow 3s ease-in-out infinite alternate;
}
@keyframes accentGlow { 0%{filter:blur(18px);opacity:0.25} 100%{filter:blur(28px);opacity:0.5} }

.hdr-sub {
    color: var(--muted); font-size: 13.5px;
    max-width: 500px; line-height: 1.8;
    margin-top: 14px; font-weight: 400;
}

/* Coord badge */
.coord-badge {
    display: inline-flex; align-items: center; gap: 7px; flex-wrap: wrap;
    font-family: var(--font-m); font-size: 9px; color: var(--muted);
    letter-spacing: 0.1em; padding: 7px 14px; border-radius: 10px;
    background: rgba(0,0,0,0.35); border: 1px solid var(--border2);
    margin-top: 14px; width: fit-content;
}
.coord-live { color: var(--red); animation: blink 1.4s steps(1) infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.15} }
.coord-sep { color: rgba(255,255,255,0.1); }
.coord-val { color: rgba(220,230,255,0.65); }

/* Header right */
.hdr-meta {
    font-family: var(--font-m); font-size: 10px;
    color: var(--muted); letter-spacing: 0.12em;
    text-align: right; margin-bottom: 14px;
    display: flex; align-items: center; justify-content: flex-end; gap: 10px;
    flex-wrap: wrap;
}
.hdr-btns { display: flex; gap: 10px; justify-content: flex-end; flex-wrap: wrap; }

/* ════════════════════════════════
   ALERTS
   ════════════════════════════════ */
.alert {
    display: flex; align-items: center; gap: 12px;
    padding: 13px 18px; border-radius: 16px; margin-bottom: 22px; font-size: 13px;
}
.alert-ok  { background:rgba(34,197,94,0.06); border:1px solid rgba(34,197,94,0.18); color:#6ee7b7; }
.alert-err { background:rgba(239,68,68,0.06); border:1px solid rgba(239,68,68,0.18); color:#fca5a5; }
.alert-icon { width:30px;height:30px;border-radius:9px;flex-shrink:0;display:flex;align-items:center;justify-content:center; }

/* ════════════════════════════════
   KPI CARDS
   ════════════════════════════════ */
.kpi-grid {
    display: grid; grid-template-columns: repeat(4,1fr);
    gap: 18px; margin-bottom: 28px;
}
@media(max-width:1200px){ .kpi-grid{ grid-template-columns:repeat(2,1fr); } }
@media(max-width:560px) { .kpi-grid{ grid-template-columns:1fr; } }

.kpi-card {
    background: linear-gradient(160deg, rgba(255,255,255,0.04) 0%, rgba(0,0,0,0.35) 100%);
    border: 1px solid var(--border); border-radius: 28px; padding: 26px;
    position: relative; overflow: hidden;
    opacity: 0; transform: translateY(28px);
    transition: transform 0.45s cubic-bezier(.175,.885,.32,1.275), box-shadow 0.4s, border-color 0.3s;
    cursor: default;
}
.kpi-card:hover {
    transform: translateY(-8px) scale(1.01);
    border-color: var(--card-active, rgba(239,68,68,0.35));
    box-shadow: 0 24px 60px rgba(0,0,0,0.55), 0 0 0 1px var(--card-active, rgba(239,68,68,0.06));
}
/* Radial glow on hover */
.kpi-card::before {
    content:''; position:absolute; inset:0; pointer-events:none;
    background: radial-gradient(circle at 15% 15%, var(--card-glow, rgba(239,68,68,0.12)), transparent 65%);
    opacity:0; transition: opacity 0.4s;
}
.kpi-card:hover::before { opacity:1; }
/* Glare sweep */
.kpi-card::after {
    content:''; position:absolute; top:0; left:-80%;
    width:60%; height:100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.03), transparent);
    transition: left 0.55s ease; pointer-events:none;
}
.kpi-card:hover::after { left: 160%; }

.kpi-icon {
    width: 50px; height: 50px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; margin-bottom: 20px;
    position: relative; z-index: 1;
    transition: transform 0.35s cubic-bezier(.34,1.56,.64,1);
}
.kpi-card:hover .kpi-icon { transform: scale(1.14) rotate(-5deg); }
.ki-r { background:rgba(239,68,68,0.1); color:var(--red); box-shadow:0 4px 20px rgba(239,68,68,0.15); }
.ki-v { background:rgba(168,85,247,0.1); color:var(--purple); box-shadow:0 4px 20px rgba(168,85,247,0.15); }
.ki-c { background:rgba(99,102,241,0.1); color:var(--blue); box-shadow:0 4px 20px rgba(99,102,241,0.15); }
.ki-a { background:rgba(245,158,11,0.1); color:var(--amber); box-shadow:0 4px 20px rgba(245,158,11,0.15); }

.kpi-num {
    font-size: clamp(2rem,4vw,2.8rem); font-weight: 900; font-style: italic;
    color: white; line-height: 1; letter-spacing: -0.03em;
    position: relative; z-index: 1;
}
.kpi-label {
    font-size: 10px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.2em; color: var(--muted); margin-top: 5px;
    position: relative; z-index: 1;
}
.kpi-mono {
    font-family: var(--font-m); font-size: 9px;
    color: rgba(92,102,128,0.6); margin-top: 10px;
    text-transform: uppercase; letter-spacing: 0.12em;
    position: relative; z-index: 1;
}

/* Progress bar */
.kpi-bar { height:3px; background:rgba(255,255,255,0.05); border-radius:4px; margin-top:18px; overflow:hidden; position:relative; z-index:1; }
.kpi-bar-fill {
    height:100%; border-radius:4px;
    transform: scaleX(0); transform-origin: left;
    transition: transform 1.4s cubic-bezier(.23,1,.32,1) 0.3s;
}
.kpi-card.in .kpi-bar-fill { transform: scaleX(1); }

/* Sparkline */
.spark {
    display:flex; align-items:flex-end; gap:3px;
    height:44px; position:relative; z-index:1; padding-bottom:6px;
}
.spark span {
    flex:1; min-width:4px; border-radius:3px 3px 0 0;
    background: currentColor; opacity:0.2;
    transform: scaleY(0); transform-origin: bottom;
}
.kpi-card.in .spark span { transform: scaleY(1); }
.spark span:last-child { opacity:0.85; }
.kpi-card:hover .spark span { opacity:0.65; }

/* ════════════════════════════════
   CONTROLS / FILTERS
   ════════════════════════════════ */
.ctrl-bar {
    display:flex; gap:12px; flex-wrap:wrap; align-items:center;
    margin-bottom: 20px;
    opacity:0; transform:translateY(14px);
}

.search-box { position:relative; flex:1; min-width:260px; }
.search-box input {
    width:100%; background:rgba(255,255,255,0.03); border:1px solid var(--border);
    border-radius:16px; padding:13px 110px 13px 44px;
    color:var(--text); font-size:13px; font-family:var(--font-d); outline:none;
    transition: border-color 0.3s, box-shadow 0.3s;
}
.search-box input::placeholder { color:var(--muted); font-size:12px; }
.search-box input:focus {
    border-color: rgba(239,68,68,0.4);
    box-shadow: 0 0 0 3px rgba(239,68,68,0.07), 0 0 25px rgba(239,68,68,0.04);
}
.s-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); color:var(--muted); font-size:12px; pointer-events:none; transition:color 0.3s; }
.search-box:focus-within .s-icon { color:var(--red); }
.s-btn {
    position:absolute; right:6px; top:50%; transform:translateY(-50%);
    background:linear-gradient(135deg,var(--red),#b91c1c); border:none;
    color:white; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em;
    padding:8px 16px; border-radius:11px; cursor:pointer; font-family:var(--font-d);
    box-shadow:0 4px 18px rgba(239,68,68,0.3); transition:all 0.25s;
}
.s-btn:hover { box-shadow:0 4px 28px rgba(239,68,68,0.55); transform:translateY(-50%) scale(1.04); }

.fpill {
    display:inline-flex; align-items:center; gap:6px;
    padding:11px 18px; border-radius:14px;
    border:1px solid var(--border); background:rgba(255,255,255,0.02);
    color:var(--muted); font-size:9px; font-weight:900;
    text-transform:uppercase; letter-spacing:0.18em;
    font-family:var(--font-d); text-decoration:none; white-space:nowrap;
    transition:all 0.25s; cursor:pointer;
}
.fpill:hover { color:white; border-color:rgba(255,255,255,0.14); background:rgba(255,255,255,0.05); }
.fp-amber { background:rgba(245,158,11,0.09); border-color:rgba(245,158,11,0.28); color:#fcd34d; }
.fp-green { background:rgba(34,197,94,0.08);  border-color:rgba(34,197,94,0.25);  color:#4ade80; }
.fp-reset { background:rgba(239,68,68,0.07);  border-color:rgba(239,68,68,0.2);   color:#f87171; }

/* ════════════════════════════════
   DATA PANEL
   ════════════════════════════════ */
.data-panel {
    background: linear-gradient(160deg, rgba(255,255,255,0.03) 0%, rgba(0,0,0,0.32) 100%);
    border:1px solid var(--border); border-radius:32px; overflow:hidden;
    opacity:0; transform:translateY(36px);
    box-shadow: 0 50px 100px rgba(0,0,0,0.5);
    position: relative;
}

/* Animated top strip */
.panel-strip {
    height:2px;
    background: linear-gradient(90deg,
        transparent 0%,
        var(--red) 20%,
        var(--red2) 40%,
        var(--purple) 60%,
        var(--cyan) 80%,
        transparent 100%
    );
    background-size:300% 100%;
    animation: stripAnim 4s ease-in-out infinite alternate;
}
@keyframes stripAnim { 0%{background-position:0%} 100%{background-position:100%} }

.panel-hdr {
    padding: 22px 30px; background:rgba(0,0,0,0.22);
    border-bottom:1px solid var(--border2);
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;
}
.panel-title {
    display:flex; align-items:center; gap:14px;
}
.ptl-bar {
    width:4px; height:26px; border-radius:3px;
    background:linear-gradient(to bottom,var(--red),var(--red2));
    box-shadow:0 0 14px var(--red);
    animation: barGlow 2.5s ease-in-out infinite alternate;
}
@keyframes barGlow { 0%{box-shadow:0 0 8px var(--red)} 100%{box-shadow:0 0 22px var(--red),0 0 44px rgba(239,68,68,0.25)} }
.ptl-text h3 {
    font-size:16px; font-weight:900; font-style:italic;
    color:white; letter-spacing:0.04em; text-transform:uppercase; margin:0;
}
.ptl-text .ptl-sub {
    font-family:var(--font-m); font-size:9px; color:var(--muted);
    display:flex; align-items:center; gap:6px; margin-top:2px; letter-spacing:0.15em;
}
.ptl-dot {
    width:5px; height:5px; border-radius:50%;
    background:var(--green); box-shadow:0 0 5px var(--green);
    animation: livePulse 2s ease-out infinite;
}
.panel-chips { display:flex; gap:8px; flex-wrap:wrap; }
.pchip {
    padding:5px 12px; border-radius:10px;
    background:rgba(255,255,255,0.02); border:1px solid var(--border2);
    font-size:9px; font-weight:800; color:var(--muted);
    font-family:var(--font-d); text-transform:uppercase; letter-spacing:0.12em;
    white-space:nowrap;
}

/* ════════════════════════════════
   TABLE
   ════════════════════════════════ */
.tbl-scroll { overflow-x:auto; }
.tbl-scroll::-webkit-scrollbar { height:4px; }
.tbl-scroll::-webkit-scrollbar-track { background:rgba(0,0,0,0.2); }
.tbl-scroll::-webkit-scrollbar-thumb { background:rgba(239,68,68,0.2); border-radius:4px; }
.tbl-scroll::-webkit-scrollbar-thumb:hover { background:rgba(239,68,68,0.45); }

.elite-table { width:100%; border-collapse:collapse; min-width:1060px; }
.elite-table thead th {
    padding:14px 22px;
    font-size:9px; font-weight:900; text-transform:uppercase;
    letter-spacing:0.22em; color:var(--muted);
    background:rgba(0,0,0,0.15); border-bottom:1px solid var(--border2);
    font-family:var(--font-d); white-space:nowrap; text-align:left;
}
.elite-table thead th:first-child { padding-left:30px; }
.elite-table thead th:last-child  { padding-right:30px; text-align:right; }

.t-row {
    border-bottom:1px solid var(--border2);
    transition: background 0.25s, box-shadow 0.25s;
    opacity:0; transform:translateX(-16px);
}
.t-row:last-child { border-bottom:none; }
.t-row:hover {
    background: rgba(239,68,68,0.025);
    box-shadow: inset 4px 0 0 var(--red), inset -1px 0 0 rgba(239,68,68,0.05);
}
.elite-table td { padding:18px 22px; vertical-align:middle; }
.elite-table td:first-child { padding-left:30px; }
.elite-table td:last-child  { padding-right:30px; }

/* ID tag */
.id-tag { font-family:var(--font-m); font-size:11px; color:var(--muted); letter-spacing:0.05em; }

/* Avatar */
.av-wrap { position:relative; display:inline-block; }
.av-ring {
    position:absolute; inset:-3px; border-radius:16px;
    border:1.5px solid transparent; transition:border-color 0.3s, box-shadow 0.3s;
    background:conic-gradient(from 0deg,var(--red),var(--purple),var(--cyan),var(--red)) border-box;
    -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: destination-out; mask-composite: exclude;
    opacity:0; transition:opacity 0.3s;
    animation: avRingSpin 4s linear infinite paused;
}
.t-row:hover .av-ring { opacity:1; animation-play-state:running; }
@keyframes avRingSpin { to{transform:rotate(360deg)} }

.avatar {
    width:44px; height:44px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-weight:900; color:white; font-size:16px;
    font-style:italic; box-shadow:0 6px 18px rgba(0,0,0,0.4);
    position:relative; z-index:1;
    transition: transform 0.3s cubic-bezier(.34,1.56,.64,1);
}
.t-row:hover .avatar { transform:scale(1.1); }

.s-name { font-weight:800; color:white; font-size:13.5px; transition:color 0.2s; }
.t-row:hover .s-name { color:#ff8c8c; }
.s-email { font-size:11px; color:var(--muted); text-decoration:none; transition:color 0.2s; display:flex;align-items:center;gap:3px;margin-top:2px; }
.s-email:hover { color:var(--red); }
.s-phone { font-size:10px; color:var(--muted); margin-top:2px; display:flex;align-items:center;gap:4px; }

/* Status badge */
.s-pill {
    display:inline-flex; align-items:center; gap:5px;
    padding:4px 10px; border-radius:100px;
    font-size:9px; font-weight:900; text-transform:uppercase;
    letter-spacing:0.12em; margin-top:6px;
}
.sp-pend { background:rgba(245,158,11,0.1); color:var(--amber); border:1px solid rgba(245,158,11,0.2); }
.sp-repl { background:rgba(34,197,94,0.1);  color:var(--green); border:1px solid rgba(34,197,94,0.2); }

/* Intent badges */
.i-tag {
    display:inline-flex; align-items:center; gap:5px;
    padding:4px 9px; border-radius:8px; width:fit-content;
    font-size:9px; font-weight:700; max-width:155px;
    overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.it-subj { background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.2); color:#a5b4fc; }
.it-veh  { background:rgba(6,182,212,0.08); border:1px solid rgba(6,182,212,0.2); color:#67e8f9; }

/* Rental period pins */
.pin { width:5px; height:5px; border-radius:50%; flex-shrink:0; }
.pin-g { background:var(--green); box-shadow:0 0 4px var(--green); }
.pin-r { background:var(--red);   box-shadow:0 0 4px var(--red); }

/* Message preview */
.msg-prev {
    font-size:12px; color:var(--muted); font-style:italic; line-height:1.65;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}

/* Timestamp */
.ts-d { font-weight:800; color:white; font-size:13px; }
.ts-t { font-family:var(--font-m); font-size:10px; color:var(--muted); margin-top:2px; }
.ts-r { font-size:9px; color:rgba(92,102,128,0.5); font-style:italic; margin-top:2px; }

/* Action buttons */
.ab {
    width:36px; height:36px; border-radius:12px;
    display:inline-flex; align-items:center; justify-content:center;
    background:rgba(255,255,255,0.04); border:1px solid var(--border);
    color:var(--muted); cursor:pointer; font-size:12px;
    transition: all 0.28s cubic-bezier(.34,1.56,.64,1);
}
.ab:hover { transform:translateY(-4px) scale(1.13); color:white; }
.ab-v:hover { background:var(--blue);   border-color:var(--blue);   box-shadow:0 8px 24px rgba(99,102,241,0.45); }
.ab-m:hover { background:var(--green);  border-color:var(--green);  box-shadow:0 8px 24px rgba(34,197,94,0.4); }
.ab-d:hover { background:var(--red);    border-color:var(--red);    box-shadow:0 8px 24px rgba(239,68,68,0.45); }

/* Tooltip */
.tt { position:relative; }
.tt::after {
    content:attr(data-t);
    position:absolute; bottom:108%; left:50%; transform:translateX(-50%);
    background:rgba(2,4,8,0.95); color:white;
    font-size:9px; font-weight:800; font-family:var(--font-d);
    letter-spacing:0.12em; text-transform:uppercase;
    white-space:nowrap; padding:4px 9px; border-radius:7px;
    border:1px solid rgba(255,255,255,0.07);
    opacity:0; pointer-events:none; transition:opacity 0.2s;
}
.tt:hover::after { opacity:1; }

/* ════════════════════════════════
   PAGINATION
   ════════════════════════════════ */
.pag-wrap {
    padding:22px 30px; border-top:1px solid var(--border2);
    background:rgba(0,0,0,0.15); display:flex; justify-content:center;
}

/* ════════════════════════════════
   EMPTY STATE
   ════════════════════════════════ */
.empty-wrap { padding:90px 20px; text-align:center; }
.empty-circle {
    position:relative; display:inline-block; margin-bottom:30px;
}
.empty-circle .ec-1, .ec-2, .ec-3 {
    position:absolute; border-radius:50%; border:1px solid rgba(255,255,255,0.04);
}
.ec-1 { inset:-14px; } .ec-2 { inset:-28px; } .ec-3 { inset:-44px; }
.empty-icon {
    width:90px; height:90px; border-radius:50%;
    background:linear-gradient(135deg,rgba(239,68,68,0.07),rgba(99,102,241,0.07));
    border:1px solid rgba(255,255,255,0.05);
    display:flex; align-items:center; justify-content:center;
}

/* ════════════════════════════════
   BUTTONS (global)
   ════════════════════════════════ */
.btn-p {
    display:inline-flex; align-items:center; gap:8px;
    padding:11px 22px; border-radius:14px; border:none;
    background:linear-gradient(135deg,var(--red),#b91c1c); color:white;
    font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em;
    font-family:var(--font-d); cursor:pointer; text-decoration:none;
    box-shadow:0 6px 24px rgba(239,68,68,0.3); transition:all 0.3s;
}
.btn-p:hover { box-shadow:0 8px 36px rgba(239,68,68,0.55); transform:translateY(-2px); }
.btn-g {
    display:inline-flex; align-items:center; gap:8px;
    padding:11px 22px; border-radius:14px;
    background:rgba(255,255,255,0.05); border:1px solid var(--border);
    color:var(--text); font-size:10px; font-weight:700;
    text-transform:uppercase; letter-spacing:0.12em;
    font-family:var(--font-d); cursor:pointer; text-decoration:none;
    transition:all 0.2s;
}
.btn-g:hover { background:rgba(255,255,255,0.1); }
.btn-green-s {
    display:inline-flex; align-items:center; gap:8px;
    padding:11px 22px; border-radius:14px; border:none;
    background:linear-gradient(135deg,#16a34a,#064e3b); color:white;
    font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em;
    font-family:var(--font-d); cursor:pointer;
    box-shadow:0 6px 24px rgba(34,197,94,0.25); transition:all 0.3s;
}
.btn-green-s:hover { box-shadow:0 8px 36px rgba(34,197,94,0.4); transform:translateY(-2px); }

/* ════════════════════════════════
   MODAL SYSTEM
   ════════════════════════════════ */
.modal-overlay {
    position:fixed; inset:0; z-index:9999;
    display:flex; align-items:center; justify-content:center; padding:18px;
    background:rgba(0,0,8,0.82); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
    opacity:0; visibility:hidden; transition:opacity 0.35s, visibility 0.35s;
}
.modal-overlay.open { opacity:1; visibility:visible; }
.modal-box {
    width:100%; display:flex; flex-direction:column; overflow:hidden;
    background:linear-gradient(165deg, #0c1020 0%, #060a14 100%);
    border:1px solid rgba(255,255,255,0.08); border-radius:30px;
    box-shadow:0 60px 120px rgba(0,0,0,0.85);
    transform:translateY(28px) scale(0.95); opacity:0;
    transition: transform 0.45s cubic-bezier(.19,1,.22,1), opacity 0.35s;
}
.modal-overlay.open .modal-box { transform:translateY(0) scale(1); opacity:1; }

/* Modal strip */
.m-strip  { height:2px; background:linear-gradient(90deg,transparent,var(--red),var(--red2),var(--purple),transparent); background-size:300%; animation:stripAnim 3s ease-in-out infinite alternate; }
.m-strip-g{ height:2px; background:linear-gradient(90deg,transparent,var(--green),var(--cyan),transparent); background-size:300%; animation:stripAnim 3s ease-in-out infinite alternate; }
.m-strip-r{ height:2px; background:linear-gradient(90deg,transparent,var(--red),var(--red2),transparent); }

.m-hdr {
    display:flex; align-items:center; justify-content:space-between; gap:14px;
    padding:22px 28px; border-bottom:1px solid var(--border2);
    background:rgba(0,0,0,0.22); flex-shrink:0;
}
.m-body { padding:26px 28px; }
.m-foot {
    padding:16px 28px; border-top:1px solid var(--border2);
    background:rgba(0,0,0,0.18); display:flex; align-items:center;
    justify-content:flex-end; gap:10px; flex-shrink:0;
}

/* Close button */
.m-x {
    width:32px; height:32px; border-radius:10px; flex-shrink:0;
    background:rgba(255,255,255,0.05); border:1px solid var(--border);
    color:var(--muted); cursor:pointer; display:flex;
    align-items:center; justify-content:center; font-size:13px;
    transition: background 0.2s, color 0.2s;
}
.m-x:hover { background:rgba(239,68,68,0.1); color:#ff8080; }

/* Info strip in view modal */
.vm-info {
    display:flex; flex-wrap:wrap; gap:10px;
    padding:12px 28px; background:rgba(0,0,0,0.1);
    border-bottom:1px solid var(--border2); flex-shrink:0;
}

/* Reply textarea */
.r-ta {
    width:100%; resize:vertical; min-height:130px;
    padding:14px 16px; border-radius:14px;
    background:rgba(0,0,0,0.4); border:1px solid rgba(255,255,255,0.07);
    color:var(--text); font-size:13px; font-family:var(--font-d); line-height:1.75;
    outline:none; transition: border-color 0.3s, box-shadow 0.3s;
}
.r-ta:focus {
    border-color:rgba(34,197,94,0.35);
    box-shadow:0 0 0 3px rgba(34,197,94,0.07);
}

/* Delete ring pulse */
@keyframes dRing { 0%{transform:scale(1);opacity:0.6} 100%{transform:scale(1.7);opacity:0} }
.d-ring { animation: dRing 1.8s ease-out infinite; }

/* ════════════════════════════════
   RESPONSIVE
   ════════════════════════════════ */
@media(max-width:768px){
    .stream-container { padding:16px 14px 48px; }
    .hdr-section { gap:20px; }
    .m-hdr, .m-body, .m-foot { padding-left:18px; padding-right:18px; }
    .panel-hdr { flex-direction:column; align-items:flex-start; }
    .hdr-btns { flex-wrap:wrap; }
}
@media(max-width:480px){
    .kpi-card { padding:18px; }
    .kpi-num  { font-size:1.9rem; }
    .fpill    { padding:9px 13px; font-size:9px; }
    .coord-badge { font-size:8px; padding:6px 10px; }
}
</style>

@php
    $total   = \App\Models\Contact::count();
    $today   = \App\Models\Contact::whereDate('created_at', today())->count();
    $week    = \App\Models\Contact::where('created_at','>=',now()->subDays(7))->count();
    $replied = \App\Models\Contact::whereNotNull('replied_at')->count();
    $sparkData = [];
    for($d=6;$d>=0;$d--){ $sparkData[] = \App\Models\Contact::whereDate('created_at',now()->subDays($d))->count(); }
    $sparkMax = max($sparkData) ?: 1;
@endphp

{{-- ═══ CINEMATIC BG ═══ --}}
<div class="cinematic-bg">
    <div class="grid-overlay"></div>
    <div class="radar-system">
        <div class="r-ring"></div><div class="r-ring"></div>
        <div class="r-ring"></div><div class="r-ring"></div>
    </div>
    <div class="radar-sweep"></div>
    {{-- Blips --}}
    <div class="blip"      style="top:20%;right:16%;animation-delay:0s;"></div>
    <div class="blip"      style="top:13%;right:36%;animation-delay:1.4s;"></div>
    <div class="blip"      style="top:38%;right:10%;animation-delay:2.8s;"></div>
    <div class="blip cyan" style="top:48%;right:44%;animation-delay:1.0s;"></div>
    <div class="blip blue" style="top:25%;right:52%;animation-delay:3.2s;"></div>
    <div class="blip"      style="top:9%;right:24%;animation-delay:0.5s;"></div>
    {{-- Data streams --}}
    <div class="dstream" style="left:68%;height:130px;animation-delay:0s;animation-duration:7s;"></div>
    <div class="dstream" style="left:76%;height:100px;animation-delay:2.5s;animation-duration:9s;opacity:0.6;background:linear-gradient(to bottom,transparent,rgba(6,182,212,0.1),transparent);"></div>
    <div class="dstream" style="left:59%;height:160px;animation-delay:5s;animation-duration:8s;"></div>
</div>
<div class="scanlines"></div>

<div class="stream-container">

    {{-- ─── ALERTS ─── --}}
    @if(session('success'))
    <div class="alert alert-ok">
        <div class="alert-icon" style="background:rgba(34,197,94,0.12);">
            <i class="fa-solid fa-circle-check" style="color:var(--green);font-size:13px;"></i>
        </div>{{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-err">
        <div class="alert-icon" style="background:rgba(239,68,68,0.12);">
            <i class="fa-solid fa-circle-exclamation" style="color:var(--red);font-size:13px;"></i>
        </div>{{ session('error') }}
    </div>
    @endif

    {{-- ─── HEADER ─── --}}
    <div class="hdr-section">
        <div id="hdrLeft">
            <div class="live-indicator">
                <div class="live-dot"></div> Intelligence Stream
            </div>
            <h1 class="hdr-title">
                CONTACT <span class="accent" data-t="LOGS">LOGS</span>
            </h1>
            <p class="hdr-sub">Real-time monitoring of client transmissions and inquiries across the RENTALX network.</p>
            <div class="coord-badge">
                <i class="fa-solid fa-location-dot" style="color:var(--red);font-size:9px;"></i>
                <span class="coord-live">▶</span>
                <span class="coord-val">24.8607° N</span>
                <span class="coord-sep">|</span>
                <span class="coord-val">67.0011° E</span>
                <span class="coord-sep">|</span>
                <span>CMD_CTR</span>
                <span class="coord-sep">›</span>
                <span style="color:rgba(168,85,247,0.75);">CONTACTS</span>
                <span class="coord-sep">|</span>
                <span style="color:rgba(34,197,94,0.7);">LOCK_ON</span>
            </div>
        </div>

        <div id="hdrRight" style="text-align:right;">
            <div class="hdr-meta">
                <span id="liveTime" style="color:var(--red);font-weight:700;">--:--:--</span>
                <span style="color:var(--border2)">|</span>
                SECURE_LINE: <span style="color:var(--green);">ENCRYPTED</span>
                &nbsp;·&nbsp;
                SESSION: <span style="color:var(--cyan);">ACTIVE</span>
            </div>
            <div class="hdr-btns">
                <button onclick="exportCSV()" class="btn-p">
                    <i class="fa-solid fa-download"></i> Export CSV
                </button>
                <a href="{{ route('admin.contacts.index') }}" class="btn-g" style="padding:11px 14px;">
                    <i class="fa-solid fa-rotate" style="font-size:11px;"></i>
                </a>
            </div>
            <div style="font-family:var(--font-m);font-size:9px;color:var(--muted);margin-top:10px;opacity:0.55;letter-spacing:0.12em;">
                ADMIN › CONTACTS › INDEX
            </div>
        </div>
    </div>

    {{-- ─── KPI CARDS ─── --}}
    <div class="kpi-grid">

        <div class="kpi-card" style="--card-glow:rgba(239,68,68,0.1);--card-active:rgba(239,68,68,0.3);">
            <div class="kpi-icon ki-r"><i class="fa-solid fa-inbox"></i></div>
            <div style="display:flex;align-items:flex-end;justify-content:space-between;">
                <div>
                    <div class="kpi-num" id="kn-0">{{ $total }}</div>
                    <div class="kpi-label">Total Inbound</div>
                </div>
                <div class="spark" style="color:var(--red);padding-bottom:8px;">
                    @foreach($sparkData as $v)
                    <span style="height:{{ round(($v/$sparkMax)*100) }}%;transition-delay:{{ $loop->index * 0.08 }}s;"></span>
                    @endforeach
                </div>
            </div>
            <div class="kpi-bar"><div class="kpi-bar-fill" style="width:100%;background:linear-gradient(90deg,var(--red),var(--red2));"></div></div>
        </div>

        <div class="kpi-card" style="--card-glow:rgba(168,85,247,0.1);--card-active:rgba(168,85,247,0.3);">
            <div class="kpi-icon ki-v"><i class="fa-solid fa-bolt"></i></div>
            <div class="kpi-num" id="kn-1">{{ $today }}</div>
            <div class="kpi-label">Received Today</div>
            <div class="kpi-mono">{{ now()->format('d M Y') }}</div>
            <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $total > 0 ? max(3,round(($today/$total)*100)) : 3 }}%;background:linear-gradient(90deg,#7c3aed,var(--purple));"></div></div>
        </div>

        <div class="kpi-card" style="--card-glow:rgba(99,102,241,0.1);--card-active:rgba(99,102,241,0.3);">
            <div class="kpi-icon ki-c"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div class="kpi-num" id="kn-2">{{ $week }}</div>
            <div class="kpi-label">Last 7 Days</div>
            <div class="kpi-mono">{{ now()->subDays(7)->format('d M') }} – {{ now()->format('d M') }}</div>
            <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $total > 0 ? max(3,round(($week/$total)*100)) : 3 }}%;background:linear-gradient(90deg,#4f46e5,var(--blue));"></div></div>
        </div>

        <div class="kpi-card" style="--card-glow:rgba(245,158,11,0.1);--card-active:rgba(245,158,11,0.3);">
            <div class="kpi-icon ki-a"><i class="fa-solid fa-check-double"></i></div>
            <div class="kpi-num" id="kn-3">{{ $replied }}</div>
            <div class="kpi-label">Processed Replies</div>
            <div class="kpi-mono">SUCCESS: {{ $total > 0 ? round(($replied/$total)*100) : 100 }}%</div>
            <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $total > 0 ? max(3,round(($replied/$total)*100)) : 3 }}%;background:linear-gradient(90deg,#b45309,var(--amber));"></div></div>
        </div>
    </div>

    {{-- ─── CONTROLS ─── --}}
    <div class="ctrl-bar" id="ctrlBar">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="search-box">
            <i class="fa-solid fa-magnifying-glass s-icon"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search name, email, subject, payload…">
            <button type="submit" class="s-btn">Scan</button>
        </form>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('admin.contacts.index', ['status'=>'pending','search'=>request('search')]) }}"
               class="fpill {{ request('status')=='pending' ? 'fp-amber' : '' }}">
                <i class="fa-solid fa-clock" style="font-size:8px;"></i> Pending
            </a>
            <a href="{{ route('admin.contacts.index', ['status'=>'replied','search'=>request('search')]) }}"
               class="fpill {{ request('status')=='replied' ? 'fp-green' : '' }}">
                <i class="fa-solid fa-check-double" style="font-size:8px;"></i> Replied
            </a>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.contacts.index') }}" class="fpill fp-reset">
                <i class="fa-solid fa-xmark" style="font-size:8px;"></i> Clear
            </a>
            @endif
        </div>
    </div>

    {{-- ─── DATA PANEL ─── --}}
    <div class="data-panel" id="mainPanel">
        <div class="panel-strip"></div>

        <div class="panel-hdr">
            <div class="panel-title">
                <div class="ptl-bar"></div>
                <div class="ptl-text">
                    <h3>Transmission Logs</h3>
                    <div class="ptl-sub">
                        <div class="ptl-dot"></div>
                        {{ $contacts->total() }} signals · Page {{ $contacts->currentPage() }}/{{ $contacts->lastPage() }}
                    </div>
                </div>
            </div>
            <div class="panel-chips">
                <div class="pchip">
                    <i class="fa-solid fa-filter" style="margin-right:5px;opacity:0.4;font-size:8px;"></i>
                    {{ request('search') ? 'Filtered' : 'All Contacts' }}
                </div>
                @if($contacts->firstItem())
                <div class="pchip">{{ $contacts->firstItem() }}–{{ $contacts->lastItem() }} / {{ $contacts->total() }}</div>
                @endif
            </div>
        </div>

        <div class="tbl-scroll">
            <table class="elite-table" id="contactsTable">
                <thead>
                    <tr>
                        <th style="width:85px;">ID_TAG</th>
                        <th>SENDER_INTEL</th>
                        <th>SUBJECT_INTENT</th>
                        <th>RENTAL_WINDOW</th>
                        <th style="min-width:200px;">PAYLOAD_PREVIEW</th>
                        <th>TIMESTAMP</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    @php
                        $avBg = [
                            'linear-gradient(135deg,#ef4444,#7f1d1d)',
                            'linear-gradient(135deg,#a855f7,#4c1d95)',
                            'linear-gradient(135deg,#6366f1,#1e1b4b)',
                            'linear-gradient(135deg,#f59e0b,#78350f)',
                            'linear-gradient(135deg,#22c55e,#052e16)',
                            'linear-gradient(135deg,#3b82f6,#1e3a8a)',
                            'linear-gradient(135deg,#ec4899,#831843)',
                            'linear-gradient(135deg,#06b6d4,#164e63)',
                        ];
                        $ci = $contact->id % 8;
                    @endphp
                    <tr class="t-row">

                        <td><span class="id-tag">#{{ sprintf('%04d',$contact->id) }}</span></td>

                        <td>
                            <div style="display:flex;align-items:center;gap:13px;">
                                <div class="av-wrap flex-shrink-0">
                                    <div class="av-ring"></div>
                                    <div class="avatar" style="background:{{ $avBg[$ci] }};">
                                        {{ strtoupper(substr($contact->name,0,1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="s-name">{{ $contact->name }}</div>
                                    <a href="mailto:{{ $contact->email }}" class="s-email">
                                        <i class="fa-solid fa-at" style="font-size:9px;"></i>{{ $contact->email }}
                                    </a>
                                    @if($contact->phone)
                                    <div class="s-phone">
                                        <i class="fa-solid fa-phone" style="font-size:8px;"></i>{{ $contact->phone }}
                                    </div>
                                    @endif
                                    @if($contact->replied_at)
                                    <span class="s-pill sp-repl"><i class="fa-solid fa-check-double" style="font-size:8px;"></i> Resolved</span>
                                    @else
                                    <span class="s-pill sp-pend"><i class="fa-solid fa-clock" style="font-size:8px;"></i> Pending</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            <div style="display:flex;flex-direction:column;gap:5px;">
                                @if($contact->subject)
                                <span class="i-tag it-subj">
                                    <i class="fa-solid fa-tag" style="font-size:8px;flex-shrink:0;"></i>
                                    {{ Str::limit($contact->subject,24) }}
                                </span>
                                @else
                                <span style="font-size:10px;color:var(--muted);font-style:italic;">No subject</span>
                                @endif
                                @if($contact->preferred_vehicle)
                                <span class="i-tag it-veh">
                                    <i class="fa-solid fa-car" style="font-size:8px;flex-shrink:0;"></i>
                                    {{ Str::limit($contact->preferred_vehicle,22) }}
                                </span>
                                @endif
                            </div>
                        </td>

                        <td>
                            @if($contact->start_date && $contact->end_date)
                            @php $days = \Carbon\Carbon::parse($contact->start_date)->diffInDays(\Carbon\Carbon::parse($contact->end_date)); @endphp
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:var(--text);font-weight:600;">
                                    <span class="pin pin-g"></span>{{ \Carbon\Carbon::parse($contact->start_date)->format('d.m.y') }}
                                </div>
                                <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:var(--text);font-weight:600;">
                                    <span class="pin pin-r"></span>{{ \Carbon\Carbon::parse($contact->end_date)->format('d.m.y') }}
                                </div>
                                <span class="i-tag" style="background:rgba(6,182,212,0.07);border:1px solid rgba(6,182,212,0.18);color:#67e8f9;margin-top:2px;width:fit-content;">
                                    <i class="fa-solid fa-clock" style="font-size:8px;"></i> {{ $days }}d
                                </span>
                            </div>
                            @else
                            <span style="font-size:10px;color:var(--muted);font-style:italic;">N/A</span>
                            @endif
                        </td>

                        <td>
                            <div class="msg-prev">"{{ Str::limit($contact->message,75) }}"</div>
                        </td>

                        <td>
                            <div class="ts-d">{{ $contact->created_at->format('M d, Y') }}</div>
                            <div class="ts-t">{{ $contact->created_at->format('H:i') }} UTC</div>
                            <div class="ts-r">{{ $contact->created_at->diffForHumans() }}</div>
                        </td>

                        <td>
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:7px;">
                                <button class="ab ab-v tt" data-t="View"
                                    onclick="openView({{ $contact->id }},'{{ addslashes($contact->name) }}','{{ addslashes($contact->email) }}','{{ addslashes($contact->phone ?? '') }}','{{ addslashes($contact->subject ?? '') }}','{{ addslashes($contact->preferred_vehicle ?? '') }}','{{ addslashes(str_replace(["\r\n","\n","\r"],["\\n","\\n","\\n"],$contact->message)) }}','{{ $contact->created_at->format('d M Y · H:i') }} UTC','{{ $ci }}','{{ addslashes(str_replace(["\r\n","\n","\r"],["\\n","\\n","\\n"],$contact->admin_reply ?? '')) }}','{{ $contact->replied_at ? \Carbon\Carbon::parse($contact->replied_at)->format('d M Y · H:i').' UTC' : '' }}')">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="ab ab-m tt" data-t="Reply"
                                    onclick="openReply({{ $contact->id }},'{{ addslashes($contact->name) }}','{{ addslashes($contact->email) }}','{{ addslashes($contact->subject ?? '') }}','{{ addslashes(str_replace(["\r\n","\n","\r"],["\\n","\\n","\\n"],$contact->message)) }}')">
                                    <i class="fa-solid fa-reply"></i>
                                </button>
                                <button class="ab ab-d tt" data-t="Erase"
                                    onclick="openDel({{ $contact->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <form id="df-{{ $contact->id }}" action="{{ route('admin.contacts.delete',$contact->id) }}" method="POST" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-wrap">
                                <div class="empty-circle">
                                    <div class="empty-icon">
                                        <i class="fa-regular fa-envelope-open" style="font-size:36px;color:rgba(92,102,128,0.4);"></i>
                                    </div>
                                    <div class="ec-1"></div><div class="ec-2"></div><div class="ec-3"></div>
                                </div>
                                <h3 style="font-size:20px;font-weight:900;font-style:italic;color:white;letter-spacing:0.04em;margin:0 0 10px;">NO_TRANSMISSIONS_DETECTED</h3>
                                <p style="color:var(--muted);font-size:13px;max-width:320px;margin:0 auto;line-height:1.75;">
                                    @if(request('search')) Signal not found. Try a different search vector. @else Awaiting inbound transmissions from RENTALX network. @endif
                                </p>
                                @if(request('search'))
                                <a href="{{ route('admin.contacts.index') }}" class="btn-p" style="margin-top:22px;">
                                    <i class="fa-solid fa-xmark"></i> Clear Filter
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
        <div class="pag-wrap">{{ $contacts->links('pagination::tailwind') }}</div>
        @endif
    </div>

</div><!-- end stream-container -->

{{-- ═══════════════ VIEW MODAL ═══════════════ --}}
<div id="viewModal" class="modal-overlay" onclick="if(event.target===this)closeView()">
    <div class="modal-box" style="max-width:640px;">
        <div class="m-strip"></div>
        <div class="m-hdr">
            <div style="display:flex;align-items:center;gap:14px;min-width:0;flex:1;">
                <div id="vm-av" class="avatar" style="width:46px;height:46px;font-size:17px;flex-shrink:0;border-radius:14px;"></div>
                <div style="min-width:0;">
                    <h3 id="vm-name" style="font-size:16px;font-weight:900;font-style:italic;color:white;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></h3>
                    <div id="vm-time" style="font-family:var(--font-m);font-size:9px;color:var(--muted);margin-top:2px;letter-spacing:0.1em;"></div>
                </div>
            </div>
            <button onclick="closeView()" class="m-x"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="vm-info">
            <a id="vm-email" href="#" style="display:flex;align-items:center;gap:5px;font-size:11px;color:var(--muted);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--muted)'">
                <i class="fa-solid fa-at" style="font-size:9px;"></i><span></span>
            </a>
            <div id="vm-phone" style="display:none;align-items:center;gap:5px;font-size:11px;color:var(--muted);">
                <i class="fa-solid fa-phone" style="font-size:9px;"></i><span class="vmp"></span>
            </div>
            <div id="vm-subj" style="display:none;">
                <span class="i-tag it-subj"><i class="fa-solid fa-tag" style="font-size:8px;"></i><span class="vms"></span></span>
            </div>
            <div id="vm-veh" style="display:none;">
                <span class="i-tag it-veh"><i class="fa-solid fa-car" style="font-size:8px;"></i><span class="vmv"></span></span>
            </div>
        </div>
        <div class="m-body" style="overflow-y:auto;max-height:360px;scrollbar-width:thin;scrollbar-color:rgba(239,68,68,0.2) rgba(0,0,0,0.2);">
            <div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:0.22em;margin-bottom:12px;font-family:var(--font-d);">Transmission Payload</div>
            <p id="vm-msg" style="font-size:14px;line-height:1.9;color:var(--text);white-space:pre-wrap;margin:0;"></p>
            <div id="vm-reply-box" style="display:none;margin-top:22px;padding:18px;background:rgba(34,197,94,0.04);border:1px solid rgba(34,197,94,0.14);border-radius:16px;">
                <div style="font-size:9px;font-weight:900;color:var(--green);text-transform:uppercase;letter-spacing:0.2em;margin-bottom:10px;display:flex;align-items:center;gap:6px;font-family:var(--font-d);">
                    <i class="fa-solid fa-check-double"></i> Admin Response Dispatched
                </div>
                <p id="vm-reply-text" style="font-size:13px;color:rgba(200,240,220,0.8);line-height:1.8;white-space:pre-wrap;margin:0;"></p>
                <div id="vm-reply-time" style="font-family:var(--font-m);font-size:9px;color:rgba(34,197,94,0.4);margin-top:10px;letter-spacing:0.1em;"></div>
            </div>
        </div>
        <div class="m-foot">
            <button id="vm-reply-btn" class="btn-g" style="background:rgba(34,197,94,0.07);border-color:rgba(34,197,94,0.2);color:var(--green);font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.12em;font-family:var(--font-d);">
                <i class="fa-solid fa-reply"></i> <span id="vm-lbl">Reply Stream</span>
            </button>
            <button onclick="closeView()" class="btn-g" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;">Close</button>
        </div>
    </div>
</div>

{{-- ═══════════════ DELETE MODAL ═══════════════ --}}
<div id="delModal" class="modal-overlay" onclick="if(event.target===this)closeDel()">
    <div class="modal-box" style="max-width:400px;">
        <div class="m-strip m-strip-r"></div>
        <div style="padding:42px 34px 34px;display:flex;flex-direction:column;align-items:center;text-align:center;">
            <div style="position:relative;margin-bottom:26px;">
                <div class="d-ring" style="position:absolute;inset:-7px;border-radius:50%;border:2px solid rgba(239,68,68,0.25);"></div>
                <div style="width:86px;height:86px;border-radius:50%;background:linear-gradient(135deg,rgba(239,68,68,0.12),rgba(80,0,0,0.28));border:1px solid rgba(239,68,68,0.22);display:flex;align-items:center;justify-content:center;box-shadow:0 0 50px rgba(239,68,68,0.12);">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size:34px;color:var(--red);"></i>
                </div>
            </div>
            <h3 style="font-size:25px;font-weight:900;font-style:italic;color:white;margin:0 0 10px;letter-spacing:-0.02em;">ERASE_LOG?</h3>
            <p style="color:var(--muted);font-size:13px;line-height:1.75;max-width:265px;margin:0 0 28px;">
                This record will be <strong style="color:#f87171;">permanently purged</strong> from the command center. <strong style="color:white;">Cannot be recovered.</strong>
            </p>
            <div style="display:flex;gap:10px;width:100%;">
                <button onclick="closeDel()" class="btn-g" style="flex:1;justify-content:center;padding:13px;border-radius:14px;">Cancel</button>
                <button id="doDelete" class="btn-p" style="flex:1;justify-content:center;padding:13px;border-radius:14px;">
                    <i class="fa-solid fa-trash"></i> Purge
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ REPLY MODAL ═══════════════ --}}
<div id="replyModal" class="modal-overlay" onclick="if(event.target===this)closeReply()">
    <div class="modal-box" style="max-width:580px;">
        <div class="m-strip m-strip-g"></div>
        <form id="replyForm" method="POST">
            @csrf
            <div class="m-hdr">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;border-radius:12px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);display:flex;align-items:center;justify-content:center;">
                        <i class="fa-solid fa-reply" style="color:var(--green);font-size:14px;"></i>
                    </div>
                    <div>
                        <h3 style="font-size:15px;font-weight:900;font-style:italic;color:white;margin:0;">DISPATCH_REPLY</h3>
                        <p id="rm-target" style="font-size:10px;color:var(--muted);margin:2px 0 0;font-weight:600;"></p>
                    </div>
                </div>
                <button type="button" onclick="closeReply()" class="m-x"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="m-body">
                <div style="margin-bottom:18px;">
                    <div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:0.2em;font-family:var(--font-d);margin-bottom:8px;">Original Payload</div>
                    <div id="rm-orig" style="background:rgba(0,0,0,0.3);border:1px solid var(--border);border-radius:12px;padding:12px 14px;font-size:12px;color:var(--muted);font-style:italic;max-height:80px;overflow-y:auto;line-height:1.7;scrollbar-width:thin;"></div>
                </div>
                <div>
                    <div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:0.2em;font-family:var(--font-d);margin-bottom:8px;">Response Payload</div>
                    <textarea name="admin_reply" id="admin_reply" rows="6" required
                        placeholder="Enter reply transmission… will be sent as encrypted email."
                        class="r-ta"></textarea>
                    <p style="font-size:10px;color:rgba(92,102,128,0.45);font-style:italic;margin-top:6px;">Dispatched via HTML email & in-app notification system.</p>
                </div>
            </div>
            <div class="m-foot">
                <button type="button" onclick="closeReply()" class="btn-g" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;">Cancel</button>
                <button type="submit" class="btn-green-s">
                    <i class="fa-solid fa-paper-plane"></i> Send Dispatch
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
/* ═══════════════════════════════════
   LIVE CLOCK
   ═══════════════════════════════════ */
(function tick(){
    const n=new Date();
    const el=document.getElementById('liveTime');
    if(el) el.textContent=[n.getHours(),n.getMinutes(),n.getSeconds()].map(v=>String(v).padStart(2,'0')).join(':');
    setTimeout(tick,1000);
})();

/* ═══════════════════════════════════
   PAGE BOOT ANIMATION SEQUENCE
   ═══════════════════════════════════ */
window.addEventListener('DOMContentLoaded', () => {

    // 1. Header slides
    gsap.fromTo('#hdrLeft',  {opacity:0,x:-50},
      {opacity:1,x:0,duration:1,ease:'power3.out'});
    gsap.fromTo('#hdrRight', {opacity:0,x:50},
      {opacity:1,x:0,duration:1,delay:0.12,ease:'power3.out'});

    // 2. KPI cards — spring bounce with stagger
    gsap.fromTo('.kpi-card',
      {opacity:0,y:40,scale:0.9},
      {opacity:1,y:0,scale:1,
       duration:0.65,stagger:0.1,delay:0.3,
       ease:'back.out(1.8)',
       onComplete(){ document.querySelectorAll('.kpi-card').forEach(c=>c.classList.add('in')); }
      });

    // 3. Counter roll-up
    document.querySelectorAll('.kpi-num').forEach(el => {
        const target = parseInt(el.textContent) || 0;
        if(!target) return;
        const frames = 45;
        let f = 0;
        const id = setInterval(() => {
            f++;
            el.textContent = Math.round(target * (f/frames));
            if(f >= frames){ el.textContent = target; clearInterval(id); }
        }, 22);
    });

    // 4. Spark bars animate
    gsap.fromTo('.spark span',
      {scaleY:0},
      {scaleY:1,duration:0.55,stagger:0.06,delay:0.55,ease:'back.out(1.5)',
       transformOrigin:'bottom center'});

    // 5. Controls bar
    gsap.fromTo('#ctrlBar',
      {opacity:0,y:18},
      {opacity:1,y:0,duration:0.6,delay:0.65,ease:'power2.out'});

    // 6. Data panel
    gsap.fromTo('#mainPanel',
      {opacity:0,y:50},
      {opacity:1,y:0,duration:0.85,delay:0.75,ease:'power3.out'});

    // 7. Table rows stagger
    gsap.fromTo('.t-row',
      {opacity:0,x:-20},
      {opacity:1,x:0,duration:0.45,stagger:0.055,delay:1.05,ease:'power2.out'});

    // 8. Panel strip pulse after load
    setTimeout(() => {
        document.querySelector('.panel-strip')?.style.setProperty('animation-duration','2.5s');
    }, 2000);
});

/* ═══════════════════════════════════
   VIEW MODAL
   ═══════════════════════════════════ */
const avBgList = [
    'linear-gradient(135deg,#ef4444,#7f1d1d)',
    'linear-gradient(135deg,#a855f7,#4c1d95)',
    'linear-gradient(135deg,#6366f1,#1e1b4b)',
    'linear-gradient(135deg,#f59e0b,#78350f)',
    'linear-gradient(135deg,#22c55e,#052e16)',
    'linear-gradient(135deg,#3b82f6,#1e3a8a)',
    'linear-gradient(135deg,#ec4899,#831843)',
    'linear-gradient(135deg,#06b6d4,#164e63)',
];

function openView(id,name,email,phone,subj,veh,msg,time,ci,reply,replyTime){
    const $=k=>document.getElementById('vm-'+k);
    const av=$('av');
    av.style.background=avBgList[ci%8];
    av.textContent=name.charAt(0).toUpperCase();
    $('name').textContent=name;
    $('time').textContent='REC_STAMP: '+time;
    const ea=$('email');
    ea.href='mailto:'+email;
    ea.querySelector('span').textContent=email;
    const ph=$('phone');
    if(phone){ph.style.display='flex';ph.querySelector('.vmp').textContent=phone;}
    else ph.style.display='none';
    const sj=$('subj');
    if(subj){sj.style.display='block';sj.querySelector('.vms').textContent=subj;}
    else sj.style.display='none';
    const vh=$('veh');
    if(veh){vh.style.display='block';vh.querySelector('.vmv').textContent=veh;}
    else vh.style.display='none';
    $('msg').textContent=msg.replace(/\\n/g,'\n');
    const rb=document.getElementById('vm-reply-box');
    if(reply){
        rb.style.display='block';
        document.getElementById('vm-reply-text').textContent=reply.replace(/\\n/g,'\n');
        document.getElementById('vm-reply-time').textContent='DISPATCHED_AT: '+replyTime;
        document.getElementById('vm-lbl').textContent='Resend Reply';
    } else {
        rb.style.display='none';
        document.getElementById('vm-lbl').textContent='Reply Stream';
    }
    document.getElementById('vm-reply-btn').onclick=()=>{ closeView(); openReply(id,name,email,subj,msg); };
    document.getElementById('viewModal').classList.add('open');
    document.body.style.overflow='hidden';
}
function closeView(){ document.getElementById('viewModal').classList.remove('open'); document.body.style.overflow=''; }

/* ═══════════════════════════════════
   DELETE MODAL
   ═══════════════════════════════════ */
let _did=null;
function openDel(id){ _did=id; document.getElementById('delModal').classList.add('open'); document.body.style.overflow='hidden'; }
function closeDel(){ _did=null; document.getElementById('delModal').classList.remove('open'); document.body.style.overflow=''; }
document.getElementById('doDelete').onclick=()=>{ if(_did) document.getElementById('df-'+_did).submit(); };

/* ═══════════════════════════════════
   REPLY MODAL
   ═══════════════════════════════════ */
function openReply(id,name,email,subj,msg){
    document.getElementById('replyForm').action=`/admin/contacts/${id}/reply`;
    document.getElementById('rm-target').textContent=`RECIPIENT: ${name} <${email}>`;
    document.getElementById('rm-orig').textContent=`"${msg.replace(/\\n/g,'\n')}"`;
    document.getElementById('admin_reply').value='';
    document.getElementById('replyModal').classList.add('open');
    document.body.style.overflow='hidden';
}
function closeReply(){ document.getElementById('replyModal').classList.remove('open'); document.body.style.overflow=''; }

/* ESC key */
document.addEventListener('keydown',e=>{ if(e.key==='Escape'){ closeView(); closeDel(); closeReply(); } });

/* ═══════════════════════════════════
   CSV EXPORT
   ═══════════════════════════════════ */
function exportCSV(){
    const rows=document.querySelectorAll('#contactsTable tbody tr.t-row');
    if(!rows.length){ alert('No data.'); return; }
    let csv='ID,NAME,EMAIL,PHONE,SUBJECT,VEHICLE,DATE\n';
    rows.forEach(tr=>{
        const tds=tr.querySelectorAll('td');
        if(tds.length<7) return;
        const id=(tds[0].textContent||'').trim();
        const name=(tds[1].querySelector('.s-name')?.textContent||'').trim();
        const email=(tds[1].querySelector('.s-email')?.textContent||'').trim();
        const phone=(tds[1].querySelector('.s-phone')?.textContent||'').trim();
        const tags=tds[2].querySelectorAll('.i-tag');
        const subj=(tags[0]?.textContent||'').trim();
        const veh=(tags[1]?.textContent||'').trim();
        const date=(tds[5].querySelector('.ts-d')?.textContent||'').trim();
        csv+=`"${id}","${name}","${email}","${phone}","${subj}","${veh}","${date}"\n`;
    });
    const a=Object.assign(document.createElement('a'),{
        href:URL.createObjectURL(new Blob([csv],{type:'text/csv'})),
        download:`rentalx_logs_${new Date().toISOString().slice(0,10)}.csv`
    });
    document.body.appendChild(a); a.click(); document.body.removeChild(a);
}
</script>
@endsection