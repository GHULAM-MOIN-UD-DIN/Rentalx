@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX REVIEWS MANAGEMENT - ULTRA-PREMIUM STYLES
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --primary-light: #f87171;
    --accent: #f97316;
    --dark: #030712;
    --darker: #000000;
    --bg: #0a0a0a;
    --card-bg: rgba(17, 24, 39, 0.7);
    --card-bg-hover: rgba(17, 24, 39, 0.8);
    --border: rgba(255, 255, 255, 0.05);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    --shadow-primary: 0 20px 30px -10px rgba(239, 68, 68, 0.3);
    --shadow-primary-lg: 0 25px 50px -12px rgba(239, 68, 68, 0.5);
    --glow: 0 0 20px rgba(239, 68, 68, 0.3);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== ANIMATIONS ===== */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ===== PAGE CONTAINER ===== */
.page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.space-y-8 > * + * {
    margin-top: 2rem;
}

/* ===== HEADER SECTION ===== */
.page-header {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    animation: slideInUp 0.6s ease-out;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 70% 30%, rgba(239, 68, 68, 0.1), transparent 70%);
    animation: rotate 20s linear infinite;
}

@media (min-width: 640px) {
    .page-header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.header-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-primary);
    animation: float 3s ease-in-out infinite;
}

.header-icon i {
    color: white;
    font-size: 1.25rem;
}

.page-header h1 {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.02em;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.page-header p i {
    color: var(--primary);
}

.date-badge {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 0.75rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.date-badge i {
    color: var(--primary);
    font-size: 0.875rem;
}

.date-badge span {
    color: var(--text-secondary);
    font-size: 0.75rem;
    font-weight: 700;
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

@media (min-width: 640px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.stat-card {
    border-radius: 1.5rem;
    padding: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: slideInUp 0.5s ease-out;
    animation-fill-mode: both;
    position: relative;
    overflow: hidden;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.2s; }

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-primary-lg);
}

.stat-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-card.total {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
}

.stat-card.pending {
    background: linear-gradient(135deg, #f97316, #ea580c);
}

.stat-card.approved {
    background: linear-gradient(135deg, #10b981, #059669);
}

.stat-card.rejected {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.stat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.stat-icon {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.75rem;
    border-radius: 1rem;
}

.stat-icon i {
    color: white;
    font-size: 1.25rem;
}

.stat-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.35rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
    color: white;
}

.stat-title {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
}

.stat-value-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: white;
    line-height: 1;
}

.stat-percent {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.8rem;
    font-weight: 600;
}

.stat-progress {
    height: 0.375rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 1rem;
    overflow: hidden;
}

.stat-progress-bar {
    height: 100%;
    background: white;
    border-radius: 1rem;
    transition: width 1s ease;
}

/* ===== TABLE CARD ===== */
.table-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    overflow: hidden;
    animation: scaleIn 0.6s ease-out;
}

.table-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background: rgba(0, 0, 0, 0.2);
}

@media (min-width: 640px) {
    .table-header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.table-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.table-title-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-title-icon i {
    color: var(--primary);
    font-size: 1rem;
}

.table-title h2 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
}

.table-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.status-filter {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.6rem 2rem 0.6rem 1rem;
    color: white;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    min-width: 140px;
}

.status-filter:focus {
    outline: none;
    border-color: var(--primary);
}

.refresh-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.6rem 1.25rem;
    color: var(--text-secondary);
    font-size: 0.8rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    cursor: pointer;
}

.refresh-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

/* ===== TABLE ===== */
.table-responsive {
    overflow-x: auto;
}

.premium-table {
    width: 100%;
    border-collapse: collapse;
}

.premium-table thead tr {
    background: rgba(0, 0, 0, 0.2);
    border-bottom: 1px solid var(--border);
}

.premium-table th {
    padding: 1rem 1.5rem;
    font-size: 0.6rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-align: left;
}

.premium-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: all 0.3s;
}

.premium-table tbody tr:hover {
    background: rgba(239, 68, 68, 0.05);
}

