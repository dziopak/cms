export const removeNode = el => {
    el.addClass("bg-danger text-white");
    el.fadeOut(300);
    setTimeout(() => {
        el.remove();
    }, 300);
};
