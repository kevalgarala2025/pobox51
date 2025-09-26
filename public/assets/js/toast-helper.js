//  General Toast Helper
//  Provides consistent toast notifications across the application
//  Usage: ToastHelper.success('Message', 'Title', {position: 'topRight'}),
//  ToastHelper.error('Message', 'Title', {position: 'bottomRight'}), etc.
//

class ToastHelper {
    // Base configuration for all toasts

    static baseConfig = {
        position: 'bottomRight', // Default position is bottom right
        timeout: 3000,
        close: true,
        closeOnClick: true,
        closeOnEscape: true,
        icon: ''
    };

    // Handle toast positioning based on position option
    static handleToastPosition(toast, position = 'bottomRight') {
        const toastWrapper = toast.closest('.iziToast-wrapper');
        if (toastWrapper) {
            let positionStyle = '';

            // Set position based on the position option
            if (position === 'topRight') {
                positionStyle = `
                    position: fixed !important;
                    top: 10px !important;
                    right: 10px !important;
                    bottom: auto !important;
                `;
            } else {
                // Default to bottomRight
                positionStyle = `
                    position: fixed !important;
                    bottom: 10px !important;
                    right: 10px !important;
                    top: auto !important;
                `;
            }

            toastWrapper.style.cssText = `
                ${positionStyle}
                z-index: 9999 !important;
                pointer-events: none !important;
            `;
            toast.style.pointerEvents = 'auto';
        }
    }

    // Apply common toast styling
    static applyBaseStyles(toast, backgroundColor, borderColor, textColor) {
        toast.style.cssText = `
            background-color: ${backgroundColor} !important;
            border-left: 4px solid ${borderColor} !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 16px 45px 16px 50px !important;
            min-height: 60px !important;
            max-width: 400px !important;
            width: auto !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            position: relative !important;
        `;

        // Style title
        const title = toast.querySelector('.iziToast-title');
        if (title) {
            title.style.cssText = `
                color: ${textColor} !important;
                font-size: 16px !important;
                font-weight: 600 !important;
                margin: 0 0 4px 0 !important;
                line-height: 1.2 !important;
                width: 100% !important;
            `;
        }

        // Style message
        const message = toast.querySelector('.iziToast-message');
        if (message) {
            message.style.cssText = `
                color: ${textColor} !important;
                font-size: 14px !important;
                line-height: 1.4 !important;
                margin: 0 !important;
                opacity: 0.85 !important;
                width: 100% !important;

            `;
        }

        // Style close button
        const closeBtn = toast.querySelector('.iziToast-close');
        if (closeBtn) {
            closeBtn.style.cssText = `
                position: absolute !important;
                right: 12px !important;
                top: 12px !important;
                width: 20px !important;
                height: 20px !important;
                color: ${textColor} !important;
                font-size: 18px !important;
                font-weight: bold !important;
                cursor: pointer !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                opacity: 0.7 !important;
                transition: opacity 0.2s !important;
            `;
            closeBtn.innerHTML = '×';
            closeBtn.addEventListener('mouseenter', () => closeBtn.style.opacity = '1');
            closeBtn.addEventListener('mouseleave', () => closeBtn.style.opacity = '0.7');
        }
    }

    // Add icon to toast
    static addIcon(toast, icon, iconBgColor) {
        const iconDiv = document.createElement('div');
        iconDiv.innerHTML = icon;
        iconDiv.style.cssText = `
            position: absolute !important;
            left: 16px !important;
            top: 16px !important;
            width: 20px !important;
            height: 20px !important;
            background-color: ${iconBgColor} !important;
            color: white !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 12px !important;
            font-weight: bold !important;
        `;
        toast.prepend(iconDiv);
    }

    // Success toast notification
    static success(message, title = '', options = {}) {
        const config = {
            ...this.baseConfig,
            ...options,
            title: title,
            message: message,
            class: 'custom-success-toast',
            onOpening: function(instance, toast) {
                const position = options.position || ToastHelper.baseConfig.position;
                ToastHelper.handleToastPosition(toast, position);
                ToastHelper.applyBaseStyles(toast, '#d1f2eb', '#28a745', '#155724');
                ToastHelper.addIcon(toast, '✓', '#28a745');
            }
        };

        iziToast.success(config);
    }

    // Error toast notification
    static error(message, title = '', options = {}) {
        const config = {
            ...this.baseConfig,
            ...options,
            title: title,
            message: message,
            timeout: false, // Error toasts don't auto-close
            class: 'custom-error-toast',
            onOpening: function(instance, toast) {
                const position = options.position || ToastHelper.baseConfig.position;
                ToastHelper.handleToastPosition(toast, position);
                ToastHelper.applyBaseStyles(toast, '#f8d7da', '#dc3545', '#721c24');
                ToastHelper.addIcon(toast, '×', '#dc3545');
            }
        };

        iziToast.error(config);
    }

    // Info toast notification
    static info(message, title = '', options = {}) {
        const config = {
            ...this.baseConfig,
            ...options,
            title: title,
            message: message,
            class: 'custom-info-toast',
            onOpening: function(instance, toast) {
                const position = options.position || ToastHelper.baseConfig.position;
                ToastHelper.handleToastPosition(toast, position);
                ToastHelper.applyBaseStyles(toast, '#d1ecf1', '#17a2b8', '#0c5460');
                ToastHelper.addIcon(toast, 'i', '#17a2b8');
            }
        };

        iziToast.info(config);
    }

    // Warning toast notification
    static warning(message, title = '', options = {}) {
        const config = {
            ...this.baseConfig,
            ...options,
            title: title,
            message: message,
            class: 'custom-warning-toast',
            onOpening: function(instance, toast) {
                const position = options.position || ToastHelper.baseConfig.position;
                ToastHelper.handleToastPosition(toast, position);
                ToastHelper.applyBaseStyles(toast, '#fff3cd', '#ffc107', '#856404');
                ToastHelper.addIcon(toast, '!', '#ffc107');
            }
        };

        iziToast.warning(config);
    }

    // Custom toast notification with custom colors
    static custom(message, title, backgroundColor, borderColor, textColor, icon, iconBgColor, options = {}) {
        const config = {
            ...this.baseConfig,
            ...options,
            title: title,
            message: message,
            class: 'custom-toast',
            onOpening: function(instance, toast) {
                const position = options.position || ToastHelper.baseConfig.position;
                ToastHelper.handleToastPosition(toast, position);
                ToastHelper.applyBaseStyles(toast, backgroundColor, borderColor, textColor);
                if (icon) {
                    ToastHelper.addIcon(toast, icon, iconBgColor);
                }
            }
        };

        iziToast.show(config);
    }
}

// Make it available globally
window.ToastHelper = ToastHelper;

// End of toast-helper.js
