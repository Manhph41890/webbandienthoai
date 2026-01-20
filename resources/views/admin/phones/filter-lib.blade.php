<style>
    :root {
        --adm-navy: #140000;
        --adm-accent: #ff4d6d;
        --adm-border: #e2e8f0;
    }

    .adm-fl-container {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 25px;
        border: 1px solid var(--adm-border);
    }

    /* Primary Row */
    .adm-fl-primary-row {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .adm-fl-search-box {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
    }

    .adm-fl-search-box i {
        position: absolute;
        left: 15px;
        color: #ffffff;
    }

    .adm-fl-search-box input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid var(--adm-border);
        border-radius: 10px;
        background: #f8fafc;
        outline: none;
        transition: 0.3s;
    }

    .adm-fl-search-box input:focus {
        border-color: var(--adm-accent);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255, 77, 109, 0.1);
    }

    .adm-fl-actions {
        display: flex;
        gap: 10px;
    }

    .adm-fl-toggle-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: #fff;
        border: 1px solid var(--adm-border);
        border-radius: 10px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        transition: 0.3s;
    }

    .adm-fl-toggle-btn:hover {
        background: #f1f5f9;
    }

    .adm-fl-toggle-btn.active {
        border-color: var(--adm-navy);
        color: var(--adm-navy);
    }

    .adm-fl-toggle-btn .chevron {
        transition: 0.3s;
        font-size: 12px;
    }

    .adm-fl-toggle-btn.active .chevron {
        transform: rotate(180deg);
    }

    .adm-fl-submit-btn {
        background: var(--adm-navy);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .adm-fl-submit-btn:hover {
        background: #2c3e50;
        transform: translateY(-1px);
    }

    /* Advanced Box (Thu vào/Kéo ra) */
    .adm-fl-advanced-box {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
    }

    .adm-fl-advanced-box.show {
        max-height: 500px;
        /* Độ cao tối đa khi mở */
        opacity: 1;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px dashed var(--adm-border);
    }

    /* Grid layout cho items */
    .adm-fl-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .adm-fl-item label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .adm-fl-item select,
    .adm-fl-item input {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--adm-border);
        border-radius: 8px;
        font-size: 14px;
        outline: none;
    }

    .adm-fl-range {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .adm-fl-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .adm-fl-reset {
        font-size: 13px;
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
    }

    .adm-fl-reset:hover {
        color: var(--adm-accent);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleAdvanced');
        const advancedBox = document.getElementById('advancedBox');

        // Kiểm tra nếu URL có chứa các tham số lọc (ngoại trừ search) thì tự động mở
        const urlParams = new URLSearchParams(window.location.search);
        const hasFilters = Array.from(urlParams.keys()).some(key => !['search', 'page'].includes(key));

        if (hasFilters) {
            toggleBtn.classList.add('active');
            advancedBox.classList.add('show');
        }

        toggleBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            advancedBox.classList.toggle('show');
        });
    });
</script>
