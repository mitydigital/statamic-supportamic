import {onWidgetReady} from "../composables/useOnWidgetReady";

function openChat(event) {
    event.preventDefault();
    window.FreshworksWidget('open');
}

export default function () {

    let widget_id = window.StatamicConfig.supportamic.chat.endpoint.split('#')[0].split('?')[0].split('/').pop();

    window.fwSettings={
        'widget_id':widget_id.split('.')[0]
    };
    !function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}()

    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = window.StatamicConfig.supportamic.chat.endpoint;
    script.defer = true;
    script.onload = () => {
        onWidgetReady(openChat);

        window.FreshworksWidget('identify', 'ticketForm', {
            name: window.StatamicConfig.supportamic.chat.identity.name,
            email: window.StatamicConfig.supportamic.chat.identity.email,
        });
    };
    document.head.appendChild(script);

}
