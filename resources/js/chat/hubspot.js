function openChat(event) {
    event.preventDefault();
    window.HubSpotConversations?.widget.open();
}

function onConversationsAPIReady() {
    // do we have any chat triggers
    let triggers = document.getElementsByClassName('supportamic-chat-trigger');
    for (let i = 0; i < triggers.length; i++) {
        triggers[i].addEventListener("click", openChat);

        // remove disabled state
        triggers[i].classList.remove('disabled');
        triggers[i].removeAttribute('disabled');
    }
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
        window.hsConversationsOnReady = [onConversationsAPIReady];
    }

}
