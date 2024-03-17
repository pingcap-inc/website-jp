export function getCookie(name) {
    const result = document.cookie.match(new RegExp(name + "=([^;]+)"));
    return result ? result[1] : "";
}
