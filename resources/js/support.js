import initHubspotChat from './chat/hubspot.js';

let chatType = window?.StatamicConfig?.supportamic?.chat.type;

if (chatType === 'hubspot') {
    initHubspotChat()
}

//
// Could be extended with a different chat setup. But we're with Hubspot for now.
//