.premium-table td {
    padding: 1rem 1.5rem;
    color: var(--text-primary);
    font-size: 0.875rem;
}

/* User Info */
.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 3rem;
    height: 3rem;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    color: var(--primary);
    transition: all 0.3s;
}

tr:hover .user-avatar {
    background: rgba(239, 68, 68, 0.2);
    transform: scale(1.1);
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 700;
    color: white;
    margin-bottom: 0.15rem;
}

.user-email {
    font-size: 0.65rem;
    color: var(--text-muted);
}

/* Product Info */
.product-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.product-image {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    object-fit: cover;
    border: 1px solid var(--border);
}

.product-image-placeholder {
    width: 3rem;
    height: 3rem;
    background: rgba(255,255,255,0.03);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image-placeholder i {
    color: var(--text-muted);
    font-size: 1rem;
}

.product-badge {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.35rem 1rem;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--text-secondary);
}

/* Rating Stars */
.rating-stars {
    display: flex;
    align-items: center;
    gap: 0.15rem;
}

.rating-stars i {
    color: #fbbf24;
    font-size: 0.75rem;
}

.rating-value {
    margin-left: 0.5rem;
    font-size: 0.7rem;
    color: var(--text-secondary);
}

/* Comment */
.comment-cell {
    max-width: 250px;
}

.comment-text {
    color: var(--text-secondary);
    font-size: 0.8rem;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0.35rem;
}

.review-title-badge {
    display: inline-block;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--primary);
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.6rem;
    font-weight: 700;
    margin-bottom: 0.35rem;
}

.image-count {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.6rem;
    color: var(--text-muted);
    margin-top: 0.35rem;
}

.image-count i {
    color: var(--primary);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    color: #f59e0b;
}

