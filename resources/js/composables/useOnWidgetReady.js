export function onWidgetReady(callback) {
    // do we have any chat triggers

    let triggers = document.getElementsByClassName('supportamic-chat-trigger');
    for (let i = 0; i < triggers.length; i++) {
        triggers[i].addEventListener("click", (event) => callback(event));

        // remove disabled state
        triggers[i].classList.remove('disabled');
        triggers[i].removeAttribute('disabled');
    }
}