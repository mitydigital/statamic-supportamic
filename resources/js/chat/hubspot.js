import {onWidgetReady} from "../composables/useOnWidgetReady";

function openChat(event) {
    event.preventDefault();
    window.HubSpotConversations?.widget.open();
}

export default function () {

    //
    // Build the identity configuration for hubspot
    //
    let _hsq = window._hsq = window._hsq || [];

    let identity = {};

    if (window.StatamicConfig.supportamic.chat.identity.email) {
        identity.email = window.StatamicConfig.supportamic.chat.identity.email;
    }
    if (window.StatamicConfig.supportamic.chat.identity.name) {
        identity.name = window.StatamicConfig.supportamic.chat.identity.name;
    }

    _hsq.push(["identify", identity]);

    //
    // Include the hubspot javascript
    //
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = window.StatamicConfig.supportamic.chat.endpoint;
    document.head.appendChild(script);

    if (!window.HubSpotConversations) {
        window.hsConversationsOnReady = [() => onWidgetReady(openChat)];
    }

}
