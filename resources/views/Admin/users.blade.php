@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX USERS DIRECTORY - ULTRA-PREMIUM STYLES
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --primary-light: #f87171;
    --accent: #f97316;
    --dark: #030712;
    --darker: #000000;
    --card-bg: rgba(17, 24, 39, 0.7);
    --border: rgba(255, 255, 255, 0.05);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
}

/* ===== ANIMATIONS ===== */
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* ===== PAGE CONTAINER ===== */
.page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    animation: slideInUp 0.6s ease-out;
}

.page-header h1 {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.export-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    color: var(--text-secondary);
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    cursor: pointer;
}

.export-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
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
    padding: 1.5rem 2rem;
    font-size: 0.65rem;
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
    padding: 1.25rem 2rem;
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
    border-radius: 1rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    transition: all 0.3s;
}

tr:hover .user-avatar {
    transform: scale(1.1);
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
}

.user-id {
    font-size: 0.65rem;
    color: var(--text-muted);
    font-family: monospace;
}

/* Email */
.user-email {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.user-email i {
    color: var(--primary);
    font-size: 0.75rem;
}

/* Role Badge */
.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
}

.role-badge.admin {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--primary);
}

.role-badge.user {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: var(--success);
}

.role-badge i {
    font-size: 0.5rem;
}

/* Date */
.join-date {
    display: flex;
    flex-direction: column;
}

.date-main {
    font-weight: 700;
    color: white;
    font-size: 0.8rem;
}

.date-year {
    font-size: 0.65rem;
    color: var(--text-muted);
}

/* Action Button */
.action-btn {
    width: 2.5rem;
    height: 2.5rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    transition: all 0.3s;
    cursor: pointer;
    margin-left: auto;
}

.action-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(239, 68, 68, 0.1);
    transform: rotate(90deg);
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .premium-table {
        min-width: 800px;
    }
}
</style>

<!-- PAGE CONTAINER -->
<div class="page-container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1>USER <span>DIRECTORY</span></h1>
            <p>Manage access levels and monitor registered accounts</p>
        </div>
        <button class="export-btn" onclick="exportUsers()">
            <i class="fa-regular fa-file-excel"></i>
            Export CSV
        </button>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>User Info</th>
                        <th>Email Address</th>
                        <th>Access Level</th>
                        <th>Joined Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ $user->name }}</span>
                                    <span class="user-id">ID: #{{ $user->id }}</span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="user-email">
                                <i class="fa-regular fa-envelope"></i>
                                {{ $user->email }}
                            </div>
                        </td>

                        <td>
                            @if($user->role == 'admin')
                                <span class="role-badge admin">
                                    <i class="fa-regular fa-circle"></i>
                                    {{ $user->role }}
                                </span>
                            @else
                                <span class="role-badge user">
                                    <i class="fa-regular fa-circle"></i>
                                    {{ $user->role }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="join-date">
                                <span class="date-main">{{ $user->created_at->format('d M') }}</span>
                                <span class="date-year">{{ $user->created_at->format('Y') }}</span>
                            </div>
                        </td>

                        <td class="text-right">
                            <button class="action-btn" onclick="viewUser({{ $user->id }})">
                                <i class="fa-regular fa-ellipsis-vertical"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Export users to CSV
function exportUsers() {
    const rows = document.querySelectorAll('.premium-table tbody tr');
    const headers = ['ID', 'Name', 'Email', 'Role', 'Joined Date'];
    
    let csv = headers.join(',') + '\n';
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowData = [];
        
        // ID from user-id span
        const userId = cells[0]?.querySelector('.user-id')?.textContent.replace('ID: #', '') || '';
        rowData.push(userId);
        
        // Name
        const userName = cells[0]?.querySelector('.user-name')?.textContent || '';
        rowData.push(`"${userName}"`);
        
        // Email
        const email = cells[1]?.querySelector('.user-email')?.textContent.trim() || '';
        rowData.push(`"${email}"`);
        
        // Role
        const role = cells[2]?.querySelector('.role-badge')?.textContent.trim() || '';
        rowData.push(`"${role}"`);
        
        // Date
        const date = cells[3]?.querySelector('.date-main')?.textContent + ' ' + cells[3]?.querySelector('.date-year')?.textContent || '';
        rowData.push(`"${date}"`);
        
        csv += rowData.join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'users_export.csv';
    a.click();
}

// View user details (placeholder)
function viewUser(id) {
    alert('View user ' + id + ' - Feature coming soon!');
}
</script>
@endsection