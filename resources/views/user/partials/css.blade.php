{{-- <link rel="stylesheet" href="{{ asset(FRONTEND_CSS_FOLDER_PATH.'libraries.css') }}">

<link rel="stylesheet" href="{{ mix(FRONTEND_CSS_FOLDER_PATH.'style.css') }}">

<link rel="stylesheet" href="{{ mix(FRONTEND_CSS_FOLDER_PATH.'responsive.css') }}"> --}}
<link rel="stylesheet" href="{{ mix(FRONTEND_CSS_FOLDER_PATH . 'style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset(FRONTEND_CSS_FOLDER_PATH . 'iziToast.css') }}">
</script>

<style>
    .modal {
        --bs-modal-margin: 1.75rem;
        --bs-modal-box-shadow: var(--bs-box-shadow);
        align-items: center;
        justify-items: center;
        margin-top: 97px !important;
        padding: 20px !important;
    }
    .modal .pop_close_btn_right{
        position: sticky;
        top: 0px;
        background-color: white;
        z-index: 99;
        padding: 32px 32px 10px 32px !important;
    }
    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        color: var(--bs-modal-color);
        pointer-events: auto;
        background-color: var(--bs-modal-bg);
        background-clip: padding-box;
        border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
        border-radius: var(--bs-modal-border-radius);
        outline: 0;
        max-height: 560px;
        overflow-y: auto;
    }
    .modal-body{
        padding: 0px 32px 32px 32px !important;
    }

    .modal-dialog {
        margin: auto;
    }

    .modal-dialog {
        position: relative;
        margin: auto;

        /* transform: translate(-50%, -50%); */
        margin: 0;
        /* remove Bootstrap's auto margin if needed */
    }

    /* Centered Copy Tooltip Styles */
    .copy-tooltip {
        position: fixed;
        top: 90%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 48px 48px;
        border-radius: 2px;
        font-size: 16px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        animation: copyTooltipBlink 0.6s ease-in-out;
    }

    .copy-tooltip-text {
        display: block;
        text-align: center;
    }

    @keyframes copyTooltipBlink {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.8);
        }
        50% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }
        100% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }
    .download-hide{
        display:none !important;
    }
    .download-show{
        display:block !important;
    }
</style>
