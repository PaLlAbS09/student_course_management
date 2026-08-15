<?php
include 'includes/auth_check.php';
include 'config/dbcon.php';
include 'includes/header.php';
include 'includes/nav.php';
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #0b0f19 !important;
        color: #d1d5db !important;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        padding-left: 280px;
    }

    .dashboard-frame {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 12px;
        padding: 32px;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
        position: relative;
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #8b5cf6;
        padding-left: 12px;
        margin-bottom: 24px;
    }

    .section-title-tag h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.4rem;
        text-transform: uppercase;
        margin: 0;
    }

    .section-title-tag p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0 0;
    }


    .form-box {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        padding: 24px;
        height: 100%;
    }

    .form-label {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control {
        background-color: #0f172a;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #0f172a;
        border-color: #8b5cf6;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(139, 92, 246, 0.2);
    }

    .form-control::placeholder {
        color: #475569;
    }

    .btn-publish {
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 12px 24px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        width: 100%;
    }

    .btn-publish:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
        color: #fff;
    }


    .table-custom {
        color: #d1d5db;
        border-collapse: separate;
        border-spacing: 0 8px;
        margin-top: 0;
    }

    .table-custom thead th {
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        border: none;
        padding: 0 16px 8px 16px;
    }

    .table-custom tbody tr {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease;
    }

    .table-custom tbody tr:hover {
        transform: translateY(-2px);
    }

    .table-custom tbody td {
        background-color: #131b2e !important;
        color: #f8fafc !important;
        border: 1px solid #1e2d4a;
        border-style: solid none;
        padding: 16px;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table-custom tbody td:first-child {
        border-left: 1px solid #1e2d4a;
        border-radius: 8px 0 0 8px;
    }

    .table-custom tbody td:last-child {
        border-right: 1px solid #1e2d4a;
        border-radius: 0 8px 8px 0;
    }

    .deleteBtn {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .deleteBtn:hover {
        background-color: #ef4444;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    .notice-date-badge {
        background-color: rgba(139, 92, 246, 0.15);
        color: #a78bfa;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid rgba(139, 92, 246, 0.3);
        white-space: nowrap;
    }
</style>

<div class="container-fluid px-4 mt-4">
    <div class="dashboard-frame">

        <div class="section-title-tag">
            <h2>Manage Notices</h2>
            <p>Publish announcements directly to the Student Portal</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-4">
                <div class="form-box">
                    <h5 class="text-white mb-4"><i class="bi bi-pencil-square me-2 text-purple" style="color: #a78bfa;"></i>Create Notice</h5>
                    <form id="addNoticeForm">
                        <input type="hidden" name="action" value="add">

                        <div class="mb-3">
                            <label class="form-label">Notice Title</label>
                            <input type="text" name="title" class="form-control"  required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Message Body</label>
                            <textarea name="body" class="form-control" rows="6"  required></textarea>
                        </div>

                        <button type="submit" class="btn btn-publish"><i class="bi bi-megaphone-fill me-2"></i>Publish Notice</button>
                    </form>
                </div>
            </div>


            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="noticeTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadNotices() {
        $.ajax({
            url: 'ajax/notices_ajax.php',
            type: 'POST',
            data: {
                action: 'fetch'
            },
            success: function(response) {
                $('#noticeTableBody').html(response);
            }
        });
    }

    $(document).ready(function() {
        loadNotices();

        $('#addNoticeForm').submit(function(e) {
            e.preventDefault();
            var btn = $(this).find('.btn-publish');
            btn.html('<i class="bi bi-hourglass-split me-2"></i>Publishing...');

            $.ajax({
                url: 'ajax/notices_ajax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        $('#addNoticeForm')[0].reset();
                        loadNotices();
                    } else {
                        alert('Error publishing notice.');
                    }
                    btn.html('<i class="bi bi-megaphone-fill me-2"></i>Publish Notice');
                }
            });
        });

        $(document).on('click', '.deleteBtn', function() {
            if (confirm("Delete this notice? It will be removed from all student dashboards immediately.")) {
                var id = $(this).data('id');
                $.ajax({
                    url: 'ajax/notices_ajax.php',
                    type: 'POST',
                    data: {
                        action: 'delete',
                        id: id
                    },
                    success: function() {
                        loadNotices();
                    }
                });
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>