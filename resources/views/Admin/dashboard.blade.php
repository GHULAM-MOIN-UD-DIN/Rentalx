@extends('adminlayout.app')

@section('content')
<style>
/* ============================================================
   COMMAND CENTER — ADMIN DASHBOARD V5.0
   Ultra-Premium Real-Time Intelligence Hub
============================================================ */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,600;0,700;0,800;0,900;1,900&display=swap');

:root {
    --red:      #ef4444;
    --red-dark: #b91c1c;
    --amber:    #f59e0b;
    --green:    #22c55e;
    --blue:     #6366f1;
    --purple:   #a855f7;
    --bg:       #020408;
    --surface:  rgba(255,255,255,.025);
    --border:   rgba(255,255,255,.07);
    --muted:    #6b7280;
}

body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; color: #f1f5f9; position: relative; }

/* ── CINEMATIC BG EFFECTS ─── */
.cinematic-bg {
    position: fixed; inset: 0; pointer-events: none; z-index: 0;
    background: 
        radial-gradient(circle at 80% 20%, rgba(239,68,68,0.06) 0%, transparent 50%),
        radial-gradient(circle at 20% 80%, rgba(99,102,241,0.05) 0%, transparent 50%);
}
.grid-overlay {
    position: absolute; inset: 0;
    background-image: linear-gradient(var(--border) 1px, transparent 1px),
                      linear-gradient(90deg, var(--border) 1px, transparent 1px);
    background-size: 50px 50px;
    mask-image: radial-gradient(circle at 50% 50%, black 20%, transparent 85%);
    opacity: 0.15;
}

/* ── HEADER ─── */
.dash-header {
    display: flex; align-items: center; justify-content: space-between;
    padding-bottom: 32px; gap: 16px; flex-wrap: wrap;
}
@media (max-width: 640px) {
    .dash-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .dash-title { font-size: clamp(1.4rem,5vw,2rem); }
}
.dash-title {
    font-size: clamp(1.6rem, 4vw, 2.6rem);
    font-weight: 900; font-style: italic;
    background: linear-gradient(135deg, #fff 40%, #6b7280);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    line-height: 1;
}
.dash-title span { -webkit-text-fill-color: var(--red); }
.live-badge {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 16px; border-radius: 100px;
    background: rgba(34,197,94,.08); border: 1px solid rgba(34,197,94,.2);
    font-size: 10px; font-weight: 900; letter-spacing: .2em; text-transform: uppercase; color: var(--green);
}
.live-dot { width: 8px; height: 8px; background: var(--green); border-radius: 50%; box-shadow: 0 0 8px var(--green); animation: blink 1.2s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }

.dash-datetime {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 20px; border-radius: 16px;
    background: var(--surface); border: 1px solid var(--border);
    font-size: 12px; font-weight: 700; color: #9ca3af;
}
.dash-datetime i { color: var(--red); }

/* ── KPI GRID ─── */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media (max-width: 1200px) { .kpi-grid { grid-template-columns: repeat(2,1fr); gap: 14px; } }
@media (max-width: 500px)  { .kpi-grid { grid-template-columns: 1fr; gap: 12px; } }

.kpi-card {
    background: linear-gradient(160deg, rgba(255,255,255,.04) 0%, rgba(0,0,0,.3) 100%);
    border: 1px solid var(--border);
    border-radius: 28px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    transition: border-color .3s, box-shadow .3s, transform .3s;
}
.kpi-card::before {
    content: ''; position: absolute; inset: 0; opacity: 0;
    transition: opacity .4s;
}
.kpi-card:hover { transform: translateY(-4px); }
.kpi-card:hover::before { opacity: 1; }

/* Color variants */
.kpi-red   { }
.kpi-red::before   { background: radial-gradient(circle at 0% 0%, rgba(239,68,68,.12), transparent 65%); }
.kpi-red:hover     { border-color: rgba(239,68,68,.4); box-shadow: 0 20px 50px -15px rgba(239,68,68,.25); }
.kpi-indigo::before{ background: radial-gradient(circle at 0% 0%, rgba(99,102,241,.12), transparent 65%); }
.kpi-indigo:hover  { border-color: rgba(99,102,241,.4); box-shadow: 0 20px 50px -15px rgba(99,102,241,.25); }
.kpi-green::before { background: radial-gradient(circle at 0% 0%, rgba(34,197,94,.12), transparent 65%); }
.kpi-green:hover   { border-color: rgba(34,197,94,.4); box-shadow: 0 20px 50px -15px rgba(34,197,94,.25); }
.kpi-amber::before { background: radial-gradient(circle at 0% 0%, rgba(245,158,11,.12), transparent 65%); }
.kpi-amber:hover   { border-color: rgba(245,158,11,.4); box-shadow: 0 20px 50px -15px rgba(245,158,11,.25); }
.kpi-purple::before{ background: radial-gradient(circle at 0% 0%, rgba(168,85,247,.12), transparent 65%); }
.kpi-purple:hover  { border-color: rgba(168,85,247,.4); box-shadow: 0 20px 50px -15px rgba(168,85,247,.25); }

.kpi-icon {
    width: 52px; height: 52px;
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    margin-bottom: 18px;
    position: relative; z-index: 1;
    transition: transform .3s;
}
.kpi-card:hover .kpi-icon { transform: scale(1.1) rotate(6deg); }
.kpi-icon.red    { background: rgba(239,68,68,.12);    color: var(--red); }
.kpi-icon.indigo { background: rgba(99,102,241,.12);   color: var(--blue); }
.kpi-icon.green  { background: rgba(34,197,94,.12);    color: var(--green); }
.kpi-icon.amber  { background: rgba(245,158,11,.12);   color: var(--amber); }
.kpi-icon.purple { background: rgba(168,85,247,.12);   color: var(--purple); }

.kpi-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; position: relative; z-index: 1; }
.kpi-label { font-size: 9px; font-weight: 900; letter-spacing: .3em; text-transform: uppercase; color: var(--muted); }
.kpi-badge {
    font-size: 9px; font-weight: 900; padding: 3px 10px; border-radius: 100px;
    display: flex; align-items: center; gap: 4px;
}
.kpi-badge.up   { background: rgba(34,197,94,.1); color: var(--green); border: 1px solid rgba(34,197,94,.2); }
.kpi-badge.down { background: rgba(239,68,68,.1); color: var(--red);   border: 1px solid rgba(239,68,68,.2); }
.kpi-badge.neu  { background: rgba(99,102,241,.1); color: var(--blue);  border: 1px solid rgba(99,102,241,.2); }