.status-badge.approved {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.status-badge.rejected {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

/* Action Buttons */
.action-group {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.action-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    color: var(--text-secondary);
    font-size: 0.7rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.action-btn.approve {
    background: rgba(16, 185, 129, 0.1);
    border-color: rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.action-btn.approve:hover {
    background: #10b981;
    color: white;
}

.action-btn.reject {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.action-btn.reject:hover {
    background: #ef4444;
    color: white;
}

.action-btn.view {
    background: rgba(59, 130, 246, 0.1);
    border-color: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.action-btn.view:hover {
    background: #3b82f6;
    color: white;
}

.action-btn.delete {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.action-btn.delete:hover {
    background: #ef4444;
    color: white;
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-icon {
    width: 5rem;
    height: 5rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--text-muted);
    font-size: 2rem;
}

.empty-state h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* Pagination */
.pagination-wrapper {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    background: rgba(0, 0, 0, 0.2);
}

@media (min-width: 640px) {
    .pagination-wrapper {
        flex-direction: row;
        justify-content: space-between;
    }
}

.pagination-info {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.pagination-info strong {
    color: white;
    font-weight: 800;
}

.pagination-links {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.pagination-links .page-link {
    display: block;
    padding: 0.5rem 0.9rem;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.pagination-links .page-link:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(239, 68, 68, 0.1);
}

.pagination-links .page-link.active {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
    box-shadow: var(--shadow-primary);
}

/* ===== MODALS ===== */
.modal-premium {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    overflow-y: auto;
}

.modal-premium.show {
    display: block;
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
}

.modal-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 1rem;
}

.modal-content {
    position: relative;
    background: var(--card-bg);
    backdrop-filter: blur(30px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    max-width: 32rem;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    animation: scaleIn 0.3s ease-out;
    box-shadow: var(--shadow-2xl);
}

.modal-content.large {
    max-width: 48rem;
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    background: var(--card-bg);
    backdrop-filter: blur(30px);
    z-index: 10;
}

.modal-header h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
}

.modal-close {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.3s;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.modal-close:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

/* Form Elements */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
}

.form-textarea {
    width: 100%;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem;
    color: white;
    font-size: 0.875rem;
    resize: vertical;
    min-height: 100px;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Review Detail */
.review-detail-user {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.review-detail-avatar {
    width: 4rem;
    height: 4rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 900;
    font-size: 1.5rem;
}

.review-detail-meta {
    flex: 1;
}

.review-detail-name {
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.25rem;
}

.review-detail-date {
    font-size: 0.75rem;
    color: var(--text-muted);
}

.review-detail-content {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 1.5rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.review-detail-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-bottom: 1rem;
}

.review-detail-rating i {
    color: #fbbf24;
    font-size: 1rem;
}

.review-detail-title {
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    margin-bottom: 1rem;
}

.review-detail-text {
    color: var(--text-secondary);
    line-height: 1.7;
    font-size: 0.95rem;
}

.review-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.review-detail-pros, .review-detail-cons {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 1rem;
    padding: 1rem;
}

.review-detail-pros h4, .review-detail-cons h4 {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.review-detail-pros h4 {
    color: #10b981;
}

.review-detail-cons h4 {
    color: #ef4444;
}

.review-detail-pros ul, .review-detail-cons ul {
    list-style: none;
    padding: 0;
}

.review-detail-pros li, .review-detail-cons li {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.review-detail-pros li i {
    color: #10b981;
    font-size: 0.7rem;
    margin-top: 0.15rem;
}

.review-detail-cons li i {
    color: #ef4444;
    font-size: 0.7rem;
    margin-top: 0.15rem;
}

.review-detail-images {
    margin-top: 1rem;
}

.review-detail-images h4 {
    font-size: 0.7rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}

.review-image-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.75rem;
}

.review-image-item {
    aspect-ratio: 1;
    border-radius: 0.75rem;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
}

.review-image-item:hover {
    transform: scale(1.05);
    border-color: var(--primary);
}

.review-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Modal Buttons */
.modal-btn {
    padding: 0.6rem 1.5rem;
    border-radius: 2rem;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    border: none;
}

.modal-btn.cancel {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text-secondary);
}

.modal-btn.cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

.modal-btn.delete {
    background: linear-gradient(135deg, var(--danger), var(--primary-dark));
    color: white;
    box-shadow: var(--shadow-primary);
}

.modal-btn.delete:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary-lg);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
}

::-webkit-scrollbar-thumb {
    background: rgba(239, 68, 68, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(239, 68, 68, 0.5);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .page-container {
        padding: 0 1rem;
    }
    
    .page-header h1 {
        font-size: 1.75rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .review-detail-grid {
        grid-template-columns: 1fr;
    }
    
    .review-image-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .action-group {
        justify-content: flex-start;
    }
}

@media (max-width: 640px) {
    .premium-table thead {
        display: none;
    }
    
    .premium-table tbody tr {
        display: block;
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    
    .premium-table tbody td {
        display: flex;
        padding: 0.5rem 0;
        border: none;
        align-items: center;
        gap: 0.5rem;
    }
    
    .premium-table tbody td::before {
        content: attr(data-label);
        font-weight: 700;
        min-width: 100px;
        color: var(--text-secondary);
        font-size: 0.7rem;
        text-transform: uppercase;
    }
    
    .user-info {
        width: 100%;
    }
    
    .product-info {
        width: 100%;
    }
    
    .rating-stars {
        width: 100%;
    }
    
    .action-group {
        width: 100%;
        justify-content: flex-start;
    }
}
</style>

<!-- PAGE CONTAINER -->
<div class="page-container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div style="display: flex; align-items: center; gap: 1rem; position: relative; z-index: 10;">
            <div class="header-icon">
                <i class="fa-regular fa-star"></i>
            </div>
            <div>
                <h1>REVIEWS <span>MANAGEMENT</span></h1>
                <p>
                    <i class="fa-regular fa-circle-check"></i>
                    Manage customer feedback and product ratings efficiently
                </p>
            </div>
        </div>
        <div class="date-badge">
            <i class="fa-regular fa-calendar"></i>
            <span>Last updated: {{ now()->format('d M, Y') }}</span>
        </div>
    </div>

    @php
        if (!isset($stats)) {
            $stats = [
                'total' => \App\Models\Review::count(),
                'pending' => \App\Models\Review::where('status', 'pending')->count(),
                'approved' => \App\Models\Review::where('status', 'approved')->count(),
                'rejected' => \App\Models\Review::where('status', 'rejected')->count()
            ];
        }
        $total = max($stats['total'], 1);
    @endphp

    <!-- STATISTICS CARDS -->
    <div class="stats-grid">
        <!-- Total Reviews -->
        <div class="stat-card total">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-regular fa-message"></i>
                </div>
                <span class="stat-badge">Total</span>
            </div>
            <div class="stat-title">TOTAL REVIEWS</div>
            <div class="stat-value-row">
                <span class="stat-number">{{ number_format($stats['total']) }}</span>
                <span class="stat-percent">100%</span>
            </div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 100%"></div>
            </div>
        </div>

        <!-- Pending Reviews -->
        <div class="stat-card pending">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <span class="stat-badge">Pending</span>
            </div>
            <div class="stat-title">PENDING REVIEWS</div>
            <div class="stat-value-row">
                <span class="stat-number">{{ number_format($stats['pending']) }}</span>
                <span class="stat-percent">{{ round(($stats['pending'] / $total) * 100) }}%</span>
            </div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($stats['pending'] / $total) * 100 }}%"></div>
            </div>
        </div>

        <!-- Approved Reviews -->
        <div class="stat-card approved">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <span class="stat-badge">Approved</span>
            </div>
            <div class="stat-title">APPROVED REVIEWS</div>
            <div class="stat-value-row">
                <span class="stat-number">{{ number_format($stats['approved']) }}</span>
                <span class="stat-percent">{{ round(($stats['approved'] / $total) * 100) }}%</span>
            </div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($stats['approved'] / $total) * 100 }}%"></div>
            </div>
        </div>

        <!-- Rejected Reviews -->
        <div class="stat-card rejected">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-regular fa-circle-xmark"></i>
                </div>
                <span class="stat-badge">Rejected</span>
            </div>
            <div class="stat-title">REJECTED REVIEWS</div>
            <div class="stat-value-row">
                <span class="stat-number">{{ number_format($stats['rejected']) }}</span>
                <span class="stat-percent">{{ round(($stats['rejected'] / $total) * 100) }}%</span>
            </div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($stats['rejected'] / $total) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-header">
            <div class="table-title">
                <div class="table-title-icon">
                    <i class="fa-regular fa-star"></i>
                </div>
                <h2>Recent Reviews</h2>
            </div>
            <div class="table-actions">
                <form action="{{ route('admin.reviews.index') }}" method="GET">
                    <select name="status" onchange="this.form.submit()" class="status-filter">
                        <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                    </select>
                </form>
                <button onclick="window.location.reload()" class="refresh-btn">
                    <i class="fa-regular fa-rotate-right"></i>
                    Refresh
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        @php
                            $pros = is_string($review->pros) ? json_decode($review->pros, true) : $review->pros;
                            $cons = is_string($review->cons) ? json_decode($review->cons, true) : $review->cons;
                            $reviewImages = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                            $pros = is_array($pros) ? $pros : [];
                            $cons = is_array($cons) ? $cons : [];
                            $reviewImages = is_array($reviewImages) ? $reviewImages : [];
                        @endphp
                        <tr>
                            <td data-label="User">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <span class="user-name">{{ $review->user->name ?? 'Unknown User' }}</span>
                                        <span class="user-email">{{ $review->user->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>

                            <td data-label="Product">
                                <div class="product-info">
                                    @if($review->product && isset($review->product->image))
                                        <img src="{{ asset('products/' . $review->product->image) }}" alt="" class="product-image">
                                    @else
                                        <div class="product-image-placeholder">
                                            <i class="fa-regular fa-box"></i>
                                        </div>
                                    @endif
                                    <span class="product-badge">
                                        {{ Str::limit($review->product->name ?? 'Unknown', 15) }}
                                    </span>
                                </div>
                            </td>

                            <td data-label="Rating">
                                <div class="rating-stars">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fa{{ $i <= ($review->rating ?? 0) ? '-solid' : '-regular' }} fa-star"></i>
                                    @endfor
                                    <span class="rating-value">({{ $review->rating ?? 0 }}/5)</span>
                                </div>
                            </td>

                            <td data-label="Comment" class="comment-cell">
                                @if($review->title)
                                    <span class="review-title-badge">{{ Str::limit($review->title, 20) }}</span>
                                @endif
                                <div class="comment-text" title="{{ $review->comment }}">
                                    {{ Str::limit($review->comment ?? 'No comment', 50) }}
                                </div>
                                @if(count($reviewImages) > 0)
                                    <div class="image-count">
                                        <i class="fa-regular fa-images"></i>
                                        <span>{{ count($reviewImages) }} {{ Str::plural('photo', count($reviewImages)) }}</span>
                                    </div>
                                @endif
                            </td>

                            <td data-label="Status">
                                @if($review->status == 'pending')
                                    <span class="status-badge pending">
                                        <i class="fa-regular fa-clock"></i>
                                        Pending
                                    </span>
                                @elseif($review->status == 'approved')
                                    <span class="status-badge approved">
                                        <i class="fa-regular fa-circle-check"></i>
                                        Approved
                                    </span>
                                @else
                                    <span class="status-badge rejected">
                                        <i class="fa-regular fa-circle-xmark"></i>
                                        Rejected
                                    </span>
                                @endif
                            </td>

                            <td data-label="Actions">
                                <div class="action-group">
                                    @if($review->status == 'pending')
                                        <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="approve-form" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn approve" title="Approve Review">
                                                <i class="fa-regular fa-circle-check"></i>
                                                <span>Approve</span>
                                            </button>
                                        </form>

                                        <button type="button" onclick="showRejectModal({{ $review->id }})" class="action-btn reject" title="Reject Review">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                            <span>Reject</span>
                                        </button>
                                    @endif

                                    <button type="button" onclick="openViewModal({{ $review->id }})" class="action-btn view" title="View Details">
                                        <i class="fa-regular fa-eye"></i>
                                        <span>View</span>
                                    </button>

                                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" class="delete-form" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete Review">
                                            <i class="fa-regular fa-trash-can"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <div class="empty-icon">
                                    <i class="fa-regular fa-message"></i>
                                </div>
                                <h3>No Reviews Found</h3>
                                <p>There are no reviews in this category yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        @if(isset($reviews) && $reviews->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing <strong>{{ $reviews->firstItem() ?? 0 }}</strong> 
                to <strong>{{ $reviews->lastItem() ?? 0 }}</strong> 
                of <strong>{{ $reviews->total() }}</strong> reviews
            </div>
            <div class="pagination-links">
                {{ $reviews->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- REJECT MODAL -->
<div id="rejectModal" class="modal-premium">
    <div class="modal-overlay" onclick="closeRejectModal()"></div>
    <div class="modal-container">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Reject Review</h3>
                <button class="modal-close" onclick="closeRejectModal()">
                    <i class="fa-regular fa-xmark"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Rejection Reason (Optional)</label>
                        <textarea name="reason" class="form-textarea" placeholder="Enter reason for rejection..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn cancel" onclick="closeRejectModal()">Cancel</button>
                    <button type="submit" class="modal-btn delete">Reject Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- VIEW MODALS -->
@foreach($reviews as $review)
    @php
        $pros = is_string($review->pros) ? json_decode($review->pros, true) : $review->pros;
        $cons = is_string($review->cons) ? json_decode($review->cons, true) : $review->cons;
        $reviewImages = is_string($review->images) ? json_decode($review->images, true) : $review->images;
        $pros = is_array($pros) ? $pros : [];
        $cons = is_array($cons) ? $cons : [];
        $reviewImages = is_array($reviewImages) ? $reviewImages : [];
    @endphp
    <div id="viewReviewModal{{ $review->id }}" class="modal-premium">
        <div class="modal-overlay" onclick="closeViewModal({{ $review->id }})"></div>
        <div class="modal-container">
            <div class="modal-content large">
                <div class="modal-header">
                    <h3>Review Details</h3>
                    <button class="modal-close" onclick="closeViewModal({{ $review->id }})">
                        <i class="fa-regular fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- User Info -->
                    <div class="review-detail-user">
                        <div class="review-detail-avatar">
                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="review-detail-meta">
                            <div class="review-detail-name">{{ $review->user->name ?? 'Unknown User' }}</div>
                            <div class="review-detail-date">{{ $review->created_at ? $review->created_at->format('M d, Y h:i A') : 'N/A' }}</div>
                        </div>
                    </div>

                    <!-- Rating & Review -->
                    <div class="review-detail-content">
                        <div class="review-detail-rating">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa{{ $i <= ($review->rating ?? 0) ? '-solid' : '-regular' }} fa-star"></i>
                            @endfor
                        </div>
                        @if($review->title)
                            <div class="review-detail-title">{{ $review->title }}</div>
                        @endif
                        <div class="review-detail-text">{{ $review->comment ?? 'No comment provided' }}</div>
                    </div>

                    <!-- Pros & Cons -->
                    @if(count($pros) > 0 || count($cons) > 0)
                    <div class="review-detail-grid">
                        @if(count($pros) > 0)
                        <div class="review-detail-pros">
                            <h4><i class="fa-regular fa-circle-check"></i> PROS</h4>
                            <ul>
                                @foreach($pros as $pro)
                                    @if($pro)
                                        <li><i class="fa-regular fa-circle-check"></i> {{ $pro }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(count($cons) > 0)
                        <div class="review-detail-cons">
                            <h4><i class="fa-regular fa-circle-xmark"></i> CONS</h4>
                            <ul>
                                @foreach($cons as $con)
                                    @if($con)
                                        <li><i class="fa-regular fa-circle-xmark"></i> {{ $con }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Images -->
                    @if(count($reviewImages) > 0)
                    <div class="review-detail-images">
                        <h4>ATTACHED IMAGES</h4>
                        <div class="review-image-grid">
                            @foreach($reviewImages as $image)
                                @if($image)
                                    <div class="review-image-item" onclick="window.open('{{ asset('uploads/reviews/' . $image) }}')">
                                        <img src="{{ asset('uploads/reviews/' . $image) }}" alt="Review Image">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn cancel" onclick="closeViewModal({{ $review->id }})">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ===== APPROVE FORM HANDLER =====
document.querySelectorAll('.approve-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Approve Review?',
            text: "This review will be visible to all users!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel',
            background: '#1f2937',
            color: '#fff',
            customClass: {
                popup: 'rounded-2xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// ===== DELETE FORM HANDLER =====
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Delete Review?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: '#1f2937',
            color: '#fff',
            customClass: {
                popup: 'rounded-2xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// ===== REJECT MODAL FUNCTIONS =====
function showRejectModal(reviewId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    
    // FIXED: Correct URL formation
    const baseUrl = "{{ url('/') }}";
    form.action = baseUrl + "/admin/reviews/" + reviewId + "/reject";
    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// ===== VIEW MODAL FUNCTIONS =====
function openViewModal(reviewId) {
    const modal = document.getElementById('viewReviewModal' + reviewId);
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function closeViewModal(reviewId) {
    const modal = document.getElementById('viewReviewModal' + reviewId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// ===== CLOSE MODALS WITH ESCAPE KEY =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
        @foreach($reviews as $review)
            closeViewModal({{ $review->id }});
        @endforeach
    }
});

// ===== SUCCESS/ERROR MESSAGES =====
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#ef4444',
        background: '#1f2937',
        color: '#fff',
        customClass: {
            popup: 'rounded-2xl'
        },
        timer: 3000
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#ef4444',
        background: '#1f2937',
        color: '#fff',
        customClass: {
            popup: 'rounded-2xl'
        }
    });
@endif

@if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: '{{ session('info') }}',
        confirmButtonColor: '#ef4444',
        background: '#1f2937',
        color: '#fff',
        customClass: {
            popup: 'rounded-2xl'
        }
    });
@endif
</script>
@endsection