.kpi-value {
    font-size: 2rem; font-weight: 900; font-style: italic; color: #fff;
    line-height: 1; position: relative; z-index: 1;
}
.kpi-sub { font-size: 10px; color: var(--muted); margin-top: 8px; position: relative; z-index: 1; }

.kpi-bar-bg { height: 3px; background: rgba(255,255,255,.06); border-radius: 10px; overflow: hidden; margin-top: 14px; position: relative; z-index: 1; }
.kpi-bar-fill { height: 100%; border-radius: 10px; position: relative; overflow: hidden; }
.kpi-bar-fill::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.25), transparent);
    animation: shimmer 2.5s infinite;
}
@keyframes shimmer { 0%{transform:translateX(-100%)} 100%{transform:translateX(100%)} }
.fill-red    { background: linear-gradient(90deg, var(--red),    #f87171); }
.fill-indigo { background: linear-gradient(90deg, var(--blue),   #818cf8); }
.fill-green  { background: linear-gradient(90deg, var(--green),  #4ade80); }
.fill-amber  { background: linear-gradient(90deg, var(--amber),  #fcd34d); }
.fill-purple { background: linear-gradient(90deg, var(--purple), #c084fc); }

/* ── ORDER STATUS ROW ─── */
.status-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-bottom: 24px; }
@media (max-width: 1024px) { .status-row { grid-template-columns: repeat(2,1fr); gap: 10px; } }
@media (max-width: 480px) { .status-row { grid-template-columns: 1fr; } }

.status-pill {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px; border-radius: 20px;
    background: var(--surface); border: 1px solid var(--border);
    transition: all .3s;
}
.status-pill:hover { transform: translateY(-2px); }
.status-pill-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.s-pending    .status-pill-dot { background: var(--amber); box-shadow: 0 0 10px var(--amber); animation: blink 1.5s infinite; }
.s-processing .status-pill-dot { background: var(--blue);  box-shadow: 0 0 10px var(--blue); }
.s-completed  .status-pill-dot { background: var(--green); box-shadow: 0 0 10px var(--green); }
.s-cancelled  .status-pill-dot { background: #6b7280; }
.status-pill:hover.s-pending    { border-color: rgba(245,158,11,.3); }
.status-pill:hover.s-processing { border-color: rgba(99,102,241,.3); }
.status-pill:hover.s-completed  { border-color: rgba(34,197,94,.3); }
.status-pill:hover.s-cancelled  { border-color: rgba(107,114,128,.3); }
.status-lbl { font-size: 9px; font-weight: 900; letter-spacing: .2em; text-transform: uppercase; color: var(--muted); }
.status-val { font-size: 22px; font-weight: 900; font-style: italic; color: #fff; line-height: 1; }

/* ── MAIN GRID ─── */
.main-grid {
    display: grid; grid-template-columns: 1fr 380px;
    gap: 20px; margin-bottom: 24px;
}
@media (max-width: 1440px) { .main-grid { grid-template-columns: 1fr; gap: 16px; } }

/* ── PANEL ─── */
.panel {
    background: linear-gradient(160deg, rgba(255,255,255,.03) 0%, rgba(0,0,0,.3) 100%);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 24px;
    transition: all 0.3s;
    width: 100%;
    overflow: hidden;
}
@media (max-width: 640px) { .panel { padding: 18px; border-radius: 20px; } }
.panel:hover { border-color: rgba(239,68,68,.15); }
.panel-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px; gap: 12px;
}
.panel-title {
    font-size: 13px; font-weight: 900; font-style: italic;
    text-transform: uppercase; letter-spacing: .05em;
    display: flex; align-items: center; gap: 10px;
    color: #fff;
}
.panel-title i { color: var(--red); font-size: 14px; }
.panel-link {
    font-size: 10px; font-weight: 900; letter-spacing: .2em; text-transform: uppercase;
    color: var(--muted); text-decoration: none; display: flex; align-items: center; gap: 6px;
    transition: color .3s;
}
.panel-link:hover { color: var(--red); }

/* ── REVENUE CHART ─── */
.chart-area {
    position: relative; height: 200px;
    display: flex; align-items: flex-end; gap: 8px;
    padding: 0 4px;
}
@media (max-width: 768px) {
    .chart-area { height: 150px; }
}
@media (max-width: 480px) {
    .chart-area { height: 120px; }
}.chart-bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px; }
.chart-bar-col { width: 100%; position: relative; display: flex; align-items: flex-end; }
.chart-bar {
    width: 100%; border-radius: 8px 8px 0 0;
    background: linear-gradient(180deg, var(--red) 0%, rgba(239,68,68,.3) 100%);
    transition: opacity .3s;
    min-height: 4px;
    position: relative;
    overflow: hidden;
}
.chart-bar::after { content:''; position:absolute; inset:0; background:linear-gradient(180deg,rgba(255,255,255,.25) 0%,transparent 60%); }
.chart-bar:hover { opacity: .8; }
.chart-label { font-size: 8px; font-weight: 900; color: var(--muted); text-transform: uppercase; }

/* ── RECENT ORDERS TABLE ─── */
.order-row {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 14px; border-radius: 16px;
    border: 1px solid transparent;
    transition: all .3s; margin-bottom: 6px;
}
@media (max-width: 768px) {
    .order-row {
        flex-direction: column; align-items: flex-start; gap: 8px;
        padding: 16px; background: rgba(255,255,255,.03);
        border-color: var(--border);
    }
    .order-id { width: 100%; border-bottom: 1px solid var(--border); padding-bottom: 4px; margin-bottom: 4px; }
    .order-amount { width: 100%; text-align: left; order: 3; margin-top: 4px; }
    .order-status-badge { width: auto; order: 4; margin-top: 8px; }
    .order-user { white-space: normal; order: 2; width: 100%; font-size: 13px; font-weight: 700; }
}
.order-row:hover { background: rgba(255,255,255,.03); border-color: var(--border); }
.order-id { font-size: 11px; font-weight: 900; color: #fff; flex-shrink: 0; width: 100px; }
.order-user { font-size: 11px; color: #9ca3af; flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.order-amount { font-size: 12px; font-weight: 900; color: #fff; flex-shrink: 0; width: 90px; text-align: right; }
.order-status-badge {
    flex-shrink: 0; width: 84px; text-align: center;
    font-size: 8px; font-weight: 900; letter-spacing: .15em; text-transform: uppercase;
    padding: 4px 0; border-radius: 100px;
}
.s-badge-pending    { background: rgba(245,158,11,.12); color: var(--amber); border: 1px solid rgba(245,158,11,.2); }
.s-badge-processing { background: rgba(99,102,241,.12); color: #818cf8;     border: 1px solid rgba(99,102,241,.2); }
.s-badge-completed  { background: rgba(34,197,94,.12);  color: var(--green); border: 1px solid rgba(34,197,94,.2); }
.s-badge-cancelled  { background: rgba(107,114,128,.1); color: #6b7280;     border: 1px solid rgba(107,114,128,.2); }

/* ── TOP PRODUCTS ─── */
.top-prod-row {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,.04);
}
.top-prod-row:last-child { border-bottom: none; }
.top-prod-rank { font-size: 10px; font-weight: 900; color: var(--muted); width: 20px; flex-shrink: 0; }
.top-prod-name { flex: 1; font-size: 12px; font-weight: 700; color: #e5e7eb; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.top-prod-cat  { font-size: 9px; color: var(--muted); margin-top: 2px; }
.top-prod-sold { flex-shrink: 0; font-size: 11px; font-weight: 900; color: var(--amber); }
.top-prod-bar-wrap { width: 70px; flex-shrink: 0; }
.top-prod-bar-bg   { height: 4px; background: rgba(255,255,255,.06); border-radius: 10px; overflow: hidden; }
.top-prod-bar-fill { height: 100%; background: linear-gradient(90deg, var(--red), var(--amber)); border-radius: 10px; }

/* ── LOW STOCK ─── */
.low-stock-row {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: 14px;
    background: rgba(245,158,11,.04); border: 1px solid rgba(245,158,11,.1);
    margin-bottom: 8px; transition: border-color .3s;
}
.low-stock-row:hover { border-color: rgba(245,158,11,.3); }
.stock-count {
    width: 36px; height: 36px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 900; color: var(--amber);
    background: rgba(245,158,11,.1);
}
.low-stock-name { flex: 1; font-size: 11px; font-weight: 700; color: #e5e7eb; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.low-stock-badge {
    font-size: 8px; font-weight: 900; padding: 3px 10px; border-radius: 100px;
    background: rgba(245,158,11,.1); color: var(--amber); border: 1px solid rgba(245,158,11,.2);
    white-space: nowrap;
}
.stock-critical { background: rgba(239,68,68,.08); border-color: rgba(239,68,68,.2); }
.stock-critical .stock-count { background: rgba(239,68,68,.1); color: var(--red); }
.stock-critical .low-stock-badge { background: rgba(239,68,68,.1); color: var(--red); border-color: rgba(239,68,68,.2); }

/* ── PENDING REVIEWS ─── */
.review-row {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 14px; border-radius: 16px; border: 1px solid rgba(255,255,255,.05);
    background: rgba(255,255,255,.02); margin-bottom: 8px; transition: border-color .3s;
}
.review-row:hover { border-color: rgba(239,68,68,.2); }
.rev-avatar {
    width: 36px; height: 36px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 900; color: #fff;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
}
.rev-product { font-size: 10px; color: var(--muted); margin-top: 2px; }
.rev-stars { display: flex; gap: 2px; color: var(--amber); font-size: 9px; }
.rev-actions { display: flex; gap: 6px; margin-top: 8px; }
.rev-btn {
    font-size: 8px; font-weight: 900; letter-spacing: .1em; text-transform: uppercase;
    padding: 4px 12px; border-radius: 100px; border: none; cursor: pointer; transition: all .3s;
    text-decoration: none; display: inline-block;
}
.rev-btn-approve { background: rgba(34,197,94,.1); color: var(--green); border: 1px solid rgba(34,197,94,.2); }
.rev-btn-approve:hover { background: var(--green); color: #fff; }
.rev-btn-reject  { background: rgba(239,68,68,.1); color: var(--red); border: 1px solid rgba(239,68,68,.2); }
.rev-btn-reject:hover  { background: var(--red); color: #fff; }

/* ── QUICK ACTIONS ─── */
.actions-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; }
@media (max-width: 900px) { .actions-grid { grid-template-columns: repeat(3,1fr); } }
@media (max-width: 650px) { .actions-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 480px) { .actions-grid { grid-template-columns: 1fr; gap: 12px; } }

.action-card {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 10px; padding: 22px 14px; border-radius: 22px; text-decoration: none;
    background: var(--surface); border: 1px solid var(--border);
    transition: all .3s; text-align: center;
}
.action-card:hover { border-color: rgba(239,68,68,.4); transform: translateY(-4px); box-shadow: 0 16px 40px -10px rgba(239,68,68,.2); }
.action-icon {
    width: 48px; height: 48px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;  transition: transform .3s;
}
.action-card:hover .action-icon { transform: scale(1.15) rotate(5deg); }
.action-card .a-label { font-size: 10px; font-weight: 900; letter-spacing: .1em; text-transform: uppercase; color: #9ca3af; }

/* ── SECTION BOTTOM GRID ─── */
.bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px; }
@media (max-width: 1024px) { .bottom-grid { grid-template-columns: 1fr; gap: 16px; } }
@media (max-width: 640px) { .bottom-grid { gap: 12px; } }

/* ── APPOINTMENT + CHAT PANELS ─── */
.appt-status-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 20px; }
@media (max-width: 480px) { .appt-status-row { grid-template-columns: 1fr; } }
.appt-stat-box {
    text-align: center; padding: 14px 10px; border-radius: 18px;
    background: rgba(255,255,255,.025); border: 1px solid rgba(255,255,255,.06);
    transition: all .3s;
}
.appt-stat-box:hover { transform: translateY(-2px); }
.appt-stat-box .asb-val { font-size: 26px; font-weight: 900; font-style: italic; line-height: 1; }
.appt-stat-box .asb-lbl { font-size: 8px; font-weight: 900; letter-spacing: .25em; text-transform: uppercase; color: var(--muted); margin-top: 4px; }

.appt-row {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: 16px; margin-bottom: 6px;
    background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.05);
    transition: all .3s;
}
.appt-row:hover { border-color: rgba(168,85,247,.3); background: rgba(168,85,247,.04); }
.appt-avatar {
    width: 36px; height: 36px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 900; color: #fff;
    background: linear-gradient(135deg, var(--purple), #7c3aed);
}
.appt-name  { font-size: 12px; font-weight: 800; color: #e5e7eb; }
.appt-car   { font-size: 10px; color: var(--muted); margin-top: 1px; }
.appt-date  { font-size: 9px; font-weight: 700; color: var(--muted); flex-shrink: 0; text-align: right; }
.appt-badge {
    flex-shrink: 0; font-size: 8px; font-weight: 900; letter-spacing: .12em;
    text-transform: uppercase; padding: 3px 10px; border-radius: 100px;
}
.appt-pending   { background: rgba(245,158,11,.1); color: var(--amber); border: 1px solid rgba(245,158,11,.2); }
.appt-confirmed { background: rgba(34,197,94,.1);  color: var(--green); border: 1px solid rgba(34,197,94,.2); }
.appt-cancelled { background: rgba(239,68,68,.1);  color: var(--red);   border: 1px solid rgba(239,68,68,.2); }
.appt-completed { background: rgba(99,102,241,.1); color: var(--blue);  border: 1px solid rgba(99,102,241,.2); }

/* Chat panel */
.chat-unread-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.2);
    color: var(--red); font-size: 9px; font-weight: 900;
    padding: 3px 10px; border-radius: 100px; letter-spacing: .1em;
    text-transform: uppercase;
}
.chat-row {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 14px; border-radius: 16px; margin-bottom: 6px;
    background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.05);
    transition: all .3s; text-decoration: none;
}
.chat-row:hover {
    border-color: rgba(99,102,241,.35);
    background: rgba(99,102,241,.06);
    transform: translateX(3px);
}
.chat-avatar {
    position: relative; width: 40px; height: 40px; border-radius: 14px;
    background: linear-gradient(135deg, var(--blue), #4f46e5);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 900; color: #fff; flex-shrink: 0;
}
.chat-online-dot {
    position: absolute; bottom: -2px; right: -2px;
    width: 10px; height: 10px; border-radius: 50%;
    background: var(--green); border: 2px solid var(--bg);
    box-shadow: 0 0 6px var(--green);
}
.chat-name    { font-size: 12px; font-weight: 900; color: #e5e7eb; }
.chat-preview { font-size: 10px; color: var(--muted); margin-top: 2px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 180px; }
.chat-unread-count {
    flex-shrink: 0; min-width: 22px; height: 22px; border-radius: 100px;
    background: var(--red); color: #fff;
    font-size: 9px; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 12px rgba(239,68,68,.5);
}
.chat-time { font-size: 9px; color: var(--muted); flex-shrink: 0; }

.chat-empty {
    text-align: center; padding: 40px 20px;
}
.chat-empty-icon { font-size: 40px; color: #1f2937; margin-bottom: 10px; }
.chat-empty-txt  { font-size: 11px; font-weight: 700; color: var(--muted); }
</style>

<div class="cinematic-bg"><div class="grid-overlay"></div></div>

<div class="space-y-7 relative z-10">

    {{-- ── HEADER ── --}}
    <div class="dash-header">
        <div>
            <div class="dash-title">COMMAND <span>CENTER</span></div>
            <p class="text-gray-500 text-sm mt-1 flex items-center gap-2">
                <span class="live-badge"><span class="live-dot"></span>LIVE</span>
                All systems operational · {{ date('l, d F Y') }}
            </p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <div class="dash-datetime">
                <i class="fa-solid fa-clock"></i>
                <span id="liveTime">--:--:--</span>
            </div>
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 bg-white/5 border border-white/10 px-4 py-2.5 rounded-2xl hover:border-red-500 hover:text-red-500 transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Site
            </a>
        </div>
    </div>

    {{-- ── KPI CARDS ── --}}
    <div class="kpi-grid">

        {{-- Revenue --}}
        <div class="kpi-card kpi-amber">
            <div class="kpi-icon amber"><i class="fa-solid fa-coins"></i></div>
            <div class="kpi-row">
                <span class="kpi-label">Total Revenue</span>
                @if($revenueGrowth >= 0)
                    <span class="kpi-badge up"><i class="fa-solid fa-arrow-trend-up"></i> +{{ $revenueGrowth }}%</span>
                @else
                    <span class="kpi-badge down"><i class="fa-solid fa-arrow-trend-down"></i> {{ $revenueGrowth }}%</span>
                @endif
            </div>
            <div class="kpi-value counter" data-target="{{ $totalRevenue }}">
                PKR {{ number_format($totalRevenue) }}
            </div>
            <div class="kpi-sub">
                This month: <strong class="text-white">PKR {{ number_format($thisMonthRevenue) }}</strong>
            </div>
            <div class="kpi-bar-bg"><div class="kpi-bar-fill fill-amber" style="width:75%"></div></div>
        </div>

        {{-- Orders --}}
        <div class="kpi-card kpi-green">
            <div class="kpi-icon green"><i class="fa-solid fa-bag-shopping"></i></div>
            <div class="kpi-row">
                <span class="kpi-label">Total Orders</span>
                <span class="kpi-badge up"><i class="fa-solid fa-arrow-up"></i> Active</span>
            </div>
            <div class="kpi-value counter" data-target="{{ $ordersCount }}">
                {{ number_format($ordersCount) }}
            </div>
            <div class="kpi-sub">
                Pending: <strong class="text-amber-400">{{ $pendingOrders }}</strong> &nbsp;·&nbsp;
                Done: <strong class="text-green-400">{{ $completedOrders }}</strong>
            </div>
            <div class="kpi-bar-bg">
                <div class="kpi-bar-fill fill-green"
                     style="width:{{ $ordersCount > 0 ? round(($completedOrders/$ordersCount)*100) : 0 }}%"></div>
            </div>
        </div>

        {{-- Users --}}
        <div class="kpi-card kpi-indigo">
            <div class="kpi-icon indigo"><i class="fa-solid fa-users"></i></div>
            <div class="kpi-row">
                <span class="kpi-label">Registered Users</span>
                <span class="kpi-badge neu"><i class="fa-solid fa-user-plus"></i> +{{ $newUsersThisMonth }}</span>
            </div>
            <div class="kpi-value">{{ number_format($usersCount) }}</div>
            <div class="kpi-sub">+{{ $newUsersThisMonth }} joined this month</div>
            <div class="kpi-bar-bg"><div class="kpi-bar-fill fill-indigo" style="width:60%"></div></div>
        </div>

        {{-- Products --}}
        <div class="kpi-card kpi-red">
            <div class="kpi-icon red"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div class="kpi-row">
                <span class="kpi-label">Catalog Items</span>
                @if($outOfStockCount > 0)
                    <span class="kpi-badge down"><i class="fa-solid fa-triangle-exclamation"></i> {{ $outOfStockCount }} OOS</span>
                @else
                    <span class="kpi-badge up"><i class="fa-solid fa-check"></i> All Stocked</span>
                @endif
            </div>
            <div class="kpi-value">{{ number_format($productsCount) }}</div>
            <div class="kpi-sub">
                Low stock: <strong class="text-amber-400">{{ $lowStockProducts->count() }}</strong> items
            </div>
            <div class="kpi-bar-bg"><div class="kpi-bar-fill fill-red" style="width:80%"></div></div>
        </div>
    </div>

    {{-- ── ORDER STATUS PILLS ── --}}
    <div class="status-row">
        <div class="status-pill s-pending">
            <div class="status-pill-dot"></div>
            <div>
                <div class="status-lbl">Pending</div>
                <div class="status-val">{{ $pendingOrders }}</div>
            </div>
        </div>
        <div class="status-pill s-processing">
            <div class="status-pill-dot"></div>
            <div>
                <div class="status-lbl">Processing</div>
                <div class="status-val">{{ $processingOrders }}</div>
            </div>
        </div>
        <div class="status-pill s-completed">
            <div class="status-pill-dot"></div>
            <div>
                <div class="status-lbl">Completed</div>
                <div class="status-val">{{ $completedOrders }}</div>
            </div>
        </div>
        <div class="status-pill s-cancelled">
            <div class="status-pill-dot"></div>
            <div>
                <div class="status-lbl">Cancelled</div>
                <div class="status-val">{{ $cancelledOrders }}</div>
            </div>
        </div>
    </div>

    {{-- ── MAIN GRID: Revenue Chart + Top Products ── --}}
    <div class="main-grid">

        {{-- Revenue Chart --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-chart-column"></i> Revenue (Last 6 Months)</div>
                <a href="{{ route('admin.orders.index') }}" class="panel-link">All Orders <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            @php
                $revValues = array_column($monthlyRevenue, 'amount');
                $maxRev = count($revValues) > 0 ? max(max($revValues), 1) : 1;
            @endphp

            <div class="chart-area">
                @foreach($monthlyRevenue as $mr)
                    @php $barH = max(4, round(($mr['amount'] / $maxRev) * 180)); @endphp
                    <div class="chart-bar-wrap">
                        <div class="chart-bar-col" style="height:180px;">
                            <div class="chart-bar" style="height:{{ $barH }}px;"
                                 title="PKR {{ number_format($mr['amount']) }}"></div>
                        </div>
                        <div class="chart-label">{{ $mr['label'] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Mini summary row --}}
            <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-white/5">
                <div class="text-center">
                    <div class="text-xl font-black text-white">PKR {{ number_format($thisMonthRevenue) }}</div>
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">This Month</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-black {{ $revenueGrowth >= 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ $revenueGrowth >= 0 ? '+' : '' }}{{ $revenueGrowth }}%
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">vs Last Month</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-black text-white">{{ $avgRating }}<span class="text-amber-400 ml-1">★</span></div>
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">Avg. Rating</div>
                </div>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-fire-flame-curved"></i> Top Products</div>
                <a href="{{ route('admin.products.index') }}" class="panel-link">View All <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            @php $maxSold = max($topProducts->max('sold_count') ?? 1, 1); @endphp

            @forelse($topProducts as $i => $prod)
                <div class="top-prod-row">
                    <div class="top-prod-rank">#{{ $i+1 }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="top-prod-name">{{ $prod->name }}</div>
                        <div class="top-prod-cat">{{ $prod->category }}</div>
                    </div>
                    <div class="top-prod-bar-wrap">
                        <div class="top-prod-bar-bg">
                            <div class="top-prod-bar-fill" style="width:{{ round(($prod->sold_count / $maxSold)*100) }}%"></div>
                        </div>
                    </div>
                    <div class="top-prod-sold">{{ $prod->sold_count }}</div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-600">
                    <i class="fa-solid fa-chart-simple text-3xl mb-3"></i>
                    <p class="text-sm">No sales data yet</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── BOTTOM GRID: Recent Orders + Low Stock ── --}}
    <div class="bottom-grid">

        {{-- Recent Orders --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-clock-rotate-left"></i> Recent Orders</div>
                <a href="{{ route('admin.orders.index') }}" class="panel-link">View All <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            {{-- Table header (hidden on small screens) --}}
            <div class="order-table-header hidden sm:flex items-center gap-6 px-3 mb-2">
                <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest w-[80px]">Order ID</span>
                <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest flex-1">Customer</span>
                <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest w-[80px] text-right">Amount</span>
                <span class="text-[9px] font-black text-gray-600 uppercase tracking-widest w-[80px] text-center">Status</span>
            </div>

            @forelse($recentOrders as $order)
                <div class="order-row">
                    <div class="order-id">#{{ $order->order_number ?? $order->id }}</div>
                    <div class="order-user">{{ $order->user->name ?? 'Guest' }}</div>
                    <div class="order-amount">PKR {{ number_format($order->total_amount) }}</div>
                    <div class="order-status-badge s-badge-{{ $order->status }}">{{ ucfirst($order->status) }}</div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-600">
                    <i class="fa-solid fa-inbox text-3xl mb-3 block"></i>
                    <p class="text-sm">No orders yet</p>
                </div>
            @endforelse
        </div>

        {{-- Low Stock Alert --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <i class="fa-solid fa-triangle-exclamation text-amber-500"></i> Stock Alerts
                </div>
                <div class="flex items-center gap-8">
                    <span class="text-[10px] font-black text-red-400">
                        {{ $outOfStockCount }} OUT OF STOCK
                    </span>
                    <a href="{{ route('admin.products.index') }}" class="panel-link">Manage <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            @forelse($lowStockProducts as $p)
                <div class="low-stock-row {{ $p->stock <= 3 ? 'stock-critical' : '' }}">
                    <div class="stock-count">{{ $p->stock }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="low-stock-name">{{ $p->name }}</div>
                        <div class="text-[9px] text-gray-600 mt-1">{{ $p->category }}</div>
                    </div>
                    <span class="low-stock-badge">{{ $p->stock <= 3 ? 'CRITICAL' : 'LOW STOCK' }}</span>
                </div>
            @empty
                <div class="text-center py-10 text-green-500/60">
                    <i class="fa-solid fa-circle-check text-3xl mb-3 block"></i>
                    <p class="text-sm font-bold">All products well-stocked!</p>
                </div>
            @endforelse

            @if($outOfStockCount > 0)
                <div class="mt-4 p-4 bg-red-500/08 border border-red-500/20 rounded-2xl flex items-center gap-3">
                    <i class="fa-solid fa-ban text-red-500"></i>
                    <span class="text-xs font-bold text-red-400">
                        <strong class="text-red-300">{{ $outOfStockCount }}</strong> product(s) completely out of stock
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- ── PENDING REVIEWS + EXTRA STATS ── --}}
    <div class="bottom-grid">

        {{-- Pending Reviews --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-star-half-stroke"></i> Pending Reviews</div>
                <div class="flex items-center gap-8">
                    @if($pendingReviewsCount > 0)
                        <span class="text-[10px] font-black text-amber-400">{{ $pendingReviewsCount }} PENDING</span>
                    @endif
                    <a href="{{ route('admin.reviews.index') }}" class="panel-link">Moderate <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            @forelse($recentReviews as $rev)
                <div class="review-row">
                    <div class="rev-avatar">{{ strtoupper(substr($rev->user->name ?? 'U', 0, 1)) }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs font-black text-white">{{ $rev->user->name ?? 'Anonymous' }}</span>
                            <div class="rev-stars">
                                @for($i=1;$i<=5;$i++)
                                    <i class="fa-{{ $i <= $rev->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="rev-product">{{ $rev->product->name ?? 'Product' }}</div>
                        <p class="text-[11px] text-gray-500 mt-1.5 line-clamp-1">{{ $rev->comment }}</p>
                        <div class="rev-actions">
                            <a href="{{ route('admin.reviews.index') }}" class="rev-btn rev-btn-approve">
                                <i class="fa-solid fa-check"></i> Approve
                            </a>
                            <a href="{{ route('admin.reviews.index') }}" class="rev-btn rev-btn-reject">
                                <i class="fa-solid fa-xmark"></i> Reject
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-green-500/60">
                    <i class="fa-solid fa-star text-3xl mb-3 block"></i>
                    <p class="text-sm font-bold">All reviews moderated!</p>
                </div>
            @endforelse
        </div>

        {{-- Platform Stats --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-gauge-high"></i> Platform Stats</div>
            </div>

            <div class="space-y-5">
                {{-- Review Score --}}
                <div class="flex items-center justify-between p-4 bg-white/03 rounded-2xl border border-white/05">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Avg Review Score</div>
                            <div class="text-lg font-black text-white">{{ $avgRating }} / 5.0</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-gray-300">{{ $approvedReviews }}</div>
                        <div class="text-[9px] text-gray-600">Approved</div>
                    </div>
                </div>

                {{-- Completion Rate --}}
                <div class="flex items-center justify-between p-4 bg-white/03 rounded-2xl border border-white/05">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-400">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Order Fulfillment</div>
                            <div class="text-lg font-black text-white">
                                {{ $ordersCount > 0 ? round(($completedOrders / $ordersCount) * 100) : 0 }}%
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-green-400">{{ $completedOrders }}</div>
                        <div class="text-[9px] text-gray-600">Completed</div>
                    </div>
                </div>

                {{-- Appointments if available --}}
                @if($appointmentsCount > 0)
                <div class="flex items-center justify-between p-4 bg-white/03 rounded-2xl border border-white/05">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Appointments</div>
                            <div class="text-lg font-black text-white">{{ $appointmentsCount }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-amber-400">{{ $pendingAppointments }}</div>
                        <div class="text-[9px] text-gray-600">Pending</div>
                    </div>
                </div>
                @endif

                {{-- Catalogue Health --}}
                <div class="flex items-center justify-between p-4 bg-white/03 rounded-2xl border border-white/05">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center text-red-400">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Catalogue Health</div>
                            <div class="text-lg font-black text-white">
                                {{ $productsCount > 0 ? round((($productsCount - $outOfStockCount) / $productsCount) * 100) : 100 }}%
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-red-400">{{ $outOfStockCount }}</div>
                        <div class="text-[9px] text-gray-600">OOS Items</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ── APPOINTMENTS + LIVE CHAT GRID ── --}}
    <div class="bottom-grid">

        {{-- Appointments Panel --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-calendar-days text-purple-400"></i> Appointments</div>
                <a href="{{ route('admin.appointments.index') }}" class="panel-link">Manage <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            {{-- Status Summary --}}
            <div class="appt-status-row">
                <div class="appt-stat-box">
                    <div class="asb-val text-amber-400">{{ $pendingAppointments }}</div>
                    <div class="asb-lbl">Pending</div>
                </div>
                <div class="appt-stat-box">
                    <div class="asb-val text-green-400">{{ $confirmedAppointments }}</div>
                    <div class="asb-lbl">Confirmed</div>
                </div>
                <div class="appt-stat-box">
                    <div class="asb-val text-purple-400">{{ $todayAppointments }}</div>
                    <div class="asb-lbl">Today</div>
                </div>
            </div>

            {{-- Recent Appointments --}}
            @forelse($recentAppointments as $appt)
                <div class="appt-row">
                    <div class="appt-avatar">{{ strtoupper(substr($appt->first_name ?? '?', 0, 1)) }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="appt-name">{{ $appt->first_name }} {{ $appt->last_name }}</div>
                        <div class="appt-car">
                            <i class="fa-solid fa-car text-purple-500 mr-1"></i>
                            {{ $appt->car_name ?? 'Car Rental' }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="appt-date">{{ optional($appt->pickup_date)->format('d M') ?? '—' }}</div>
                        <div class="mt-1">
                            <span class="appt-badge appt-{{ $appt->status ?? 'pending' }}">
                                {{ ucfirst($appt->status ?? 'pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-600">
                    <i class="fa-solid fa-calendar-xmark text-3xl mb-3 block"></i>
                    <p class="text-sm">No appointments yet</p>
                </div>
            @endforelse
        </div>

        {{-- Live Chat Panel --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fa-solid fa-comments text-indigo-400"></i> Live Chat Inbox</div>
                <div class="flex items-center gap-10">
                    @if($totalUnreadMessages > 0)
                        <span class="chat-unread-badge">
                            <i class="fa-solid fa-envelope"></i> {{ $totalUnreadMessages }} Unread
                        </span>
                    @endif
                    <a href="{{ route('admin.chat.index') }}" class="panel-link">Open Chat <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            @if($liveChatUsers->isEmpty())
                <div class="chat-empty">
                    <div class="chat-empty-icon"><i class="fa-regular fa-comment-dots"></i></div>
                    <div class="chat-empty-txt">No unread messages right now</div>
                    <a href="{{ route('admin.chat.index') }}"
                       class="mt-5 inline-block text-[10px] font-black uppercase tracking-widest text-indigo-400 border border-indigo-500/30 px-5 py-2 rounded-full hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition">
                        Open Chat Center
                    </a>
                </div>
            @else
                @foreach($liveChatUsers as $cu)
                    <a href="{{ route('admin.chat.index') }}" class="chat-row">
                        <div class="chat-avatar">
                            {{ strtoupper(substr($cu['name'], 0, 1)) }}
                            @if($cu['is_online'])
                                <span class="chat-online-dot"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="chat-name">{{ $cu['name'] }}</div>
                            <div class="chat-preview">{{ $cu['message'] }}</div>
                        </div>
                        <div class="flex flex-col items-end gap-1.5">
                            @if($cu['unread'] > 0)
                                <div class="chat-unread-count">{{ $cu['unread'] }}</div>
                            @endif
                            <div class="chat-time">{{ $cu['time'] }}</div>
                        </div>
                    </a>
                @endforeach

                <a href="{{ route('admin.chat.index') }}"
                   class="mt-4 w-full flex items-center justify-center gap-2 py-3 rounded-2xl
                          bg-indigo-600/10 border border-indigo-500/20 text-indigo-400
                          text-[10px] font-black uppercase tracking-widest
                          hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Open Full Chat
                </a>
            @endif
        </div>
    </div>


    {{-- ── QUICK ACTIONS ── --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title"><i class="fa-solid fa-bolt-lightning"></i> Quick Actions</div>
        </div>
        <div class="actions-grid">
            <a href="{{ route('admin.products.create') }}" class="action-card">
                <div class="action-icon bg-red-500/10 text-red-500"><i class="fa-solid fa-plus-circle"></i></div>
                <span class="a-label">Add Product</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="action-card">
                <div class="action-icon bg-green-500/10 text-green-500"><i class="fa-solid fa-truck"></i></div>
                <span class="a-label">Manage Orders</span>
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="action-card">
                <div class="action-icon bg-purple-500/10 text-purple-400"><i class="fa-solid fa-calendar-check"></i></div>
                <span class="a-label">Appointments</span>
                @if($pendingAppointments > 0)
                    <span class="text-[9px] font-black text-purple-400 bg-purple-400/10 border border-purple-400/20 px-2 py-0.5 rounded-full">
                        {{ $pendingAppointments }} pending
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.chat.index') }}" class="action-card">
                <div class="action-icon bg-indigo-500/10 text-indigo-400"><i class="fa-solid fa-headset"></i></div>
                <span class="a-label">Live Chat</span>
                @if($totalUnreadMessages > 0)
                    <span class="text-[9px] font-black text-red-400 bg-red-400/10 border border-red-400/20 px-2 py-0.5 rounded-full">
                        {{ $totalUnreadMessages }} unread
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.users.index') }}" class="action-card">
                <div class="action-icon bg-indigo-500/10 text-indigo-400"><i class="fa-solid fa-users-gear"></i></div>
                <span class="a-label">Users</span>
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="action-card">
                <div class="action-icon bg-amber-500/10 text-amber-400"><i class="fa-solid fa-star"></i></div>
                <span class="a-label">Reviews</span>
                @if($pendingReviewsCount > 0)
                    <span class="text-[9px] font-black text-amber-400 bg-amber-400/10 border border-amber-400/20 px-2 py-0.5 rounded-full">
                        {{ $pendingReviewsCount }} pending
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="action-card">
                <div class="action-icon bg-green-500/10 text-green-400"><i class="fa-solid fa-envelope-open-text"></i></div>
                <span class="a-label">Contacts</span>
            </a>
            <a href="{{ route('admin.rentacar.index') }}" class="action-card">
                <div class="action-icon bg-red-500/10 text-red-400"><i class="fa-solid fa-car"></i></div>
                <span class="a-label">Rent a Car</span>
            </a>
        </div>
    </div>

</div>

<script>
// ── Live Clock ────────────────────────────────────────────────
function tick() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2,'0');
    const m = String(now.getMinutes()).padStart(2,'0');
    const s = String(now.getSeconds()).padStart(2,'0');
    const el = document.getElementById('liveTime');
    if (el) el.innerText = `${h}:${m}:${s}`;
}
tick();
setInterval(tick, 1000);

// ── GSAP Animations ───────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // Timeline for hero elements (immediate load)
    const tl = gsap.timeline();

    tl.from('.dash-header', { opacity: 0, y: -20, duration: 0.5, ease: 'power2.out' })
      .from('.kpi-card', {
        opacity: 0, y: 30, stagger: 0.05, duration: 0.6, ease: 'power2.out', clearProps: "all"
      }, "-=0.3")
      .from('.status-pill', {
        opacity: 0, y: 15, stagger: 0.04, duration: 0.5, ease: 'power2.out', clearProps: "all"
      }, "-=0.4");

    // Panels (Snap scroll triggered)
    gsap.utils.toArray('.panel').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: { 
                trigger: el, 
                start: 'top 95%', 
                toggleActions: 'play none none none' 
            },
            opacity: 0, y: 25, duration: 0.5, ease: 'power2.out', clearProps: "all"
        });
    });

    // KPI bar fills
    gsap.utils.toArray('.kpi-bar-fill, .top-prod-bar-fill').forEach(el => {
        const targetWidth = el.style.width;
        el.style.width = '0%';
        gsap.to(el, {
            scrollTrigger: { trigger: el, start: 'top 98%', toggleActions: 'play none none none' },
            width: targetWidth, duration: 1, ease: 'power3.out', delay: 0.1
        });
    });

    // Chart bars
    gsap.utils.toArray('.chart-bar').forEach((el, i) => {
        const targetH = el.style.height;
        el.style.height = '0px';
        gsap.to(el, { 
            height: targetH, 
            duration: 0.8, 
            ease: 'back.out(1.2)', 
            delay: i * 0.05 + 0.5 
        });
    });
});
</script>

@endsection